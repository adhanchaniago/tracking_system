  <!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
            </div>
             <form action="<?=base_url();?>index.php/system/manage/new_user" method="post">
            	<div class="modal-body">  
               
                
                <div class="form-group">
                    <label for="email">Nama</label>
                    <input type="text"  name="nama" class="form-control"    required/>
                </div>    
                
                <div class="form-group">
                    <label for="email">Kode Unit</label>
                    <input type="text"  required class="form-control"  name="kode"/>
                     </div>
         		<div class="form-group">
                    <label for="email">Keterangan</label>
                    <input type="text"  required class="form-control"  name="keterangan"/>
                     </div>
                 <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text"  required class="form-control"  name="username"/>
                     </div>
             	<div class="form-group">
                    <label for="email">Password</label>
                    <input type="text"  required class="form-control"  value="123" readonly name="password"/>
                    Password Default : 123 
                </div>
         
         
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit" name="save">Save</button>
            </div>
              </form>
        </div>
    </div>
</div>
<!-- // Modal -->

<?=$this->session->flashdata('sukses');?>  
 <div class="x_panel">
                  <div class="x_title">
                    <h2>  User Data </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">
<!--
  <form  action="" method="post"  class="navbar-form alert"  style="background-color:#EEF8ED; border:1px solid #efefef; color:#;">
 
<div class="form-group">
<b> Periode Report : </b>
</div>
<div class="form-group">
<input type="text" id="from" name="startdate" class="form-control" value="<?=date('Y-m-d', strtotime("-30 days"));?>" readonly>
</div>
<div class="form-group input-group" style="margin-top:5px;">
<input type="text" id="to" name="enddate" class="form-control " value="<?=date('Y-m-d');?>" readonly>
<span class="input-group-btn">
<button type="submit" name="view" class="btn btn-success"> <i class="glyphicon glyphicon-zoom-out"></i> Report </button>

</span>
</div>
<div class="form-group">

</div>
</form>
-->
<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#add_new_record_modal"> <i class="fa fa-plus"></i> Add User </a>

<hr />
<div class="table-responsive">
 <table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>                    
                        
                          <th width="6%">ID</th>
                          <th width="24%">Nama</th>
                          <th width="11%">Kode Unit</th>
                          <th width="32%">Keterangan</th>
                          <th width="17%">Username</th>
                          <th width="10%">Action </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					    if(isset($_POST['view'])) {
					  $data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  WHERE  DATE(a.trxdatetime) >='$_POST[startdate]' AND DATE(a.trxdatetime) <='$_POST[enddate]' AND typetrx='Ganti Sementara' ") or die ("Error Query".$mysqli->error); 
					  } else {
					    //$data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  where typetrx='Ganti Sementara' AND (status!='8' OR status!='5') ORDER BY idtrx DESC") or die ("Error Query".$mysqli->error); 
					  }
					  $no=1;
                      foreach ($unit as $row) { ?>
                        <tr>
                         
                    
                          <td><?=$row->iduser;?></td>
                          <td><?=$row->nama;?></td>
                          <td><?=$row->kode_site;?></td>
                          <td><?=$row->keterangan;?></td>
                           <td><?=strtoupper($row->username);?></td>
                          <td>  <a href="<?=base_url();?>index.php/system/manage/update_user/<?=$row->iduser;?>" class="btn btn-sm btn-warning" title="Update"> <i class="fa fa-edit"></i> </a>  <a href="<?=base_url();?>index.php/system/manage/reset_password/<?=$row->iduser;?>"  onclick="return confirm('ARE YOU SURE RESET PASSWORD?')" class="btn btn-sm btn-success" title="Reset Password"> <i class="fa fa-refresh"></i> </a></td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
   </div>
</div>
</div>