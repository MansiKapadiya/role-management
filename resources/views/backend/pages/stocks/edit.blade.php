
@extends('backend.layouts.app')

@section('title')
Stock Edit - Admin Panel
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
                    <h4 class="header-title"><a href="{{ route('admin.stock.index') }}">Back </a>Edit Stock</h4>
                    @include('backend.layouts.messages')
                    
                    <form action="{{ route('admin.stock.update', $stock->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Select Product</label>
                            <select  class="form-control" name="product_id">
                                <option value="">Select Product</option>
                                @foreach($products AS $product)
                                <option value="{{ $product->id }}" {{ ($product->product_id == $product->id) ? 'selected' : ''}}>{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Earn Amount</label>
                            <input type="number" class="form-control" id="quantity"  value="{{ $stock->quantity }}" name="quantity" placeholder="Enter a Earn Amount">
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