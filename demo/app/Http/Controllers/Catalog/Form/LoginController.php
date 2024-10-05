<?php

namespace App\Http\Controllers\Catalog\Form;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\Signup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {

        $data['action'] = route('catalog.loginpage.submit');
        return view('catalog.form.loginform', $data);
    }


    public function loginForm(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = Signup::where('email', $credentials['email'])->first();
        // dd($user);
        if($user){
            $password = $request->request->get('password');
            $hash_password = Hash::check($password, $user['password']);
            if($hash_password){
                if($user->role === 'user' || $user->role == 'manager'){
                    $request->session()->put('isUser' , $user->id);
                }elseif($user->role === 'admin'){
                    $request->session()->put('isAdmin' , $user->id);
                    // dd(session('isAdmin'));
                }
                
                $request->session()->put('userName' , $user->fullName);
                $request->session()->put('userImage' , $user->profileimage);
                $request->session()->put('userEmail' , $user->email);
                if($user['role'] === "user"){
                    return redirect()->route('catalog.leave')->with('success', 'Logged in successfully.');
                }else if($user['role'] === "manager"){
                    return redirect()->route('catalog.manager-leave')->with('success', 'Logged in successfully.');
                }else if($user['role'] == "admin"){
                    return redirect()->route('admin.admin_login')->with('success', 'Logged in successfully.');
                }
            }else{
                return back()->withErrors(['email' => 'Invalid email or password']);
            }
        }
        else{
            return back()->withErrors(['email' => 'Invalid email or password']);
        }
    }


   public function logout(Request $request)
   {
    $request->session()->forget('isUser' );
    $request->session()->forget('userName' );
    $request->session()->forget('userImage' );
    $request->session()->forget('userEmail' );
    return redirect()->route('catalog.login')->with('success', 'Logged out successfully.');
   }
}
