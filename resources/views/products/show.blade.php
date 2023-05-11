@extends('master.layout')
@section('content')
<title>  {{ $product->title }} </title>


    <div class="container my-2">
        <div class="row">
            <div class="col-md-8">
                 <div class="card">
                    <h3 class="card-header">{{$product->title }} </h3>
                                    <div class="card-img-top">
                                         <img src="{{asset($product->image)}}" class="img-fluid w-100" alt="...">
                                    </div>
                                    <div class="card-body">
                                         <h5 class="card-title">{{ $product->title }}</h5>
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
                                            {{ ($product->body) }}
                                         </p>
                                         <p class ="font-weight-bold">
                                            @if ($product->inStock > 0)
                                                <span class="text-success">
                                                    Disponible
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    Pas Disponible
                                                </span>
                                            @endif

                                         </p>

                                    </div>

                            @if (Auth::check())
                            @if(Auth::user()->id == $product->user_id || Auth::user()->admin)
                                <a href="{{route('products.edit',$product->slug) }}" class="btn btn-warning">
                                    Modifier
                                </a>
                                <form id="{{ $product->id }}" action="{{route('products.destroy',$product->slug)}}" method="product">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button
                                    onclick="event.preventDefault();
                                    if(confirm('Voulez vous vraiment supprimer ce product?'))
                                    document.getElementById({{ $product->id}}).submit();"
                                    class="btn btn-danger" type="submit">
                                    Supprimer
                                </button>
                            @endif
                            @endif
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Vendeur</h3>
                    <div class="card-body">
                        <p class="card-text">
                            <span class="font-weight-bold">
                                Nom:
                            </span>
                            {{$product->user->name}}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">
                                Email:
                            </span>
                            {{$product->user->email}}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">
                                Téléphone:
                            </span>
                            {{$product->user->phone}}
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">
                                Adresse:
                            </span>
                            {{$product->user->address}}
                        </p>
                    </div>
                </div> --}}
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header">Choisissez votre quantité</h3>
                        <div class="card-body">
                            <form action="{{route('add.cart',$product->slug)}}" method='POST'>
                                @csrf
                                <div class="form-group">
                                    <label for="quantity" class="label-input my-2">
                                        Quantité disponible: {{$product->inStock}}
                                    </label>
                                    <input type="number" name="quantity" id="quantity"
                                        value="1"
                                        placeholder="Quantité"
                                        max = "{{$product->inStock}}"
                                        min="1"
                                        class="form-control"
                                    >
                                </div>
                                <div class="form-group my-2">
                                    <button type="submit" class="btn btn-block bg-dark text-white">
                                        <i class="fas fa-shopping-cart"></i>
                                        Ajouter au panier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                 </div>
        </div>
    </div>

@endsection

