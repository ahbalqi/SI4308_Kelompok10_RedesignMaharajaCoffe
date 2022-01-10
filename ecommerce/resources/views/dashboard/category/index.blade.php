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
		                    <th>Kategori</th>
		                    <th style="width: 15%">Action</th>
		                  </tr>
		                </thead>
		                <tbody>

		                  <?php $n= 1;
		                    foreach ($category as $row) { ?>
		                      <tr>
		                        <td><?= $n++ ?></td>
		                        <td><?= $row->category_name ?></td>
		                        <td>
		                          <a href="/dashboard/category/<?= $row->id ?>" class="btn btn-warning btn-sm">Ubah</a>
		                          <a onclick="return confirm('Apakah anda yakin ?')" href="/dashboard/category/delete/<?= $row->id ?>" class="btn btn-danger btn-sm">Hapus</a>
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


	<form method="POST" action="/dashboard/category/insert">
	@csrf
	<div class="modal fade" id="modalAdd">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Tambah Kategori</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	          <label for="exampleInputEmail1">Nama Kategori</label>
	          <input type="text" autocomplete="off" required="" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama kategori">
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