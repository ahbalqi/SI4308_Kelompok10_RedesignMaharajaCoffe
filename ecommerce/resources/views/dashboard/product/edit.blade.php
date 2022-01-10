@extends('layout/admin')

@section('content')
	
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>UBAH PRODUK</h6>
				</div>
				<div class="card-body">
					 @if (session('alert'))
					    <div class="row mt-4">
					    	<div class="col-md-12">
						        {!! session('alert') !!}
						    </div>
					    </div>
					@endif

					@if($errors->any())
						<div class="alert alert-danger mt-3">
						    {!! implode('', $errors->all('<div>:message</div>')) !!}
						</div>
					@endif

		              <form method="POST" action="/dashboard/product/update/<?= $product->id ?>" enctype="multipart/form-data">
		              	@csrf
		              	<div class="row">
		              		<div class="col-md-6">
		              			<div class="ms-form-group">
					            	<label>Gambar</label><br>
					            	<input type="file" name="image"><br>
					            	<small class="text-muted">*Upload gambar jika ingin mengubah thumbnail produk</small>
					            </div>
		              		</div>
		              		<div class="col-md-6 text-right">
		              			<img style="width:200px" src="/images/product/<?= $product->product_image ?>">
		              		</div>
				         </div>

				          <div class="ms-form-group mt-2">
				            <label>Nama Produk</label>
				            <input type="text" value="<?= $product->product_name ?>" autocomplete="off" required="" placeholder="Masukkan nama produk..." class="form-control" name="product_name" value="">
				          </div>

				          <div class="ms-form-group mt-2">
				            <label>Kategori</label>
				            <select class="form-control" required="" name="category_id">
				            	<option value="">Pilih</option>
				            	<?php foreach ($category as $row){ ?>
				            		<option value="<?= $row->id ?>" <?= $row->id == $product->category_id ? 'selected="selected"' : '' ?> ><?= $row->category_name ?></option>
				            	<?php } ?>
				            </select>
				          </div>

				          <div class="ms-form-group mt-2">
				            <label>Harga</label>
				            <input type="text" value="<?= $product->product_price ?>" autocomplete="off" required="" placeholder="Masukkan harga produk..." class="form-control rupiah" name="product_price" value="">
				          </div>

				          <div class="ms-form-group mt-2">
				            <label>Keterangan</label>
				            <textarea type="text" autocomplete="off" required="" placeholder="Masukkan keterangan..." class="form-control" name="product_desc"><?= nl2br($product->product_desc) ?></textarea>
				          </div>

				        <br>
				        <a class="btn btn-outline-secondary" href="/dashboard/product">Kembali</a> &nbsp;
				        <button class="btn btn-warning">Ubah</button>
		              	<br>
				     </form>
				</div>
			</div>
		</div>
	</div>

@endsection