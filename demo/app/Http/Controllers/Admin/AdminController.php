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
        // if ($leaveDetails) {
        //     foreach ($leaveDetails as $value) {

        //         $empId = $value->user_id;
        //         // dd($empId);
        //         $empDetail = DB::table('users')->where('id', $empId)->first();
        //         // dd($empDetail);
        //         $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
        //         $status = '';
        //         if($approval){
        //             if($approval->status == 1){
        //                 $status = 'Approved';
        //             }else if($approval->status == 2){
        //                 $status = 'Rejected';
        //             }else{
        //                 $status = 'Unapproved';
        //             }
        //             if(isset($approval->user_id) && null !== $approval->user_id){
        //                 $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
        //             }else{
        //                 $approval_by = '';
        //             }
        //         }else{
        //             $status = 'Unapproved';
        //         }
                
        //         $data['leaveDetails'][] = [
        //             'emp_name' => $empDetail->fullName,
        //             'emp_id' => $empDetail->id,
        //             'role' => $empDetail->role ?? '',
        //             'leave_form_id' => $value->id,
        //             'leave_application_type' => $value->leave_application_type ?? '',
        //             'leave_apply_date' => $value->leave_apply_date ?? '',
        //             'leave_type' => $value->leave_type ?? '',
        //             'leave_date_from' => $value->leave_date_from ?? '',
        //             'leave_date_to' => $value->leave_date_to ?? '',
        //             'leave_half_day' => $value->leave_half_day ?? '',
        //             'leave_day' => $value->leave_day ?? '',
        //             'leave_reason' => $value->leave_reason ?? '',
        //             'leave_manager_email' => $value->leave_manager_email ?? '',
        //             'leave_cc_email' => $value->leave_cc_email ?? '',
        //             'leave_contact_no' => $value->leave_contact_no ?? '',
        //             'leave_contact_address1' => $value->leave_contact_address1 ?? '',
        //             'leave_city' => $value->leave_city ?? '',
        //             'leave_pincode' => $value->leave_pincode ?? '',
        //             'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
        //             'created_at' => $value->created_at ?? '',
        //             'updated_at' => $value->updated_at ?? '',
        //             'leave_contact_address2' => $value->leave_contact_address2 ?? '',
        //             'leave_contact_address3' => $value->leave_contact_address3 ?? '',
        //             'approvel_status' => $status,
        //             'approved_by' => $approval_by->fullName ?? ''
        //         ];
        //     }
        // } 

        if ($leaveDetails) {
            foreach ($leaveDetails as $value) {
                $empId = $value->user_id;
        
                // Fetch employee details based on user_id
                $empDetail = DB::table('users')->where('id', $empId)->first();
        
                // Check if employee details exist
                if ($empDetail) {
                    $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
                    $status = '';

                    $reads = '';
            
                    if($value->read){
                        $reads = 'R';
                    }else{
                        $reads = 'UR';
                    }
                    
                    // Determine the approval status
                    if ($approval) {
                        if ($approval->status == 1) {
                            $status = 'Approved';
                        } else if ($approval->status == 2) {
                            $status = 'Rejected';
                        } else {
                            $status = 'Unapproved';
                        }
        
                        // Fetch approval user details
                        if (isset($approval->user_id) && null !== $approval->user_id) {
                            $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
                        } else {
                            $approval_by = null;
                        }
                    } else {
                        $status = 'Unapproved';
                        $approval_by = null;
                    }
        
                    // Add leave details to data array
                    $data['leaveDetails'][] = [
                        'emp_name' => $empDetail->fullName, // Use 'N/A' if fullName is not available
                        'emp_id' => $empDetail->id, // Use 'N/A' if id is not available
                        'role' => $empDetail->role,
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
                        'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
                        'created_at' => $value->created_at ?? '',
                        'updated_at' => $value->updated_at ?? '',
                        'approvel_status' => $status,
                        'leaveread' => $reads,
                        'approved_by' => $approval_by->fullName ?? 'N/A' // Use 'N/A' if approved_by is not available
                    ];
                }
            }
        }
        
        // dd($leaveDetails);

        return view('admin.admin', $data);

    }

    public function formApprovel(int $status, int $leave_form_id)
    {
        $user_id = session('isAdmin');
        // dd($user_id);

        // Check if the approval record exists
        $query = DB::table('approval')->where('user_id', $user_id)->where('leave_form_id', $leave_form_id)->first();

        // If the approval record exists, update the status
        if ($query) {
            DB::select("UPDATE approval SET status = ? WHERE leave_form_id = ? AND user_id = ?", [$status, $leave_form_id, $user_id]);
        } else {
            // Otherwise, insert a new approval record
            DB::table('approval')->insert([
                'user_id' => $user_id,
                'leave_form_id' => $leave_form_id,
                'status' => $status ?? 0,
                'leaveread' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // If the leave form is approved (status = 1), deduct the appropriate leave
        if ($status == 1) {
            // Fetch the leave form details to determine the type of leave
            $leaveForm = DB::table('leave_form')->where('id', $leave_form_id)->first();
            // dd($leaveForm);

            if ($leaveForm) {
                $leaveType = $leaveForm->leave_type; // Assuming 'leave_type' field exists in leave_form table
                $days = $leaveForm->leave_day;  // Number of days the leave is for
                // dd($leaveType);
                // dd($leaveForm->user_id);
                // Fetch the user's leave balance
                $leaveBalance = DB::table('leavesbalance')->where('user_id', $leaveForm->user_id)->first();
                // dd($leaveBalance);
                // Deduct the leave based on the type
                switch ($leaveType) {
                    case 'Sick Leave':
                        if ($leaveBalance->sick_leave >= $days) {
                            DB::table('leavesbalance')
                                ->where('user_id', $leaveForm->user_id)
                                ->update(['avl_sick_leave' => $leaveBalance->sick_leave - $days]);
                        } else {
                            return redirect()->back()->with('error', 'Insufficient sick leave.');
                        }
                        break;

                    case 'Earned Leave':
                        if ($leaveBalance->earned_leave >= $days) {
                            DB::table('leavesbalance')
                                ->where('user_id', $leaveForm->user_id)
                                ->update(['avl_earned_leave' => $leaveBalance->earned_leave - $days]);
                        } else {
                            return redirect()->back()->with('error', 'Insufficient earned leave.');
                        }
                        break;

                    case 'Restricted Holiday':
                        if ($leaveBalance->rh_leave >= $days) {
                            DB::table('leavesbalance')
                                ->where('user_id', $leaveForm->user_id)
                                ->update(['avl_rh_leave' => $leaveBalance->rh_leave - $days]);
                        } else {
                            return redirect()->back()->with('error', 'Insufficient RH leave.');
                        }
                        break;

                    default:
                        return redirect()->back()->with('error', 'Invalid leave type.');
                }
            }
        }

        return redirect()->route('catalog.manager-leave')->with('success', 'Form status changed and leave deducted.');
    }
}
