
@extends('backend.layouts.app')

@section('title')
Category Edit - Admin Panel
@endsection

@section('styles')
<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('content')

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"><a href="{{ route('admin.categories.index') }}">Back </a>Edit Category</h4>
                    @include('backend.layouts.messages')
                    
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="category_name" value="{{ $category->category_name }}" name="category_name" placeholder="Enter a Category Name">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection


@section('scripts')

@endsection