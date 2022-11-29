
@extends('backend.layouts.app')

@section('title')
Category Create - Admin Panel
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
                    <h4 class="header-title"><a href="{{ route('admin.categories.index') }}">Back </a>Create New Category</h4>
                    @include('backend.layouts.messages')
                    
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="category_name" placeholder="Enter a Category Name">
                        </div>

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Category</button>
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