<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;

class CartController extends Controller
{
    public function index(){
        $userdata = Session::get('userdata');
        $cart = new Cart();
        $data['cart'] = $cart->data('user_id', $userdata->id)->get();
        return view('patient/index', $data);
    }

    public function add($product_id){
        if(Session::get('login')){
            $cart = new Cart();
            $product = new Product();

            if($product->data('product.id', $product_id)->count() == 0){
                return redirect('/search')->with('alert', show_alert('Data produk tidak diketahui', 'danger'));    
            }

            $cartData = $cart->data([
                            'user_id' => Session::get('userdata')->id,
                            'product_id' => $product_id
                        ]);

            if($cartData->count() > 0){
                $productInCart = $cartData->first();
                $newQty = $productInCart->qty + 1;
                $cart->updates(['qty' => $newQty], $productInCart->cart_id);
            }else{
                $cart->create([
                    'user_id'       => Session::get('userdata')->id,
                    'product_id'    => $product_id,
                    'qty'           => 1
                ]);
            }

            return redirect('/search')->with('alert', show_alert('Produk berhasil dimasukkan ke keranjang belanja', 'success'));    
        }
    }

    public function delete($cart_id){
        if(Session::get('login')){
            $cart = new Cart();
            $data = $cart->data([
                        'user_id' => Session::get('userdata')->id,
                        'cart.id' => $cart_id
                    ]);
            if($data->count() == 0){
                return redirect('/profile/cart')->with('alert', show_alert('ID Cart tidak diketahui', 'danger'));
            }

            $cart->deletes($cart_id);
            return redirect('/profile/cart')->with('alert', show_alert('Produk pada keranjang belanja berhasil dihapus', 'success'));
        }
    }

    public function checkout(){
        if(Session::get('login')){
            $user_id = Session::get('userdata')->id;
            $cart = new Cart();
            $userCart = $cart->inUser($user_id);
            
            if(count($userCart) == 0){
                return redirect('/profile/cart')->with('alert', show_alert('Tidak ada produk yang ditambahkan', 'danger'));
            }

            $order = new Order();
            $orderData = [
                'user_id'     => $user_id,
                'order_code'  => generate_random(8),
                'order_date'  => date('Y-m-d H:i:s'),
                'order_total' => 0,
                'order_status'=> 'pending'
            ];
            $order->create($orderData);
            $order_id = $order->getLastId($user_id);
            
            $grandTotal = 0;
            var_dump($order_id);
            foreach ($userCart as $row){ 
                $subtotal = $row->qty * $row->product_price;
                $grandTotal += $subtotal;

                $orderDetail = [
                    'order_id'  => $order_id,
                    'product_id' => $row->product_id,
                    'qty'   => $row->qty,
                    'price' => $row->product_price,
                    'subtotal' => $subtotal
                ];
                $order->insertDetail($orderDetail);
            }

            $cart->deleteUserCart($user_id);
            $order->updates(['order_total' => $grandTotal], $order_id);
            return redirect('/profile/order/'.$order_id)->with('alert', show_alert('Checkout berhasil dilakukan, harap melakukan pembayaran', 'success'));
        }
    }
}
