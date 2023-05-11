@extends('master.adminLayout')
@section('contentNav')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
        @include('master.sidebar')
        </div>
        <div class="col-md-8">
            <h3 class="text-center">Liste des commandes</h3>
            <table class="table table-hover table-bordered" style="background-color: dddddd; ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nom</th>
                        <th>produit</th>
                        <th>quantity</th>
                        <th>Prix</th>
                        <th>total</th>
                        <th>Piement</th>
                        <th>livré</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <hr>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }} DH</td>
                        <td>{{ $order->total }} DH</td>
                        <td>
                            @if ($order->paid)
                            <i class="fas fa-times-circle text-success"></i>
                            @else
                            <i class="fas fa-check-circle text-danger"></i>
                            @endif
                        </td>
                        <td>
                            @if ($order->delivered)
                            <i class="fas fa-times-circle text-success"></i>
                            @else
                            <i class="fas fa-check-circle text-danger"></i>
                            @endif
                        <td>

                            <a href="" class="btn btn-success btn-sm">Edit</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
             <hr>
                <div class="justify-content-center d-flex">
                    {{ $orders->links() }}
                </div>
    </div>
</div>
@endsection
