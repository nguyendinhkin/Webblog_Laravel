@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All portfolio</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Portfolio Name</th>
                                    <th>Portfolio Title</th>
                                    <th>Portfolio Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($allportfolio as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->portfolio_name }}</td>
                                        <td>{{ $item->portfolio_title }}</td>
                                        <td><img width="50" height="50" src="{{ asset('upload/portfolio/'.$item->portfolio_image) }}"></td>
                                        <td>
                                            <a href="{{ route('edit.portfolio', $item->id) }}" class="btn btn-info sm" title="Edit Image"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.portfolio', $item->id) }}" class="btn btn-danger sm" title="Delete Image" id="delete"><i class="fas fa-trash-alt"></i></a>
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
