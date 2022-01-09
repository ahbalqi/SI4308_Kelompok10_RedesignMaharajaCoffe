<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Session;

class ProductController extends Controller
{

    public function index(){
        if(Session::get('role') == 'admin'){
            $product = new Product();
            $category = new Category();;
            $data['product'] = $product->data()->get();
            $data['category'] = $category->data()->get();
            return view('dashboard/product/index', $data);

        }else{
            return redirect('/admin');
        }
    }

    public function edit($id){
        if(Session::get('role') == 'admin'){
        	$product = new Product();
            $category = new Category();
        	$data['product'] = $product->data('product.id', $id)->first();
            $data['category'] = $category->data()->get();
        	return view('dashboard/product/edit', $data);
        }else{
            return redirect('admin');
        }
    }

    public function insert(Request $request){
        if(Session::get('role') == 'admin'){
        	$request->validate([
                'product_name'  => 'required',
                'product_price' => 'required|numeric|gt:0',
                'product_desc'  => 'required',
                'image'	=> 'required|mimes:jpeg,jpg,png'
            ]);

        	$imageName = 'product_'.time().'.'.$request->file('image')->extension();  
            $request->file('image')->move(public_path('images/product'), $imageName);

            $input = $request->except(['_token']);
            unset($input['image']);
            $input['product_image'] = $imageName;

            $product = new Product();
    		$product->create($input);

        	return redirect('dashboard/product')->with('alert', show_alert('Data berhasil ditambahkan', 'success'));
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

    public function delete($id){
        if(Session::get('role') == 'admin'){
            $product = new Product();
            $product->deletes($id);

            return redirect('dashboard/product')->with('alert', show_alert('Data berhasil dihapus', 'success'));
        }else{
            return redirect('admin');
        }
    }
}
