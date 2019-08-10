<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function  tanggal($tgl){
$tanggal  =  substr($tgl,8,2);
$bulan  =  getBulan(substr($tgl,5,2));
$tahun  =  substr($tgl,0,4);
return  $tanggal.' '.$bulan.' '.$tahun;
}
  
function  getBulan($bln){
switch  ($bln){
case  1:
return  "Januari";
break;
case  2:
return  "Februari";
break;
case  3:
return  "Maret";
break;
case  4:
return  "April";
break;
case  5:
return  "Mei";
break;
case  6:
return  "Juni";
break;
case  7:
return  "Juli";
break;
case  8:
return  "Agustus";
break;
case  9:
return  "September";
break;
case  10:
return  "Oktober";
break;
case  11:
return  "November";
break;
case  12:
return  "Desember";
break;
}
}

function hari($hari)
{
switch ($hari){
    case 0 : $hari="Minggu";
        Break;
    case 1 : $hari="Senin";
        Break;
    case 2 : $hari="Selasa";
        Break;
    case 3 : $hari="Rabu";
        Break;
    case 4 : $hari="Kamis";
        Break;
    case 5 : $hari="Jum'at";
        Break;
    case 6 : $hari="Sabtu";
        Break;
}
return $hari;
}

function status($var){
    if($var=='1'){
        $status="<span class='label label-success'>Yes</span>";
        return $status;
    }
    else if($var=='0'){
    $status="<span class='label label-danger'>No</span>";
        return $status;
    }
	
}

function status_kelulusan($var){
    if($var=='1'){
        $status="<span class='label label-success'>LULUS</span>";
        return $status;
    }
    else if($var=='0'){
    $status="<span class='label label-danger'>TIDAK LULUS</span>";
        return $status;
    }
	}
function status_lulus($var){
    if($var=='1'){
        $status="LULUS";
        return $status;
    }
    else if($var=='0'){
    $status="TIDAK LULUS";
        return $status;
    }
	}
function kategori($var){
    if($var=='1'){
        $status="Berita";
        return $status;
    }
    else if($var=='2'){
    $status="Artikel";
        return $status;
    }
}