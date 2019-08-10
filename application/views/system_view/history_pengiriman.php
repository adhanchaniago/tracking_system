<?=$this->session->flashdata('sukses');?>  <br />
 <div class="x_panel">
                  <div class="x_title">
                    <h2> <i class="fa fa-file-text-o"></i> History All Shipment  </h2>
                    
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">
<form class="form-horizontal" role="form" method="get" action="">
    
    <div class="form-group">
        
            <div class="form-group row">
               
                <div class="col-md-4">
               
                    <select name="shipment" class="form-control select2_single" required>
           <option value="ALL"> ALL UNIT </option>     
                 
           <?php foreach ($site as $data1 ) {     		
             if($this->input->get('shipment')==$data1->kode_site) {
             echo " <option value=\"$data1->kode_site\" selected>".$data1->kode_site." => ".strtoupper($data1->keterangan)."</option> ";
		     } else {
			 echo " <option value=\"$data1->kode_site\">".$data1->kode_site." => ".strtoupper($data1->keterangan)."</option> ";
		     }
			} ?>           
          </select>
                </div>
                 <div class="col-md-2">
                   <select name="state" class="form-control">
                   <option value="all_state"> All Status </option>
                   <option value="1">In Shipment </option>
                   <option value="2">Received </option>
                   </select>
                </div>
               
                <div class="col-md-2">
                    <input type="text" class="form-control" id="from"  value="<?=$this->input->get('from');?>" name="from" placeholder="From" readonly>
                </div>
               
                <div class="col-md-2">
                    <input type="text" class="form-control" id="to" name="to" value="<?=$this->input->get('to');?>" placeholder="To" readonly>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search-minus"></i></button>
               
            </div>
        </div>
    </div>
</form>
<hr />
    <a href="<?=base_url();?>index.php/system/order/export_history?shipment=<?=$this->input->get('shipment');?>&state=<?=$this->input->get('state');?>&from=<?=$this->input->get('from');?>&to=<?=$this->input->get('to');?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-excel"></i> Export Excel</a>
    <div class="clearfix"></div>
<div class="table-responsive">
 <table id="example" class="table table-striped  table-bordere table-hover" width="100%" style="font-size:12px">
                      <thead>
                        <tr>
                       
                          <th width="12%">Tanggal</th>
                          <th width="10%">No. PO</th>
                          <th width="12%">No. Ref</th>
                          <th width="12%">No. Resi</th>
                          <th width="10%">Tujuan </th>
                          <th width="7%">Estapet</th>
                          <th width="9%">Vehicle</th>
                          <th width="11%">Driver</th>
                          <th width="7%">Status </th>                          
                          <th width="10%"> </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if(is_array($data)): ?>
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
                          <td> <a href="<?=base_url();?>index.php/system/order/supply?traceby=NOPO&keywoard=<?=$row->nomor_po;?>" class="btn btn-sm btn-default" title="Detail"> <i class="fa fa-search"></i> </a> <a href="<?=base_url();?>index.php/system/order/cetak_surat_jalan?nomorpo=<?=$row->nomor_po;?>&id=<?=$row->idtrack;?>" class="btn btn-sm btn-warning" title="Print" target="_blank"> <i class="fa fa-print"></i> </a> 
   </td>
                        </tr>
                        
                       <?php $no ++; } ?>
                         <?php endif; ?>
                        </tbody>
                        </table>
   </div>
</div>
</div>

