<?php

if(!function_exists('show_alert')){
	function show_alert($message, $status){
		return '<div class="alert alert-'.$status.' alert-dismissible">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  '.$message.'
				</div>';
	}
}

function format_rp($a){
	if(!is_numeric($a)) return NULL;
	$jumlah_desimal="0";
	$pemisah_desimal="";
	$pemisah_ribuan=".";
	$angka="Rp ".number_format($a, $jumlah_desimal, $pemisah_desimal,$pemisah_ribuan);
	return $angka;
}

function format_number($a){
	if(!is_numeric($a)) return NULL;
	$jumlah_desimal="0";
	$pemisah_desimal="";
	$pemisah_ribuan=".";
	$angka=number_format($a, $jumlah_desimal, $pemisah_desimal,$pemisah_ribuan);
	return $angka;
}

function format_angka($a){
 	$angka = preg_replace("/[^0-9]/", "", $a);
	return $angka*1;
}

function get_monthname($number, $is_short = false){
	if($number == 1 or $number ==  "01"){
		return "Januari";
	}else if($number == 2 or $number == "02"){
		return "Februari";
	}else if($number == 3 or $number ==  "03"){
		return "Maret";
	}else if($number == 4 or  $number == "04"){
		return "April";
	}else if($number == 5 or  $number == "05"){
		return "Mei";
	}else if($number == 6 or  $number == "06"){
		return "Juni";
	}else if($number == 7 or  $number == "07"){
		return "Juli";
	}else if($number == 8 or  $number == "08"){
		return "Agustus";
	}else if($number == 9 or $number == "09"){
		return "September";
	}else if($number == "10"){
		return "Oktober";
	}else if($number == "11"){
		return "November";
	}else if($number == "12"){
		return "Desember";
	}
}

function indonesian_date($string, $with_time = false, $is_string = true, $is_short = false){
	$time = $string;
	if($is_string){
		$time = strtotime($string);
	}
	$tgl = date('d', $time);

	if(!$is_short){
		$bln = get_monthname(date('m', $time));
	}else{
		$bln = get_short_month(date('m', $time));
	}
	
	$thn = date('Y', $time);
	$txt = $tgl." ".$bln." ".$thn;

	if($with_time){
		$jam = date('H:i', $time);
		$txt .= ", ".$jam;
	}
	return $txt;
}

function generate_random($n){ 
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
}

function get_status_order($status){
	$txt = '';
	if($status == 'pending'){
		$txt = '<span class="badge bg-info text-white">Pending</span>';
	}else if($status == 'complete'){
		$txt = '<span class="badge badge-success text-white"><i class="fa fa-check-circle"></i> Selesai</span>';
	}else if($status == 'verify'){
		$txt = '<span class="badge badge-primary text-white"><i class="fa fa-clock"></i> Menunggu Verifikasi</span>';
	}else if($status == 'deny'){
		$txt = '<span class="badge badge-danger text-white"><i class="fa fa-times"></i> Ditolak</span>';
	}

	return $txt;
}