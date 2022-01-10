@extends('layout/template')

@section('title')
	<h5>ABOUT US</h5>
@endsection

@section('content')
	@if (session('alert'))
	    <div class="row mt-4">
	    	<div class="col-md-12">
		        {!! session('alert') !!}
		    </div>
	    </div>
	@endif

	<div class="row mb-4">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<img src="/images/banner.jpg" class="img-fluid">
		</div>
	</div>

	<div class="row mb-4">
	  <div class="col-md-8 text-left text-primary">
	    <h5><b>BARANG TERBARU</b></h5>
	    <h6 class="text-muted">Lihat barang terbaru pada toko ini</h6>
	  </div>
	  <div class="col-md-4 text-right">
	  	<a class="btn btn-outline-primary btn-sm mt-2">Lihat Semua</a>
	  </div>

	  <hr>
	</div>

	@if(count($product) > 0)
		<div class="row">
			@foreach ($product as $row) 
				<div class="col-md-4">
		          <div class="card">
					<center>
					    <img style="width: 250px; height: 250px" src="/images/product/<?= $row->product_image ?>" class="card-img-top" alt="...">
					</center>
				    <div class="card-body">
				      <h5 class="card-title"><?= $row->product_name ?></h5>
				      <small>Kategori : <?= $row->category_name ?></small><br>
				      <small class="card-text">
				      	<?= $row->product_price ?>
				      </small>
				    </div>
				    <div class="card-footer">
				    	<div class="row">
				    		<div class="col-md-6">
				    			Harga
				    			<h6>Rp. <?= number_format($row->product_price) ?></h6>
				    		</div>
				    		<div class="col-md-6">
				    			<a href="/cart/insert/<?= $row->id ?>" class="btn btn-primary pull-right">Masukkan Keranjang</a>
				    		</div>
				    	</div>
				    </div>
				  </div>
				</div>
			@endforeach
		</div>
	@else
		<div class="row">
			<div class="col-md-12 text-center">
				<h6 class="text-danger">Data Kosong</h6>
			</div>
		</div>
	@endif
	

@endsection