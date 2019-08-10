

 <div class="x_panel">
                  <div class="x_title">
                    <h2> Pending Budget Penyelesaian </h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <!-- <li><a class="btn-sm btn btn-default" data-toggle="collapse" data-parent="#accordion"  href="#gg"><i class="fa fa-plus"></i> Add Data</a></li>  -->
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
 <div class="x_content">

<div class="table-responsive">
 <table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>                    
                        
                          <th width="10%">Nama</th>
                          <th width="26%">Jumlah </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					
					  $no=1;
                      foreach ($pending as $row) { ?>
                        <tr>
                         
                    
                          <td><?=$row->nama;?></td>
                           <td><?=rupiah($row->saldo_outstanding);?></td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
   </div>
</div>
</div>