<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Image;
use Carbon\Carbon;


class BlogController extends Controller
{
    public function AllBlog()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.blog_all', compact('blog'));
    }

    public function AddBlog()
    {
        $categories = BlogCategory::OrderBy('blog_category', 'ASC')->get();
        return view('admin.blog.blog_add', compact('categories'));
    }

    public function StoreBlog(Request $request)
    {
        $image = $request->file('image');
        $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(430,327)->save('upload/blog/'.$name_image);
        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_image' => $name_image,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Add Blog Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::OrderBy('blog_category', 'ASC')->get();
        return view('admin.blog.blog_edit', compact('blog', 'categories'));
    }

    public function UpdateBlog(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        if($request->file('image')) {
            $image = $request->file('image');
            $name_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_image);
            $blog->blog_image = $name_image;
        }
        $blog->blog_category_id = $request->blog_category_id;
        $blog->blog_title = $request->blog_title;
        $blog->blog_description = $request->blog_description;
        $blog->blog_tags = $request->blog_tags;
        $blog->save();

        $notification = [
            'message' => 'Update Blog Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog')->with($notification);

    }

    public function BlogDetails($id)
    {
        $blog = Blog::findOrFail($id);

        return view('fontend.blog_details', compact('blog'));
    }

    public function CategoryBlog($id)
    {
        $category = BlogCategory::findOrFail($id);
        $blog = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->paginate(10);

        return view('fontend.cat_blog_details', compact('blog', 'category'));
    }

    public function HomeBlog()
    {
        $blog = Blog::latest()->paginate(10);
        return view('fontend.home_blog', compact('blog'));
    }
}
