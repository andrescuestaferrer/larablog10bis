<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

if ( !defined('__PUBLIC__') )  define('__PUBLIC__',$_SERVER['DOCUMENT_ROOT']);
require_once(__PUBLIC__.'/traits/CommonFunctions.php');;
use Public\traits\CommonFunctions;

class AuthorGeneralSettings extends Component
{
    // traits
    use CommonFunctions;

    public $settings;
    public $blog_name, $blog_email, $blog_description ;

    public function mount() {
        $this->settings = Setting::find(1);
        $this->blog_name = $this->settings->blog_name;
        $this->blog_email = $this->settings->blog_email;
        $this->blog_description = $this->settings->blog_description;
    }

    public function updateGeneralSettings() {
        $this->validate([
            'blog_name'    => 'required',
            'blog_email'   => 'required|email',
        ]);

        $update = $this->settings->update([
            'blog_name'        => $this->blog_name,
            'blog_email'       => $this->blog_email,
            'blog_description' => $this->blog_description,
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),  // time UTC
        ]);

        if ($update) {
            $this->showToastr('General setting have been successfully changed', 'success');
            $this->Dispatch('updateAuthorFooter');
        } else {
            $this->showToastr('Something went wrong changing general settings. Try again later.', 'error');
        }
    }

    public function render()
    {
        return view('livewire.author-general-settings');
    }
}
