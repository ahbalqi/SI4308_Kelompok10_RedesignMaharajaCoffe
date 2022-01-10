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

	<div class="row mb-3">
	  <div class="col-md-8 text-left text-primary">
	    <h5><b>CARI BARANG</b></h5>
	    <h6 class="text-muted">Cari barang yang kamu butuhkan disini</h6>
	  </div>
	  <hr>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<form>
						<div class="row">
							<div class="col-md-3">
								<label>Kategori</label>
						        <select class="form-control" required="" name="category_id" required="">
						        	<option value="">Pilih</option>
						        	<?php foreach ($category as $row) { ?>
						        		<option value="<?= $row->id ?>" <?= $row->id == Request::get('category_id') ? 'selected="selected"' : '' ?>>
					        				<?= $row->category_name ?>
					        			</option>
						        	<?php } ?>
						        </select>
							</div>

							<div class="col-md-6">
								<label>Keyword</label>
								<input type="text" value="<?= Request::get('product_name') ?>" class="form-control" name="product_name" required="" placeholder="Cari disini...">
							</div>

							<div class="col-md-2">
								<br>
								<button class="mt-2 btn btn-block btn-primary"><i class="fa fa-search"></i> Cari</button>
							</div>

							<?php if(isset($_GET['category_id'])){ ?>
								<div class="col-md-1">
									<br>
									<a href="/search" class="mt-2 btn btn-light">Reset</a>
								</div>
							<?php } ?>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	@if(count($product) > 0)
		<div class="row mt-3">
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
				      	<?= $row->product_desc ?>
				      </small>
				    </div>
				    <div class="card-footer">
				    	<div class="row">
				    		<div class="col-md-6">
				    			Harga
				    			<h6>Rp. <?= number_format($row->product_price) ?></h6>
				    		</div>
				    		<div class="col-md-6">
				    			<a href="/cart/insert/<?= $row->product_id ?>" class="btn btn-primary pull-right">Masukkan Keranjang</a>
				    		</div>
				    	</div>
				    </div>
				  </div>
				</div>
			@endforeach
		</div>
	@else
		<div class="row mt-3">
			<div class="col-md-12 text-center">
				<h6 class="text-danger">Data Kosong</h6>
			</div>
		</div>
	@endif
	

@endsection