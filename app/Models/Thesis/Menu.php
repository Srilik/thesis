<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $sort
 * @property string $name
 * @property string|null $route_name
 * @property string|null $active_component
 * @property string|null $url
 * @property array|null $permissions
 * @property array|null $roles
 * @property string|null $icon_svg
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @property-read int|null $children_count
 * @property-read Menu|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Menu hasAnyRolesPermissions()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereActiveComponent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIconSvg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRoles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRouteName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUrl($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        "sort",
        "name",
        "route_name",
        "active_component",
        "url",
        "permissions",
        "roles",
        "icon_svg",
        "parent_id",
    ];

    protected $casts = [
        'permissions' => 'json',
        'roles' => 'json',
    ];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id')->orderBy('sort');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort');
    }

    // SQL Server 2014
    public function scopeHasAnyRolesPermissions($query): \Illuminate\Database\Eloquent\Builder
    {
        $staff = auth('staff')->user();
        $staffPermissions = $staff->getPermissionNames()->toArray();
        $staffRoles = $staff->getRoleNames()->toArray();
        $curentUserPermissionsFromRoles = $staff->getPermissionsViaRoles()->pluck('name')->toArray();
        $defualtPermissions = ['Staff'];
        $isCheckAttendance = $staff->check_attend ? ['Attendance'] : [];
        $permissions = array_merge($staffPermissions, $curentUserPermissionsFromRoles, $defualtPermissions, $isCheckAttendance);
        return $query->where(function ($query) use ($permissions, $staffRoles) {
            foreach ($permissions as $permission) {
                $query->orWhere('permissions', 'like', '%' . $permission . '%');
            }
            foreach ($staffRoles as $role) {
                $query->orWhere('roles', 'like', '%' . $role . '%');
            }
        });
    }
}
