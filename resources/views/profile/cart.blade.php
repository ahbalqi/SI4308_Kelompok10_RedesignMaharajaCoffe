@extends('layout/template')

@section('title')
	<h5>ABOUT US</h5>
@endsection

@section('content')

	<div class="row mt-5">
		<div class="col-md-12">
			<div class="card shadow">
				<div class="card-header">
					KERANJANG BELANJA
				</div>
				<div class="card-body">

					@if (session('alert'))
					    <div class="row mt-4">
					    	<div class="col-md-12">
						        {!! session('alert') !!}
						    </div>
					    </div>
					@endif

					<table class="table">
						<thead>
							<tr>
								<th style="width: 5%">No</th>
								<th style="width: 15%"></th>
								<th>Produk</th>
								<th style="width: 5%">Qty</th>
								<th style="width: 15%" class="text-center">Harga</th>
								<th style="width: 15%" class="text-center">Subtotal</th>
								<th style="width: 10%" class="text-center"></th>
							</tr>
						</thead>
						<tbody>

							<?php $n=0; $total = 0; foreach($cart as $row){ $n++; $total += $row->qty * $row->product_price; ?>
									<tr>
										<td><?= $n ?></td>
										<td><img style="width: 100px; height: 50px" src="/images/product/<?= $row->product_image ?>"></td>
										<td><?= $row->product_name ?><br><small class="text-muted"><?= $row->category_name ?></small></td>
										<td class="text-center"><?= $row->qty ?></td>
										<td class="text-right"><?= format_rp($row->product_price) ?></td>
										<td class="text-right"><?= format_rp($row->qty * $row->product_price) ?></td>
										<td class="text-center">
											<a href="/cart/delete/<?= $row->cart_id ?>" class="btn btn-danger">Hapus</a>
										</td>
									</tr>
							<?php } ?>

							<tr class="bg-light">
								<th colspan="5">TOTAL</th>
								<th class="text-right"><?= format_rp($total) ?></th>
								<th></th>
							</tr>
						</tbody>

						<?php if(count($cart)){ ?>
							<tfoot>
								<td colspan="7">
									<a onclick="return confirm('Apakah anda yakin melakukan pemesanan ini ?')" href="/cart/checkout" class="btn btn-success"><i class="fa fa-shopping-cart"></i> CHECKOUT</a>
								</td>
							</tfoot>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection