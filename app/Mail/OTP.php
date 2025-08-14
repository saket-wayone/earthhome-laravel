<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class OTP extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    protected $aggname;
    protected $pdfname;
    /**
     * Create a new message instance.
     */
    public function __construct($id ,$aggrement =false)
    {
        $this->aggname = $aggrement  ? 'Authentication Mail' : 'Authentication Mail';
        $this->pdfname = $aggrement  ? 'Authentication Mail' : 'Authentication Mail';
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->aggname . ' : Grow Fortuna',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // now fetcheding the data from the db 
          // Fetch the risk model
          $data =  $this->id;
        $user =    User::find($data);
         $otp = rand(100000, 999999);
         
         DB::table('users')->where('id',$user->id)->update(['otp'=>$otp]);
         $info['name'] = $user->name;
         $info['otp'] = $otp;

        return $this->view('emails.otp' , compact('info'))
            ->subject('OTP');
           
    }

    
}
