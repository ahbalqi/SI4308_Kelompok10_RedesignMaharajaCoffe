@extends('layout/template')

@section('content')
	<div class="row mt-5">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="card shadow">
				<div class="card-body">
					<form class="form-signin" method="POST" action="/auth/do_login">
					@csrf
					  <div class="text-center mb-4">
					    <h1 class="h3 mb-3 mt-3">LOGIN</h1>
					    <p class="text-muted">Login untuk dapat melakukan pembelanjaan<p>
					  </div>

					  <hr>

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

					  <div class="form-label-group">
					  	<label for="inputEmail">Email address</label>
					    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
					  </div>

					  <div class="form-label-group mt-3">
					  	<label for="inputPassword">Password</label>
					    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
					  </div>

					  <button class="btn btn-lg btn-primary btn-block mt-4" name="submit" type="submit">Sign in</button>
					  <p class="text-center mt-3">Belum punya akun ?, <a href='/register'><b>Daftar Disini</b></a></p>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection