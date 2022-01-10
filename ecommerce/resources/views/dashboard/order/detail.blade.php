@extends('layout/admin')

@section('content')

	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h6>DETAIL PESANAN</h6>
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

		            <div class="row">
					 	<div class="col-md-6">
					 		<a href="index.php" class="btn btn-outline-secondary">Kembali</a>
					 	</div>
					 	<div class="col-md-6 text-right">
					 		<?php if($order->order_status == 'verify'){ ?>
					 			<a href="/dashboard/order/verify/<?= $order->order_id ?>" class="btn btn-success" onclick="return confirm('Apakah anda yakin menyetujui pesanan ini ?')"><i class="fa fa-check-circle"></i> Verifikasi Pembayaran</a>
					 		<?php } ?>
					 	</div>
					 </div>

					 <div class="row mt-3">
					 	<div class="col-md-4">
					 		
					 		<table class="table">
					 			<tr class="bg-light">
					 				<th colspan="2"><h6><i class="fa fa-user"></i> Identitas Pemesan</h6></th>
					 			</tr>
					 			<tr>
					 				<td>Nama</td>
					 				<td class="text-right"><b><?= $order->nama ?></b></td>
					 			</tr>

					 			<tr>
					 				<td>Email</td>
					 				<td class="text-right"><b><?= $order->email ?></b></td>
					 			</tr>

					 			<tr>
					 				<td>No HP</td>
					 				<td class="text-right"><b><?= $order->no_hp ?></b></td>
					 			</tr>
					 		</table>

					 		<table class="table mt-3">
					 			<tr class="bg-light">
					 				<th colspan="2"><h6><i class="fa fa-shopping-cart"></i> Detail Pesanan</h6></th>
					 			</tr>
					 			<tr>
					 				<td>Kode Pesanan</td>
					 				<td class="text-right"><b><?= $order->order_code ?></b></td>
					 			</tr>

					 			<tr>
					 				<td>Tanggal</td>
					 				<td class="text-right"><b><?= indonesian_date($order->order_date, true) ?></b></td>
					 			</tr>

					 			<tr>
					 				<td>Status</td>
					 				<td class="text-right"><?= get_status_order($order->order_status) ?></td>
					 			</tr>

					 			<tr>
					 				<td>Bukti Bayar</td>
					 				<td class="text-right">
					 					<?php if($order->order_proof != ''){ ?>
					 						<button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalProof"><i class="fa fa-image"></i> Lihat Bukti</button>
					 					<?php }else{ ?>
					 						<span class="text-danger"><i class="fa fa-times-circle"></i> Belum Dikirim</span>
					 					<?php } ?>
					 				</td>
					 			</tr>

					 		</table>
					 	</div>

					 	<div class="col-md-8">
					 		
					 		<table class="table">
					 			
					 			<thead class="bg-primary">
					 				<tr class="bg-light">
					 					<th colspan="5"><h6><i class="fa fa-dropbox"></i> Detail Pesanan</h6></th>
					 				</tr>
					 				<tr class="text-white">
					 					<th style="width: 5%">No</th>
					 					<th>Produk</th>
					 					<th>Qty</th>
					 					<th class="text-center">Harga</th>
					 					<th class="text-center">Subtotal</th>
					 				</tr>
					 			</thead>

					 			<tbody>
				                  <?php $n= 1;
				                    foreach ($item as $row) { ?>
				                      <tr>
				                        <td><?= $n++ ?></td>
				                        <td><?= $row->product_name ?><br><small class="text-muted"><?= $row->category_name ?></small></td>
				                        <td><?= $row->qty ?></td>
				                        <td class="text-right"><?= format_rp($row->price) ?></td>
				                        <td class="text-right"><?= format_rp($row->subtotal) ?></td>
				                      </tr>
				                <?php } ?>
					 			</tbody>

					 		</table>
					 	</div>
					 </div>

				</div>
			</div>
		</div>
	</div>
@endsection


<div class="modal fade" id="modalProof">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Bukti Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <img class="img-fluid" src="/images/proof/<?= $order->order_proof ?>">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>