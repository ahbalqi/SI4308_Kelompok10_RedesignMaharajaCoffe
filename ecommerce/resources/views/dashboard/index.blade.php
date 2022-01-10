@extends('layout/admin')

@section('content')
	@if (session('alert'))
	    <div class="row mt-4">
	    	<div class="col-md-12">
		        {!! session('alert') !!}
		    </div>
	    </div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>DASHBOARD</h6>
				</div>
			</div>
		</div>
	</div>
@endsection