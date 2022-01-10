@extends('layout/admin')

@section('content')

	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>KATEGORI</h6>
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

		              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">Tambah</button>
		              <br>

		              <table class="table table-hover mt-4">
		                <thead class="bg-primary text-white">
		                  <tr>
		                    <th style="width: 5%">No</th>
		                    <th></th>
		                    <th>Produk</th>
		                    <th>Kategori</th>
		                    <th>Deskripsi</th>
		                    <th class="text-center">Harga</th>
		                    <th style="width: 15%">Action</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php $n= 1;
		                    foreach ($product as $row) { ?>
		                      <tr>
		                        <td><?= $n++ ?></td>
		                        <td><img style="width: 100px; height: 50px" src="/images/product/<?= $row->product_image ?>"></td>
		                        <td><?= $row->product_name ?></td>
		                        <td><?= $row->category_name ?></td>
		                        <td><?= nl2br($row->product_desc) ?></td>
		                        <td class="text-right"><?= format_rp($row->product_price) ?></td>
		                        <td>
		                          <a href="/dashboard/product/<?= $row->id ?>" class="btn btn-warning btn-sm">Ubah</a>
		                          <a onclick="return confirm('Apakah anda yakin ?')" href="/dashboard/product/delete/<?= $row->id ?>" class="btn btn-danger btn-sm">Hapus</a>
		                        </td>
		                      </tr>
		                  <?php  }
		                  ?>
		                </tbody>
		              </table>
				</div>
			</div>
		</div>
	</div>


	<form method="POST" action="/dashboard/product/insert" enctype="multipart/form-data">
	@csrf
	<div class="modal fade" id="modalAdd">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Tambah Produk</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="ms-form-group">
	            <label>Gambar</label><br>
	            <input type="file"  required="" name="image">
	          </div>

	          <div class="ms-form-group mt-2">
	            <label>Nama Produk</label>
	            <input type="text" autocomplete="off" required="" placeholder="Masukkan nama produk..." class="form-control" name="product_name" value="">
	          </div>

	          <div class="ms-form-group mt-2">
	            <label>Kategori</label>
	            <select class="form-control" required="" name="category_id">
	            	<option value="">Pilih</option>
	            	<?php foreach ($category as $row) { ?>
		        		<option value="<?= $row->id ?>" <?= $row->id == Request::get('category_id') ? 'selected="selected"' : '' ?>>
	        				<?= $row->category_name ?>
	        			</option>
		        	<?php } ?>
	            </select>
	          </div>

	          <div class="ms-form-group mt-2">
	            <label>Harga</label>
	            <input type="text" autocomplete="off" required="" placeholder="Masukkan harga produk..." class="form-control rupiah" name="product_price" value="">
	          </div>

	          <div class="ms-form-group mt-2">
	            <label>Keterangan</label>
	            <textarea type="text" autocomplete="off" required="" placeholder="Masukkan keterangan..." class="form-control" name="product_desc"></textarea>
	          </div>
	      </div>
	      <div class="modal-footer justify-content-between">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button class="btn btn-primary">Simpan</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
	  <!-- /.modal-dialog -->
	</div>
	</form>

@endsection