@extends('admin.admin_master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Portfolio</h4><br><br>
                            <form method="POST" action="{{ Route('update.portfolio') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $portfolio->id }}">
                                <div class="row mb-3">
                                    <label for="portfolio_name" class="col-sm-2 col-form-label">Portfolio Name</label>
                                    <div class="col-sm-10">
                                        <input name="portfolio_name" class="form-control" type="text" placeholder="Portfolio Name" id="portfolio_name" value="{{ $portfolio->portfolio_name }}">

                                    </div>

                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="portfolio_title" class="col-sm-2 col-form-label">Portfolio Title</label>
                                    <div class="col-sm-10">
                                        <input name="portfolio_title" class="form-control" type="text" placeholder="Portfolio Title" id="portfolio_title" value="{{ $portfolio->portfolio_title }}">

                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="elm1" class="col-sm-2 col-form-label">Portfolio Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="portfolio_description" class="form-control" id="elm1" rows="5">{{ $portfolio->portfolio_description }}</textarea>
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
                                        <img id="ShowImage" class="rounded avatar-lg" src="{{ url('upload/portfolio/'.$portfolio->portfolio_image) }}" alt="Card image cap">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input class="btn btn-info waves-effect waves-light" type="submit" value="Update Portfolio">

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
