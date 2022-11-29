@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <div>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    </div>
                    @endif


                    <div class="row">
                        @foreach($products As $product)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">{{$product->product_name}}</div>

                                <div class="card-body">
                                    <img src="/images/{{ $product->image}}" style="width:20rem;height:20rem;" />
                                </div>
                                <a class="btn btn-primary text-white" href="{{ route('addToCart', $product->id) }}" onclick="event.preventDefault(); document.getElementById('cart-form-{{ $product->id }}').submit();">
                                    Add To Cart
                                </a>
                                <form id="cart-form-{{ $product->id }}" action="{{ route('addToCart', $product->id) }}" method="POST" style="display: none;">
                                    @method('GET')
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection