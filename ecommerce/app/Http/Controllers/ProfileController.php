<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Order;
use Session;

class ProfileController extends Controller
{

    public function index(){
        if(Session::get('login')){
            $user = new Customer();
            $data['user'] = $user->data('id', Session::get('userdata')->id)->first();
            return view('profile/index', $data);
        }
    }

    public function cart(){
        if(Session::get('login')){
            $cart = new Cart();
            $data['cart'] = $cart->inUser(Session::get('userdata')->id);
            return view('profile/cart', $data);
        }
    }

    public function order(){
        if(Session::get('login')){
            $order = new Order();
            $data['order'] = $order->data([
                                'user_id' => Session::get('userdata')->id
                             ])->get();
            return view('profile/order', $data);
        }
    }

    public function order_detail($order_id){
        if(Session::get('login')){
            $order = new Order();
            $orderData  = $order->data([
                        'order.id' => $order_id,
                        'user_id'  => Session::get('userdata')->id
                     ]);

            if($orderData->count() == 0){
                return redirect('/profile/order/')->with('alert', show_alert('Order ID Tidak diketahui', 'danger'));
            }

            $data['order'] = $orderData->first();
            $data['item']  = $order->getItem($data['order']->order_id);
            return view('profile/order_detail', $data);
        }
    }

    public function upload_proof(Request $request, $order_id){
        if(Session::get('login')){
            $order = new Order();
            $orderData  = $order->data([
                        'order.id' => $order_id,
                        'user_id'  => Session::get('userdata')->id
                     ]);

            if($orderData->count() == 0){
                return redirect('/profile/order/')->with('alert', show_alert('Order ID Tidak diketahui', 'danger'));
            }

            $request->validate([
                'image'         => 'required|mimes:jpeg,jpg,png'
            ]);

            $imageName = 'proof_'.time().'.'.$request->file('image')->extension();  
            $request->file('image')->move(public_path('images/proof'), $imageName);

            $input = $request->except(['_token']);
            $getOrder = $orderData->first();
            $inputOrder['order_proof'] = $imageName;
            $inputOrder['order_status'] = 'verify';

            $order->updates($inputOrder, $getOrder->order_id);

            return redirect('/profile/order/'.$getOrder->order_id)->with('alert', show_alert('Bukti pembayaran berhasil diupload, silahkan meunggu proses verifikasi', 'success'));
        }
    }

    public function update_profile(Request $request){
        if(Session::get('login')){
            $request->validate([
                'nama'          => 'required',
                'no_hp'         => 'required|numeric'
            ]);

            $input = $request->except(['_token']);
            $data = [
                'nama' => $input['nama'],
                'no_hp' => $input['no_hp']
            ];

            if($input['password'] != ''){
                if($input['password'] != $input['confirm_password']){
                    return redirect('/profile')->with('alert', show_alert('Password yang anda ketik tidak sama', 'danger'));
                }

                $data['password'] = $input['password'];
            }

            $user = new Customer();
            $user->updates($data, Session::get('userdata')->id);

            return redirect('/profile')->with('alert', show_alert('Data berhasil diubah', 'success'));
        }
    }
}
