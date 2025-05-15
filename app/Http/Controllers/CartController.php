<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->base_price,
            'quantity' => 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function view()
    {
        $cart = session('cart', []);
        return view('cart.view', compact('cart'));
    }
}
