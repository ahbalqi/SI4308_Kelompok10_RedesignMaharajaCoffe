<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }
    public function store(Request $request){
        dd($request->all());
        $validated = $request->validate([
            'nama' => 'required|unique:posts',
            'body' => 'required',
        ]);

        $query = DB::table('posts')->insert(
            [
            'nama' => $request['nama'],
            'menu' => $request['menu'],
            'ket' => $request['ket'] 
        ]);
        return redirect('/posts')->with('success','Berhasil Post');
    }

    public function index(){
        $posts = DB::table('posts')->get();//SELECT * FROM posts
        
        // dd($posts);
        return view('posts.index',compact('posts'));
    }

    public function show($id){
        // dd($id);
        $post = DB::table('posts')->where('id',$id)->first();//SELECT * FROM posts
        //Select * FROM sasdasda WHERE id=1
        //dd($post);
        return view('posts.show',compact('post'));
        
    }

    public function edit($id){
        $post = DB::table('posts')->where('id',$id)->first();

        return view('posts.edit',compact('post'));
    }

    public function update($id, Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'body' => 'required',
        ]);

        $query= DB::table('posts')
                    ->where('id',$id)
                    ->update([
                        'menu' => $request['menu'],
                        'ket' => $request['ket']
                    ]);
        return redirect('/posts')->with('success','Berhasil update post !');
    }
    public function delete($id){
        $query = DB::table('posts')->where ('id',$id)->delete();
        return redirect('/posts')->with('success','Post Berhasil dihapus !');
    }
}
