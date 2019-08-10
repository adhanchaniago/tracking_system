<?=$this->session->flashdata('sukses');?> 
 <div class="x_panel">
                  <div class="x_title">
                    <h2>  Pending Request Budget </h2>
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
  <form  action="" method="get"  class="navbar-form alert"  style="background-color:#EEF8ED; border:1px solid #efefef; color:#;">
 
<div class="form-group">
<b> Periode Report : </b>
</div>
<div class="form-group">
<input type="text" id="from" name="startdate" class="form-control" value="<?=date('Y-m-d', strtotime("-30 days"));?>" readonly>
</div>
<div class="form-group input-group" style="margin-top:5px;">
<input type="text" id="to" name="enddate" class="form-control " value="<?=date('Y-m-d');?>" readonly>
<span class="input-group-btn">
<button type="submit"  class="btn btn-success"> <i class="glyphicon glyphicon-zoom-out"></i> Report </button>

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
                          <th width="25%">Customer</th>
                          <th width="7%">Jumlah</th>
                          <th width="13%">User </th>
                          <th width="5%">Status</th>
                         <th width="5%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  
					 
					    //$data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  where typetrx='Ganti Sementara' AND (status!='8' OR status!='5') ORDER BY idtrx DESC") or die ("Error Query".$mysqli->error); 
					  
					  $no=1;
					  $jumlah=0;
                      foreach ($data as $row) {
					  $jumlah+=$row->jumlah;
					   ?>

                        <tr>
                         
                          <td><?=$row->tglrequest;?></td>
                          <td><?=$row->nopol;?></td>                         
                          <td><?=$row->customer;?></td>
                          <td><?=rupiah($row->jumlah);?></td>
                          <td><?=$row->nama;?></td>
                          <td><?=status($row->status);?></td>
                        <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($row->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i> </a> </td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        <tfoot>
                          <tr>
                       
                          <th width="11%"></th>
                          <th width="10%"></th>                         
                          <th width="25%">TOTAL</th>
                          <th width="7%"><?=rupiah($jumlah);?></th>
                          <th width="13%"></th>
                          <th width="5%"></th>
                         <th width="5%"> </th>                          
                        </tr>
                        </tfoot>
                        </table>
                        
                       
   </div>
</div>
</div>