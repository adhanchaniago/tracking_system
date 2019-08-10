<?=$this->session->flashdata('sukses');?>  <br />
 <div class="x_panel">
                  <div class="x_title">
                    <h2> <i class="fa fa-spinner fa-spin"></i> Outstanding Shipment </h2>
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
 <table id="example" class="table table-striped  table-bordere table-hover" width="100%" style="font-size:12px">
                      <thead>
                        <tr>
                       
                          <th width="13%">Tanggal</th>
                          <th width="10%">No. PO</th>
                          <th width="11%">No.Ref</th>
                          <th width="12%">No. Resi</th>
                          <th width="10%">Tujuan </th>
                          <th width="10%">Estapet</th>
                          <th width="9%">Vehicle</th>
                          <th width="8%">Driver</th>
                          <th width="8%">Status </th>                          
                          <th width="9%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($data)):  ?>
                      <?php
					
					  $no=1;
                      foreach ($data as $row) { ?>
                        <tr>
                         
                          <td><?=$row->tglpost;?></td>
                          <td><?=$row->nomor_po;?></td>
                          <td><?=$row->noref;?></td>
                          <td><?=$row->noresi;?></td>
                          <td><?=$row->tujuan;?></td>
                          <td><?=$row->site;?></td>
                          <td><?=$row->vehicle;?></td>
                          <td><?=strtoupper($row->driver);?></td>
                          <td><?=status_kirim($row->status);?></td>
                          <td> 
                          <div class="btn-group btn-group-sm" role="group" aria-label="...">
                          <a href="<?=base_url();?>index.php/system/order/supply?traceby=NOPO&keywoard=<?=$row->nomor_po;?>" class="btn btn-sm btn-default" title="Detail"> <i class="fa fa-search"></i> </a> <a href="<?=base_url();?>index.php/system/order/cetak_surat_jalan?nomorpo=<?=$row->nomor_po;?>&id=<?=$row->idtrack;?>" class="btn btn-sm btn-warning" title="Print" target="_blank"> <i class="fa fa-print"></i> </a> 
                          
                           </div>
   </td>
                        </tr>
                        
                       <?php $no ++; } ?>
                         <?php endif; ?>
                        </tbody>
                        </table>
   </div>
</div>
</div>

