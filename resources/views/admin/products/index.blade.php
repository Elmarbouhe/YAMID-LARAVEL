@extends('master.adminLayout')
@section('contentNav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
        @include('master.sidebar')
        </div>
        <div class="col-md-8">
            <h3 class="text-center">
            <a href="{{route('products.create')}}"
            class="btn btn-primary my-2">
               <i class ="fa fa-plus"></i>
            </a>
            Liste des produits</h3>

            <table class="table table-hover table-bordered" style="background-color: #dddddd;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>titer</th>
                        <th>description</th>
                        <th>quantity</th>
                        <th>Prix</th>
                        <th>disponible</th>
                        <th>image</th>
                        <th>categorie</th>
                        <th>SPRM </th>
                        <th>MDF </th>

                    </tr>
                </thead>
                <hr>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ Str::limit($product->description, 50) }}</td>
                        <td>{{ $product->inStock }}</td>
                        <td>{{ $product->price }} DH</td>
                        <td>
                            @if ($product->inStock>0)
                            <i class="fas fa-check-circle text-success"></i>
                            @else
                            <i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <img src="{{ asset($product->image)}}"
                            alt="{{ $product->title }}" width="50" height="50"
                            class="img-fluid rounded-circle">
                        </td>
                        <td>{{ $product->category->title }}</td>
                        <td>
                            {{-- supprition d'un produit --}}
                            <form id="{{ $product->id }}" method="POST" action="{{ route("products.destroy" , $product->slug) }}">
                                @csrf
                                @method("DELETE")
                                <button
                                onclick="event.preventDefault();
                                   if(confirm('Do you really want to delete the product {{$product->title}} ?'))
                                    document.getElementById({{ $product->id }}).submit();"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        <td>
                            {{-- modification d'un produit --}}
                            <form method="POST" action="{{ route('products.update' , $product->id) }}">
                                @csrf
                                @method("PUT")
                                <button class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
             <hr>
                <div class="justify-content-center d-flex">
                    {{ $products->links() }}
                </div>
    </div>
</div>
@endsection
