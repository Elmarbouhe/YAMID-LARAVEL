<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Shop;

class ShopController extends Controller
{
    public function register()
    {
        return view('shop.register');
    }

    public function processRegister(Request $request)
    {




        $name = $request->input('name');

         Shop :: create([
            'name'=>$request->input('name'),
            'latitude'=>$request->input('latitude'),
            'longitude'=>$request->input('longitude'),

        ]);


        return redirect()->route('shop.register')->with('success', 'Shop registered successfully!');

    }
}
