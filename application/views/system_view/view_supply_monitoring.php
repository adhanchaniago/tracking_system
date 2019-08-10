 <div class="x_panel">
                  <div class="x_title">
                    <h2> <i class="fa fa-search-plus"></i> Track Shipment  </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  
 <div class="x_content">
   <?=$this->session->flashdata('sukses');?> 
   <br>
<form name="form1" method="get" action="">

  <div class="row">
<div class="col-xs-12 col-sm-3 col-md-3 col-lg-offset-3">
        <div class="form-group">
          <select name="traceby" class="form-control" required>
            <option value=""> Trace By </option>
            <option value="NOPO">Nomor PO </option>
            <option value="NOREF"> No. Reference </option>
            <option value="NORESI"> No. Resi</option>
            </select>
          </div>
       </div>
        <div class="col-xs-12 col-sm-3 col-md-3">
        <div class="form-group">  
          <input type="text" name="keywoard" class="form-control" required placeholder="Please Enter Keywoard" value="<?=$this->input->get('keywoard');?>">
         </div>
         </div>
          <div class="col-xs-12 col-sm-3 col-md-3">
        <div class="form-group">  
            <button type="submit" class="btn btn-primary"> GO </button>
           
          </div>
          </div>
          </div>
      
</form>
<?php
if(isset($_GET['keywoard'])) { ?>
<?php if(is_array($data)): ?>
 <?php foreach($data as $row) :  endforeach; ?>
	
    <a href="<?=base_url();?>index.php/system/order/export_to_excel?traceby=<?=$this->input->get('traceby');?>&keywoard=<?=$this->input->get('keywoard');?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-excel"></i> Export Excel</a>
  <table width="100%" class="table-condense table table-striped table-bordered">
  <tr>
    <td colspan="2" bgcolor="#95a5a6" style="color:white"> HEADER TEXT </td>
    </tr>
  <tr>
    <td width="19%">No. PO</td>
    <td width="81%"><?=$row->nomor_po;?></td>
  </tr>
  <tr>
    <td>No. Reference</td>
    <td><?=$row->noref;?></td>
  </tr>
  <tr>
    <td>Tujuan </td>
    <td><?=$row->tujuan;?></td>
  </tr>
  <tr>
    <td>Waktu kirim</td>
    <td><?=$row->tglpost;?></td>
  </tr>
  <tr>
    <td>Flag Type</td>
    <td><?=flag($row->flag);?></td>
  </tr>
  <tr>
    <td>Last Position </td>
    <td><?=$row->site;?></td>
  </tr>
  <tr>
    <td>Status </td>
    <td><?=status_kirim($row->status);?></td>
  </tr>
  <tr>
    <td>Remarks</td>
    <td><?=$row->note;?></td>
  </tr>
  </table>

<br>
<div class="table-responsive">
<table width="100%" class="table table-condense table-striped table-hove">
  <tr>
    <td colspan="11" bgcolor="#95a5a6" style="color:white"> RINCINAN DATA </td>
    </tr>
  <tr style="font-weight:bold">
  <td width="3%">No</td>
    <td width="14%">Waktu Update</td>
    <td width="16%">No Resi</td>
    <td width="8%">Vehicle</td>
    <td width="11%">Driver</td>
    <td width="11%">Item Barang</td>
    <td width="5%">Qty</td>
    <td width="12%">Ket.</td>
    <td width="9%">User</td>
    <td width="6%">Unit</td>
    <td width="5%">Status</td>
  </tr>
  <?php
  $data=$this->db->query("SELECT * FROM detailtrack  a INNER JOIN tbluser b ON a.iduser=b.iduser WHERE po_number='$row->nomor_po' ORDER BY iddetail ASC");
  $no=1;
  foreach ($data->result() as $view) {
  ?>
  <tr>
    <td><b><?=$no;?></b></td>
    <td><?=$view->tglupdate;?></td>
    <td><?=$view->noresi;?></td>
    <td><?=$view->vehicle;?></td>
    <td><?=$view->driver;?></td>
    <td><?=$view->item;?></td>
    <td><?=$view->qty;?> <?=$view->satuan;?></td>
    <td><?=$view->remarks;?></td>
    <td><?=strtoupper($view->nama);?></td>
    <td><?=$view->kode_site;?></td>
    <td><?=status($view->stts_kirim);?></td>
  </tr>
  <?php $no++; } ?>
</table>
</div>
	
<?php } ?>

</div>
</div>
