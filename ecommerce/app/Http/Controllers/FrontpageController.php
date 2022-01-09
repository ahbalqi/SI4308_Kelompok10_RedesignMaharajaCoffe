<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Category;
use Session;

class FrontpageController extends Controller
{
    public function index(){
    	$product = new Product();
        $data['product'] = $product->data()->get();
    	return view('home', $data);
    }

    public function search(Request $request){
    	$category = new Category();
    	$data['category'] = $category->data()->get();

    	$tb = DB::table('product');
        if($request->input('category_id')){
        	$tb->where('category_id', $request->input('category_id'));
        }

        if($request->input('product_name')){
        	$tb->where('product_name', 'like', '%'.$request->input('product_name').'%');
        }

        $tb->join('category', 'category.id', '=', 'product.category_id')
           ->select('*', 'product.id AS product_id');
    	$data['product']  = $tb->get();
    	return view('search', $data);
    }

    public function dashboard(){
        if(Session::get('role') == 'admin'){
            return view('dashboard/index');
        }else{
            return redirect('admin');
        }
    }
}
