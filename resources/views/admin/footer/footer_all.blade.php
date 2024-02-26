@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Footer Page</h4><br><br>
                            <form method="POST" action="{{ Route('footer.update', $allfooter->id) }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="number" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input name="number" class="form-control" type="text" placeholder="Number" id="number" value="{{ $allfooter->number }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="short_description" class="col-sm-2 col-form-label">Short Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="short_description" required="" class="form-control" id="short_description" rows="5">{{ $allfooter->short_description }}</textarea>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input name="address" class="form-control" type="text" placeholder="Address" id="address" value="{{ $allfooter->address }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" class="form-control" type="text" placeholder="Email" id="email" value="{{ $allfooter->email }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-sm-10">
                                        <input name="facebook" class="form-control" type="text" placeholder="Facebook" id="facebook" value="{{ $allfooter->facebook }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input name="twitter" class="form-control" type="text" placeholder="Twitter" id="twitter" value="{{ $allfooter->twitter }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
                                    <div class="col-sm-10">
                                        <input name="copyright" class="form-control" type="text" placeholder="Copyright" id="copyright" value="{{ $allfooter->copyright }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input class="btn btn-info waves-effect waves-light" type="submit" value="Update Footer">

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

@endsection
