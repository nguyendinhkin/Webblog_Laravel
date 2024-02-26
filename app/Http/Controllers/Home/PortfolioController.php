<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Image;
use Illuminate\Support\Carbon;
class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $allportfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('allportfolio'));
    }

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {
        $request->validate([
           'portfolio_name' => 'required',
           'portfolio_title' => 'required',
           'portfolio_description' => 'required'
        ], [
            'portfolio_name.required' => 'Portfolio Name is required',
            'portfolio_title.required' => 'Portfolio Title is required',
            'portfolio_description.required' => 'Portfolio Description is required'
        ]);

        $image = $request->file('image');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$image_name);

        Portfolio::insert([
           'portfolio_name' => $request->portfolio_name,
           'portfolio_title' => $request->portfolio_title,
           'portfolio_description' => $request->portfolio_description,
           'portfolio_image' => $image_name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Add Portfolio Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $id = $request->id;
        $portfolio = Portfolio::findOrFail($id);

        if($request->file('image')) {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$name_image);
            $portfolio->portfolio_image = $name_image;
        }

        $portfolio->portfolio_name = $request->portfolio_name;
        $portfolio->portfolio_title = $request->portfolio_title;
        $portfolio->portfolio_description = $request->portfolio_description;
        $portfolio->save();

        $notification = [
            'message' => 'Update Portfolio Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $image = 'upload/portfolio/'.$portfolio->portfolio_image;
        unlink($image);
        $portfolio->delete();

        $notification = [
            'message' => 'Delete Portfolio Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        return view('fontend.portfolio_details', compact('portfolio'));
    }

    public function HomePortfolio()
    {
        $portfolio = Portfolio::orderBy('id', 'DESC')->paginate(10);
        return view('fontend/portfolio', compact('portfolio'));
    }
}
