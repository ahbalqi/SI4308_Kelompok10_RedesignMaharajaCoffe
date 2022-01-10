<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

	<style type="text/css">
		.shadow{
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  			transition: 0.3s;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	  <a class="navbar-brand" href="#"><b>MAHARAJA</b> COFFEE</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link ml-5" href="/">Home</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link active" href="/search">Cari Barang</a>
	      </li>
	    </ul>
	    <span class="navbar-text">
	    	@if(session()->has('login'))
	    		<li class="dropdown mr-5" style="list-style-type: none;">
			        <a style="text-decoration: none" class="dropdown-toggle mr-5" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        	Selamat Datang, {{ session()->get('userdata')->nama }}
			        </a>
			        <div class="dropdown-menu mr-5" aria-labelledby="dropdown01">
			          <a style="color: #666" class="dropdown-item" href="/profile">Profile</a>
			          <a style="color: #666" class="dropdown-item" href="/profile/cart">Lihat Keranjang Saya</a>
			          <a style="color: #666" class="dropdown-item" href="/profile/order">Daftar Pesanan</a>
			          <a style="color: #666" class="dropdown-item" href="/auth/logout">Logout</a>
			        </div>
			    </li>

			@else
				<a href="/login">Login</a> &emsp;
	      		<a href="/register">Register</a>
	    	@endif
	    </span>
	  </div>
	</nav>

	<div class="container mt-4">
		<div class="container login-container">
			@yield('content')
		</div>
	</div>

	<br><br><br><br>
</body>
</html>