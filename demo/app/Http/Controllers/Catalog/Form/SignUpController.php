<?php

namespace App\Http\Controllers\Catalog\Form;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\Signup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignUpController extends Controller
{
    public function index()
    {
        $data['action'] = route('catalog.register.submit');
        $data['forms'] = DB::table('leave_form')->get();
        return view('catalog.form.signupform',$data);
    }

        // Handle the registration form submission
    public function register(Request $request)
    {
        // dd($request->request);
        $vaildation = $request->validate([
            'profileimage' => 'nullable|max:255',
            'fullName' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|max:255',
            'role' => 'required|max:255',
            'termsCheck' => 'required|max:255',
        ]);

        if($vaildation['email']){
            $getUser = DB::table('users')->where('email', $vaildation['email'])->first();
            if($getUser){
                return redirect()->route('catalog.signup')->with('email_error', 'Email already exists');
            }
        }

        if($vaildation['password'] !== $vaildation['password_confirmation']){
            return redirect()->route('catalog.signup')->with('password_error', 'Password does not match');
        }

        $array = [
            'profileimage' => $vaildation['profileimage'],
            'fullName' => $vaildation['fullName'],
            'email' => $vaildation['email'],
            'password' => $vaildation['password'],
            'email_verified_at' => 1,
            'role' => $vaildation['role'],
            'termsCheck' => $vaildation['termsCheck'],
        ];

        try {
            $leave = Signup::register($array);
            return redirect('/login')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }



    }

}
