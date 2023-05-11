@extends('master.layout')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <div class="card my-2">
                <h3 class="card-header">YAMID
                </h3>
                              @if (session('success'))
                                <div class="alert alert-success my-2" role="alert">
                                {{ session('success') }}
                                </div>
                              @endif
                              @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                </div>
                              @endif
                <div class="card-body ">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-4 mb-2 shadow-sm ">
                                <div class="card" style="width:18rem,height:100%">
                                    <div class="card-img-top">
                                                    <img src="{{asset($product->image)}}" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="card-body">
                                         <h5 class="card-title">{{ $product->title }}</h5>
                                         <h5 class="card-title">{{ $product->user ? $product->user->name : null }}</h5>
                                         <p class="d-flex flex-row justify-content-between align-items-center">
                                            <span class="text-muted">
                                                {{ $product->price}} DH
                                            </span>
                                            <span class="text-danger">
                                                <strike>
                                                {{ $product->old_price}} DH
                                                </strike>
                                            </span>
                                         </p>
                                         <p class="card-text">
                                            {{ Str::limit($product->body, 100) }}
                                         </p>
                                         <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">
                                            <li class="fas fa-eye"></li>
                                            Voire
                                         </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                     <div class="d-flex justify-content-center my-4">
                        {{ $products->links() }}
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-4">
            <div class="list-group my-2">
                <li class="list-group-item active">
                    <i class='fas fa-book-medical' style='font-size:24px;color:rgb(255, 255, 255)'></i>
                     Para categories
                </li>
                @foreach ($categories as $category)
                <a href="{{route('category.products', $category->slug)}}" class="list-group-item list-group-item-action">
                    {{$category->title}}
                    {{ $category->products->count()}}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
