
@extends('backend.layouts.app')

@section('title')
Role Page - Admin Panel
@endsection

@section('styles')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection


@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title float-left">Category List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('category.create'))
                        <a class="btn btn-primary text-white" href="{{ route('admin.categories.create') }}">Create New Category</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="5%">Admin</th>
                                    <th width="10%">Category Name</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($categories as $category)
                             <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $category->admin->username }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('category.edit'))
                                    <a class="btn btn-success text-white" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('category.delete'))
                                    <a class="btn btn-danger text-white" href="{{ route('admin.categories.destroy', $category->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- data table end -->

</div>
</div>
@endsection


@section('scripts')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script>
         /*================================
        datatable active
        ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }

    </script>
    @endsection