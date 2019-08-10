<!-- MODAL 2 -->

  <div class="modal-dialog" >
	 <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#3399CC; color:white">
        <button type="button" class="close" data-dismiss="modal"></button>
        <h5 class="modal-title" style="color:white"><b> <i class="fa fa-arrow-circle-right"></i> Finishing Budget </b></h5>
      </div>
	   
      <div class="modal-body">	
	  <p>
        <form action="<?=base_url();?>index.php/system/order/upload_berkas"method="post" enctype="multipart/form-data">
        <input type="hidden" value="<?=$this->uri->segment('4');?>" name="ID">  
        No Booking
        <input type="text" name="no_booking"  value="<?=$this->uri->segment('6');?>" autocomplete="off" class="form-control"required >
        Scan Berkas   
        <input type="file" name="file_upload" required> <font color="#FF0000"> Extension : pdf,doc,xls,docx,jpg,png </font><br>
        Budget BBM
        <input type="text" name="budget_bbm" autocomplete="off" id="textone" onkeyup="sum()" class="form-control"required onkeypress="return goodchars(event,'0123456789',this)">
        Budget Parkir
        <input type="text" name="budget_parkir" autocomplete="off"  id="texttwo" onkeyup="sum()" class="form-control"required onkeypress="return goodchars(event,'0123456789',this)">
        Budget Tol
        <input type="text" name="budget_tol" autocomplete="off"  id="text3" class="form-control"  onkeyup="sum()" required onkeypress="return goodchars(event,'0123456789',this)">
        Budget Lain-lain
        <input type="text" name="budget_lain"  autocomplete="off" id="text4"class="form-control"required onkeyup="sum()" onkeypress="return goodchars(event,'0123456789',this)">
        Keterangan Lain-lain
        <input type="text" name="ket_lain"  class="form-control" value="-" required>
        Actual Budget
        <input type="text" name="jumlah_budget"   id="result" readonly class="form-control"required ><br />
        Request Budget
        <input type="text"  name="request" value="<?=$this->uri->segment('5');?>" readonly id="text5" class="form-control" ><br />        
          Sisa 
        <input type="text"   name="sisa"  id="sisa" readonly class="form-control" ><br />
        
        <button type="submit" class="btn btn-info pull-right" name="upload"> SUBMIT </button>  <button class="btn btn-warning pull-right" onclick="window.history.go(-1); return false;"><i class="fa fa-arrow-left"></i> Back</button><br />
		  </form>
        </p>
	  </div>
      <div class="modal-footer" style="background-color:#efefef;">      </div>
    </div>
<!-- modal Content -->
 </div>

<!-- END MODAL -->
<script>
function sum() {
       var txtFirstNumberValue  = document.getElementById('textone').value;
       var txtSecondNumberValue = document.getElementById('texttwo').value;
	   var txtthreeNumberValue  = document.getElementById('text3').value;
	   var text4			    = document.getElementById('text4').value;
	   var text5			    = document.getElementById('text5').value;
	   var result			    = document.getElementById('result').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;
	   if (txtthreeNumberValue == "")
	   txtthreeNumberValue = 0;
	   if (text4 == "")
	   text4 = 0;
	   if (text5 == "")
	   text5 = 0;

       var result = parseInt(txtFirstNumberValue) +  parseInt(txtSecondNumberValue) +  parseInt(txtthreeNumberValue)  +  parseInt(text4);
       if (!isNaN(result)) {
           document.getElementById('result').value = result;
       }
	   var sisa = parseInt(text5) - parseInt(result);
	    if (!isNaN(sisa)) {
           document.getElementById('sisa').value = sisa;
       }
   }
  </script>
 