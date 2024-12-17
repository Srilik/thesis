<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Show login form
    public function login()
    {
        return inertia('User/Login');
    }

    // get login request
    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
            'remember' => 'nullable|boolean'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $encryptedPassword = $user->password;
            $checkPassword = Hash::check($request->password, $encryptedPassword);
            if ($checkPassword) {
                if ($user->role === $request->role) {

                    // if($request->role == 'admin') {
                    //     Auth::login($user);
                    //     // return redirect()->route('admin.dashboard');
                    //     } elseif($request->role == 'user') {
                    //     Auth::login($user);
                    //     // return redirect()->route('student.dashboard');
                    //     }
                    // }
                    // login here
                    Auth::login($user, $request->remember);
                    $request->session()->regenerate();

                    return redirect()->to('/dashboard');
                } else {
                    throw ValidationException::withMessages([
                        'role' => 'You do not have the required permissions to log in!'
                    ]);
                }
            }
            // throw ValidationException::withMessages([
            //     'email' => 'Invalid email or password.'
            // ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
            'role' => 'You do not have the required permissions to log in!',

        ]);




        // $adminUser = AdminUser::where('email', $request->email)->first();
        // if ($adminUser) {
        //     $encryptedPassword = $adminUser->password;
        //     $checkPassword = Hash::check($request->password, $encryptedPassword);
        //     if ($checkPassword) {
        //         // login here
        //         Auth::guard('admin')->login($adminUser, $request->remember);
        //         $request->session()->regenerate();

        //         return redirect()->to('/is-admin');
        //     }
        // }
    }

    // logout request
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
