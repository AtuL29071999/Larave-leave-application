<?php

namespace App\Models\Catalog\Form;

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


    public static function register($data = array()){
        $query = DB::table('users')->insert([
            'image' => $data['profileimage'],
            'fullName' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'termsCheck' => isset($data['termsCheck']) ? 1 : 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if($query){
            return true;
        }else{
            return false;
        }
    }
}
