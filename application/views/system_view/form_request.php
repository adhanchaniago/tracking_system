
   <!--  <link rel="stylesheet" href="<?=base_url();?>chosen-master/source/chosen.css" /> -->
    <?=$this->session->flashdata('sukses');?> 
    <br /> 
 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url();?>index.php/system/order/proccess" method="post" >

<span class="y_title"> <i class="fa fa-file-text"></i>  Header Shipment  </span>
 <div class="x_panel line_panel">
 <br />
<!--
  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">No Booking <span class="required"> </span>                        </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="nobooking" placeholder="isikan minus (-) bila no booking tidak ada"  >
  
   </div>
   </div>
    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nomor Polisi<span class="required">*</span>
    </label>
    <div class="col-md-5 col-sm-6 col-xs-12">
       <?php
    $jsArray = "var prdName = new Array();\n";   
    echo "  <select class=\"select2_single\" name=\"nopol\" style=\"width:100%\" onchange=\"changeValue(this.value)\" > ";
      foreach($data as $row): 
     echo " <option value='$row->nopol'>$row->nopol</option>";
	$jsArray .= "prdName['" . $row->nopol . "'] = {box1:'" .addslashes(strtoupper($row->type)). "'};\n"; 
      endforeach; ?>
    </select>
 </div>
  </div>

   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Type<span class="required">*</span>                        </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control" id="type" name="type" readonly required>
  
     </div>
   </div>
   -->
   
 
   

   <!--
 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  Customer<span class="required">*</span>                        </label>
                      
    <div class="col-md-5 col-sm-5 col-xs-10">
          <?php
    $jsArray2 = "var prdName2 = new Array();\n";   
    echo "  <select class=\"select2_single\" name=\"no_cmd\" style=\"width:100%\" onchange=\"changeValue2(this.value)\" > ";
      foreach($customer as $row): 
     echo " <option value='$row->no_cmd'> ".$row->no_cmd." => ".strtoupper($row->customer)." </option>";
	$jsArray2 .= "prdName2['" . $row->no_cmd . "'] = {box1:'" .addslashes(strtoupper($row->customer)). "'};\n"; 
      endforeach; ?>
    </select>    
    <input type="hidden"  class="form-control"  name="customer"  id="customer">
    </div>
    <div class="col-md-1 col-sm-1 col-xs-1">
    <a href="#" data-toggle="modal" data-target="#new_customer" class="btn btn-dark">+</a>
    </div>    
      </div>
      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Paket <span class="required">*</span>                        </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <select class="form-control"  name="paket"  required>
     <option value=""> Pilih </option>
     <option value="ALL IN">ALL IN </option>
     <option value="DAILY">DAILY </option>
     <option value="EKSPEDISI">EKSPEDISI </option>
     <option value="MONTHLY">MONTHLY</option>
     <option value="SELFDRIVE/MONTHLY">SELFDRIVE/MONTHLY</option>
     <option value="OUT TOWN">OUT TOWN</option>
     </select>
  
     </div>
   </div>
    <div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Masa Sewa<span class="required">*</span>  </label>
                      
   <div class="col-md-2 col-sm-2 col-xs-6">                 		
   <input type="text"  class="form-control" id="from" name="startdate"  placeholder="Start Date" required>
      
      </div>
        <div class="col-md-3 col-sm-3 col-xs-6">
                 		
          <input  type="text"  class="form-control" id="to" name="enddate"  placeholder="End Date" required>
      
    </div>
      </div>
-->

   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. PO  <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="nomorpo"   value="<?=$this->session->userdata('nomorpo');?>" required>
  
     </div>
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. Reference <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="noref"   value="<?=$this->session->userdata('noref');?>" required>
  
     </div>
   </div>
   <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No. Resi <span class="required">*</span>      </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	 <input type="text"  class="form-control"  name="resi" value="RES/KIR/HO/<?=$kodeunik?>" readonly required>
  
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
                 		
          <select name="tujuan" class="form-control select2_single" required>
           <option value=""> Pilih </option>
           <?php foreach ($site as $data ) {     		
             if($this->session->userdata('tujuan')==$data->kode_site) {
            echo " <option value=\"$data->kode_site\" selected>".$data->kode_site." => ".$data->keterangan."</option> ";
		   } else {
			echo " <option value=\"$data->kode_site\">".$data->kode_site." => ".$data->keterangan."</option> ";
		     }
			} ?>           
          </select>
       
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
                 		
  <textarea   class="form-control" name="remarks"><?=$this->session->userdata('remarks');?></textarea>
       
        </div>
      </div>
       

 
         

   <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  <span class="required"> </span>
    </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
          <button  class="btn btn-primary btn-round btn-bloc pull-right" name="save" id="button"> KIRIM <i class="fa fa-play-circle"></i></button>
     <button type="reset" class="btn btn-warning btn-round btn-bloc pull-right"><i class="fa fa-chevron-circle-left"></i> RESET </button>
  
        </div>
      </div>
       
  </div>

 </form>
 
  <span class="y_title"> <i class="fa fa-file-text-o"></i>  Detail Barang </span>
 <div class="x_panel line_panel">
 <div class="row">
<h3 class="col-lg-12">  </h3>

  <div class="col-md-4 col-lg-4 col-sm-4">
 
  <div class="panel-body" style="background-color:#efefef">
                <form id="sidebar">
                      <input type="hidden" id="id" name="id" class="form-control" placeholder=""/>
                    <div class="form-group">
                        <label for="nm">Item Barang </label>
                        <input type="text" id="nm" name="nm" class="form-control" placeholder="" required />
                    </div>
                    <div class="form-group">
                       
                        <div class="row">
                        <div class="col-lg-4">
                         <label for="em">Qty</label>
                        <input type="text" id="em" name="em" class="form-control" placeholder="" required onkeypress="return goodchars(event,'0123456789',this)"/>
                        </div>
                        <div class="col-lg-8">
                         <label for="em">Satuan</label>
                        <input type="text" id="sat" name="sat" class="form-control" placeholder="" required />
                        </div>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="nm">Keterangan </label>
                        <input type="text" id="ket" name="ket" class="form-control" placeholder="" required />
                    </div>
                    <button type="button" id="save" class="btn btn-warning" onClick="saveData()"> Add Item </button>
                    <button type="button" id="update" class="btn btn-success" onClick="updateData()">Update</button>
                </form>
                </div>
                <br>
            </div>
 
 <!-- MENAMPILKAN DATA TABEL -->           
<div class="col-lg-8 col-md-8 col-sm-8">
           <div class="records_content"></div>
		   </div>
		   </div>
</div>


<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(kd){  
document.getElementById('type').value = prdName[kd].box1;  
};  
</script> 
<script type="text/javascript">    
<?php echo $jsArray2; ?>  
function changeValue2(kd){  
document.getElementById('customer').value = prdName2[kd].box1;  
};  
</script> 

<script>
   function showDiv(elem){
   if(elem.value =="LAIN-LAIN") {
      document.getElementById('hidden_div1').style.display = "block";
	
} else  {
 document.getElementById('hidden_div1').style.display = "none";
 document.getElementById('hidden_div2').style.display = "block";
  
}
}
</script>
<script>
function sum() {
       var txtFirstNumberValue = document.getElementById('harga').value;
       var txtSecondNumberValue = document.getElementById('jumlah').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;

       var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('total').value = result;
       }
   }
  </script>

<!--
   <script src="<?=base_url();?>chosen-master/source/mootools-yui-compressed.js"></script>
  <script src="<?=base_url();?>chosen-master/demos/mootools-more-1.4.0.1.js"></script>
  <script src="<?=base_url();?>chosen-master/source/chosen.js"></script>
  <script src="<?=base_url();?>chosen-master/source/Locale.en-US.Chosen.js"></script>
  <script> $$(".chzn-select").chosen(); $$(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
  -->
