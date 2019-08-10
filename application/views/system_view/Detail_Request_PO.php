 <?php foreach ($data as $row) :  endforeach; ?>
 
  <!-- page content -->
    
<style type="text/css">

.a {

}
</style>
            <div class="row">
              <div class="col-md-12">
                <div clas="x_panel">
                  <div class="x_title">
                    <h2> Detail Request Budget </h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="content invoice ">
                      <!-- title row -->
                      <div class="panel panel-warning">
                      <div class="panel-heading">
                      <h3 class="panel-title"> <i class="fa fa-table"></i> Data Request </h3>
                      </div>
                      <div class="panel-body form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Tanggal Request </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->tglrequest;?>
                   </div>
                   </div>
               
                   
                     <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > No. Booking </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->no_booking;?>
                   </div>
                   </div>
                   
                     <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Nomor Polisi </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->nopol;?>
                   </div>
                   </div>
                   
                     <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Type   </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->type;?>
                   </div>
                   </div>
                   
                     <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Nama Driver   </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=strtoupper($row->driver);?>
                   </div>
                   </div>
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > No CMD </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->cmd;?>
                   </div>
                   </div>
                  <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Customer </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->customer;?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Masa Sewa  </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->startdate;?> s/d  <?=$row->enddate;?>
                   </div>
                   </div>
                  
                  <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Service </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->service;?>
                   </div>
                   </div> 
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > <h3> Jumlah  </h3> </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                  <h3 style="color:#FF6600"> Rp. <?=rupiah($row->jumlah);?> </h3>
                   </div>
                   </div>
                   
                  <div style="background-color:#fafafa; padding:7px 0px">
                  <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" >  Atas Nama</label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=strtoupper($row->trxatasnama);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Nama Bank </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=strtoupper($row->trxbank);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Nomor Rekening </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=strtoupper($row->trxnorek);?>
                   </div>
                   </div>
                   </div>
                   
                    
                   
                      </div> <!-- end body -->
                      </div><!-- end panel -->
					
                      <!-- Table row -->
                      <?php if($row->status >='4') { ?>
                      
                      <div class="panel panel-warning">
                      <div class="panel-heading">
                      <h3 class="panel-title"> <i class="fa fa-th-list"></i> Detail Actual Budget </h3>
                      </div>
                      <div class="panel-body form-horizontal form-label-left">
                      
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > BBM </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=rupiah($row->budget_bbm);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Parkir </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=rupiah($row->budget_parkir);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Tol </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=rupiah($row->budget_tol);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Lain-lain </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=rupiah($row->budget_lain);?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > Keterangan Lain </label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                   <?=$row->ket_lain;?>
                   </div>
                   </div>
                   
                   <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > <h3> Actual Budget </h3></label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                  <h3 style="color:#009933"> Rp. <?=rupiah($row->jumlah_selesai);?> </h3>
                   </div>
                   </div>
                   
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12" > <h4> Sisa </h4></label>                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                  <h4 style="color:#CC3333"> Rp. <?=rupiah($total=$row->sisa);?> </h4>
                   </div>
                   </div>
                   
                   </div> <!-- end body -->
                      </div><!-- end panel -->
                      
					<?php } ?>
                   
                      <div clas="row">
                  
                        <div class="row">
                        <div class="col-md-2  col-xs-12">
       <button class="btn btn-default btn-block pull-lef" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Back</button>
                         </div>
                          
              <?php if($this->session->userdata('pettylevel')=='admin' and $row->status=='1') { ?>
          <div class="col-md-2 col-xs-12">
          <button class="btn btn-danger pull-lef btn-block" data-toggle="modal" data-target="#a"><i class="fa fa-times"></i> Rejected </button>      		  		  </div>  
          
          <div class="col-md-2 col-xs-12">
         <button class="btn btn-success pull-lef btn-block" data-toggle="modal" data-target="#b"><i class="fa fa-check"></i> Approved </button>		
         </div>
                          		<?php } ?>
                        </div> 
                      </div>
                      <!-- /.row -->

                      <div class="row">
                       

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                         
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


<!-- MODAL 1 -->
 <div id="b" class="modal fade" role="dialog" >
  <div class="modal-dialog">
	 <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#339966; color:white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="color:white"><b> <i class="fa fa-arrow-circle-right"></i> Approved Budget</b></h5>
      </div>
	   
      <div class="modal-body">	
	  <p>
        <form action="<?=base_url();?>index.php/system/order/approved" method="post"  enctype="multipart/form-data" id="demo-form2" data-parsley-validate>
        <input type="hidden" value="<?=md5($row->idclaim);?>" name="ID">
        <input type="hidden" value="<?=$row->email;?>" name="email">
        <input type="text" name="tgltransfer"  id="from" class="form-control"  readonly placeholder="Tanggal Transfer"  value="<?=date('Y-m-d');?>"required><br />
        <input type="text" name="jumlah" value="<?=$row->jumlah;?>" class="form-control" required><br />
        
        
        <button type="submit" class="btn btn-success btn-sm pull-right" name="approved"> Submit </button> <br />
		  </form>
        </p>
	  </div>
      <div class="modal-footer" style="background-color:#efefef;">      </div>
    </div>
<!-- modal Content -->
 </div>
</div> 
<!-- END MODAL -->                    


<!-- MODAL 2 -->
 <div id="a" class="modal fade" role="dialog" >
  <div class="modal-dialog" >
	 <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#CC0000; color:white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="color:white"><b> <i class="fa fa-arrow-circle-right"></i> Reject Request</b></h5>
      </div>
	   
      <div class="modal-body">	
	  <p>
        <form action="<?=base_url();?>index.php/system/order/reject"method="post">
        <input type="hidden" value="<?=md5($row->idclaim);?>" name="ID">
          <input type="hidden" value="<?=$row->email;?>" name="email">
        <textarea class="form-control" placeholder="Masukan Alasan Ditolak"   name="reason" required/></textarea><br />
        <button type="submit" class="btn btn-danger btn-sm pull-right" name="reject"> Submit </button> <br />
		  </form>
        </p>
	  </div>
      <div class="modal-footer" style="background-color:#efefef;">      </div>
    </div>
<!-- modal Content -->
 </div>
</div> 
<!-- END MODAL -->


<!-- MODAL 2 -->
 <div id="c" class="modal fade" role="dialog" >
  <div class="modal-dialog" >
	 <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#FF9933; color:white">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="color:white"><b> <i class="fa fa-arrow-circle-right"></i> Pending Request Part </b></h5>
      </div>
	   
      <div class="modal-body">	
	  <p>
        <form action="<?=base_url();?>index.php/system/order/do_pending"method="post">
        <input type="hidden" value="<?=md5($row->idclaim);?>" name="ID">
          <input type="hidden" value="<?=$row->email;?>" name="email">
        <textarea class="form-control" placeholder="Masukan Alasan Pending"   name="pending" required/></textarea><br />
        <button type="submit" class="btn btn-warning btn-sm pull-right" name="request"> Submit </button> <br />
		  </form>
        </p>
	  </div>
      <div class="modal-footer" style="background-color:#efefef;">      </div>
    </div>
<!-- modal Content -->
 </div>
</div> 
<!-- END MODAL -->
