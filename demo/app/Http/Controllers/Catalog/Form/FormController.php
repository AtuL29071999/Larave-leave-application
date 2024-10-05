<?php

namespace App\Http\Controllers\Catalog\Form;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\LeaveForm;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    // public function index()
    // {
    //     $data['action'] = route('catalog.save');
    //     $data['forms'] = [];
    //     // dd(session('isUser'));
    //     $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();
    //     // dd();
    //     if ($leaveDetails) {
    //         foreach ($leaveDetails as $value) {
    //             $user = DB::table('users')->where('id', session('isUser'))->first();
    //             dd($user);
    //             $empId = $value->user_id;
    //             $empDetail = DB::table('users')->where('id', $empId)->first();
    //             $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
    //             $status = '';
    //             if($approval){
    //                 if($approval->status == 1){
    //                     $status = 'Approved';
    //                 }else if($approval->status == 2){
    //                     $status = 'Rejected';
    //                 }else{
    //                     $status = 'Unapproved';
    //                 }
    //                 if(isset($approval->user_id) && null !== $approval->user_id){
    //                     $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
    //                 }else{
    //                     $approval_by = '';
    //                 }

    //                 $data['forms'][] = [
    //                     'emp_name' => $empDetail->fullName,
    //                     'emp_id' => $empDetail->id,
    //                     'leave_form_id' => $value->id,
    //                     'leave_application_type' => $value->leave_application_type ?? '',
    //                     'leave_apply_date' => $value->leave_apply_date ?? '',
    //                     'leave_type' => $value->leave_type ?? '',
    //                     'leave_date_from' => $value->leave_date_from ?? '',
    //                     'leave_date_to' => $value->leave_date_to ?? '',
    //                     'leave_half_day' => $value->leave_half_day ?? '',
    //                     'leave_day' => $value->leave_day ?? '',
    //                     'leave_reason' => $value->leave_reason ?? '',
    //                     'leave_manager_email' => $value->leave_manager_email ?? '',
    //                     'leave_cc_email' => $value->leave_cc_email ?? '',
    //                     'leave_contact_no' => $value->leave_contact_no ?? '',
    //                     'leave_contact_address1' => $value->leave_contact_address1 ?? '',
    //                     'leave_city' => $value->leave_city ?? '',
    //                     'leave_pincode' => $value->leave_pincode ?? '',
    //                     'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
    //                     'created_at' => $value->created_at ?? '',
    //                     'updated_at' => $value->updated_at ?? '',
    //                     'leave_contact_address2' => $value->leave_contact_address2 ?? '',
    //                     'leave_contact_address3' => $value->leave_contact_address3 ?? '',
    //                     'approvel_status' => $status,
    //                     'approved_by' => $approval_by->fullName ?? ''
    //                 ];
                
    //             }else{
    //                 $status = 'Unapproved';
    //             }
    //         }
    //     }

    //     // dd($data['forms']);

    //     if($user->role === 'user'){
    //         return view('catalog.form.leaveform', $data);
    //     }else{
    //         return redirect()->route('catalog.manager-leave');
    //     }
        
    // }
    public function index()
{
    $data['action'] = route('catalog.save');
    $data['forms'] = [];
    
    // Fetch the user once at the beginning
    $user = DB::table('users')->where('id', session('isUser'))->first();
    
    // Check if user exists
    if (!$user) {
        // Handle the case where the user is not found
        return redirect()->route('catalog.login')->with('error', 'User not found');
    }
    
    // Fetch leave details
    $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();

    if ($leaveDetails) {
        foreach ($leaveDetails as $value) {
            $empId = $value->user_id;
            $empDetail = DB::table('users')->where('id', $empId)->first();
            $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
            $status = '';

            if ($approval) {
                if ($approval->status == 1) {
                    $status = 'Approved';
                } elseif ($approval->status == 2) {
                    $status = 'Rejected';
                } else {
                    $status = 'Unapproved';
                }

                $approval_by = $approval->user_id ? DB::table('users')->where('id', $approval->user_id)->first() : '';
            }

            $data['forms'][] = [
                'emp_name' => $empDetail->fullName,
                'emp_id' => $empDetail->id,
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

    // Check the user's role to determine view
    if ($user->role === 'user') {
        return view('catalog.form.leaveform', $data);
    } else {
        return redirect()->route('catalog.manager-leave');
    }
}


    public function addLeaveForm(Request $request)
    {

        $vaildation = $request->validate([
            'application' => 'nullable|max:255',
            'applydate' => 'nullable|max:255',
            'type' => 'nullable|max:255',
            'from_date' => 'nullable|max:255',
            'to_date' => 'nullable|max:255',
            'halfday' => 'nullable|max:255',
            'days' => 'nullable|max:255',
            'reason' => 'nullable|max:255',
            'managerEmail' => 'nullable|max:255',
            'ccmail' => 'nullable|max:255',
            'contact' => 'nullable|max:255',
            'contact_address1' => 'nullable|max:255',
            'contact_address2' => 'nullable|max:255',
            'contact_address3' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'pincode' => 'nullable|max:255',
            'medical_certificate' => 'nullable|max:255'
        ]);
dd($request->request);
        $array = [
            'leave_application_type' => $vaildation['application'],
            'leave_apply_date' => $vaildation['applydate'],
            'leave_type' => $vaildation['type'],
            'leave_date_from' => $vaildation['from_date'],
            'leave_date_to' => $vaildation['to_date'],
            'leave_half_day' => $vaildation['halfday'],
            'leave_day' => $vaildation['days'],
            'leave_reason' => $vaildation['reason'],
            'leave_manager_email' => $vaildation['managerEmail'],
            'leave_cc_email' => $vaildation['ccmail'],
            'leave_contact_no' => $vaildation['contact'],
            'leave_contact_address1' => $vaildation['contact_address1'],
            'leave_contact_address2' => $vaildation['contact_address2'],
            'leave_contact_address3' => $vaildation['contact_address3'],
            'leave_city' => $vaildation['city'],
            'leave_pincode' => $vaildation['pincode'],
            'leave_medical_certificate' => $vaildation['medical_certificate'],
        ];


        try {
            $leave = LeaveForm::addLeaveForm($array);
            return redirect('/leave')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function editLeaveForm($id){
         $leave = LeaveForm::findOrFail($id); 
        $data['action'] = route('catalog.update', $leave->id);  
        // dd($leave);
        return view('catalog.form.editleaveform', compact('leave', 'data'));  
    }

    public function updateLeaveForm(Request $request, $id)
    {
        $leave = LeaveForm::findOrFail($id);  

        $vaildation = $request->validate([
            'application' => 'nullable|max:255',
            'applydate' => 'nullable|max:255',
            'type' => 'nullable|max:255',
            'from_date' => 'nullable|max:255',
            'to_date' => 'nullable|max:255',
            'halfday' => 'nullable|max:255',
            'days' => 'nullable|max:255',
            'reason' => 'nullable|max:255',
            'managerEmail' => 'nullable|max:255',
            'ccmail' => 'nullable|max:255',
            'contact' => 'nullable|max:255',
            'contact_address1' => 'nullable|max:255',
            'contact_address2' => 'nullable|max:255',
            'contact_address3' => 'nullable|max:255',
            'city' => 'nullable|max:255',
            'pincode' => 'nullable|max:255',
            'medical_certificate' => 'nullable|max:255'
        ]);

        $array = [
            'leave_application_type' => $vaildation['application'],
            'leave_apply_date' => $vaildation['applydate'],
            'leave_type' => $vaildation['type'],
            'leave_date_from' => $vaildation['from_date'],
            'leave_date_to' => $vaildation['to_date'],
            'leave_half_day' => $vaildation['halfday'],
            'leave_day' => $vaildation['days'],
            'leave_reason' => $vaildation['reason'],
            'leave_manager_email' => $vaildation['managerEmail'],
            'leave_cc_email' => $vaildation['ccmail'],
            'leave_contact_no' => $vaildation['contact'],
            'leave_contact_address1' => $vaildation['contact_address1'],
            'leave_contact_address2' => $vaildation['contact_address2'],
            'leave_contact_address3' => $vaildation['contact_address3'],
            'leave_city' => $vaildation['city'],
            'leave_pincode' => $vaildation['pincode'],
            'leave_medical_certificate' => $vaildation['medical_certificate'],
        ];


        try {
            $leave = LeaveForm::updateLeaveForm($array);
            return redirect('/leave')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Method to delete a leave form
    public function deleteLeaveForm($id)
    {
        $leave = LeaveForm::findOrFail($id);  
        $leave->delete();  
        return redirect('/leave')->with('success', 'Success');
    }
}
