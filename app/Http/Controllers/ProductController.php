<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        if (!$store) {
            abort(404);
        }  

        $product = Product::where('id',$request->id)->first();

        if (!$store) {
            abort(404);
        }

        return view('pages.product', compact('store','product'));
    }
}
