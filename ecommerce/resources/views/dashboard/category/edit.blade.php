@extends('layout/admin')

@section('content')
	
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>UBAH KATEGORI</h6>
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
					
		              <form method="POST" action="/dashboard/category/update/<?= $category->id ?>">
		              	@csrf
		              <div class="form-group">
				          <label for="exampleInputEmail1">Nama Kategori</label>
				          <input value="<?= $category->category_name ?>" type="text" autocomplete="off" required="" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama kategori">
				        </div>

				        <a class="btn btn-outline-secondary" href="/dashboard/category">Kembali</a> &nbsp;
				        <button class="btn btn-warning">Ubah</button>
		              	<br>
				     </form>
				</div>
			</div>
		</div>
	</div>

@endsection