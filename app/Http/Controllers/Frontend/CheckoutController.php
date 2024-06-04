<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = $user->cart;
        $cartItems = [];
        if ($cart) {
            // $cartItems = $cart->with('cartItems.product')->get()[0]->cartItems;
            $cartItems = $cart->with('cartItems.product')->first()->cartItems;
        }
        if (count($cartItems) == 0) {
            return to_route('cart.index');
        }
        $discount = 0;
        if (session()->exists('coupon')) {
            $coupon = session()->get('coupon');
            $code = $coupon['code'];
            $discount = $coupon['discount'];
        }
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->qty;
        }
        return view('frontend.pages.checkout', compact('cartItems', 'discount', 'totalPrice'));
    }
    public function createOrder(CheckoutRequest $request)
    {
        try {
            $user = Auth::user();
            $cart = $user->cart;
            $cartItems = [];
            if ($cart) {
                $cartItems = $cart->with('cartItems.product')->first()->cartItems;
            }
            if (count($cartItems) == 0) {
                return redirect()->back();
            }
            $input = $request->only([
                'fullname',
                'address',
                'phone',
                'email',
                'note',
                'total_money'
            ]);

            if (session()->exists('coupon')) {
                $coupon = session()->get('coupon');
                $code = $coupon['code'];
                $discount = $coupon['discount'];

                $coupon = Coupon::where('code', $code)->first();
                $coupon->qty = $coupon->qty - 1;
                $coupon->save();

                $input['discount'] = $discount;
            }

            $order = $user->orders()->create($input);
            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'product_id' => $item->product->id,
                    'product_name' => $item->product->name,
                    'qty' => $item->qty,
                    'product_price' => $item->product->price,
                ]);
                $item->delete();
            }
            return to_route('home');
        } catch (\Exception $e) {
            return to_route('cart.index');
        }

    }
}
