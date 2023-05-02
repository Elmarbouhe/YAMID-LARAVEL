<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    //return cart items
    public function index()
    {
        return view('cart.index')->with([
            'items' => \Cart::getContent(),
        ]);
    }

    //add item to cart
    public function addProductToCart(Request $request,Product $product)
    {
        \Cart::add([
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(),
            'associatedModel' => $product,
        ]);

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier avec succès!');
    }

    //update cart product on cart
    public function updateProductOnCart(Request $request,Product $product)
    {
        \Cart::update($product->id,array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));

        return redirect()->route('cart.index')->with('success', 'la carte a été mise à jour avec succès!');
    }

    //remove item from cart
    public function removeProductFromCart(Product $product)
    {
        \Cart::remove($product->id);
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier avec succès!');
    }
}
