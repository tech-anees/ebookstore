<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use File;

class HomeController extends Controller
{
    public function profile()
    {
        return view('admin.custom_auth.profile');
    }

    public function profile_update(Request $request)
    {
        $user = Auth()->user();
        
        $request->validate([
            'name' => ['required'],
            'designation' => ['required'],
            'bio' => ['required'],
        ]);

        $fileName = null;
        if (request()->hasFile('user_img')) 
        {
            $file = request()->file('user_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/', $fileName);

            File::delete('./uploads/' . $user->user_img);
        }

        $data = $request->all();
        $data['user_img'] = $fileName;
        $user->update($data);

        return redirect()->back();
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back();
    }

    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }
}
