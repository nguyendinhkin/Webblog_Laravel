@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Blog Category</h4><br><br>
                            <form method="POST" action="{{ Route('update.blog.category', $blogCategory->id) }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $blogCategory->id }}">
                                <div class="row mb-3">
                                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <input name="blog_category" class="form-control" type="text" placeholder="Category Name" id="category_name" value="{{ $blogCategory->blog_category }}">
                                    </div>

                                </div>
                                <!-- end row -->

                                <input class="btn btn-info waves-effect waves-light" type="submit" value="Update Blog Category">

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
