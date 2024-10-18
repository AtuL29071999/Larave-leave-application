<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    
    public static function  sendEmail($array = []){

        // dd( $array['leave_application_type'] );
        $toEmail = "atulkr803@gmail.com";
        $message = "Hello welcome to our website";
        $subject = "Welcome to Team1";

        

        $adminEMail = "atulkr803@gmail.com";
        // dd($adminEMail);
        $response = Mail::to($adminEMail)->send(new welcomeemail($subject,$array));

        if($response){
            return back()->with('success',"Thanks you for contacting us");
        }else{
            return back()->with('error',"Unable to submit leave form. Please try again");
        }
    }
}
