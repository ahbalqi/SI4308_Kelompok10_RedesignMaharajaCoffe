<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;



class Order extends Model
{   
    protected $table = 'order';
    
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

        $tb->join('users', 'users.id', '=', 'order.user_id')
           ->select('*', 'order.id AS order_id');
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

    public function get_detail($order_id){
        $tb = DB::table($this->table);
        $tb->where('order_id', $order_id)
           ->join('product', 'product.id', '=', 'order_detail.product_id')
           ->join('category', 'category.id', '=','product.category_id')
           ->select('*', 'order_detail.id AS order_detail_id')
           ->orderBy('order_detail.id');
        return $tb->get();
    }

    public function getLastId($user_id){
        return DB::table($this->table)
               ->join('users', 'users.id', '=', 'order.user_id')
               ->select('*', 'order.id AS order_id')
               ->orderBy('order.id')
               ->where('user_id', $user_id)
               ->first()->order_id;
    }

    public function insertDetail($data){
        return DB::table('order_detail')->insert($data);
    }

    public function getItem($order_id){
        return DB::table('order_detail')
               ->where('order_id', $order_id)
               ->join('product', 'product.id', '=', 'order_detail.product_id')
               ->join('category', 'category.id', '=', 'product.category_id')
               ->select('*', 'order_detail.id AS order_detail_id')->get();
    }
}
