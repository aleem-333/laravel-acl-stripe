<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, User};


class ProductController extends Controller
{
    public function show(Request $request, Product $product)
    {
        $product = $product->find($request->product_id);
        $intent = (new User())->createSetupIntent();
        if ($product) {
            return view('web.checkout', compact('product', 'intent'));
        } else {
            return redirect()->back()->with('error', 'Error!!! The Product does not exist.');
        }
    }
}
