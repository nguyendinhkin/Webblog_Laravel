@extends('admin.admin_master')
@section('admin')
    <style>
        .bootstrap-tagsinput .tag{
            margin-right: 2px;
            color: #b70000;
            font-weight: 700px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Blog</h4><br><br>
                            <form method="POST" action="{{ Route('store.blog') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="portfolio_name" class="col-sm-2 col-form-label">Category Name</label>
                                    <div class="col-sm-10">
                                        <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->blog_category }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                                    <div class="col-sm-10">
                                        <input name="blog_title" class="form-control" type="text" placeholder="Blog Title" id="blog_title">

                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="elm1" class="col-sm-2 col-form-label">Blog Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="blog_description" class="form-control" id="elm1" rows="5"></textarea>

                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input name="image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="ShowImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="blog_tags" class="col-sm-2 col-form-label">Blog Tags</label>
                                    <div class="col-sm-10">
                                        <input name="blog_tags" class="form-control" type="text" placeholder="Blog Tags" id="blog_tags" data-role="tagsinput">

                                    </div>
                                </div>
                                <!-- end row -->

                                <input class="btn btn-info waves-effect waves-light" type="submit" value="Add Blog">

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#image').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#ShowImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
