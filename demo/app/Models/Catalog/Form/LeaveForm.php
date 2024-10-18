<?php

namespace App\Models\Catalog\Form;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveForm extends Model
{
    use HasFactory;

    protected $table = 'leave_form';

    protected $fillable = [
        'leave_application_type',
        'leave_apply_date',
        'leave_type',
        'leave_date_from',
        'leave_date_to',
        'leave_half_day',
        'leave_day',
        'leave_reason',
        'leave_manager_email',
        'leave_cc_email',
        'leave_contact_no',
        'leave_medical_certificate',
        'read',
        'status',
        'user_id'
    ];

    public function signup()
    {
        return $this->belongsTo(Signup::class, 'signup_id');
    }


    public static function addLeaveForm($array = []){

        $result = DB::table('leave_form')->insert([
            'user_id' => session('isUser') ?? null,
            'leave_application_type' => $array['leave_application_type'] ?? null,
            'leave_apply_date' => $array['leave_apply_date'] ?? null,
            'leave_type' => $array['leave_type'] ?? null,
            'leave_date_from' => $array['leave_date_from'] ?? null,
            'leave_date_to' => $array['leave_date_to'] ?? null,
            'leave_half_day' => $array['leave_half_day'] ?? null,
            'leave_day' => $array['leave_day'] ?? null,
            'leave_reason' => $array['leave_reason'] ?? null,
            'leave_manager_email' => $array['leave_manager_email'] ?? null,
            'leave_cc_email' => $array['leave_cc_email'] ?? null,
            'leave_contact_no' => $array['leave_contact_no'] ?? null,
            'leave_medical_certificate' => $array['leave_medical_certificate'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
            'read' => 0,
            'status' => 0,
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    }



    public static function updateLeaveForm($array = []){
        $result = DB::table('leave_form')->update([
            'leave_application_type' => $array['leave_application_type'],
            'leave_apply_date' => $array['leave_apply_date'] ?? null,
            'leave_type' => $array['leave_type'] ?? null,
            'leave_date_from' => $array['leave_date_from'] ?? null,
            'leave_date_to' => $array['leave_date_to'] ?? null,
            'leave_half_day' => $array['leave_half_day'] ?? null,
            'leave_day' => $array['leave_day'] ?? null,
            'leave_reason' => $array['leave_reason'] ?? null,
            'leave_manager_email' => $array['leave_manager_email'] ?? null,
            'leave_cc_email' => $array['leave_cc_email'] ?? null,
            'leave_contact_no' => $array['leave_contact_no'] ?? null,
            'leave_medical_certificate' => $array['leave_medical_certificate'] ?? null,
            'updated_at' => now()
        ]);

        if($result){
            return true;
        }else{
            return false;
        }
    
    }
    
}
