<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MenuController extends Controller
{
    public function index(): \Inertia\Response
    {
        if (\request()->new) {
            $menuEdit = [
                'roles' => Role::pluck('name'),
                'permissions' => Permission::pluck('name'),
                'parentMenus' => Menu::where('parent_id', null)->get(),
                'menu' => new Menu()
            ];
        } else {
            $menuEdit = [];
        }
        return Inertia::render('Admin/Menu/Index', [
            'menus' => Menu::with(['children'])->whereNull('parent_id')->orderBy('sort')->get(),
            'menuEdit' => $menuEdit
        ]);
    }

    public function edit(int $id): \Inertia\Response
    {
        $menu = Menu::where('id', $id)->firstOrFail();
        $roles = Role::pluck('name');
        $permissions = Permission::pluck('name');
        $parentMenus = Menu::where('parent_id', null)->where('id', '!=', $id)->get();
        return Inertia::render('Admin/Menu/Index', [
            'menuEdit' => [
                'roles' => $roles,
                'permissions' => $permissions,
                'parentMenus' => $parentMenus,
                'menu' => $menu
            ]
        ]);
    }

    public function store(Request $request, $id = null): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'sort' => 'nullable|numeric',
            'name' => 'required|string',
            'route_name' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && !\Route::has($value)) {
                        $fail('The route name is not valid');
                    }
                }
            ],
            'active_component' => 'nullable|string',
            'url' => 'nullable|string',
            'permissions' => 'nullable|array',
            'roles' => 'nullable|array',
            'icon_svg' => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
        ]);
        if ($id) {
            $menu = Menu::find($id);
            $menu->update($validated);
        } else {
            $menu = Menu::create($validated);
        }
        return redirect()->route('admin.menu.index')->with('success', 'Menu saved successfully');
    }

    public function sorting(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->data;
        foreach ($data as $key => $value) {
            if (isset($value['id']) && isset($value['sort'])) {
                $menu = Menu::find($value['id']);
                $menu->sort = $value['sort'];
                $menu->save();
            }
        }

        return redirect()->back()->with('success', 'Menu sorted successfully');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->back()->with('success', 'Menu deleted successfully');
    }

    public function getMenus(Request $request): \Illuminate\Http\JsonResponse
    {
        /**
         * [
         *   roles => [...],
         *   permissions => [...]
         * ]
         */
        $rolesPermissions = (array) $request->user()->rolePermissionList();
        $staffRoles = $rolesPermissions['roles'];
        $staffPermissions = $rolesPermissions['permissions'];

        $allMenus = Menu::with('children')->whereNull('parent_id')->orderBy('sort')->get();
//        $menus = $allMenus->filter(function ($menu) use ($staffRoles, $staffPermissions) {
//            if (count($menu->roles) > 0) {
//                foreach ($menu->roles as $role) {
//                    if (in_array($role, $staffRoles)) {
//                        return true;
//                    }
//                }
//            }
//            if (count($menu->permissions) > 0) {
//                foreach ($menu->permissions as $permission) {
//                    if (in_array($permission, $staffPermissions)) {
//                        return true;
//                    }
//                }
//            }
//            return false;
//        });

        // using fnmatch to filter menus
        $menus = $allMenus->filter(function ($menu) use ($staffRoles, $staffPermissions) {
            if (count($menu->roles) > 0) {
                foreach ($menu->roles as $role) {
                    foreach ($staffRoles as $staffRole) {
                        if (fnmatch($staffRole,$role)) {
                            return true;
                        }
                    }
                }
            }
            if (count($menu->permissions) > 0) {
                foreach ($menu->permissions as $permission) {
                    foreach ($staffPermissions as $staffPermission) {
                        if (fnmatch($staffPermission,$permission)) {
                            return true;
                        }
                    }
                }
            }

            return false;
        });

        // filter children

        $menus = $menus->map(function ($menu) use ($staffRoles, $staffPermissions) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'route_name' => $menu->route_name,
                'active_component' => $menu->active_component,
                'url' => $menu->url,
                'icon_svg' => $menu->icon_svg,
                'children' => $menu->children->filter(function ($child) use ($staffRoles, $staffPermissions) {
                    if (count($child->roles) > 0) {
                        foreach ($child->roles as $role) {
                            foreach ($staffRoles as $staffRole) {
                                if (fnmatch($staffRole,$role)) {
                                    return true;
                                }
                            }
                        }
                    }
                    if (count($child->permissions) > 0) {
                        foreach ($child->permissions as $permission) {
                            foreach ($staffPermissions as $staffPermission) {
                                if (fnmatch($staffPermission,$permission)) {
                                    return true;
                                }
                            }
                        }
                    }
                    return false;
                })
            ];
        });
//
//        $menus = $menus
//            ->filter(function ($menu) {
//                if (($menu->route_name && \Route::has($menu->route_name)) || ($menu->url)) {
//                    return true;
//                }
//            })
//            ->map(function ($menu) use ($staffRoles, $staffPermissions) {
//                return [
//                    'id' => $menu->id,
//                    'name' => $menu->name,
//                    'route_name' => $menu->route_name,
//                    'active_component' => $menu->active_component,
//                    'url' => $menu->url,
//                    'icon_svg' => $menu->icon_svg,
//                    'children' => $menu->children->filter(function ($child) use ($staffRoles, $staffPermissions) {
//                        if (count($child->roles) > 0) {
//                            foreach ($child->roles as $role) {
//                                if (in_array($role, $staffRoles)) {
//                                    return true;
//                                }
//                            }
//                        }
//                        if (count($child->permissions) > 0) {
//                            foreach ($child->permissions as $permission) {
//                                if (in_array($permission, $staffPermissions)) {
//                                    return true;
//                                }
//                            }
//                        }
//                        return false;
//                    })
//                ];
//            });
        return response()->json($menus);
    }
}
