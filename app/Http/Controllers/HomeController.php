<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('home')->with([
            'products' => Product::latest()->paginate(6),
            'categories' => Category::has('products')->get(),
        ]);
    }


    public function showByCategory(Category $category){
        $product = $category->products()->latest()->paginate(6);
        return view('home')->with([
            'products' => $product ,
            'categories' => Category::has('products')->get(),
        ]);


    }

}


