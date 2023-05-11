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
                <h3 class ="card-title">creation d'un categorie</h3>
                <div class="card-body">
                    <form method="post" action="{{route('categories.store')}}">
                        @csrf
                        <div class="form-group my-2">
                            <input type="text"
                            name="title"
                            placeholder="Titre du produit"
                            class="form-control">
                        </div>
                        <div class="form-group my-2">
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
