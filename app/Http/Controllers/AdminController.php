<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['showAdminLoginForm','admineLogin']);
    }

    public function index()
    {
        return view('admin.index')->with([
            "products" => Product::all(),
            "orders" => Order::all(),
        ]);
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    public function admineLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);
        if (auth()->guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
            ],$request->get('remember')))
            {return redirect('/admin');
            }else{
                return redirect()->route('admin.login')->with('error','Email-Address And Password Are Wrong.' );
            }
    }

    public function getProducts()
    {
        return view('admin.products.index')->with([
            "products" => Product::latest()->paginate(5),
        ]);
    }

    public function getOrders()
    {
        return view('admin.orders.index')->with([
            "orders" => Order::latest()->paginate(8),
        ]);
    }



    public function adminLogout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }


}
