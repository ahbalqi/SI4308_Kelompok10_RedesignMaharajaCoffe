@extends('adminlte.master')

@section('content')
<div class="container ">
  <div class="row row-cols-1 row-cols-md-2 g-4">
      <div class="col">
        <div class="card">
          <img src="{{asset('img/sepatu1.jpg')}}" class="card-img-top img-thumbnail" style="height: 300px " alt="...">
          <div class="card-body">
            <h5 class="card-title">Barang 1</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="{{asset('img/tas1.jpg')}}" class="card-img-top img-thumbnail" style="height: 300px " alt="...">
          <div class="card-body">
            <h5 class="card-title">Barang 2</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="ml-3 mt-2">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="/posts" method="POST">
            @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="title">Nama Barang : </label>
              <input type="text" class="form-control" id="nama" value="{{old('nama','')}}" name="nama" placeholder="Enter Name">
                @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
              <label for="menu">Menu : </label>
              <div class="form-check">  
                <input class="form-check-input" type="checkbox" value="menu" name="menu" id="menu">
                <label class="form-check-label" for="menu">
                  COD
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="menu" name="menu" id="menu">
                <label class="form-check-label" for="menu">
                  Transfer Atm
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="menu" name="menu" id="menu">
                <label class="form-check-label" for="menu">
                  Merchant
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="menu" name="menu" id="menu">
                <label class="form-check-label" for="menu">
                  Gopay/LinkAja/OVO
                </label>
              </div>
            </div>
            
            <div class="form-group">
              <label for="ket">Keterangan</label>
              <input type="text" class="form-control" id="ket" value="{{old('ket','')}}" name="ket" placeholder="Enter Note">
                @error('ket')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
          
          </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Order</button>
          </div>
        </form>
      </div>
</div>
@endsection