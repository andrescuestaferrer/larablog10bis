<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthorForgotForm extends Component
{
    public $email;

    public function ForgotHandler() {
        $this->validate([
            'email'  => 'required|email|exists:users,email'
        ],[
            'email.require'    => 'The :attribute is required',
            'email.email'      => 'Invalid email address',
            'email.exists'     => 'This :attribute is not registered in database'
        ]);

        $token =  base64_encode(Str::random(64));
        // Prevent duplication of password_reset_tokens by email
        $result = DB::table('password_reset_tokens')->where('email', $this->email)->first();
        if ($result != null) {
            session()->flash('fail', 'We have already e-mailed your password reset link. Please check your spam folder if not found');
            return;
        }

        DB::table('password_reset_tokens')->insert([
            'email'      => $this->email,
            'token'      => $token,
            'created_at' => Carbon::now()
        ]);
        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-form',['token' => $token, 'email' => $this->email]);
        $body_message = "<br>We have received a request to reset the password for <b><i>".$user->name."</i></b> account associated with <b><i>".
            $this->email."</i></b>. <br> You can reset your password by clicking the button below.";
        $body_message .= '<br>';
        $body_message .= '<a href="'.$link.'" target="_blank"  style="color:#FFF;border-color:#22bc68;border-style:solid;border-width:10px 180px; background-color:#22bc66; display:inline-block; text-decoration:none; border-radius:3px; box-shadow:0 2px 3px rgb(0,0,0,0.16); -webkit-text-size-adjust:none; box-sizing;border-box" > Reset Password on Larablog10</a> ';
        $body_message .= '<br>';
        $body_message .= 'If you did not request for a password reset, please ignore this email.';

        $data = array(
            'name'         => $user->name,
            'body_message' => $body_message
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user) {
            $message->from('noreply@example.com', 'Larablog10');
            $message->to($user->email , $user->name)
                    ->subject('Reset Password on Larablog10');
        });

        session()->flash('success', 'We have e-mailed your password reset link to '.$this->email.' .');
        $this->email = null;
    }  //End of ForgotHandler()

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
