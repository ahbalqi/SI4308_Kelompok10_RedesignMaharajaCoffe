@extends('adminlte.master')

@section('content')
<div class="ml-3 mt-2">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Post {{$post->id}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="/posts/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" value="{{old('title',$post->title)}}" name="title" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <input type="text" class="form-control" id="body" value="{{old('body',$post->body)}}" name="body" placeholder="Body">
                @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
          
          </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </form>
      </div>
</div>
@endsection