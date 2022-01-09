<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;



class Cart extends Model
{   
    protected $table = 'cart';
    
    public function data($key = '', $value = ''){
        $tb = DB::table($this->table);
        
        if($key != ''){
            if(is_array($key)){
                foreach ($key as $k => $v) {
                     $tb->where($k, $v);
                }
               
            }else{
                $tb->where($key, $value);
            }
        }

        $tb->join('product', 'product.id', '=', 'cart.product_id')
           ->join('category', 'category.id', '=', 'product.category_id')
           ->select('*', 'cart.id AS cart_id');
        return $tb;
    }

    public function create($data){
        return DB::table($this->table)->insert($data);
    }

    public function updates($data, $id){
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function deletes($id){
        return DB::table($this->table)->where('id', $id)->delete();
    }

    public function inUser($user_id){
        $tb = DB::table($this->table);
        $tb->where('user_id', $user_id)
           ->join('product', 'product.id', '=', 'cart.product_id')
           ->join('category', 'category.id', '=','product.category_id')
           ->select('*', 'cart.id AS cart_id');
        return $tb->get();
    }

    public function deleteUserCart($user_id){
        return DB::table($this->table)->where('user_id', $user_id)->delete();
    }
}
