@extends('master.adminLayout')
@section('contentNav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-2">

        </div>
        <div class="col-md-10">
            <h3 class="text-center" style="background-color: #fff; border-radius: 10px; box-shadow: 0px 3px 10px 0px #000; padding: 10px;">
                produits</h3>

            <table class="table table-hover table-bordered" style="background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px 0px #000; padding: 10px;">
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

                    </tr>
                </thead>
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
                            <img src="{{ $product->image }}"
                            alt="{{ $product->title }}" width="50" height="50"
                            class="img-fluid rounded-circle">
                        </td>
                        <td>{{ $product->category->title }}</td>

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
