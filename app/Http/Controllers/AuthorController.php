<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    //
    public function index(Request $request){
        return view('back.pages.home');
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function ResetForm(Request $request, $token = null) {
        $data = [
            'pageTitle' => 'Reset Password'
        ];
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    // service called from  ijaboCropTool  when process URL 'processUrl'
    public function changeProfilePicture(Request $request) {
        $user = User::find(auth('web')->id());
        $path = 'back/dist/img/authors/';
        $file = $request->file('file');
        $old_picture = $user->getAttributes()['picture'];
        $file_path = $path.$old_picture;
        $new_picture_name = 'AIMG'.$user->id.time().rand(1,100000).'.jpg';

        if ( $old_picture != null && File::exists(public_path($file_path)) ) {
            File::delete(public_path($file_path));
        }
        $upload = $file->move(public_path($path), $new_picture_name);
        if ($upload) {
            $user->update([
                'picture' => $new_picture_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Your profile picture has been successfully updated']);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong when updating profile picture']);
        }
    }

    // Change Blog logo/Favicon get from file on 'back/dist/img/logo-favicon/'
    //   whose name is in the Database  '\App\Models\Setting::find(1)->$request['changeBlogPic']' 
    //   and $request['changeBlogPic'] is the field of the table settings that contains the name of the file
    public function changeBlogPic(Request $request) {
        $whatPic = $request['changeBlogPic'];
        // dd('$whatPic= '.$whatPic);  // 'blog_logo' or 'blog_favicon'
        $file = $request->file($whatPic);
        $extension = $file->getClientOriginalExtension();
        $pic_path = 'back/dist/img/logo-favicon/';
       
        $settings = Setting::find(1);
        $old_pic = $settings->getAttributes()[$whatPic];
        $filename = time().'_'.rand(1,100000).'_lara'.$whatPic.$extension;

        if ($request->hasFile($whatPic)) {
            if ($old_pic != null && File::exists(public_path($pic_path.$old_pic)) ) {
                File::delete(public_path($pic_path.$old_pic));
            }
            $upload = $file->move(public_path($pic_path), $filename);
            if ($upload) {
                $settings->update([
                    $whatPic => $filename
                ]);
                return response()->json(['status' => 1, 'msg' => 'Your '.$whatPic.' has been successfully updated']);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong when updating '.$whatPic]);
            }
        }
    }


}
