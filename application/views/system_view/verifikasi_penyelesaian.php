<?=$this->session->flashdata('sukses');?> 
 <div class="x_panel">
                  <div class="x_title">
                    <h2> Report Finishing Budget </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">

<div class="table-responsive">

<table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>
                       
                          <th width="9%">Tanggal</th>
                          <th width="8%">Booking</th> 
                           <th width="8%">Nopol</th>                         
                          <th width="9%">Request</th>
                          <th width="12%">Actual </th>
                          <th width="7%">Sisa</th>
                           <th width="9%">Berkas</th>
                          <th width="10%">User</th>
                      
                         <th width="14%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  
					 
					    //$data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  where typetrx='Ganti Sementara' AND (status!='8' OR status!='5') ORDER BY idtrx DESC") or die ("Error Query".$mysqli->error); 
					  
					  $no=1;
					  $total=0;
                      foreach ($data as $row) { 
					  $total=$row->jumlah - $row->jumlah_selesai;
					  ?>
                        <tr>
                         
                          <td><?=$row->tglrequest;?></td>
                          <td><?=$row->no_booking;?></td> 
                          <td><?=$row->nopol;?></td>                         
                          <td><?=rupiah($row->jumlah);?></td>
                          <td><?=rupiah($row->jumlah_selesai);?></td>
                          <td><?=rupiah($row->sisa);?></td>
                          <td><a href="<?=base_url();?>uploads/<?=$row->dokumen;?>" target="_blank">Download </a></td>
                          <td><?=$row->nama;?></td>                   
                          <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($row->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i> </a> 
  <a href="<?=base_url();?>index.php/system/order/approved_document/<?=md5($row->idclaim);?>"  onclick="return confirm('ARE YOU SURE COMPLETE DOCUMENT?')"class="btn btn-sm btn-success" title="Approved Document"> <i class="fa fa-check-square-o"></i> </a>                        </td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
                        
                       
   </div>
</div>
</div>