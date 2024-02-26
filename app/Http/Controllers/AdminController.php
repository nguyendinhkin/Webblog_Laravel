<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Contact;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
          'message' => 'User Logout Successfuly',
          'alert-type' => 'success'
        ];

        return redirect('/login')->with($notification);
    }

    public function Profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_image = $filename;
        }
        $data->save();
        $notification = [
          'message' => 'Update Profile Successfuly',
          'alert-type' => 'success'
        ];
        return redirect(Route('admin.profile'))->with($notification);
    }

    public function ChangePassword()
    {
        return view('admin.admin_change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $validatePassword = $request->validate([
           'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword))
        {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();
            session()->flash('message', 'Change Password Successfuly');
            return redirect()->back();
        } else
        {
            session()->flash('message', 'New password is not match');
            return redirect()->back();
        }
    }

    public function HomeAdmin()
    {
        $countBlog = Blog::count();
        $countPortfolio = Portfolio::count();
        $countBlogCategory = BlogCategory::count();
        $countContactMessage = Contact::count();
        $blog = Blog::latest()->take(7)->get();
        return view('admin.index', compact('blog','countBlog', 'countPortfolio', 'countBlogCategory', 'countContactMessage'));
    }
}
