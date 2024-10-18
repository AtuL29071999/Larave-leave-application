<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\DB;

class welcomeemail extends Mailable
{
    use Queueable, SerializesModels;



    public $array;
    public $subject;
    /**
     * Create a new message instance.
     */

    public function __construct($subject, $array)
    {
        $this->subject = $subject;
        $this->array = $array;
    }

    

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        
        
        return new Envelope(
            subject: "Leave Form",
            from: new Address(env('MAIL_FROM_ADDRESS'), 'Team1')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $user_id = session('isUser');
        // dd($user_id);
        $userdata = DB::table('users')->where('id',$user_id)->first();
        // dd($userdata);
        $array = $this->array;
        $managerdata = DB::table('users')->where('email',$array['leave_manager_email'])->first();
        // dd($array);   
        return new Content(
            view: 'mail.welcomeemail',
            with: [
                'formdata' => $array,
                'managerdata' => $managerdata,
                'userdata' => $userdata
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
