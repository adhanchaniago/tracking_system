<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Error 404 Not Found</title>
  <!-- Bootstrap -->
    <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<style type="text/css">

.error-template {padding: 40px 15px;text-align: center; color:#900}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Not Found</h2>
                <div class="error-details">
                  Maaf, terjadi kesalahan, Halaman yang diminta tidak ditemukan!
            </div>
                <div class="error-actions">
                    <a href="<?=base_url();?>index.php/system/dashboard" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Team Support</h4>
      </div>
      <div class="modal-body">
        <p>Jika mengalami masalah pada sistem, Silahkan hubungi team IT:</p>
        <p> WIWID </p>
        <p> AGUS </p>
        <p> ARDI </p>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
   <!-- jQuery -->
    <script src="<?=base_url();?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
