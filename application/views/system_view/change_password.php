
<div class="col-lg-12">
<h4> <i class="fa fa-lock"></i> Change password</h4><hr />
   <?=$this->session->flashdata('sukses');?> 
<form action="<?=base_url();?>index.php/system/dashboard/process_change_password" method="post">
  <table  border="0" cellpadding="4" width="100%">
    
    <tr>
      <td width="302"></td>
    </tr>
    
    <tr>
      <td><label> Password Lama </label></td>
    </tr>
    <tr>
      <td><input name="oldPass" type="password"  id="textfield6" class="form-control "required/></td>
    </tr>
    <tr>
      <td><label> Password Baru</label></td>
    </tr>
    <tr>
      <td><input name="newPass1" type="password"  id="textfield7"  class="form-control"required/></td>
    </tr>
    <tr>
      <td><label>Ulangi Password Baru</label></td>
    </tr>
    <tr>
      <td><input name="newPass2" type="password" id="textfield8"class="form-control "required /></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><label>
      <button type="submit" name="changepassword" class="btn  btn-primary "> Update</button>
      </label></td>
    </tr>
  </table>
  
</form>
</div>
