<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <link rel="shortcut icon" href="<?=base_url();?>find.ico"type="image/gif/ico">
  <title>Log In</title>

  <!-- CSS  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
  <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet"> 
  <link href="<?=base_url();?>css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- Font Awesome -->
  <link href="<?=base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<style type="text/css">
 body{ 
background: #673AB7;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #512DA8, #673AB7);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #512DA8, #673AB7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
.header {
background: #000046;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #1CB5E0, #000046);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #1CB5E0, #000046); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }
.header2 {
	background: #007991;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #78ffd6, #007991);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #78ffd6, #007991); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
/* fallback */
@font-face {
  font-family: 'Material Icons';
  font-style: normal;
  font-weight: 400;
  src: url(<?php echo base_url();?>fonts/roboto/materialize.woff2) format('woff2');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  line-height: 1;
  letter-spacing: normal;
  text-transform: none;
  display: inline-block;
  white-space: nowrap;
  word-wrap: normal;
  direction: ltr;
  -moz-font-feature-settings: 'liga';
  -moz-osx-font-smoothing: grayscale;
}

@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);

body {
background: #EFEFBB;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #D4D3DD, #EFEFBB);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #D4D3DD, #EFEFBB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  font-family: 'Open Sans', sans-serif;
}

.login {
  
  margin:  auto;
  font-size: 16px;
}

/* Reset top and bottom margins from certain elements */
.login-header,
.login p {
  margin-top: 0;
  margin-bottom: 0;
}

/* The triangle form is achieved by a CSS hack */
.login-triangle {
  width: 0;
  margin-right: auto;
  margin-left: auto;
  border: 12px solid transparent;
  border-bottom-color: #C0392B;
}

.login-header {
  background: #C0392B;
  padding: 20px;
  font-size: 1.4em;
  font-weight: normal;
  text-align: center;
 
  color: #fff;
}

.login-container {
  background: #ebebeb;
  padding: 12px;
}

/* Every row inside .login-container is defined with p tags */
.login p {
  padding: 12px;
}

.login input {
  box-sizing: border-box;
  display: block;
  width: 100%;
  border-width: 1px;
  border-style: solid;
  padding: 16px;
  outline: 0;
  font-family: inherit;
  font-size: 0.95em;
}

.login input[type="email"],
.login input[type="password"] {
  background: #fff;
  border-color: #bbb;
  color: #555;
}

/* Text fields' focus effect */
.login input[type="email"]:focus,
.login input[type="password"]:focus {
  border-color: #888;
}

.login input[type="submit"] {
  background: #C0392B;
  border-color: transparent;
  color: #fff;
  cursor: pointer;
}

.login input[type="submit"]:hover {
  background: #D91E18;
}

/* Buttons' focus effect */
.login input[type="submit"]:focus {
  border-color: #05a;
}
@media (max-width: 240px) {
    .navbar-header > li > a {
	    font-size: 13px;
	}

	.x-navbar .sub-menu a {
	    font-size: 13px;
	}
}

@media (max-width: 320px) {
   .navbar-header > li > a {
	    font-size: 12px;
	}

	.x-navbar .sub-menu a {
	    font-size: 14px;
	}
}
@media (max-width: 480px) {
    .navbar-header > li > a {
	    font-size: 12px;
	}

	.x-navbar .sub-menu a {
	    font-size: 15px;
	}
}

@media (max-width: 768px) {
    .navbar-header > li > a {
	    font-size: 12px;
	}

	}
</style>
<body>
 
<nav class="navbar navbar-default" style="height:70px; background-color:#C0392B; border:0px; border-radius:0px; padding-top:5px">
  <div class="container-fluid">
    <div class="navbar-header">
    <p style="display:inline;"> <a href="<?=base_url();?>index.php/front_end/sign_in" style="color:#C0392B;  font-family:tahoma; font-size:16px">  <img src="<?=base_url();?>spog1.png" alt="LOGO SPOG" height="60" width="70">  SRIWIJAYA PALM OIL GROUP  </a> </p>
    </div>
    
  </div>
</nav>

<div class="container">
 <?=$this->session->flashdata('sukses');?> 
<br><br>
<form action="" method="get" role="form">
<div class="row">
			    				<div class="col-xs-12 col-sm-3 col-md-3">
			    					<div class="form-group">
			                <select name="traceby" class="form-control input-lg" required>
        <option value=""> Track By </option>
        <option value="NOPO">Nomor PO </option>
        <option value="NOREF"> No. Reference </option>
        <option value="NORESI"> No. Resi</option>
      </select>
			    					</div>
			    				</div>
                                
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<input type="text" name="keywoard" required placeholder="Please Enter Keywoard"  class="form-control input-lg">
			    					</div>
			    				</div>
                                <div class="col-xs-12 col-sm-3 col-md-3">
			    					<div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-search-plus"></i> Track</button> 
      <a class="btn btn-danger btn-lg" data-toggle="collapse" data-parent="#accordion" href="#view_login">Log In</a>
                                    </div>
                                    </div>
			    			</div>

</form>

 <form  action="<?=base_url();?>index.php/front_end/login" method="post">
 <?php 
 if($this->uri->segment(3)=='false') {
	 $in="in";
 } else {
	$in=""; 
 }
 ?>
  <div class="login col-md-4  col-lg-4 col-sm-4 col-xs-12 col-lg-offset-6 panel-collapse collapse <?=$in;?>" id="view_login">
  
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in System </h2>

 <div class="login-container">
    <p><input type="text" name="username" required placeholder="Username" ></p>
    <p><input type="password" placeholder="Password" name="password"></p>
    <p><input type="submit" value="LOG IN" name="login" ></p>
  </div>
</div>

</form>
</div>
<div class="container-fluid">
 <?php
if(isset($_GET['keywoard'])) { ?>
<?php 
if(!empty($data)) {
foreach($data as $row) :  endforeach; 

?>
<br>
<div class="panel panel-heading">
<div class="panel-heading">
<div class="panel-title" style="color:#900;"> Track By : <?=$this->input->get('traceby');?>, Keywoard : <?=$this->input->get('keywoard');?>   <a href="<?=base_url();?>index.php/system/order/export_to_excel?traceby=<?=$this->input->get('traceby');?>&keywoard=<?=$this->input->get('keywoard');?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-excel"></i> Export Excel</a> </div>
</div>
<div class="panel-body">
 
	

  <table width="100%" class="table-condense table table-striped table-bordered">
  <tr>
    <td colspan="2"  class="header" style="color:white"> HEADER DATA </td>
    </tr>
  <tr>
    <td width="19%">No. PO</td>
    <td width="81%"><?=$row->nomor_po;?></td>
  </tr>
  <tr>
    <td>No. Ref</td>
    <td><?=$row->noref;?></td>
  </tr>
  <tr>
    <td>Tujuan </td>
    <td><?=$row->tujuan;?></td>
  </tr>
  <tr>
    <td>Datetime</td>
    <td><?=$row->tglpost;?></td>
  </tr>
   <tr>
    <td>Type</td>
    <td><?=flag($row->flag);?></td>
  </tr>
  <tr>
    <td>Transit </td>
    <td><?=$row->site;?></td>
  </tr>
  <tr>
    <td>Remarks </td>
    <td><?=$row->note;?></td>
  </tr>
  <tr>
    <td>Status </td>
    <td><?=status_kirim($row->status);?></td>
  </tr>
</table>

<br>
<div class="table-responsive">
<table width="100%" class="table table-condense table-striped table-hover table-bordered">
  <tr>
    <td colspan="11" class="header" style="color:white"> RINCINAN DATA </td>
    </tr>
  <tr style="font-weight:bold">
  <td width="3%">No</td>
    <td width="14%">Waktu Update</td>
    <td width="16%">No Resi</td>
    <td width="8%">Vehicle</td>
    <td width="11%">Driver</td>
    <td width="11%">Item Barang</td>
    <td width="5%">Qty</td>
    <td width="12%">Remarks</td>
    <td width="9%">User</td>
    <td width="6%">Unit</td>
    <td width="5%">Status</td>
  </tr>
  <?php
  $data=$this->db->query("SELECT * FROM detailtrack  a INNER JOIN tbluser b ON a.iduser=b.iduser WHERE po_number='$row->nomor_po' ORDER BY iddetail ASC");
  $no=1;
  foreach ($data->result() as $view) {
  ?>
  <tr>
    <td><b><?=$no;?></b></td>
    <td><?=$view->tglupdate;?></td>
    <td><?=$view->noresi;?></td>
    <td><?=$view->vehicle;?></td>
    <td><?=$view->driver;?></td>
    <td><?=$view->item;?></td>
    <td><?=$view->qty;?> <?=$view->satuan;?></td>
    <td><?=$view->remarks;?></td>
    <td><?=strtoupper($view->nama);?></td>
    <td><?=$view->kode_site;?></td>
    <td><?=status($view->stts_kirim);?></td>
  </tr>
  <?php $no++; } ?>
</table>
</div>
</div>
</div>
	
<?php } else {
	echo "<div class='alert alert-danger'> TIDAK DITEMUKAN DATA </div>";
} } ?>

</div>

<!--  Scripts-->
  <!-- jQuery -->
    <script src="<?=base_url();?>js/jquery-2.1.1.min.js"></script>
    <!-- Bootstrap -->
<script src="<?=base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>
