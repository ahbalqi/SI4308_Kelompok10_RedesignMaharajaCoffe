<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{

    public function index(){
        if(Session::get('role') == 'admin'){
            $category = new Category();
            $data['category'] = $category->data()->get();
            return view('dashboard/category/index', $data);
        }else{
            return redirect('admin');
        }
    }

    public function edit($id){
        if(Session::get('role') == 'admin'){
            $category = new Category();
            $data['category'] = $category->data('id', $id)->first();
            return view('dashboard/category/edit', $data);
        }else{
            return redirect('admin');
        }
    }

    public function insert(Request $request){
        if(Session::get('role') == 'admin'){
        	$request->validate([
                'category_name'	=> 'required',
            ]);

            $input = $request->except(['_token']);

            $category = new Category();
    		$category->create($input);

        	return redirect('dashboard/category')->with('alert', show_alert('Data berhasil ditambahkan', 'success'));
        }else{
            return redirect('admin');
        }
    }

    public function update(Request $request, $id){
        if(Session::get('role') == 'admin'){
        	$request->validate([
                'category_name' => 'required',
            ]);

            $input = $request->except(['_token']);

            $category = new Category();
    		$category->updates($input, $id);

        	return redirect('dashboard/category')->with('alert', show_alert('Data berhasil diubah', 'success'));
        }else{
            return redirect('admin');
        }
    }

    public function delete($id){
        if(Session::get('role') == 'admin'){
        	$category = new Category();
    		$category->deletes($id);

        	return redirect('dashboard/category')->with('alert', show_alert('Data berhasil dihapus', 'success'));
        }else{
            return redirect('admin');
        }
    }
}
