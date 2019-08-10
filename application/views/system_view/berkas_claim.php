<script>
$(document).ready(function() {
  $('#check-all').click(function(){
    $("input:checkbox").attr('checked', true);
  });
  $('#uncheck-all').click(function(){
    $("input:checkbox").attr('checked', false);
  });
});
</script>
<?=$this->session->flashdata('sukses');?> 

 <div class="x_panel">
                  <div class="x_title">
                    <h2>  Claim Document </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">
<form action="<?=base_url();?>index.php/system/saldo/transfer_completed" method="post">
<div class="table-responsive">
<div class="pull-right">
<a id="check-all" href="javascript:void(0);" class="btn btn-sm btn-info">check all</a>
<a id="uncheck-all" href="javascript:void(0);" class="btn btn-sm btn-warning">uncheck all</a> 
</div>
<table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>
                       
                          <th width="12%">Tanggal</th>
                          <th width="11%">Booking</th> 
                           <th width="11%">Nopol</th>                         
                          <th width="11%">Request</th>
                          <th width="12%">Actual</th>
                          <th width="10%">Sisa</th>
                           <th width="12%">Berkas</th>
                           <th width="14%">User</th>
                          <th width="7%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php				  
					  $no=1;
					  $total=0;
					  $grand=0;
                      foreach ($data as $row) { 
					  $total=$row->jumlah - $row->jumlah_selesai;
					  $grand +=$row->jumlah_selesai;
					  ?>
                        <tr>
                         
                          <td><?=$row->tglrequest;?></td>
                          <td><?=$row->no_booking;?></td> 
                          <td><?=$row->nopol;?></td>                         
                          <td><?=rupiah($row->jumlah);?></td>
                          <td><?=rupiah($row->jumlah_selesai);?></td>
                          <td><?=rupiah($row->sisa);?></td>
                          <td><a href="<?=base_url();?>uploads/<?=$row->dokumen;?>" target="_blank"> Download </a></td>
                          <td><?=$row->nama;?></td>
                          <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($row->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i></a>    <!-- <a href="<?=base_url();?>index.php/system/saldo/transfer_completed/<?=md5($row->idclaim);?>" class="btn btn-sm btn-success" title="Complete Transfer"> <i class="fa fa-check"></i></a>--><input type="checkbox" name="ID[]" class="form-control" value="<?=$row->idclaim;?>" />        </td>
                        </tr>
                          <?php $no ++; } ?>
                          <tfoot>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><?=rupiah($grand);?></td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        </tfoot>
                     
                        </tbody>
                        </table>                
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary pull-right">SUBMIT</button>
                            </form>   
</div>
</div>