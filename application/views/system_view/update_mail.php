  <!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div clas="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Update Mail </h4>
            </div>
             <form action="<?=base_url();?>index.php/system/manage/edit_save" method="post">
            	<div class="modal-body">  
               <?php foreach($unit as $row): endforeach;?>
                 <input type="hidden"  name="idpush" class="form-control"    value="<?=$row->idpush;?>" required/>
                  <div class="form-group">
                    <label for="email">Nama </label>
                    <input type="text"  name="nama" class="form-control"    value="<?=$row->nama;?>" required/>
                </div>
                
               
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"  required class="form-control" value="<?=$row->email;?>"  name="email"/>
                     </div>
                     
                     <div class="form-group">
                    <label for="email">Kode Unit </label>
                    <input type="text"  name="kode" class="form-control"    value="<?=$row->kode_site;?>" required/>
                </div>
         			<div class="form-group">
                    <label for="email">Set Email</label>
                    <input type="text"  required class="form-control" value="<?=$row->setMail;?>"  name="setmail"/>
                    1 = Kirim Barang , 2 = Terima Barang, 3 = Return Barang, 4= Rekap Barang
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