<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Facades\Redirect;
use Image;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutPage'));
    }

    public function UpdateAbout(request $request)
    {
        $about_id = $request->id;

        if($request->file('image')) {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_image);

            About::findOrFail($about_id)->update([
               'title' => $request->title,
               'short_title' => $request->short_title,
               'short_description' => $request->short_description,
               'long_description' => $request->long_description,
               'about_image' => $name_image,
            ]);

            $notification = [
              'message' => 'Update About Page With Image Successfuly',
              'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = [
                'message' => 'Update About Page Without Image Successfuly',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function HomeAbout()
    {
        $aboutPage = About::find(1);
        return view('fontend.about_page', compact('aboutPage'));
    }

    public function AboutMultiImage()
    {
        return view('admin.about_page.multi_image');
    }

    public function StoreMultiImage(Request $request)
    {
        $image = $request->file('image');

        foreach ($image as $multi_image) {
            $name_image = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_image);
            MultiImage::insert([
               'multi_image' => $name_image,
                'created_at' => Carbon::now()
            ]);
        } //end foreach
        $notification = [
          'message' => 'Add About Multi Image Successfuly',
          'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function AllMultiImage()
    {
        $allImage = MultiImage::all();
        return view('admin.about_page.all_multi_image', compact('allImage'));
    }

    public function EditMultiImage($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));
    }

    public function UpdateMultiImage(Request $request)
    {
        $id = $request->id;
        if($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);

            MultiImage::findOrFail($id)->update([
               'multi_image' => $name_gen
            ]);
            $notification = [
              'message' => 'Update Multi Image Successfuly',
              'alert-type' => 'success'
            ];


        } else {
            $notification = [
              'message' => 'Update Multi Image Fail',
              'alert-type' => 'error'
            ];
            return Redirect::route('edit.multi.image', $id)->with($notification);
        }

        return Redirect::route('all.multi.image')->with($notification);
    }

    public function DeleteMultiImage($id)
    {
        $multi = MultiImage::findOrFail($id);
        $image = 'upload/multi/' . $multi->multi_image;
        unlink($image);

        MultiImage::findOrFail($id)->delete();

        $notification = [
            'message' => 'Delete Multi Image Successfuly',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
