<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Dimensions;


class ProductController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:admin')->except(['showAdminLoginForm','admineLogin']);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home')->with([
            'products' => Product::latest()->paginate(8),
            'categories' => Category::has('products')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        //
        return view("admin.products.create")->with([
            "categories"=> Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|min:3',
        'description' => 'required|min:5',
        'image' => 'image|mimes:png,jpg,jpeg|max:8000',
        'price' => 'required|numeric',
        'category_id' => 'required|numeric',
    ]);


    //add image
    if ($request->has("image")) {
        $file = $request->image;
        $imageName = "images/products/" . time() . "_" . $file->getClientOriginalName();
        $file->move(public_path("images/products"), $imageName);


            Product::create([
                "title" => $request->title,
                "slug" => Str::slug($request->title),
                "description" => $request->description,
                "price" => $request->price,
                "old_price" => $request->old_price,
                "inStock" => $request->inStock,
                "image" => $imageName,
                "category_id" => $request->category_id,

            ]);
            return redirect()->route("admin.products")->withSuccess("Produit ajouté");
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
         return view('products.show')->with([
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product){
        return view("admin.products.edit")->with([
            "product"=>$product,
            "categories"=> Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $this->validate($request,[
            "title"=>"required|min:3",
             "description"=>"required|min:5",
             "image"=> "image`|mimes:png,jpg,jpeg|max:2048",
             "price"=>"required|numeric",
             "category_id"=>"required|numeric",
        ]);

        if($request->has("image")){
            $image_path=public_path("images/products/".$product->image);
            if(File::exists($image_path)){
                unlink($image_path);
            }
            $file=$request->image;
            $imageName="images/products/".time()."_".$file->getClientOriginalName();
            $file->move(public_path("images/products"),$imageName);
            $product->image=$imageName;
        }
        $title=$request->title;
            $product->update([
                "title"=>$title,
                "slug"=>Str::slug($title),
                "description"=>$request->description,
                "price"=>$request->price,
                "old_price"=>$request->old_price,
                "inStock"=>$request->category_id,
                "image"=>$product->image,
            ]);
           return redirect()->route("admin.products")->withSuccess("Produit modifié"); }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $image_path=public_path("images/products/".$product->image);
        if(File::exists($image_path)){
            unlink($image_path);
        }
        $product->delete();
        return redirect()->route("admin.products")->withSuccess("Produit supprimé");
    }
}
