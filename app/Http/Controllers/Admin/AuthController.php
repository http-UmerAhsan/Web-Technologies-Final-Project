<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function showLogin() {
        if (session('admin_logged_in')) return redirect()->route('admin.dashboard');
        return view('auth.login');
    }
    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ],[
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
        ]);
        $u = $request->input('username');
        $p = $request->input('password');
        $validUser = $u === env('ADMIN_USERNAME','UmerAhsan');
        $validPass = $p === env('ADMIN_PASSWORD','admin99');
        if ($validUser && $validPass) {
            session(['admin_logged_in'=>true,'admin_username'=>$u,'admin_login_at'=>now()]);
            return redirect()->route('admin.dashboard')->with('success','Welcome back, '.$u.'!');
        }
        $errors = ['general'=>'Invalid credentials. Please try again.'];
        if (!$validUser) $errors['username'] = 'Username not found. Please check and try again.';
        if ($validUser && !$validPass) $errors['password'] = 'Incorrect password. Please try again.';
        return back()->withInput($request->only('username'))->withErrors($errors);
    }
    public function logout(Request $request) {
        session()->forget(['admin_logged_in','admin_username','admin_login_at']);
        return redirect()->route('admin.login')->with('success','You have been logged out successfully.');
    }
}
