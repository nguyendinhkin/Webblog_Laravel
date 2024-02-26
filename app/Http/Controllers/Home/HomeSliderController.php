<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeSlide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeSlide'));
    }

    public function UpdateSlider(request $request)
    {
        $slide_id = $request->id;

        if($request->file('image'))
        {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_image);

            HomeSlide::findOrFail($slide_id)->update([
               'title' => $request->title,
               'short_title' => $request->short_title,
               'video_url' => $request->video_url,
               'home_slide' => $name_image
            ]);

            $notification = [
              'message' => 'Update Home Slide With Image Successfuly',
              'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = [
                'message' => 'Update Home Slide Without Image Successfuly',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }
}
