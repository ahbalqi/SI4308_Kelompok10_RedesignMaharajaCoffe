@extends('adminlte.master')

@section('content')

<div class="ml-3 mt-2">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Order Kopi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">
              {{session('success')}}
            </div>
          @endif
          <a class="btn btn-primary mb-2" href="/posts/create">Order</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">No.Pemesanan</th>
                <th>Barang</th>
                <th>Via</th>
                <th>Keterangan</th>
                <th style="width: 40px">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($posts as $key => $post )
              <tr>
                  <td class="text-center">{{$key + 1}}</td>
                  <td>{{$post->nama}}</td>
                  <td>{{$post->menu}}</td>
                  <td>{{$post->ket}}</td>
                  <td style="display:flex">
                    <a href="{{route('show', $post->id)}}" class="btn btn-info btn-sm">show</a>
                    <a href="{{route('edit', $post->id)}}" class="btn btn-default btn-sm inline">edit</a>
                    <form action="/posts/{{$post->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="submit" value="delete" class="btn btn-danger btn-sm">
                    </form>
                  </td>

              </tr>
              @empty                  
                  <td colspan="4">No Posts</td>
              @endforelse
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div> --}}
      </div>
</div>
@endsection