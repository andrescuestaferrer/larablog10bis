<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLoginForm extends Component
{
    public $email, $password; 

    public function LoginHandler() {

        $this->validate([
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required:min:5'
        ],[
            'email'            => 'Enter your email address',
            'email.email'      => 'Invalid email address',
            'email.exists'     => 'This email is not registered in database',
            'password.required'=> 'Password is required'
        ]);

        $credentials = array('email' => $this->email, 'password' => $this->password);

        if( Auth::guard('web')->attempt($credentials) ) {
            $checkuser = User::where('email', $this->email)->first();
            if ($checkuser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been blocked.');
            } else {
                return redirect()->route('author.home');
            }
        } else {
            session()->flash('fail', 'Incorrect email/username or password');
        }
    }    
    
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
