@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Multi Image</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>About Multi Page</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach($allImage as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img width="50" height="50" src="{{ url('upload/multi/'.$item->multi_image) }}"></td>
                                        <td>
                                            <a href="{{ route('edit.multi.image', $item->id) }}" class="btn btn-info sm" title="Edit Image"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.multi.image', $item->id) }}" class="btn btn-danger sm" title="Delete Image" id="delete"><i class="fas fa-trash-alt"></i></a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>

@endsection
