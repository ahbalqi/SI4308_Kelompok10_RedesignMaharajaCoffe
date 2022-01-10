@extends('layout/template')

@section('content')

	<div class="row mt-5">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-header">
					PROFILE
				</div>
				<div class="card-body">
					<form class="form-signin" method="POST" action="/user/update">
					  @csrf

					  	@if (session('alert'))
						    <div class="row mt-4">
						    	<div class="col-md-12">
							        {!! session('alert') !!}
							    </div>
						    </div>
						@endif

					  <div class="form-label-group">
					  	<label for="inputEmail">Email</label><br>
					    <?= $user->email ?>
					  </div>

					  <div class="form-label-group mt-3">
					  	<label for="inputEmail">Nama Lengkap</label>
					    <input type="text" id="inputEmail" name="nama" class="form-control" placeholder="Nama Lengkap..." required value="<?= $user->nama ?>">
					  </div>

					  <div class="form-label-group mt-3">
					  	<label for="inputEmail">No. Telp</label>
					    <input type="number" name="no_hp" id="inputEmail" class="form-control" placeholder="Nomor Handphone..." required value="<?= $user->no_hp ?>">
					  </div>

					  <div class="form-label-group mt-3">
					  	<label for="inputPassword">Password</label>
					    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password...">
					    <small>* Abaikan jika tidak ingin mengubah password</small>
					  </div>

					  <div class="form-label-group mt-3">
					  	<label for="inputPassword">Ulangi Password</label>
					    <input type="password" name="confirm_password" id="inputPassword" class="form-control" placeholder="Password...">
					  </div>

					  <button class="btn btn-lg btn-warning btn-block mt-3" name="submit" type="submit">Ubah Data</button>
					</form>
				</div>
			</div>
		</div>
	</div>


@endsection