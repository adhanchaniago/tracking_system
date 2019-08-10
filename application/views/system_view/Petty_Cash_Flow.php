 <div class="x_panel">
  <div class="x_title">
                    <h3 style="background-color:#efefef; padding:5px"> Petty Cash </h3>
   </div>
  <div class="x_content">
<div class="table-responsive">

<table id="example" class="table-condensed table-hover table-striped" width="100%">
                      <thead style="background-color:#fafafa; color:#000;">
                        <tr >
                       
                          <th width="12%" align="right" style="background-color:#003399; color:white;">NAMA</th>
                          <th width="11%"  style="background-color:#33CCCC; color:white">SALDO</th>
                          <th width="11%" style="background-color:#FF9900; color:white;">PENDING CLAIM</th> 
                           <th width="11%" style="background-color:#339966; color:white;">ACTUAL CLAIM</th>                         
                          <th width="11%" style="background-color:#CE2406; color:white;">SISA SALDO</th>
                           <th width="11%" style="background-color:#99CC66; color:white;" >TOTAL REQUEST</th>                         
                          <th width="11%" style="background-color:#3333CC; color:white;">NEXT REQUEST</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php				  
					  $no=1;
					  $total=0;
					  $saldo=0;
					  $now=0;
					  $pending=0;
					  $claim=0;
                      foreach ($data as $row) { 
					  $saldo +=$row->SALDO;
					  $now+=$row->SISASALDO;
					  $pending+=$row->PENDINGCLAIM;
					  $claim+=$row->ACTUALCLAIM;
					  if($row->SISASALDO <=50000 ) {
					  $sisa="<font color='red'> ".rupiah($row->SISASALDO)."";
					  } else {
					  $sisa="<font color='green'> ".rupiah($row->SISASALDO)."";
					  }
					    if($row->REQUEST <=50000 ) {
					  $next="<font color='red'> ".rupiah($row->REQUEST)."";
					  } else {
					  $next="<font color='#000'> ".rupiah($row->REQUEST)."";
					  }
					  ?>  
                      <tr style="text-align:right">                     
                          <td ><?=$row->NAMA_USER;?></td>
                          <td ><?=rupiah($row->SALDO);?></td>
                          <td ><?=rupiah($row->PENDINGCLAIM);?></td> 
                          <td ><?=rupiah($row->ACTUALCLAIM);?></td>                         
                          <td style="font-weight:bold"><?=$sisa;?></td>
                           <td ><?=rupiah($row->total_request);?></td>                         
                          <td style="font-weight:bold"><?=$next;?></td>
                        </tr>
                       <?php $no ++; } ?>
                       
                       </tbody>
                       <tfoot>
                        <tr style="background-color:#efefef; font-size:16px; color:black; font-weight:bold; text-align:right">
                          <td>TOTAL</td>
                          <td><?=rupiah($saldo);?></td>
                          <td><?=rupiah($pending);?></td>
                          <td><?=rupiah($claim);?></td>
                          <td><?=rupiah($now);?></td>
                          <td></td>
                          <td></td>
                        </tr>
                     
                       </tfoot>
                        
                       
                        </table>
                        
                       
   </div>
</div>
</div>

