<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function AllBlogCategory()
    {
        $blogCategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blogCategory'));
    }

    public function AddBlogCategory()
    {
        return view('admin.blog_category.blog_category_add');
    }

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
           'blog_category' => 'required'
        ], [
            'blog_category.required' => 'Blog Category name is required'
        ]);

        BlogCategory::insert([
           'blog_category' => $request->blog_category
        ]);

        $notification = [
            'message' => 'Add Blog Category Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function EditBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit', compact('blogCategory'));
    }

    public function UpdateBlogCategory(Request $request, $id)
    {

        BlogCategory::findOrFail($id)->update([
           'blog_category' => $request->blog_category
        ]);

        $notification = [
            'message' => 'Update Blog Category Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'Delete Blog Category Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
