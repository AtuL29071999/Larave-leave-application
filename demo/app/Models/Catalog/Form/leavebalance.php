<?php

namespace App\Models\Catalog\Form;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leavebalance extends Model
{
    use HasFactory;

    protected $table = 'leaves';

    protected $fillable = ['user_id', 'total_leave', 'sick_leave', 'earned_leave', 'rh_leave', 'leave_taken_at'];
}
