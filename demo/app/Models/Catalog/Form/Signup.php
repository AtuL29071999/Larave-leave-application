<?php

namespace App\Models\Catalog\Form;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Signup extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['fullName', 'email', 'password', 'role', 'termsCheck'];


    // Define the relationship with the LeaveForm model
    public function leaveForms()
    {
        return $this->hasMany(LeaveForm::class, 'signup_id');
    }


    public static function register($data = array())
    {

        // dd($data);
        $user_id = DB::table('users')->insertGetId([
            'image' => $data['profileimage'],
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'termsCheck' => isset($data['termsCheck']) ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // dd($query);

        if ($user_id) {
            // Assign leaves after user is registered
            self::assignLeaves($user_id);
            return true;
        } else {
            return false;
        }
    }


    public static function assignLeaves($user_id)
    {
        $currentDate = Carbon::now();
        $dayOfMonth = $currentDate->day;
        $currentMonth = $currentDate->month;

        // Total annual leaves
        $rhLeave = 2; // Fixed 2 leaves for the entire year

        // Sick and Earned Leave based on the remaining months
        // By default, each month provides 1 sick leave and 1 earned leave.
        // Special case: If user signs up in the current month, total leave is 2.5 sick leave + 2.5 earned leave.

        if ($dayOfMonth > 15) {
            // Case when user signs up after 15th of the month
            $sickLeave = 2.5;
            $earnedLeave = 2.5;
        } else {
            // Normal case for the remaining months
            $monthsLeftInYear = 12 - $currentMonth + 1; // Calculate months left including the current month
            $sickLeave = $monthsLeftInYear;
            $earnedLeave = $monthsLeftInYear;
        }

        // Total leaves
        $totalLeave = $sickLeave + $earnedLeave + $rhLeave;

        // Insert leave data for the user
        DB::table('leavesbalance')->insert([
            'user_id' => $user_id,
            'total_leave' => $totalLeave,
            'sick_leave' => $sickLeave,
            'avl_sick_leave' => $sickLeave,  // Leaves assigned according to months left in the year
            'earned_leave' => $earnedLeave,
            'avl_earned_leave' => $earnedLeave, // Leaves assigned according to months left in the year
            'rh_leave' => $rhLeave,
            'avl_rh_leave' => $rhLeave, // Fixed 2 leaves for RH
            'leave_taken_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }



    // Method to apply leave
    public function applyLeave($leaveType, $days)
    {
        // Fetch the user's current leave balance
        $leave = DB::table('leavesbalance')->where('user_id', $this->id)->first();

        if (!$leave) {
            return ['status' => false, 'message' => 'Leave data not found for the user.'];
        }

        // Check leave type and deduct accordingly
        switch ($leaveType) {
            case 'sick':
                if ($leave->sick_leave >= $days) {
                    // Deduct sick leave
                    DB::table('leavesbalance')
                        ->where('user_id', $this->id)
                        ->update(['sick_leave' => $leave->sick_leave - $days]);
                } else {
                    return ['status' => false, 'message' => 'Insufficient sick leave.'];
                }
                break;

            case 'earned':
                if ($leave->earned_leave >= $days) {
                    // Deduct earned leave
                    DB::table('leavesbalance')
                        ->where('user_id', $this->id)
                        ->update(['earned_leave' => $leave->earned_leave - $days]);
                } else {
                    return ['status' => false, 'message' => 'Insufficient earned leave.'];
                }
                break;

            case 'rh':
                if ($leave->rh_leave >= $days) {
                    // Deduct RH leave
                    DB::table('leavesbalance')
                        ->where('user_id', $this->id)
                        ->update(['rh_leave' => $leave->rh_leave - $days]);
                } else {
                    return ['status' => false, 'message' => 'Insufficient RH leave.'];
                }
                break;

            default:
                return ['status' => false, 'message' => 'Invalid leave type.'];
        }

        return ['status' => true, 'message' => 'Leave applied successfully.'];
    }
}
