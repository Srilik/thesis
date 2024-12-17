<?php

namespace App\Http\Controllers\Attendance;
use App\Http\Controllers\Controller;
use App\Models\Attendance\User_Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Blade view for login form
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    // get login request
    public function verifyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean'
        ]);

        $user = User_Attendance::where('email', $request->email)->first();
        if ($user) {
            $encryptedPassword = $user->password;
            $checkPassword = Hash::check($request->password, $encryptedPassword);
            if ($checkPassword) {
                // login here
                Auth::login($user, $request->remember);
                $request->session()->regenerate();

                return redirect()->to('admin.dashboard');
            }


            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.'
            ]);
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.'
        ]);
    }
    // logout request
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('showLoginForm');
    }
}
