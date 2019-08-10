<script type="text/javascript">
function selectElementContents(el) {
    var body = document.body, range, sel;
    if (document.createRange && window.getSelection) {
        range = document.createRange();
        sel = window.getSelection();
        sel.removeAllRanges();
        try {
            range.selectNodeContents(el);
            sel.addRange(range);
        } catch (e) {
            range.selectNode(el);
            sel.addRange(range);
        }
    } else if (body.createTextRange) {
        range = body.createTextRange();
        range.moveToElementText(el);
        range.select();
    }
}
</script>  
 <div class="x_panel">
                  <div class="x_title">
                    <h2>  History Report All Request </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">

  <form  action="" method="get"  class="navbar-form alert"  style="background-color:#EEF8ED; border:1px solid #efefef; color:#;">
 
<div class="form-group">
<b> Periode Report : </b>
</div>
<div class="form-group">
<select name="get_user" class="form-control" required>
<option value="">Pilih</option>
<?php foreach($users as $view) {
echo "<option value='$view->id_user'>$view->nama</option>";
}
?>
</select>
</div>

<div class="form-group">
<input type="text" id="from" name="startdate" class="form-control" value="<?=date('Y-m-d', strtotime("-7 days"));?>" readonly>
</div>
<div class="form-group input-group" style="margin-top:5px;">
<input type="text" id="to" name="enddate" class="form-control " value="<?=date('Y-m-d');?>" readonly>
<span class="input-group-btn">
<button type="submit"  class="btn btn-success"> <i class="glyphicon glyphicon-zoom-out"></i> Report </button>

</span>
</div>
<div class="form-group">

</div>
</form>
 <span onclick="selectElementContents( document.getElementById('tableId') );" class="btn btn-sm btn-warning pull-right" ><i class="fa fa-copy"></i> Copy  Data </span>
    <div class="clearfix"></div>
<div class="table-responsive">

<?php
					    if(!isset($_GET['startdate'])) { 
						echo " <div class='error'> Masukan periode tanggal untuk melihat history data </div>";
						 } else {
						?>
 <table id="tableId" class="table  example1 table-striped table-condense table-bordere  table-hover" width="100%" style="font-size:11px">
                      <thead>
                        <tr>
                       
                          <th width="9%">Tanggal</th>
                          <th width="11%">Booking</th> 
                          <th width="10%">Nopol</th>                         
                          <th width="11%">Driver</th>
                          <th width="11%">CMD</th>
                          <th width="11%">Customer</th>
                          <th width="11%">Start</th>
                          <th width="11%">End</th>
                          <th width="11%">Request</th>
                          <th width="11%">Bbm</th>
                          <th width="11%">Tol</th>
                          <th width="11%">Parkir</th>
                          <th width="11%">Lain</th>
                          <th width="11%">Ket</th>
                          <th width="11%">Actual </th>
                          <th width="12%">User</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php				  
					  $no=1;
					  $total=0;
					  $grand=0;
                      foreach ($data as $row) { 
					  $total=$row->jumlah - $row->jumlah_selesai;
					  $grand+=$row->jumlah_selesai;
					  ?>
                    
                      
                        <tr>
                         
                          <td><?=$row->tglrequest;?></td>
                          <td> <?=$row->no_booking;?></td> 
                          <td><?=$row->nopol;?></td>                         
                          <td><?=strtoupper($row->driver);?></td>
                          <td><?=$row->cmd;?></td>
                          <td><?=$row->customer;?></td>
                          <td><?=$row->startdate;?></td>
                          <td><?=$row->enddate;?></td>
                          <td><?=rupiah($row->jumlah);?></td>
                          <td><?=rupiah($row->budget_bbm);?></td>
                          <td><?=rupiah($row->budget_tol);?></td>
                          <td><?=rupiah($row->budget_parkir);?></td>
                          <td><?=rupiah($row->budget_lain);?></td>
                          <td><?=$row->ket_lain;?></td>
                          <td><?=rupiah($row->jumlah_selesai);?></td>
                          <td><?=$row->username;?></td>
                        </tr>
                        
                       <?php $no ++; } ?>
                       <tfoot>
                         <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>TOTAL</td>
                          <td colspan="2" align="left"><b> Rp. <?=rupiah($grand);?> </b> </td>
                         
                        </tr>
                        </tfoot>
                        </tbody>
                        </table>
                        
      <?php } ?>
   </div>
</div>
</div>