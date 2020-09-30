<?php

namespace App\Http\Controllers;

use App\Product;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductController extends Controller
{
    //

    public function index(){

        if(request()->categorie){
            
            $product= Product::with('categories')->whereHas('categories',function($query){
                $query->where('slug',request()->categorie);
            })->paginate(6);
        }
        else {
            $product= Product::with('categories')->paginate(6);
        }
//dd($product);
        return view('products.index' )->with('product',$product);
    }


public function show($slug){

    //Permet d'afficher le produit selectionner
$product= Product::where('slug',$slug)->firstorfail();

//Le slug sera le lien, $product recuper le premier enregistrement
return view('products.show',['product'=>$product]);

}

}