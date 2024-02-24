<?php

namespace App\Http\Controllers;

use App\Models\admin\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart');
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';
        return view('cart', compact('cart', 'locale'));
    }

    public function add(Request $request, $id)
    {
        if (!Auth::check())
        {
            return redirect('/login');
        }

        $product = Item::find($id);

        $cart = session('cart', []);

        if (isset($cart[($id . '_' .$request->size)])) {
            $cart[$id . '_' .$request->size]['quantity'] += $request->quantity;
        } else {
            $cart[$id . '_' .$request->size] = [
                'product' => $product,
                'quantity' => $request->quantity,
                'size' => $request->size
            ];
        }

        session(['cart' => $cart]);
        return redirect()->route('cart');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return back()->with('success', 'Товар удален из корзины.');
    }


    public function clear()
    {
        session(['cart' => []]);

        return back()->with('success', 'Корзина очищена.');
    }


    public function changeQuantity(Request $request)
    {
        $cart = session('cart', []);

        if (isset($request->name)) {
            $cart[$request->name]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        return 'Количество данного товара было обновлено на ' . $request->quantity;
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';

        $name =  Auth::check() ? $request->user()->name : '';

        return view('checkout', compact('cart', 'locale', 'name'));
    }
}
