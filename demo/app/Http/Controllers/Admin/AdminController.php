<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\Signup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.adminlogin');
    }

    public function adminLoginForm(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = Signup::where('email', $credentials['email'])->first();
        if($user){
            $password = $request->request->get('password');
            $hash_password = Hash::check($password, $user['password']);
            if($hash_password){
                if($user->role === 'admin'){

                    $request->session()->put('isAdmin' , $user->id);
                    $request->session()->put('userName' , $user->fullName);
                    $request->session()->put('userImage' , $user->profileimage);
                    $request->session()->put('userEmail' , $user->email);
                
                    return redirect()->route('admin.showUserDetails');
                }else{
                    return back()->withErrors(['email' => 'Invalid email or password']);
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
    $request->session()->forget('isAdmin' );
    $request->session()->forget('userName' );
    $request->session()->forget('userImage' );
    $request->session()->forget('userEmail' );
    return redirect()->route('catalog.login')->with('success', 'Logged out successfully.');
   }

    public function showUserDetails(){
        $data['leaveDetails'] = [];
        $leaveDetails = DB::table('leave_form')->get();
        if ($leaveDetails) {
            foreach ($leaveDetails as $value) {

                $empId = $value->user_id;
                $empDetail = DB::table('users')->where('id', $empId)->first();
                $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
                $status = '';
                if($approval){
                    if($approval->status == 1){
                        $status = 'Approved';
                    }else if($approval->status == 2){
                        $status = 'Rejected';
                    }else{
                        $status = 'Unapproved';
                    }
                    if(isset($approval->user_id) && null !== $approval->user_id){
                        $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
                    }else{
                        $approval_by = '';
                    }
                }else{
                    $status = 'Unapproved';
                }
                
                $data['leaveDetails'][] = [
                    'emp_name' => $empDetail->fullName,
                    'emp_id' => $empDetail->id,
                    'role' => $empDetail->role ?? '',
                    'leave_form_id' => $value->id,
                    'leave_application_type' => $value->leave_application_type ?? '',
                    'leave_apply_date' => $value->leave_apply_date ?? '',
                    'leave_type' => $value->leave_type ?? '',
                    'leave_date_from' => $value->leave_date_from ?? '',
                    'leave_date_to' => $value->leave_date_to ?? '',
                    'leave_half_day' => $value->leave_half_day ?? '',
                    'leave_day' => $value->leave_day ?? '',
                    'leave_reason' => $value->leave_reason ?? '',
                    'leave_manager_email' => $value->leave_manager_email ?? '',
                    'leave_cc_email' => $value->leave_cc_email ?? '',
                    'leave_contact_no' => $value->leave_contact_no ?? '',
                    'leave_contact_address1' => $value->leave_contact_address1 ?? '',
                    'leave_city' => $value->leave_city ?? '',
                    'leave_pincode' => $value->leave_pincode ?? '',
                    'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
                    'created_at' => $value->created_at ?? '',
                    'updated_at' => $value->updated_at ?? '',
                    'leave_contact_address2' => $value->leave_contact_address2 ?? '',
                    'leave_contact_address3' => $value->leave_contact_address3 ?? '',
                    'approvel_status' => $status,
                    'approved_by' => $approval_by->fullName ?? ''
                ];
            }
        } 

        return view('admin.admin', $data);

    }

    public function formApprovel(int $status, int $leave_form_id){

        $user_id = session('isAdmin');
        $query = DB::table('approval')->where('user_id', $user_id)->where('leave_form_id', $leave_form_id)->first();
        if($query){
            DB::select("UPDATE approval SET status =". $status ." WHERE leave_form_id = ". $leave_form_id ." AND user_id = ". $user_id);
        }else{
            DB::table('approval')->insert([
                'user_id' => $user_id,
                'leave_form_id' => $leave_form_id,
                'status' =>  $status ?? 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect()->route('admin.showUserDetails')->with('success', 'Form status changed');
    }
}
