<?php
 foreach($data as $row) :  endforeach; 
 if($row->status=='1') {
	 $t='<td width="48%">  HO </td>
        <td width="52%"> KIRIM </td>';
 } else {
	 $t='<td width="48%">  '.$row->tujuan.' </td>
        <td width="52%"> TERIMA </td>';
 }
$sql= $this->db->query("SELECT
a.nama,
c.status,
b.tglupdate
FROM
tbluser AS a
Inner Join detailtrack AS b ON a.iduser = b.iduser INNER JOIN tbltrack c ON b.idtrack=c.idtrack WHERE kode_site='$row->tujuan' AND po_number='$row->nomor_po' AND b.idtrack='$row->idtrack' AND status='2' GROUP BY b.iddetail");
foreach($sql->result() as $b): endforeach;
if($b->status=='2') {
	$terima=strtoupper($b->nama);
	$tgl=$b->tglupdate;
} else {
	$terima="Waiting Received";
	$tgl="";
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="shortcut icon" href="<?=base_url();?>preview.ico"type="image/gif/ico">
<title>SURAT JALAN <?=$row->nomor_po;?> </title>
 <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style type="text/css">
body {
	font-family:tahoma;
	letter-spacing:0.4em;
}

</style>
<body>

 
<table width="100%" align="center">
  <tr style="border-bottom: 1px solid #333;
    box-shadow: 0 2px 0 #ccc;">
    <td colspan="3"><img src="<?=base_url();?>spog.png" height="60" width="85"  style="float:left; padding-right:20px"/> <b> PT. SRIWIJAYA PALM OIL GROUP </b> <br /> Jl. Kapten A. Rivai No B17-18, Komplek Ruko Taman Mandiri <br />Palembang, Sumatera Selatan. 
    </td>
  </tr>
  <tr>
    <td width="40%"><h3>SURAT JALAN</h3></td>
    <td width="35%"><table width="59%" border="1">
      <tr style="font-size:20px; padding:5px; text-align:center">
        <?=$t;?>
      </tr>
    </table></td>
    <td width="25%">Yth : KA. GUDANG</td>
  </tr>
  <tr>
    <td>Nomor : <?=$row->noresi;?></td>
    <td>&nbsp;</td>
    <td>di -
    <?=$row->site;?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Bersama ini kami kirimkan barang-barang yang tertera dibawah ini, sesuai dengan Surat Pesanan Barang :</td>
  </tr>
  <tr>
    <td>Nomor : <b> <?=$row->nomor_po;?> </b></td>
    <td colspan="2">Untuk Proyek :</td>
  </tr>
  <tr style="border-top:1px solid #333">
    <td colspan="3">
    
    <table width="100%" border="0" clas="table-condensed">
      <tr>
        <td width="5%">No. </td>
        <td width="40%">Nama Barang</td>
        <td width="16%">Banyaknya</td>
        <td width="39%">Keterangan</td>
      </tr>
      <?php 
	  $data=$this->db->query("SELECT * FROM detailtrack  a INNER JOIN tbluser b ON a.iduser=b.iduser WHERE po_number='$row->nomor_po' AND idtrack='$row->idtrack' AND a.iduser='".$row->iduser."' ORDER BY iddetail ASC");
  $no=1;
  foreach ($data->result() as $view) {
	  ?>
      <tr>
        <td height="30"><?=$no;?></td>
        <td><?=$view->item;?></td>
        <td><?=$view->qty;?> <?=$view->satuan;?></td>
        <td><?=$view->remarks;?></td>
      </tr>
      <?php $no++; } ?>
    </table></td>
  </tr>
  <tr style="border-top:1px solid #333">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Palembang, 
    <?=tanggal($row->tglpost);?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Yang mengeluarkan barang</td>
    <td>Expedisi : <?=$row->site;?></td>
    <td style="padding-left:00px">Yang menerima,</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nomor Polisi : <?=$row->vehicle;?> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><?=strtoupper($row->nama);?></td>
    <td><?=strtoupper($row->driver);?></td>
    <td><?=$terima;?></td>
  </tr>
  <tr>
    <td style="padding-left:0px">ADM. PEMBELIAN</td>
    <td style="padding-left:0px">SOPIR</td>
    <td style="padding-left:0px"><?=$tgl;?></td>
  </tr>
  <tr>
    <td><?=$row->tglupdate;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> <small> No. Ref : <?=$row->noref;?> </small> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>