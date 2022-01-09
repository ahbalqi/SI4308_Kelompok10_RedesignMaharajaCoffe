<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Session;

class OrderController extends Controller
{

    public function index(){
        if(Session::get('role') == 'admin'){
            $order = new Order();
            $data['order'] = $order->data()->get();
            return view('dashboard/order/index', $data);

        }else{
            return redirect('/admin');
        }
    }

    public function detail($id){
        if(Session::get('role') == 'admin'){
        	$order = new Order();
            $raw = $order->data('order.id', $id);
            if($raw->count() == 0){
                return redirect('dashboard/order')->with('alert', show_alert('Order ID Tidak diketahui', 'danger'));
            }

            $data['order'] = $raw->first();
            $data['item'] = $order->getItem($id);
        	return view('dashboard/order/detail', $data);
        }else{
            return redirect('admin');
        }
    }

    public function update(Request $request, $id){
        if(Session::get('role') == 'admin'){
        	$request->validate([
                'product_name'  => 'required',
                'product_price' => 'required|numeric|gt:0',
                'product_desc'  => 'required'
            ]);

        	$input = $request->except(['_token']);

        	if(isset($input['image'])){
        		$imageName = 'product_'.time().'.'.$request->file('image')->extension();  
            	$request->file('image')->move(public_path('images/product'), $imageName);
            	$input['product_image'] = $imageName;
        	}   
        	
            $product = new Product();
            unset($input['image']);
    		$product->updates($input, $id);

        	return redirect('dashboard/product')->with('alert', show_alert('Data berhasil diubah', 'success'));
        }else{
            return redirect('admin');
        }
    }

    public function verify($order_id){
        if(Session::get('role') == 'admin'){
            $order = new Order();
            $order->updates(['order_status' => 'complete'], $order_id);

            return redirect('dashboard/order/'.$order_id)->with('alert', show_alert('Data berhasil diverifikasi', 'success'));
        }else{
            return redirect('admin');
        }
    }
}
