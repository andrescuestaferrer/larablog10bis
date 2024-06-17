<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StrongPwd implements Rule
{
    public function passes($attribute, $value)
    {
        // return preg_match('/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%])(?=.*[\d\x]).*$/', $value) > 0;
        return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', $value) > 0;
    }
    public function message()
    {
        // https://stackoverflow.com/questions/31539727/laravel-password-validation-rule
        // return 'The :attribute must contain characters from at least : 1 Uppercase(A-Z), 1 Lowercase(a-z), 1 Numeric(0-9), 1 special char(!$#%), 1 unicode car ';
        // https://5balloons.info/password-regex-validation-laravel-authentication/
        return 'The :attribute must be more than 6 chars long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special char of   #?!@$%^&*-';
    }
}

class AuthorResetForm extends Component
{
    public $email, $token, $new_password, $confirm_new_password;

    public function mount(){
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function ResetHandler() {
        $this->validate([
            'email'         => 'required|email|exists:users,email',
            // 'new_password'  => 'required:min:8',            // TODO: UNCOMMENT THIS TO HAVE A STRONG PASSWORD
            // 'new_password'  => ['required', new StrongPwd], // TODO: UNCOMMENT THIS TO HAVE A STRONG PASSWORD
            'confirm_new_password'  => 'same:new_password',
        ],[
            'email.required'   => 'The email field is required',
            'email.email'      => 'Invalid email address',
            'email.exists'     => 'This email is not registered',
            'new_password.required'=> 'Enter New Password',
            'new_password.min' => 'Minimun caracter must be 5',
            'confirm_new_password' => 'The Confirmed New Password and New Password MUST MATCH'
        ]);

        $check_token = DB::table('password_reset_tokens')->where([
            'email' => $this->email,
            'token' => $this->token
        ])->first();

        if (!$check_token) {
            session()->flash('fail', 'Invalid token');
        } else {
            DB::beginTransaction();  // transaction = update user.password + delete password_resets
            $result = User::where('email', $this->email)->update([
                'password'  => Hash::make($this->new_password)
                ]);
            if (!$result) {
                DB::rollBack();
                session()->flash('fail', 'Something went wrong updating password: try again later');
            } else {
                $result = DB::table('password_reset_tokens')->where([
                    'email' => $this->email
                    ])->delete();
                if (!$result) {
                    DB::rollBack();
                    session()->flash('fail', 'Something went wrong updating password: try again later');
                } else {
                    DB::commit();  // transaction = update user.password + delete password_resets
                    $success_token = Str::random(64);
                    session()->flash('success', 'Your password has been updated successfully. Login with your email (<em>'.$this->email.'</em>) and your new password' );

                    $this->redirectRoute('author.login', ['tkn' => $success_token, 'UEmail' => $this->email]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
