<?php
 if(!$this->session->userdata('pettyiduser')){

 			$this->session->set_flashdata('sukses',' <div class="error"> Anda harus login  dahulu </div>');
            redirect('index.php/front_end/sign_in');
   } 	
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?=base_url();?>find.ico"type="image/gif/ico">

    <title> Tracking System </title>
    <!-- Bootstrap -->
    <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=base_url();?>vendors/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url();?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?=base_url();?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
   <!-- Datatables -->
    <link href="<?=base_url();?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <!-- Custom Theme Style -->
    <link href="<?=base_url();?>build/css/custom.min.css" rel="stylesheet">
    <link href="<?=base_url();?>css/style.css" rel="stylesheet">
      
    <script src="<?=base_url();?>js/jquery.min.js"></script>
    
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container" style="background-color:#1F3A93">
        <div class="col-md-3 left_col  menu_fixe" >
          <div class="left_col scroll-view" style="background-color:#1F3A93">
            <div class="navbar nav_title" style="background-color:#F39C12">
              <a href="<?=base_url();?>index.php/system/dashboard" class="site_title"><i class="fa fa-search-minus"></i> Tracking System </span></a>            </div>

            <div class="clearfix"></div>    
            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?=base_url();?>avatar.png" alt="..." class="img-circle profile_img">              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$this->session->userdata('pettynama');?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"  style="background-color:#1F3A93">
              <div class="menu_section">
                <h3>User Site : <?=$this->session->userdata('pettysite');?> </h3>
                <ul class="nav side-menu" style="background-color:#1F3A93">  
                
           <li><a href="<?=base_url();?>index.php/system/dashboard"> <i class="fa fa-home"></i>   Home  </a> </li>  
         
       
        <?php if($this->session->userdata('pettysite')=='HO' || $this->session->userdata('pettyusername')=='ADMIN') {?>
        <?php if ($this->session->userdata('pettyusername')=='ADMIN') {?>
        <li><a><i class="fa fa-cog"></i> Manage Data <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">       
        <li><a href="<?=base_url();?>index.php/system/manage/view_user"> User Data </a> </li>     
        <li><a href="<?=base_url();?>index.php/system/manage/view_mail"> Push Mail </a> </li>           
        </ul>
        </li>  
        <?php } ?>
        
        <li><a href="<?=base_url();?>index.php/system/order/kirim_barang"> <i class="fa  fa-edit"></i>    Shipment Form </a> </li> 
        <li><a href="<?=base_url();?>index.php/system/order/receive_data"> <i class="fa fa-check-square-o"></i>   Receive/Send Shipment </a> </li>
        <li><a href="<?=base_url();?>index.php/system/order/view_status"> <i class="fa fa-spinner fa-spin"></i>  Outstanding Shipment  </a> </li>  
        <li><a href="<?=base_url();?>index.php/system/order/supply"> <i class="fa fa-search-plus"></i>   Track Shipment</a> </li> 
        <li><a><i class="fa fa-file-text"></i> Report Data<span class="fa fa-chevron-down"></span></a>
       <ul class="nav child_menu">       
       <li><a href="<?=base_url();?>index.php/system/order/history">  All Shipment </a> </li>           
       </ul>
       </li>       
        <?php } else { ?> 
        <li><a href="<?=base_url();?>index.php/system/order/receive_data"> <i class="fa fa-check-square-o"></i>   Receive/Send Shipment </a> </li>
        <li><a href="<?=base_url();?>index.php/system/order/return_barang"> <i class="fa fa-undo"></i>   Return Barang </a> </li>    	<li><a href="<?=base_url();?>index.php/system/order/supply"> <i class="fa fa-search-plus"></i>   Track Shipment </a> </li>
        
        <?php } ?>

      
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons-->
            <div class="sidebar-footer hidden-small" >
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>              </a>            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav navbar-fixed-top" >
          <div class="nav_menu " style="background-color:#1F3A93;">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle" style="color:white"><i class="fa fa-bars"></i></a>              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url();?>avatar.png" alt=""> <span style="color:#fff"> <?=$this->session->userdata('pettynama');?> </span>
                    <span class=" fa fa-angle-down"></span>                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                 	<!--<li><a href="<?=base_url();?>index.php/system/dashboard/profile"> Profile</a></li> -->
                     <li><a href="<?=base_url();?>index.php/system/dashboard/change_password"> Change Password</a></li>
                    
                    <li><a href="<?=base_url();?>index.php/front_end/logout"> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col">
         <br> <br> <br>
         

    <ul class="breadcrumb">

        <li><a href="<?=base_url();?>index.php/dashboard">Home</a></li>       

        <li class="active"><?=$breadcrumb;?></li>

    </ul>


        <?php $this->load->view($main);?>
        </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           &copy; Copyright <?=date('Y');?>  PT. Sriwijaya Palm Oil Group 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?=base_url();?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="<?=base_url();?>vendors/nprogress/nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=base_url();?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
      <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url();?>js/moment/moment.min.js"></script>
    <script src="<?=base_url();?>js/datepicker/daterangepicker.js"></script>
    <!-- Select2 -->
    <script src="<?=base_url();?>vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url();?>build/js/custom.min.js"></script>
  <!--  <script src="<?=base_url();?>js/script.js"></script> -->
  <script>
  //$('table').dataTable();

  viewData(); 
  
$('#update').prop("disabled",true);

function viewData(){
    $.get('<?=base_url();?>index.php/system/order/insert_detail', function(data){
        $('.records_content').html(data)
    })
}

function saveData(){
 
    var name = $('#nm').val()
    var email = $('#em').val()
	var ket = $('#ket').val()
	var sat = $('#sat').val()
  
    $.post('<?=base_url();?>index.php/system/order/insert_detail?p=add', { nm:name, em:email,ket:ket,sat:sat}, function(data){
        viewData()
        $('#id').val(' ')
        $('#nm').val(' ')
        $('#em').val(' ')
		$('#ket').val(' ')
		$('#sat').val(' ')
       
    })
}

function editData(id, nm, em,ket,sat) {
    $('#id').val(id)
    $('#nm').val(nm)
    $('#em').val(em)
	$('#ket').val(ket)
	$('#sat').val(sat)
  
    $('#id').prop("readonly",true);
    $('#save').prop("disabled",true);
    $('#update').prop("disabled",false);
}

function updateData(){
    var id = $('#id').val()
    var name = $('#nm').val()
    var email = $('#em').val()
	var ket = $('#ket').val()
	var sat = $('#sat').val()
    
    $.post('<?=base_url();?>index.php/system/order/insert_detail?p=update', {id:id, nm:name, em:email,ket:ket,sat:sat}, function(data){
        viewData()
        $('#id').val(' ')
        $('#nm').val(' ')
        $('#em').val(' ')
		$('#ket').val(' ')
	    $('#sat').val(' ')
       
        $('#id').prop("readonly",false);
        $('#save').prop("disabled",false);
        $('#update').prop("disabled",true);
    })
}

function deleteData(id){
    $.post('<?=base_url();?>index.php/system/order/insert_detail?p=delete', {id:id}, function(data){
        viewData()
    })
}

function removeConfirm(id){
    var con = confirm('YAKIN DATA AKAN DIHAPUS?');
    if(con=='1'){
        deleteData(id);
    }
}
</script>
      
    <!-- datatables -->
   <script src="<?=base_url();?>datatables/jquery.dataTables.min.js"></script>
   <script src="<?=base_url();?>datatables/dataTables.bootstrap.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday,#from,#to').daterangepicker({
          singleDatePicker: true,
     format: "YYYY-MM-DD",  
          calender_style: "picker_3"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    
    <!-- /bootstrap-daterangepicker -->

   

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
	    
        $(".select2_single").select2({
          placeholder: "Select a data",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

   
    
    <!-- ONLY NUMBER -->
     <script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}
</script>

<script  type="text/javascript">
$(document).ready(function() {

    $('#example,.example1').DataTable();
} );
</script>

      
 </body>
</html>
