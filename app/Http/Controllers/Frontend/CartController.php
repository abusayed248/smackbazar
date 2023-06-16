<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{               
    /**
     * Display a listing of the resource.
     */
    public function addToCart(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!Auth::check()) {
                toast('At first login your account! then try add to cart!!', 'error')->position('top-end')->width('25em')->padding('2em');
                DB::commit();
                return redirect()->route('login');
            }
            $product = Product::where('id', $request->product_id)->first();
            $cart    = Cart::where('product_id', $request->product_id)->first();
            if (!$cart) {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'name' => $product->p_name_en,
                    'thumbnail' => $product->thumbnail,
                    'qty' => 1,
                    'price' => $product->discount_price?$product->discount_price:$product->regular_price,
                ]);
            } else {
               $cart->update([
                    'qty' => ++$cart->qty,
                    'price' => ($product->discount_price?$product->discount_price:$product->regular_price)*($cart->qty),
                ]); 
            }

            $pd_dec = Product::find($request->product_id);
            $pd_dec->decrement('stock_qty');

            toast('Product added to cart sucessfully', 'success')->position('top-end')->width('25em')->padding('2em');
            DB::commit();
            return redirect()->back();
            
        } catch (\Throwable $e) {
            report($e);
            toast($e->getMessage(), 'error')->position('top-end')->width('25em')->padding('2em');
            DB::rollback();
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function viewCart()
    {
        $data = Cart::where('user_id', Auth::id())->get();
        $qty = $data->sum('qty');
        $totalPrice = $data->sum('price');
        return response()->json(['qty' => $qty, 'price' => $totalPrice]);
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
