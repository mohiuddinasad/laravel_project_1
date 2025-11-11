<?php

namespace App\Http\Controllers\Backend\MyProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SweetAlert2\Laravel\Swal;

class MyProfileController extends Controller
{

    // profile view
    public function profile_view()
    {
        $user = Auth::user();
        return view('backend.myProfile.profileView', compact('user'));
    }

    public function profile_info(Request $request)
    {
        // handle profile info update


        // profile info validation
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'phone' => 'required',

        ]);
        $userInfo = Auth::user();
        $userInfo->name = $request->name;
        $userInfo->email = $request->email;
        $userInfo->title = $request->title;
        $userInfo->phone = $request->phone;
        $userInfo->description = $request->description;
        Swal::success([
            'title' => 'Information Updated',
        ]);


        $userInfo->save();
        return back();


    }

    // profile image update
    public function profile_image(Request $request)
    {
        $userImage = Auth::user();
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $uniName = 'profile-' . time() . '-' . $request->profile_image->getClientOriginalName();
            $image->storeAs('profileImages/', $uniName, 'public');
            $userImage->profile_image = $uniName;
            $userImage->save();
            Swal::success([
                'title' => 'Image Updated',
            ]);

            return back();
        }
    }

    // password update
    public function profile_pass(Request $request)
    {
        $userPass = Auth::user();
        if (!Hash::check($request->current_pass, $userPass->password)) {
            return back()->with('error', 'current password not match');
        }
        if ($request->new_pass != $request->confirm_pass) {
            return back()->with('confirm_error', 'confirm pass not match!');
        } else {
            $userPass->password = Hash::make($request->new_pass);
            $userPass->save();
            Swal::success([
                'title' => 'Password Updated',
            ]);


            return back();
        }

    }
}
