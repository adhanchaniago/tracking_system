 <div class="x_panel">
                  <div class="x_title">
                    <h2> Status Pengiriman </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">
 <!--
  <form  action="" method="post"  class="navbar-form alert"  style="background-color:#EEF8ED; border:1px solid #efefef; color:#;">
 
<div class="form-group">
<b> Periode Report : </b>
</div>
<div class="form-group">
<input type="text" id="from" name="startdate" class="form-control" value="<?=date('Y-m-d', strtotime("-30 days"));?>" readonly>
</div>
<div class="form-group input-group" style="margin-top:5px;">
<input type="text" id="to" name="enddate" class="form-control " value="<?=date('Y-m-d');?>" readonly>
<span class="input-group-btn">
<button type="submit" name="view" class="btn btn-success"> <i class="glyphicon glyphicon-zoom-out"></i> Report </button>
<a href="" class="btn btn-warning">  All  </a>
</span>
</div>
<div class="form-group">

</div>
</form>
-->
<div class="table-responsive">
 <table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>
                       
                          <th width="11%">Tanggal</th>
                          <th width="10%">Nopol</th>                         
                          <th width="18%">Customer</th>
                          <th width="12%">Driver</th>
                          <th width="16%">Start </th>
                          <th width="15%"> End</th>
                          <th width="13%">Request By </th>
                          <th width="13%">Status</th>
                         <th width="5%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  
					 
					    //$data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  where typetrx='Ganti Sementara' AND (status!='8' OR status!='5') ORDER BY idtrx DESC") or die ("Error Query".$mysqli->error); 
					  
					  $no=1;
                      foreach ($data_pending as $display) { ?>
                        <tr>
                         
                          <td><?=$display->tglrequest;?></td>
                          <td><?=$display->nopol;?></td>                         
                          <td><?=$display->customer;?></td>
                          <td><?=$display->driver;?></td>
                          <td><?=$display->startdate;?></td>
                          <td><?=$display->enddate;?></td>
                          <td><?=$display->nama;?></td>
                          <td><?=status($display->status);?></td>
                        <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($display->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i> </a> </td>
                             
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
                        
                       
                        
   </div>
</div>
</div>
