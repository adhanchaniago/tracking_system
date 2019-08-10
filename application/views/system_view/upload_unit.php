 <br>
  <?=$this->session->flashdata('sukses');?> 
 <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?=base_url();?>index.php/system/unit/do_upload" method="post"  enctype="multipart/form-data">

<span class="y_title"> <i class="fa fa-upload"></i>  Upload Unit </span>
 <div class="x_panel line_panel">
 <br />
 <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Berkas File <span class="required">*</span>                        </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
    <input type="file" name="file" required>
     
     </div>
   </div>
  
   <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">  <span class="required"> </span>
    </label>
                      
     <div class="col-md-5 col-sm-6 col-xs-12">
          <button  class="btn btn-primary btn-round btn-bloc" name="save" id="button"> UPLOAD</button>
     
  
        </div>
      </div>
      
  </div>

</form>
