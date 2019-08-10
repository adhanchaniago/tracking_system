
 <div class="panel-body">
 <?=$this->session->flashdata('sukses');
 $datestring=''.date('Y-m').' first day of last month';
 $dt=date_create($datestring);

 ?> 
 <br>
   <div clas="x_title">
  
           <h1 class="pull-left">  Budget Controlling  </h1>           
               <?php if($this->session->userdata('pettylevel') =='kasir') { ?> 
                <div class="pull-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#b"> <i class="fa fa-arrow-circle-left"></i> Top Up </button>  
                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#c">  Withdraw  <i class="fa fa-arrow-circle-right"></i></button>  
                </div>
                <?php } ?>
                <div class="clearfix"></div>
                
                <br>
                
         <div class="row">
         <?php foreach($saldo as $row) : ?>
        <div class="col-md-4 col-xs-12">
        	<a class="info-tiles tiles-<?=$row->bg;?> has-footer" href="#">
			    <div class="tiles-heading">
			        <div class="pull-left"><?=$row->nama;?></div>
			        <div class="pull-right">
			        	<div id="tilerevenues" class="sparkline-block"><canvas width="40" height="13" style="display: inline-block; width: 40px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"> <?=rupiah($row->saldo_outstanding);?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left"></div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
    	</div>    
        
       <?php  endforeach; ?>
    

</div>
</div>



<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="b" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Top Up Saldo </h4>
            </div>
             <form action="<?=base_url();?>index.php/system/saldo/top_up" method="post">
            	<div class="modal-body">  
               
                
                <div class="form-group">
                    <label for="email">Nama User </label>
                    <?php

    echo "  <select class=\"select2_single\" name=\"iduser\" style=\"width:100%\" > ";
      foreach($users as $row): 
     echo " <option value='$row->id_user'>$row->nama</option>";
	
      endforeach; ?>
    </select>
                </div>
                
               
                
                <div class="form-group">
                    <label for="email"> Jumlah </label>
                    <input type="text"  required class="form-control" onkeypress="return goodchars(event,'0123456789',this)"   name="jumlah"/>
                     </div>
                     
                     <div class="form-group">
                    <label for="email">Remarks</label>
                    <input type="text"  required class="form-control"  name="remarks"/>
                     </div>
         
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button  class="btn btn-info" type="submit" name="save">Top Up </button>
            </div>
              </form>
        </div>
    </div>
</div>
<!-- // Modal -->

  <!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="c" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Withdraw Saldo </h4>
            </div>
             <form action="<?=base_url();?>index.php/system/saldo/withdraw" method="post">
            	<div class="modal-body">  
               
                   <div class="form-group">
                    <label for="email">Nama User </label>
                    <?php

    echo "  <select class=\"select2_single\" name=\"iduser\" style=\"width:100%\" > ";
      foreach($users as $row): 
     echo " <option value='$row->id_user'>$row->nama</option>";
	
      endforeach; ?>
    </select>
                </div>
                
                
                <div class="form-group">
                    <label for="email">Jumlah </label>
                    <input type="text"  name="jumlah" class="form-control"  onkeypress="return goodchars(event,'0123456789',this)"  required/>
                </div>
                
               
                
                <div class="form-group">
                    <label for="email">Remarks</label>
                    <input type="text"  required class="form-control"  name="remarks"/>
                     </div>
         
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button  class="btn btn-danger" type="submit" name="save">Proccess</button>
            </div>
              </form>
        </div>
    </div>
</div>
<!-- // Modal -->

<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(kd){  
document.getElementById('saldo').value = prdName[kd].box1;  
};  
</script> 