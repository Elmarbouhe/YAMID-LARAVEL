@extends('master.layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 card my-5">
            <h4>Votre Panier</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>image</th>
                        <th>Titre</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td><img src="{{ $item->associatedModel->image }}"
                             alt="{{ $item->title }}"
                             width="50"
                             height="50"
                            class="img-fluid rounded-circle">
                            </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form  class="d-flex flex-row justify-content-center align-items-center" action="{{route('cart.update', $item->associatedModel->slug)}}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <input type="number" name="quantity" id="quantity"
                                        value="{{ $item->quantity }}"
                                        placeholder="Quantité"
                                        max = "{{$item->associatedModel->inStock}}"
                                        min="1"
                                        class="form-control">
                                </div>
                                <div class="form-group my-2">
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->price * $item->quantity }}</td>
                        <td>
                            <form  class="d-flex flex-row justify-content-center align-items-center" action="{{route('remove.cart', $item->associatedModel->slug)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <div class="form-group my-2">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="text-dark" font-weight-bold>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>{{ Cart::getTotal() }} DH</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
