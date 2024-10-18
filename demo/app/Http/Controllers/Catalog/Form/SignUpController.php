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
        $vaildation = $request->validate([
            'fullName' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'password_confirmation' => 'required|max:255',
            'role' => 'required|max:255',
            'termsCheck' => 'required|max:255',
        ]);
        
        $file = $request->file('profileimage'); //get files
        if(null !== $file){
            $folderPath = public_path('image/profile');
            if(!file_exists($folderPath)){
                mkdir($folderPath, 0777, true); // where 0777 is permission
            }
            $imageName = $file->getClientOriginalName();
            $imagePath = public_path('image/profile').$imageName;
            if(!file_exists($imagePath)){
                $file->move(public_path('image/profile/'),$imageName);
            }
            
        }

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
            'profileimage' => $imageName ?? '',
            'fullName' => $vaildation['fullName'],
            'email' => $vaildation['email'],
            'password' => $vaildation['password'],
            'email_verified_at' => 1,
            'role' => $vaildation['role'],
            'termsCheck' => $vaildation['termsCheck'],
        ];

        // dd($array);

        try {
            $leave = Signup::register($array);
            return redirect('/login')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }



    }

    public function editProfile(){
        $data['profile'] = DB::table('users')->where('id',session('isUser'))->first();
        $data['action'] = route('catalog.updateProfie');
        return view('catalog.form.profile',$data);

    }

    public function updateProfie(Request $request){
        $data = $request->request;
        $user_id = session('isUser');

        $vaildation = $request->validate([
            'fullName' => 'required|max:255'
        ]);

        try{
            // update image
            $file = $request->file('profileimage'); //get files
            if(null !== $file){
                $folderPath = public_path('image/profile');
                if(!file_exists($folderPath)){
                    mkdir($folderPath, 0777, true); // where 0777 is permission
                }
                $imageName = $file->getClientOriginalName();
                $imagePath = public_path('image/profile').$imageName;
                if(!file_exists($imagePath)){
                    $file->move(public_path('image/profile/'),$imageName);
                }
            }

            $profile = DB::table('users')->where('id', $user_id)->first();
            if($profile){
                $updateData = [
                    'fullName' => $data->get('fullName')
                ];
                // Conditionally add the profile image if it exists
                if (isset($file)) {
                    $updateData['profileimage'] = $imageName;
                }

                DB::table('users')->where('id', $user_id)->update($updateData);
            }

            $request->session()->put('userImage' , $imageName);

            return redirect()->route('catalog.editProfile');
        
        }catch(Exception $e){
            dd($e->getMessage());
        }
        
    }


    // public function assignLeaveToUser(){
    //     $userData = DB::table('users')->where('id', $userId)->get();
    // }

}
