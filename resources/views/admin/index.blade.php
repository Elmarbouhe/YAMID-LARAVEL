@extends('master.adminLayout')
@section('contentNav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('admin.products') }}">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                <h3>Products</h3>
                <span class="badge badge-pill badge-light">
                    {{ $products->count() }}
                </span>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.orders') }}">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                <h3>Orders</h3>
                <span class="badge badge-pill badge-light">
                    {{ $orders->count() }}
                </span>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
@endsection





