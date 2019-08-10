          <div class="x_panel">
          <div class="x_title">
            <h2> Return Barang </h2>
            
            <div class="clearfix"></div>
          </div>
 <div class="x_content">
   <?=$this->session->flashdata('sukses');?> 
   <br>
<form name="form1" method="get" action="">

  <table width="100%">
  <tr>
    <td width="12%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="46%">
      <div class="form-group input-group" style="margin-top:5px;">
        
        <input type="text" name="nomorpo" class="form-control" required placeholder="Masukan No. PO" value="<?=$this->input->get('nomorpo');?>">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary"> CARI </button>
          </span>
        </div></td>
    <td width="34%"></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php
if(isset($_GET['nomorpo'])) { 
foreach($data as $b) :  endforeach;  

$data1=$this->db->query("SELECT * FROM detailtrack as sub INNER JOIN tbltrack a ON sub.idtrack=a.idtrack WHERE sub.iddetail=(SELECT min(iddetail)  FROM detailtrack WHERE po_number='$b->nomor_po') AND status='2' GROUP BY a.idtrack ORDER BY sub.iddetail DESC ");
  $nox=1;
  if($data1->num_rows() > 0) {
  foreach ($data1->result() as $view1) { 
  
  ?>
	<h4> Nomor Resi : <?=$view1->noresi;?>
     <button onClick="javascript:window.location.href='<?=base_url();?>index.php/system/order/return_barang?nomorpo=<?=$_GET['nomorpo'];?>&resi=<?=$view1->noresi;?>&id=<?=$view1->idtrack;?>'" class="btn btn-warning btn-sm" <?=$disable;?>><i class="fa fa-check-square-o"></i> Pilih</button></h4>
 
<?php  $nox++; }  } else {
	echo "<div class='error'><i class='fa fa-times'></i> Tidak ditemukan data </div>";
} ?> 

 <?php
 if(isset($_GET['nomorpo'])  && isset($_GET['resi']) && isset($_GET['id'])) {
	 
 foreach($data2 as $row) :  endforeach; 	 
	  ?>
<form action="<?=base_url();?>index.php/system/order/form_return" method="post">
<table width="100%" class="table-condense table table-striped table-bordered">
  <tr>
    <td colspan="2" bgcolor="#DADFE1" style="color:#333"> HEADER TEXT </td>
    </tr>
  <tr>
    <td width="19%">No. PO</td>
    <td width="81%"><?=$row->nomor_po;?><input type="hidden" name="nomorpo" value="<?=$row->nomor_po;?>"></td>
  </tr>
  <tr>
    <td>No. Reference</td>
    <td><?=$row->noref;?> <input type="hidden" name="noref" value="<?=$row->noref;?>"></td>
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

<table width="100%" class="table table-condense table-striped table-hove">
  <tr>
    <td colspan="5" bgcolor="#DADFE1" style="color:#333"> RINCINAN BARANG </td>
    </tr>
  <tr style="font-weight:bold">
  <td width="4%">No</td>
    <td width="36%">Item Barang</td>
    <td width="20%">Qty</td>
    <td width="30%">Keterangan</td>
    <td width="10%"><input id="selecctall" type="checkbox">
    Check All</td>
  </tr>
  <?php
  $data=$this->db->query("SELECT * FROM detailtrack  a INNER JOIN tbluser b ON a.iduser=b.iduser WHERE po_number='$row->nomor_po' AND b.kode_site='HO' ORDER BY iddetail ASC");
  $no=1;
  foreach ($data->result() as $view) {
  ?>
  <tr>
    <td><b><?=$no;?></b> </td>
    <td><?=$view->item;?>  </td>
    <td><?=$view->qty;?> <?=$view->satuan;?> </td>
    <td><?=$view->remarks;?>  </td>
    <td><input type="checkbox"  name="iddetail[]" value="<?=$view->iddetail;?>"  class="checkbox1"></td>
  </tr>
  <?php $no++; } ?>
</table>
<br>
<button type="submit" class="btn btn-primary  btn-lg pull-right" name="return"> NEXT <i class="fa fa-arrow-circle-right"></i> </button>
</form>

<?php }  } ?>
</div>
</div>

<script>

	            $(document).ready(function() {

	                resetcheckbox();

	                $('#selecctall').click(function(event) {  //on click

	                    if (this.checked) { // check select status

                       $('.checkbox1').each(function() { //loop through each checkbox

	                            this.checked = true;  //select all checkboxes with class "checkbox1"             

	                        });

	                    } else {

	                        $('.checkbox1').each(function() { //loop through each checkbox

	                            this.checked = false; //deselect all checkboxes with class "checkbox1"                     

	                        });

	                    }

	                });
					
					function  resetcheckbox(){

	                $('input:checkbox').each(function() { //loop through each checkbox

	                this.checked = false; //deselect all checkboxes with class "checkbox1"                     

	                   });

	                }

	            });
			</script>