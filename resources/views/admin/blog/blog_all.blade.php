@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Blog</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Blog Category</th>
                                    <th>Blog Title</th>
                                    <th>Blog Image</th>
                                    <th>Blog Tags</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>

                                @foreach($blog as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->category->blog_category }}</td>
                                        <td>{{ $item->blog_title }}</td>
                                        <td><img width="50" height="50" src="{{ asset('upload/blog/'.$item->blog_image) }}"></td>
                                        <td>{{ $item->blog_tags }}</td>
                                        <td>
                                            <a href="{{ route('edit.blog', $item->id) }}" class="btn btn-info sm" title="Edit Blog"><i class="fas fa-edit"></i></a>
                                            <a href="" class="btn btn-danger sm" title="Delete Blog" id="delete"><i class="fas fa-trash-alt"></i></a>
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
