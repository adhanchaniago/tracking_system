    <?=$this->session->flashdata('sukses');?> 
    <br /> 
 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url();?>index.php/system/order/return_process" method="post" >

<span class="y_title"> <i class="fa fa-file-text"></i>  Return Form  </span>
 <div class="x_panel line_panel">
 <br />


   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. PO  <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="nomorpo"   value="R/<?=$this->session->userdata('pettysite');?>/<?=$this->input->post('nomorpo');?>" required>
  
     </div>
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. Reference <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="noref"   value="R/<?=$this->session->userdata('pettysite');?>/<?=$this->input->post('noref');?>" required>
  
     </div>
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. Resi <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="resi" value="RES/KIR/<?=$this->session->userdata('pettysite');?>/<?=$kodeunik?>" readonly required>
  
     </div>
   </div>
 
 
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Vehicle <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="vehicle" value="<?=$this->session->userdata('vehicle');?>" required>
  
     </div>
   </div>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driver <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="namadriver"  value="<?=$this->session->userdata('namadriver');?>" required>
  
     </div>
   </div>     
      

      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Tujuan Utama <span class="required">*</span>
                        </label>
                      
                            <div class="col-md-5 col-sm-6 col-xs-12">
            <!--     		
          <select name="tujuan" class="form-control select2_single" required>
           <option value=""> Pilih </option>
           <?php foreach ($site as $data ) {     		
             if($this->session->userdata('tujuan')==$data->kode_site) {
            echo " <option value=\"$data->kode_site\" selected>".$data->kode_site." => ".$data->keterangan."</option> ";
		   } else {
			echo " <option value=\"$data->kode_site\">".$data->kode_site." => ".$data->keterangan."</option> ";
		     }
			} ?>           
          </select> -->
          <input type="text"  class="form-control"  name="tujuan"  value="HO" readonly>
       
        </div>
      </div>
      
       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Unit Estapet <span class="required">*</span>
                        </label>
                      
                            <div class="col-md-5 col-sm-6 col-xs-12">
                 		
          <select name="estapet" class="form-control select2_single" required>
           <option value=""> Pilih </option>
           <?php foreach ($site as $data ) {     		
		   if($this->session->userdata('estapet')==$data->kode_site) {
            echo " <option value=\"$data->kode_site\" selected>".$data->kode_site." => ".$data->keterangan."</option> ";
		   } else {
			echo " <option value=\"$data->kode_site\">".$data->kode_site." => ".$data->keterangan."</option> ";
		     }
			} ?>           
          </select>
       
        </div>
      </div>
      
  <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Remarks <span class="required"></span>
  </label>
                      
  <div class="col-md-5 col-sm-6 col-xs-12">
                 		
  <textarea   class="form-control" name="note"><?=$this->session->userdata('remarks');?></textarea>
       
      </div>
    </div>

   <hr>
      
      <table width="100%" class="table table-condense table-striped table-hove">
  <tr>
    <td colspan="5" bgcolor="#DADFE1" style="color:#333"> RINCINAN BARANG </td>
    </tr>
  <tr style="font-weight:bold">
  <td width="3%">No</td>
    <td width="32%">Item Barang</td>
    <td width="14%">Qty</td>
    <td width="20%">Satuan</td>
    <td width="31%">Keterangan</td>
    </tr>
  <?php
  $item=$this->input->post('item');
  $remarks=$this->input->post('remarks');
  $satuan=$this->input->post('satuan');
  $iddetail=$this->input->post('iddetail');
  
  $count = count($iddetail);
    $no=1;
  for($i=0;$i<$count;$i++){
	 $sql=$this->db->query("SELECT * FROM detailtrack WHERE iddetail='$iddetail[$i]'");
	 foreach ($sql->result() as $view) : endforeach;
  ?>
  <tr>
    <td><b><?=$no;?></b> <input type="hidden"  name="cekid[]" value="<?=$view->iddetail;?>">  </td>
    <td><?=$view->item;?> <input type="hidden"  name="item" value="<?=$view->item;?>"> </td>
    <td>  <input type="text"  name="qty[]" value=""  placeholder="Qty Return" size="10"required onkeypress="return goodchars(event,'0123456789',this)"></td>
    <td><?=$view->satuan;?><input type="hidden"  name="satuan" value="<?=$view->satuan;?>"></td>
    <td><?=$view->remarks;?> <input type="hidden"  name="remarks" value="<?=$view->remarks;?>"> </td>
    </tr>
    
  <?php  $no++;  } ?>
  
</table>
     <br> <br> 
   <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  <span class="required"> </span>
    </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
     <button  class="btn btn-primary btn-round btn-bloc pull-right" name="save" id="button"> SEND <i class="fa fa-chevron-circle-right"></i></button>
     <button type="reset" class="btn btn-warning btn-round btn-bloc pull-right"><i class="fa fa-refresh"></i> RESET </button>
     <a href="javascript: window.history.go(-1)"  class="btn btn-success btn-round btn-bloc pull-right"><i class="fa fa-chevron-circle-left" ></i> BACK </a>
  
      </div>
    </div>
          
  </div>

 </form>