  <!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div clas="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Update User </h4>
            </div>
             <form action="<?=base_url();?>index.php/system/manage/edit_save_user" method="post">
            	<div class="modal-body">  
               <?php foreach($unit as $row): endforeach;?>
                <input type="hidden"  name="iduser" class="form-control"    value="<?=$row->iduser;?>" />
                 <div class="form-group">
                    <label for="email">Nama</label>
                    <input type="text"  name="nama" class="form-control"    value="<?=$row->nama;?>" required/>
                </div>    
                
                <div class="form-group">
                    <label for="email">Kode Unit</label>
                    <input type="text"  required class="form-control"  value="<?=$row->kode_site;?>" name="kode" readonly />
                     </div>
         		<div class="form-group">
                    <label for="email">Keterangan</label>
                    <input type="text"  required class="form-control"  value="<?=$row->keterangan;?>" name="keterangan"/>
                     </div>
                 <div class="form-group">
                    <label for="email">Username</label>
                    <input type="text"  required class="form-control" value="<?=$row->username;?>"  name="username"/>
                     </div>
             	<div class="form-group">
                    <label for="email">Password</label>
                    <input type="text"  required class="form-control"  value="123" disabled name="password"/>
                    Password Default : 123 
                </div>
               
              
            </div>
            
            <div class="modal-footer">               
                <button  class="btn btn-primary"  name="update" type="submit">Save</button>
            </div>
              </form>
        </div>
    </div>
</div>
<!-- // Modal -->