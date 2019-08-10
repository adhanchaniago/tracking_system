 <div class="x_panel">
                  <div class="x_title">
                    <h2> Terima/kirim Barang </h2>
                    
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
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php
if(isset($_GET['nomorpo'])) { ?> 
<h4> Resi Outstanding dengan No. PO  : <font color="#009933"><?=$_GET['nomorpo'];?></font> </h4>
 <table width="100%" class="table table-condensed table-bordered">
  <tr style="background-color:#efefef">
    <td width="4%">No</td>
    <td width="78%">No. Resi </td>
    <td width="10%">Status</td>
    <td width="8%">Aksi</td>
  </tr>
  <?php
  foreach($data as $b) :  endforeach;  
  
  $data1=$this->db->query("SELECT * FROM detailtrack as sub INNER JOIN tbltrack a ON sub.idtrack=a.idtrack WHERE sub.iddetail=(SELECT max(iddetail)  FROM detailtrack WHERE po_number='$b->nomor_po') AND status!='2' GROUP BY a.idtrack ORDER BY sub.iddetail DESC ");
  $nox=1;
  if($data1->num_rows() > 0) {
  foreach ($data1->result() as $view1) { 
  
  if(($view1->iduser==$this->session->userdata('pettyiduser') && $view1->stts_kirim=='1')) {
	  $disable="disabled";
  } else {	   
	  $disable="";
  }
  ?>
	
     
  <tr>
    <td><?=$nox;?></td>
    <td><b><?=$view1->noresi;?></b></td>
    <td><b> <?=status($view1->stts_kirim);?> </b> </td>
    <td><button onClick="javascript:window.location.href='<?=base_url();?>index.php/system/order/receive_data?nomorpo=<?=$_GET['nomorpo'];?>&resi=<?=$view1->noresi;?>&id=<?=$view1->idtrack;?>'" class="btn btn-warning btn-sm" <?=$disable;?>><i class="fa fa-check-square-o"></i> Pilih</button></td>
  </tr>
<?php  $nox++; }  } else {
	echo "<tr> <td colspan='4'><font color='red'> <h5> <i class='fa fa-times'></i> Tidak Ada Resi Outstanding </h5> </font> </td>";
}?>
</table>
 <?php
 if(isset($_GET['nomorpo'])  && isset($_GET['resi'])) { 
 
     foreach($data2 as $row) :  endforeach; ?>
  
     <h4> Detail Form No. Resi : <?=$_GET['resi'];?> <hr /> </h4>
     
	 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url();?>index.php/system/order/save_terima_barang" method="post" >
       <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. PO  <span class="required"></span> </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
     <input type="hidden"  class="form-control"  name="idtrack"  value="<?=$row->idtrack;?>">   
      <input type="hidden"  class="form-control"  name="iddetail"  value="<?=$row->iddetail;?>">          		
   	 <input type="text"  class="form-control"  name="nomorpo"  value="<?=$row->nomor_po;?>"  readonly >
  
     </div>
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. Resi <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
     <?php if($row->stts_kirim=='1') {  ?>
      <input type="text"  class="form-control"  name="resi"  value="RES/TER/<?=$this->session->userdata('pettysite');?>/<?=substr($row->noresi,-5,5);?>" required>    
	   
	<?php   } else {?>  
    
     <input type="text"  class="form-control"  name="resi"  value="RES/KIR/<?=$this->session->userdata('pettysite');?>/<?=substr($row->noresi,-5,5);?>" required>
        
       <?php } ?>	

     </div>
   </div>
 
 
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Vehicle <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="vehicle"  value="<?=$row->vehicle;?>"required>
  
     </div>
   </div>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driver <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="namadriver" value="<?=$row->driver;?>" required>
  
     </div>
   </div>     
      
 
         <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Tujuan Utama <span class="required"></span>
                        </label>
                      
                            <div class="col-md-5 col-sm-6 col-xs-12">
                 		
          <input  type="text"   class="form-control" name="tujuan" value="<?=$row->tujuan;?>" readonly>
       
        </div>
      </div>
       <?php if($row->stts_kirim=='1') { 
	   
	   echo " <input  type=\"hidden\"   class=\"form-control\" name=\"estapet\" value=\"$row->site\">";
	   
	   } else {?>       
       
           <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Unit Estapet <span class="required">*</span>
           </label>
                      
           <div class="col-md-5 col-sm-6 col-xs-12">
           <select name="estapet" class="form-control select2_single" required>
           <option value=""> Pilih </option>
            <?php foreach ($site as $data ) {     		
          echo " <option value=\"$data->kode_site\">".$data->kode_site." => ".$data->keterangan."</option> ";
			} ?>           
          </select>
       
        </div>
      </div>
      <?php } ?>

  		  <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Remarks <span class="required">*</span>
          </label>                      
          <div class="col-md-5 col-sm-6 col-xs-12">                 		
          <textarea class="form-control" name="remarks" required readonly><?=$row->note;?></textarea>
       
        </div>
      </div>
      
      
  <div class="form-group">
 
  <div class="col-md-7 col-sm-12 col-xs-12 col-lg-offset-2">
<table width="100%" align="center" class=" table-condensed table-striped table-hove">
  <tr>
    <td colspan="4" bgcolor="#FF9933" style="color:white"> DETAIL  </td>
    </tr>
  <tr style="font-weight:bold">
    <td width="43%">Item Barang</td>
    <td width="6%">Qty</td>
    <td width="11%">Satuan</td>
     <td width="40%">Ket</td>
    </tr>
  <?php
  $data=$this->db->query("SELECT * FROM (
    SELECT * FROM detailtrack ORDER BY iddetail DESC 
) sub inner join tbluser as b on sub.iduser=b.iduser where
 idtrack='$row->idtrack' AND noresi='$row->noresi' GROUP BY item
ORDER BY iddetail ASC");
  foreach ($data->result() as $view) {
  ?>
  <tr>
    <td><?=strtoupper($view->item);?> 
     <input type="hidden" value="<?=$view->item;?>"  name="item[]"/>
     <input type="hidden" value="<?=$view->satuan;?>"  name="satuan[]"/>
     <input type="hidden" value="<?=$view->remarks;?>"   name="ket[]" />
     </td>
    <td><b><input type="text" value="<?=$view->qty;?>"  size="2" name="qty[]" required onkeypress="return goodchars(event,'0123456789',this)"/></b></td>
    <td><?=$view->satuan;?></td>
    <td><?=$view->remarks;?></td>
    </tr>
  <?php } ?>
</table>
</div>
</div>
<br />
      
       <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  <span class="required"> </span>
    </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
     <?php if($row->stts_kirim=='1') {?>
     <input  type="hidden"   class="form-control" name="status" value="0">
    <button  class="btn btn-primary btn-round btn-bloc pull-right" name="save" id="button">  TERIMA <i class="fa fa-check-square-o"></i></button>  
    <?php  } else { ?>
    <input  type="hidden"   class="form-control" name="status" value="1">
    <button  class="btn btn-warning btn-round btn-bloc pull-right" name="save" id="button">  KIRIM <i class="fa fa-check-square-o"></i></button>
    <?php } ?> 
        </div>
      </div>
     </form>
     
     
	
<?php } } ?>

</div>
</div>
