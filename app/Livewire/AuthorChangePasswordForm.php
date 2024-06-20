<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Contracts\Validation\Rule;    // TODO: UNCOMMENT TO HAVE A STRONG PASSWORD

if ( !defined('__PUBLIC__') )  define('__PUBLIC__',$_SERVER['DOCUMENT_ROOT']);
require_once(__PUBLIC__.'/traits/CommonFunctions.php');
use Public\traits\CommonFunctions;

class AuthorChangePasswordForm extends Component
{
    // traits
    use CommonFunctions;

    public $current_password, $new_password, $confirm_new_password;

    public function changePassword() {
       $this->validate([
            'current_password'=>[
                'required', function($attribute, $value, $fail){
                    if ( !Hash::check($value,User::find(auth('web')->id())->password) ) {
                        return $fail(__('The current password is incorrect'));
                    }
                }
            ],
            'new_password'         => 'required|min:5|max:25',
            // TODO: UNCOMMENT NEXT validation TO HAVE A STRONG PASSWORD
            // 'current_password'=>[
            //     'required', function($attribute, $value, $fail){
            //         if ( !preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', $value) ) {
            //             return $fail('The :attribute must be more than 6 chars long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special char of   #?!@$%^&*-') ;
            //         }
            //     }
            // ],
             // TODO: END OF UNCOMMENT NEXT validation TO HAVE A STRONG PASSWORD
            'confirm_new_password' => 'same:new_password'
        ], [
            'current_password.required' => 'Enter your current password',
            'new_password.required'     => 'Enter new password',
            'confirm_new_password.same' => 'The confirm password must be equal to new password given'

        ] );
        $query = User::find(auth('web')->id())->update([
            'password'   => Hash::make($this->new_password)
        ] );

        if ($query) {
            $this->showToastr('Your password has been successfully changed', 'success');
            $this->current_password = $this->new_password = $this->confirm_new_password = null;
        } else {
            $this->showToastr('Something went wrong changing your password. Try again later.', 'error');
        }

    }

    public function render()
    {
        return view('livewire.author-change-password-form');
    }
}
