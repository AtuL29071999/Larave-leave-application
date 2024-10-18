<?php

namespace App\Http\Controllers\Catalog\Form;

use App\Http\Controllers\Catalog\EmailController;
use App\Http\Controllers\Controller;
use App\Models\Catalog\Form\ManagerLeaveForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerLeaveFormController extends Controller
{
    public function index()
    {

        $data['manageraction'] = route('catalog.manager-leave_apply');

        $data['managerLeaveForm'] = [];

        $manger_leave_form = DB::table('leave_form')->where('user_id', session('isUser'))->get();
        foreach ($manger_leave_form as $key => $value) {
            $empId = $value->user_id;
            $mangerDetail = DB::table('users')->where('id', $empId)->first();
            $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
            $status = '';
            $reads = '';

            if ($value->read) {
                $reads = 'R';
            } else {
                $reads = 'UR';
            }

            if ($approval) {
                if ($approval->status == 1) {
                    $status = 'Approved';
                } else if ($approval->status == 2) {
                    $status = 'Rejected';
                } else {
                    $status = 'Unapproved';
                }
                if (isset($approval->user_id) && null !== $approval->user_id) {
                    $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
                } else {
                    $approval_by = '';
                }
            } else {
                $status = 'Unapproved';
            }

            $data['managerLeaveForm'][] = [
                'mgr_name' => $mangerDetail->fullName,
                'id' => $mangerDetail->id,
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
                'leave_read' => $reads,
                'approvel_status' => $status,
                'approved_by' => $approval_by->fullName ?? ''
            ];
        }

        // dd($data['managerLeaveForm']);

        $data['leaveDetails'] = [];
        $leaveDetails = DB::table('leave_form')->where('leave_manager_email', session('userEmail'))->get();

        // if ($leaveDetails) {
        //     foreach ($leaveDetails as $value) {
        //         $empId = $value->user_id;
        //         $empDetail = DB::table('users')->where('id', $empId)->first();
        //         $approval = DB::table('approval')->where('leave_form_id', $value->id)->first();
        //         $status = '';

        //         $reads = '';

        //         // dd($approval->leaveread);

        //         if($approval){
        //             if($approval->leaveread){
        //                 $reads = 'R';
        //             }else{
        //                 $reads = 'UR';
        //             }
        //         }

        //         // dd($leaveDetails);
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
        //             'leaveread' => $reads,
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
                    // dd($approval);

                    $reads = '';

                    if ($value->read) {
                        $reads = 'R';
                    } else {
                        $reads = 'UR';
                    }

                    if ($approval) {
                        if ($approval->leaveread) {
                            $reads = 'R';
                        } else {
                            $reads = 'UR';
                        }

                        // Determine approval status
                        if ($approval->status == 1) {
                            $status = 'Approved';
                        } else if ($approval->status == 2) {
                            $status = 'Rejected';
                        } else {
                            $status = 'Unapproved';
                        }

                        // dd($approval->status);

                        if (isset($approval->user_id) && null !== $approval->user_id) {
                            $approval_by = DB::table('users')->where('id', $approval->user_id)->first();
                        } else {
                            $approval_by = '';
                        }
                    } else {
                        $status = 'Unapproved';
                    }

                    // Add the leave details to the data array
                    $data['leaveDetails'][] = [
                        'emp_name' => $empDetail->fullName ?? 'N/A',  // Make sure 'fullName' is the correct column
                        'emp_id' => $empDetail->id ?? 'N/A',
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
                        'approved_by' => $approval_by->fullName ?? ''
                    ];
                }
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

        // dd($leaveDetails);


        $user = DB::table('users')->where('id', session('isUser'))->first();
        // if ($user->role === 'manager') {
        //     return view('catalog.form.managerleaveform', $data);
        // } else {
        //     return redirect()->route('catalog.leave');
        // }
        return $user->role === 'manager'
            ? view('catalog.form.managerleaveform', array_merge($data, ['chartData' => $chartData, 'leaveData' => $leaveData]))
            : redirect()->route('catalog.leave');
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

    public function showManagerDetails()
    {
        $data['action'] = route('catalog.addLeaveForm');
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
                    'leave_medical_certificate' => $value->leave_medical_certificate ?? '',
                    'created_at' => $value->created_at ?? '',
                    'updated_at' => $value->updated_at ?? '',
                    'approvel_status' => $status,
                    'approved_by' => $approval_by->fullName ?? ''
                ];
            }

            // dd($data['forms']);
        }

        // Check the user's role to determine view
        if ($user->role === 'manager') {
            return view('catalog.form.managerleaveform', $data);
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
            'medical_certificate' => 'nullable|max:255'
        ]);



        $data = $request->request;
        // echo $vaildation['application'];

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

        EmailController::sendEmail($array);


        try {
            $leave = ManagerLeaveForm::addLeaveForm($array);
            return redirect('/leave')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function getLeaveForm(){
    //     $data['action'] = route('catalog.save');


    //     return view('catalog.index', $data);
    // }

    public function editLeaveForm($id)
    {
        $leave = ManagerLeaveForm::findOrFail($id);  // Find the leave form by its ID
        $data['action'] = route('catalog.update', $leave->id);  // Pass the update route to the form
        return view('catalog.form.editleaveform', compact('leave', 'data'));
    }



    public function updateLeaveForm(Request $request, $id)
    {
        $leave = ManagerLeaveForm::findOrFail($id);  // Find the leave form by its ID

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



        $data = $request->request;
        // echo $vaildation['application'];
        // dd($data);

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
            $leave = ManagerLeaveForm::updateLeaveForm($array);
            return redirect('/leave')->with('success', 'Success');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // Method to delete a leave form
    public function deleteLeaveForm($id)
    {
        $leave = ManagerLeaveForm::findOrFail($id);
        $leave->delete();

        return redirect('/leave')->with('success', 'Success');
    }

    // public function formApprovel(int $status, int $leave_form_id){
    //     // dd($status);
    //     $user_id = session('isUser');
    //     $query = DB::table('approval')->where('user_id', $user_id)->where('leave_form_id', $leave_form_id)->first();
    //     if($query){
    //         DB::select("UPDATE approval SET status =". $status ." WHERE leave_form_id = ". $leave_form_id ." AND user_id = ". $user_id);
    //     }else{
    //         DB::table('approval')->insert([
    //             'user_id' => $user_id,
    //             'leave_form_id' => $leave_form_id,
    //             'status' =>  $status ?? 0,
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ]);
    //     }

    //     return redirect()->route('catalog.manager-leave')->with('success', 'Form status changed');
    // }

    public function formApprovel(int $status, int $leave_form_id)
    {
        $user_id = session('isUser');

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
                dd($leaveType);
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


    public function fromRead(int $read, int $leave_form_id)
    {
        $user_id = session('isUser');
        $query = DB::table('approval')->where('user_id', $user_id)->where('leave_form_id', $leave_form_id)->first();

        if ($query) {
            DB::select("UPDATE approval SET leaveread =" . $read . " WHERE leave_form_id = " . $leave_form_id . " AND user_id = " . $user_id);
        } else {
            DB::table('approval')->insert([
                'user_id' => $user_id,
                'leave_form_id' => $leave_form_id,
                'leaveread' =>  $read ?? 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // return redirect()->route('catalog.manager-leave')->with('success', 'Form read changed');

        return redirect()->route('catalog.manager-leave')->with('success', 'Form read changed');
    }

    //Method to read a leave form
    public function readLeaveForm($id)
    {
        $user_id = session('isUser');
        $leave = ManagerLeaveForm::findOrFail($id);
        // dd($leave->user_id);
        if ($leave) {
            DB::select("UPDATE approval SET leaveread =" . 1 . " WHERE leave_form_id = " . $id . " AND user_id = " . $user_id);
            $query = DB::table('approval')->where('user_id', $user_id)->where('leave_form_id', $id)->first();
            // dd($query);
        } else {
            DB::table('approval')->insert([
                'user_id' => $leave->user_id,
                'leave_form_id' => $id,
                'leaveread' =>  $read ?? 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }


        $data['action'] = route('catalog.read', $leave->id);
        //    dd($data['action'] );
        // formApprovel($status, $leave_form_id);
        return view('catalog.form.leaveread', compact('leave', 'data'));
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
        $leavebalancedata = DB::table('leavesbalance')->where('user_id', $user_id);
        // dd($leavebalancedata);
        // $showLeave = '';
        // if($type == "Sick Leave"){
        //     $showLeave = $leavebalancedata->avl_sick_leave;
        // }else if($type == "Earned Leave"){
        //     $showLeave = $leavebalancedata->avl_earned_leave;
        // }else{
        //     $showLeave = $leavebalancedata->avl_rh_leave;
        // }
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
