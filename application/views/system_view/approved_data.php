<?=$this->session->flashdata('sukses');?> 

 <div class="x_panel">
                  <div class="x_title">
                    <h2>  Done Approved </h2>
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
                       
                          <th width="10%">Tanggal</th>
                          <th width="13%">Booking</th> 
                           <th width="14%">Nopol</th>                         
                          <th width="10%">Request</th>
                          <th width="9%">Digunakan </th>
                          <th width="9%">Sisa</th>
                           <th width="11%">Berkas</th>
                          <th width="5%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php				  
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
                          <td><?=rupiah($total);?></td>
                          <td><a href="<?=base_url();?>uploads/<?=$row->dokumen;?>" target="_blank">Download </a></td>
                          <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($row->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i>            </a>            </td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
                        
                       
   </div>
</div>
</div>