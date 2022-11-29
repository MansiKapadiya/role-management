
@extends('backend.layouts.app')

@section('title')
Product Page - Admin Panel
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
                    <h4 class="header-title float-left">Product List</h4>
                    <p class="float-right mb-2">
                        @if (Auth::guard('admin')->user()->can('product.create'))
                        <a class="btn btn-primary text-white" href="{{ route('admin.products.create') }}">Create New Product</a>
                        @endif
                    </p>
                    <div class="clearfix"></div>
                    <div class="data-tables">
                        @include('backend.layouts.messages')
                        <table id="dataTable" class="text-center">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Admin</th>
                                    <th width="10%">Category Name</th>
                                    <th width="10%">Product Name</th>
                                    <th width="10%">Description</th>
                                    <th width="10%">Image</th>
                                    <th width="10%">Price</th>
                                    <th width="10%">Total Quantity</th>
                                    <th width="10%">Used Quantity</th>
                                    <th width="10%">Remaining Quantity</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($products as $product)
                             <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $product->admin->username }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->description }}</td>
                                <td><img src="/images/{{ $product->image}}" style="width:60px;height:60px;"/></td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->total_quantity }}</td>
                                <td>{{ $product->used_quantity }}</td>
                                <td>{{ $product->remaining_quantity }}</td>
                                <td>
                                    @if (Auth::guard('admin')->user()->can('product.edit'))
                                    <a class="btn btn-success text-white" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                    @endif
                                    @if (Auth::guard('admin')->user()->can('product.delete'))
                                    <a class="btn btn-danger text-white" href="{{ route('admin.products.destroy', $product->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();">
                                        Delete
                                    </a>
                                    @endif

                                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
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