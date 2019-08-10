<?php foreach ($data as $row): endforeach;?>
   <?=$this->session->flashdata('sukses');?> 
   <br>
<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url();?>index.php/system/dashboard/action_update" method="post" >

<span class="y_title"> <i class="fa fa-user"></i>  Profile </span>
 <div class="x_panel line_panel">
 <br />
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Username </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="username"  readonly="readonly"  value="<?=$row->username;?>" >
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Nama </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="nama"  value="<?=$row->nama;?>" >
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Email </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="email"  class="form-control"  name="email"  value="<?=$row->email;?>" >
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Cabang </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="ket_lain"  value="<?=$row->cabang;?>"  disabled>
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Atas Nama </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="atasnama"  value="<?=$row->atasnama;?>" >
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> Bank </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="bank"  value="<?=$row->bank;?>" >
  
     </div>
   </div>
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> No Rekening </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <input type="text"  class="form-control"  name="norek"  value="<?=$row->norek;?>" >
  
     </div>
   </div>
 
   
   <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name"> </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
                 		
   	  <button type="submit" name="simpan" class="btn btn-primary"> SIMPAN </button>
  
     </div>
   </div>
   

   
   </div>
   </form>