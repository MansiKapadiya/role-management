
@extends('backend.layouts.app')

@section('title')
Product Edit - Admin Panel
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
                    <h4 class="header-title"><a href="{{ route('admin.products.index') }}">Back </a>Edit Product</h4>
                    @include('backend.layouts.messages')
                    
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Select Category</label>
                            <select  class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories AS $category)
                                <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : ''}}>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $product->product_name }}" name="product_name" placeholder="Enter a Product Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Product Description</label>
                            <textarea class="form-control" id="description" name="description" rows="2">{{ $product->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <img src="/images/{{ $product->image}}" style="width:60px;height:60px;"/>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter a Product Price" value="{{ $product->price }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update Product</button>
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