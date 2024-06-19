<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

if ( !defined('__PUBLIC__') )  define('__PUBLIC__',$_SERVER['DOCUMENT_ROOT']);
require_once(__PUBLIC__.'/traits/CommonFunctions.php');
use Public\traits\CommonFunctions;

class AuthorPersonalDetails extends Component
{
    // traits
    use CommonFunctions;

    public $author;
    public $name, $username, $email,  $biography;

    public function mount() {
        $this->author =  User::find(auth('web')->id());
        $this->name   =  $this->author->name;
        $this->username   =  $this->author->username;
        $this->email   =  $this->author->email;
        $this->biography  =  $this->author->biography;
    }

    public function UpdateDetails() {
        $this->validate([
            'name'      => 'required|string',
            'username'  => 'required|unique:users,username,'.auth('web')->id()
        ]);
        User::where('id', auth('web')->id())->update([
            'name'      => $this->name,
            'username'  => $this->username,
            'biography' => $this->biography
        ]);

        // $this->emit('updateAuthorProfileHeader');    // livewire 2.x  emit() and dispatchBrowserEvent() unified to dispatch() in livewire 3.x
        $this->dispatch('updateAuthorProfileHeader');
        // $this->emit('updateTopHeader');   // livewire 2.x  emit() and dispatchBrowserEvent() unified to dispatch() in livewire 3.x
        $this->dispatch('updateTopHeader');

        $this->showToastr('Your profile info have been successfully updated', 'success');
    }
    
    public function render()
    {
        return view('livewire.author-personal-details');
    }

}
