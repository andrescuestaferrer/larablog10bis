<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\App; 

// class Uppercase implements Rule
// {
//     public function passes($attribute, $value)
//     {
//         return preg_match('/^[A-Z][A-Z0-9]{5,31}$/', $value) > 0;
//     }
//     public function message()
//     {
//         return 'The :attribute must be all UPPERCASE LETTERS and numbers';
//     }
// }

class UserCaseSensitive implements Rule
{
    public function passes($attribute, $value)
    {
        return User::where(DB::raw('BINARY `username`'), $value)->first();
    }
    public function message()
    {
        return 'The username is case sensitive and is not registered';
    }
}

class AuthorLoginForm extends Component
{
    public $login_id, $password, $username; 

    public function LoginHandler() {
        // $oldLocale = App::currentLocale() ; App::setLocale('es'); 

        $this->username = $this->login_id;
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ( $fieldType == 'email') {
            $this->validate([
                'login_id'  => 'required|email|exists:users,email',
                'password'  => 'required:min:5'
            ],[
                'login_id'         => 'Email is required',
                'login_id.email'   => 'Invalid email address',
                'login_id.exists'  => 'This email is not registered in database',
                'password.required'=> 'Password is required'
            ]);
        } else {
            $this->validate([
                // 'login_id'  => 'required|exists:users,username',
                'login_id'  => ['required', new UserCaseSensitive],
                // 'login_id'  => 'required|regex:/^[A-Za-z][A-Za-z0-9]{5,31}$/',
                // 'login_id'  => ['required', new Uppercase],
                'password'  => 'required:min:5'
            ],[
                // 'login_id.required' => 'Username is required',
                // 'login_id.exists'   => 'Username is not registered in database',
                'password.required' => __('Password is required')
                // 'password.required' => __('validation.custom.password.required')
                // 'password.required' => __('required', ['attribute' => 'contraseña']) 
            ]);
        }

        // App::setLocale($oldLocale);

        $credentials = array($fieldType => $this->login_id, 'password' => $this->password);

        if( Auth::guard('web')->attempt($credentials) ) {
            $checkuser = User::where($fieldType, $this->login_id)->first();
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
