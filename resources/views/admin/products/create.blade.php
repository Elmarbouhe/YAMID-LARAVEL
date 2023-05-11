@extends('master.adminLayout')

@section('contentNav')
<div class="pb-8">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
            <div class="col-md-4">
                @include('master.sidebar')
            </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h3>creation d'un produit</h3>
                <div class="card-body">
                    <form method="post" action="{{route("products.store")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text"
                            name="title"
                            placeholder="Titre du produit"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea
                            name="description"
                            placeholder="Description"
                            cols="30" rows="10"
                            class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input
                            type="number"
                            name="price"
                            placeholder="Prix du produit"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <input
                            type="number"
                            name="old_price"
                            placeholder="Ancien prix du produit"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <input
                            type="number"
                            name="inStock"
                            placeholder="Quantité du produit"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <input
                            type="file"
                            name="image"
                            class="form-control">
                        </div>
                        <div  class="form-group">
                            <select name="category_id" class="form-control">
                                <option value="">Choisir une categorie</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
