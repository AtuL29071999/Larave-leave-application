<?php

namespace App\Http\Controllers\Catalog\Form;

use App\Http\Controllers\Catalog\EmailController;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\leavebalance;
use App\Models\Catalog\Form\LeaveForm;
use App\Models\Catalog\Form\Signup;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

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

    public function aboutForm()
    {
        return view('catalog.form.about');
    }

    // public function index()
    // {
    //     $data['action'] = route('catalog.save');
    //     $data['forms'] = [];

    //     // Fetch the user once at the beginning
    //     $user = DB::table('users')->where('id', session('isUser'))->first();

    //     // Check if user exists
    //     if (!$user) {
    //         // Handle the case where the user is not found
    //         return redirect()->route('catalog.login')->with('error', 'User not found');
    //     }

    //     // Fetch leave details
    //     $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();

    //     // if ($leaveDetails) {
    //     //     foreach ($leaveDetails as $value) {

    //     //         $empId = $value->user_id;
    //     //         $empDetail = DB::table('users')->where('id', $empId)->first();
    //     //         $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
    //     //         $status = '';
    //     //         $reads = '';

    //     //         // dd($approval->leaveread == 1);

    //     //         if($approval->leaveread == 1){
    //     //             $reads = 'R';
    //     //         }else{
    //     //             $reads = 'UR';
    //     //         }

    //     //         // dd($reads);


    //     //         if ($approval) {
    //     //             if ($approval->status == 1) {
    //     //                 $status = 'Approved';
    //     //             } elseif ($approval->status == 2) {
    //     //                 $status = 'Rejected';
    //     //             }
    //     //             $approval_by = $approval->user_id ? DB::table('users')->where('id', $approval->user_id)->first() : '';
    //     //         }else{
    //     //             $status = 'Unapproved';
    //     //         }

    //     //         // dd($value);

    //     //         $data['forms'][] = [
    //     //             'emp_name' => $empDetail->fullName,
    //     //             'emp_id' => $empDetail->id,
    //     //             'leave_form_id' => $value->id,
    //     //             'leave_application_type' => $value->leave_application_type ?? '',
    //     //             'leave_apply_date' => $value->leave_apply_date ?? '',
    //     //             'leave_type' => $value->leave_type ?? '',
    //     //             'leave_date_from' => $value->leave_date_from ?? '',
    //     //             'leave_date_to' => $value->leave_date_to ?? '',
    //     //             'leave_half_day' => $value->leave_half_day ?? '',
    //     //             'leave_day' => $value->leave_day ?? '',
    //     //             'leave_reason' => $value->leave_reason ?? '',
    //     //             'leave_manager_email' => $value->leave_manager_email ?? '',
    //     //             'leave_cc_email' => $value->leave_cc_email ?? '',
    //     //             'leave_contact_no' => $value->leave_contact_no ?? '',
    //     //             'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
    //     //             'created_at' => $value->created_at ?? '',
    //     //             'updated_at' => $value->updated_at ?? '',
    //     //             'leave_read' => $reads,
    //     //             'approvel_status' => $status,
    //     //             'approved_by' => $approval_by->fullName ?? ''
    //     //         ];
    //     //     }
    //     // }

    //     if ($leaveDetails) {
    //         foreach ($leaveDetails as $value) {
    //             $empId = $value->user_id;
    //             $empDetail = DB::table('users')->where('id', $empId)->first();

    //             if (!$empDetail) {
    //                 continue;
    //             }

    //             $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
    //             $status = 'Unapproved';
    //             $reads = ($approval && $approval->leaveread == 1) ? 'R' : 'UR';

    //             if ($approval) {
    //                 if ($approval->status == 1) {
    //                     $status = 'Approved';
    //                 } elseif ($approval->status == 2) {
    //                     $status = 'Rejected';
    //                 }
    //                 $approver = DB::table('users')->where('id', $approval->user_id)->first();
    //                 $approvedBy = $approver->fullName ?? '';
    //             } else {
    //                 $approvedBy = '';
    //             }

    //             $data['forms'][] = [
    //                 'emp_name' => $empDetail->fullName ?? '',
    //                 'emp_id' => $empDetail->id ?? '',
    //                 'leave_form_id' => $value->id ?? '',
    //                 'leave_application_type' => $value->leave_application_type ?? '',
    //                 'leave_apply_date' => $value->leave_apply_date ?? '',
    //                 'leave_type' => $value->leave_type ?? '',
    //                 'leave_date_from' => $value->leave_date_from ?? '',
    //                 'leave_date_to' => $value->leave_date_to ?? '',
    //                 'leave_half_day' => $value->leave_half_day ?? '',
    //                 'leave_day' => $value->leave_day ?? '',
    //                 'leave_reason' => $value->leave_reason ?? '',
    //                 'leave_manager_email' => $value->leave_manager_email ?? '',
    //                 'leave_cc_email' => $value->leave_cc_email ?? '',
    //                 'leave_contact_no' => $value->leave_contact_no ?? '',
    //                 'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
    //                 'created_at' => $value->created_at ?? '',
    //                 'updated_at' => $value->updated_at ?? '',
    //                 'leave_read' => $reads,
    //                 'approvel_status' => $status,
    //                 'approved_by' => $approvedBy
    //             ];
    //         }
    //     }

    //     $view = $this->showLeaveChart();
    //     dd($view);

    //     // dd($data['forms']);

    //     // Check the user's role to determine view
    //     if ($user->role === 'user') {
    //         return view('catalog.form.leaveform', $data);
    //     } else {
    //         return redirect()->route('catalog.manager-leave');
    //     }
    // }

    // public function showLeaveChart()
    // {
    //     // dd("hle");
    //     $leaveData = LeaveBalance::select(
    //         DB::raw("MONTH(leave_taken_at) as month"),
    //         DB::raw("SUM(total_leave - (avl_sick_leave + avl_earned_leave + avl_rh_leave)) as used_leave")
    //     )
    //     ->groupBy(DB::raw("MONTH(leave_taken_at)"))
    //     ->get();

    //     $chartData = [];

    //     foreach ($leaveData as $data) {
    //         $monthName = date('M', mktime(0, 0, 0, $data->month, 10)); // Jan, Feb, etc.
    //         $chartData[] = ['label' => $monthName, 'y' => $data->used_leave];
    //     }

    //     return view('leave-chart', compact('chartData'));
    // }

    // public function index()
    // {
    //     $data['action'] = route('catalog.save');
    //     $data['forms'] = [];

    //     // Fetch the user once at the beginning
    //     $user = DB::table('users')->where('id', session('isUser'))->first();

    //     // Check if user exists
    //     if (!$user) {
    //         return redirect()->route('catalog.login')->with('error', 'User not found');
    //     }

    //     // Fetch leave details
    //     $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();

    //     if ($leaveDetails) {
    //         foreach ($leaveDetails as $value) {
    //             $empDetail = DB::table('users')->where('id', $value->user_id)->first();

    //             if (!$empDetail) {
    //                 continue;
    //             }

    //             $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
    //             $status = 'Unapproved';  // Default status
    //             $reads = ($approval && $approval->leaveread == 1) ? 'R' : 'UR';  // Read status

    //             $approvedBy = '';
    //             if ($approval) {
    //                 // Determine approval status
    //                 $status = match ($approval->status) {
    //                     1 => 'Approved',
    //                     2 => 'Rejected',
    //                     default => 'Unapproved',
    //                 };

    //                 $approver = DB::table('users')->where('id', $approval->user_id)->first();
    //                 $approvedBy = $approver->fullName ?? '';  // Fallback if null
    //             }

    //             // Add form data
    //             $data['forms'][] = [
    //                 'emp_name' => $empDetail->fullName ?? '',
    //                 'emp_id' => $empDetail->id ?? '',
    //                 'leave_form_id' => $value->id ?? '',
    //                 'leave_application_type' => $value->leave_application_type ?? '',
    //                 'leave_apply_date' => $value->leave_apply_date ?? '',
    //                 'leave_type' => $value->leave_type ?? '',
    //                 'leave_date_from' => $value->leave_date_from ?? '',
    //                 'leave_date_to' => $value->leave_date_to ?? '',
    //                 'leave_half_day' => $value->leave_half_day ?? '',
    //                 'leave_day' => $value->leave_day ?? '',
    //                 'leave_reason' => $value->leave_reason ?? '',
    //                 'leave_manager_email' => $value->leave_manager_email ?? '',
    //                 'leave_cc_email' => $value->leave_cc_email ?? '',
    //                 'leave_contact_no' => $value->leave_contact_no ?? '',
    //                 'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
    //                 'created_at' => $value->created_at ?? '',
    //                 'updated_at' => $value->updated_at ?? '',
    //                 'leave_read' => $reads,
    //                 'approvel_status' => $status,
    //                 'approved_by' => $approvedBy
    //             ];
    //         }
    //     }

    //     // No need to debug view now
    //     // $view = $this->showLeaveChart();
    //     $chartData = $this->getChartData();
    //     // dd($view);

    //     // Check the user's role to determine the view
    //     // return $user->role === 'user'
    //     //     ? view('catalog.form.leaveform', $data)
    //     //     : redirect()->route('catalog.manager-leave');

    //     $leaveData = [
    //         ['type' => 'SL', 'total' => 9, 'availed' => 2],  // Sick Leave
    //         ['type' => 'EL', 'total' => 13, 'availed' => 4.5], // Earned Leave
    //         ['type' => 'RH', 'total' => 2, 'availed' => 0],  // Restricted Holiday
    //     ];
    //     return $user->role === 'user'
    //     ? view('catalog.form.leaveform', array_merge($data, ['chartData' => $chartData]))
    //     : redirect()->route('catalog.manager-leave');
    // }

    // public function index()
    // {
    //     $data['action'] = route('catalog.save');
    //     $data['forms'] = [];

    //     // Fetch the user once at the beginning
    //     $user = DB::table('users')->where('id', session('isUser'))->first();

    //     // Check if user exists
    //     if (!$user) {
    //         return redirect()->route('catalog.login')->with('error', 'User not found');
    //     }

    //     // Fetch leave details (Modify this if you fetch dynamically from DB)
    //     $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();

    //     if ($leaveDetails) {
    //         foreach ($leaveDetails as $value) {
    //             $empDetail = DB::table('users')->where('id', $value->user_id)->first();

    //             if (!$empDetail) {
    //                 continue;
    //             }

    //             $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
    //             $status = 'Unapproved';  // Default status
    //             $reads = ($approval && $approval->leaveread == 1) ? 'R' : 'UR';  // Read status

    //             $approvedBy = '';
    //             if ($approval) {
    //                 // Determine approval status
    //                 $status = match ($approval->status) {
    //                     1 => 'Approved',
    //                     2 => 'Rejected',
    //                     default => 'Unapproved',
    //                 };

    //                 $approver = DB::table('users')->where('id', $approval->user_id)->first();
    //                 $approvedBy = $approver->fullName ?? '';  // Fallback if null
    //             }

    //             // Add form data
    //             $data['forms'][] = [
    //                 'emp_name' => $empDetail->fullName ?? '',
    //                 'emp_id' => $empDetail->id ?? '',
    //                 'leave_form_id' => $value->id ?? '',
    //                 'leave_application_type' => $value->leave_application_type ?? '',
    //                 'leave_apply_date' => $value->leave_apply_date ?? '',
    //                 'leave_type' => $value->leave_type ?? '',
    //                 'leave_date_from' => $value->leave_date_from ?? '',
    //                 'leave_date_to' => $value->leave_date_to ?? '',
    //                 'leave_half_day' => $value->leave_half_day ?? '',
    //                 'leave_day' => $value->leave_day ?? '',
    //                 'leave_reason' => $value->leave_reason ?? '',
    //                 'leave_manager_email' => $value->leave_manager_email ?? '',
    //                 'leave_cc_email' => $value->leave_cc_email ?? '',
    //                 'leave_contact_no' => $value->leave_contact_no ?? '',
    //                 'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
    //                 'created_at' => $value->created_at ?? '',
    //                 'updated_at' => $value->updated_at ?? '',
    //                 'leave_read' => $reads,
    //                 'approvel_status' => $status,
    //                 'approved_by' => $approvedBy
    //             ];
    //         }
    //     }

    //     // Example leave and chart data (these should be dynamic, ideally from your database)
    //     $chartData = $this->getChartData();

    //     // For example, additional leave data if you need
    //     $leaveData = [
    //         'total_sick_leave' => 9,
    //         'availed_sick_leave' => 2,
    //         'total_earned_leave' => 13,
    //         'availed_earned_leave' => 4.5,
    //         'total_rh_leave' => 2,
    //         'availed_rh_leave' => 0
    //     ];

    //     return $user->role === 'user'
    //         ? view('catalog.form.leaveform', array_merge($data, ['chartData' => $chartData, 'leaveData' => $leaveData]))
    //         : redirect()->route('catalog.manager-leave');
    // }

    public function index()
    {
        $data['action'] = route('catalog.save');
        $data['forms'] = [];

        // Fetch the user once at the beginning
        $user = DB::table('users')->where('id', session('isUser'))->first();

        // Check if user exists
        if (!$user) {
            return redirect()->route('catalog.login')->with('error', 'User not found');
        }

        // Fetch leave details (Modify this if you fetch dynamically from DB)
        $leaveDetails = DB::table('leave_form')->where('user_id', session('isUser'))->get();

        if ($leaveDetails) {
            foreach ($leaveDetails as $value) {
                $empDetail = DB::table('users')->where('id', $value->user_id)->first();

                if (!$empDetail) {
                    continue;
                }

                $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
                $status = 'Unapproved';  // Default status
                $reads = ($approval && $approval->leaveread == 1) ? 'R' : 'UR';  // Read status

                $approvedBy = '';
                if ($approval) {
                    // Determine approval status
                    $status = match ($approval->status) {
                        1 => 'Approved',
                        2 => 'Rejected',
                        default => 'Unapproved',
                    };

                    $approver = DB::table('users')->where('id', $approval->user_id)->first();
                    $approvedBy = $approver->fullName ?? '';  // Fallback if null
                }

                // Add form data
                $data['forms'][] = [
                    'emp_name' => $empDetail->fullName ?? '',
                    'emp_id' => $empDetail->id ?? '',
                    'leave_form_id' => $value->id ?? '',
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
                    'leave_read' => $reads,
                    'approvel_status' => $status,
                    'approved_by' => $approvedBy
                ];
            }
        }

        // Fetch leave balance data for available leave
        $leaveBalance = DB::table('leavesbalance')->where('user_id', session('isUser'))->first();

        // Calculate leave data
        $leaveData = [
            'total_sick_leave' => $leaveBalance->sick_leave ?? 0,
            'availed_sick_leave' => $leaveBalance->sick_leave - $leaveBalance->avl_sick_leave ?? 0,
            'total_earned_leave' => $leaveBalance->earned_leave ?? 0,
            'availed_earned_leave' => $leaveBalance->earned_leave - $leaveBalance->avl_earned_leave ?? 0,
            'total_rh_leave' => $leaveBalance->rh_leave ?? 0,
            'availed_rh_leave' => $leaveBalance->rh_leave - $leaveBalance->avl_rh_leave ?? 0,
        ];

        // Fetch used leave data for each month
        $chartData = $this->getChartData();

        return $user->role === 'user'
            ? view('catalog.form.leaveform', array_merge($data, ['chartData' => $chartData, 'leaveData' => $leaveData]))
            : redirect()->route('catalog.manager-leave');
    }




    protected function getChartData()
    {
        $leaveData = DB::table('leavesbalance')->where('user_id', session('isUser'))->first();

        if (!$leaveData) {
            return [];
        }

        $totalUsedLeave = ($leaveData->total_leave) - ($leaveData->avl_sick_leave + $leaveData->avl_earned_leave + $leaveData->avl_rh_leave);
        $monthName = date('M', strtotime($leaveData->leave_taken_at));

        return [
            ['label' => $monthName, 'y' => $totalUsedLeave]
        ];
    }

    // public function showLeaveChart()
    // {
    //     // dd("from show");
    //     $leaveData = DB::table('leavesbalance')->where('id', session('isUser'))->first();
    //     $totalUsedLeave = ($leaveData->total_leave) - ($leaveData->avl_sick_leave + $leaveData->avl_earned_leave + $leaveData->avl_rh_leave);
    //     dd(date('M',$leaveData->leave_taken_at));

    //     // Prepare chart data
    //     $chartData = [];
    //     foreach ($leaveData as $data) {
    //         dd($data);
    //         $monthName = date('M', mktime(0, 0, 0, $data->month, 10)); // Convert to short month names
    //         $chartData[] = ['label' => $monthName, 'y' => $data->used_leave];
    //     }

    //     return view('leave-chart', compact('chartData'));
    // }

    public function showLeaveChart()
    {
        // Fetch the leave balance data for the current user
        $leaveData = DB::table('leavesbalance')->where('user_id', session('isUser'))->first();

        // Check if leave data is available
        if (!$leaveData) {
            return redirect()->back()->with('error', 'Leave data not found');
        }

        // Calculate the total used leave
        $totalUsedLeave = ($leaveData->total_leave) - ($leaveData->avl_sick_leave + $leaveData->avl_earned_leave + $leaveData->avl_rh_leave);

        // Prepare chart data (using month name)
        $monthName = date('M', strtotime($leaveData->leave_taken_at)); // Convert to short month names
        // dd($monthName);
        $chartData = [
            ['label' => $monthName, 'y' => $totalUsedLeave]  // y is the used leave for that month
        ];

        return view('catalog.form.leaveform', compact('chartData'));
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
            'medical_certificate' => 'nullable|max:255'
        ]);
        // dd($request->request);
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
            'leave_medical_certificate' => $vaildation['medical_certificate'],
        ];

        // dd($array);


        EmailController::sendEmail($array);

        try {
            $leave = LeaveForm::addLeaveForm($array);
            return redirect('/leave')->with('success', 'Successfully applied');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function editLeaveForm($id)
    {
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
        // $leave = DB::table(leave_form)->where('id',$id);

        return redirect('/leave')->with('success', 'Success');
    }

    public function getApplicationType($type, $user_id)
    {
        $applications = DB::table('leave_form')->where('leave_type', $type)->where('user_id', $user_id)->get();
        $total_approved = 0;
        $total_pending = 0;
        if ($applications) {
            foreach ($applications as $application) {
                $approvelData = DB::table('approval')->where('leave_form_id', $application->id)->first();
                if ($approvelData && $approvelData->status == 1) {
                    $total_approved++;
                }
                if ($approvelData && $approvelData->status == 0) {
                    $total_pending++;
                }
            }
        }
        $array = [
            'total_balance' => 0,
            'total_avail_date' => 0,
            'total_applied' => $applications->count() ?? 0,
            'total_approved' => $total_approved ?? 0,
            'total_pending' => $total_pending ?? 0
        ];
        return response()->json($array);
    }
}
