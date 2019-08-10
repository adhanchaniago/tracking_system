  <?php
 $datestring=''.date('Y-m').' first day of last month';
 $dt=date_create($datestring);

 ?> 
 <script type="text/javascript">
   $(document).ready(function () {
			var chart = new CanvasJS.Chart("chart", {
			 theme: "theme2",
				title: {
					text: "Status Outstanding Request Budget",
					fontFamily: "verdana",					
					fontSize:"16"
				},
				axisY: {
					
					gridColor: "white"
				},
				 axisX:{
   labelFontSize: 11,
 },
				dataPointWidth: 80,
				data: [{
					type: "column",
					indexLabelLineThickness: 7,
					dataPoints: <?php 

  $data_points1 = array();
    
 /*  if(isset($_POST['submit'])) {
$query1=$mysqli->query("SELECT 
 status,
  count(*) as jumlah
FROM
  trx_notif WHERE  status!='5' AND status!='6' and status!='8' AND YEAR(trxdatetime)='".$_POST['tahun']."' and MONTH(trxdatetime)='".$_POST['bulan']."'  group by status;"); 
  } 
  else {
  
 $query1=$mysqli->query("SELECT status, count(*) as jumlah FROM trx_notif WHERE status !='5' and status!='6' and status!='8' group by status;");
  } */
    
    foreach($chart_pending as $row1 )
    {        
        $point1 = array("label" => status_chart($row1->status) , "y" => $row1->jumlah);
        
        array_push($data_points1, $point1);        
    }
    
    echo json_encode($data_points1, JSON_NUMERIC_CHECK);


?>
				}]
			});
			chart.render();
		 
        });
	
    </script>
 
 <script type="text/javascript">
   $(document).ready(function () {
			var chart = new CanvasJS.Chart("chartContainer", {
			 theme: "theme2",
				title: {
					text: "Total Pemakaian Biaya Operasional",
					fontFamily: "verdana",					
					fontSize:"16"
				},
				axisY: {
					
					gridColor: "white"
				},
				 axisX:{
   labelFontSize: 11,
 },
				dataPointWidth: 80,
				data: [{
					type: "column",
					indexLabelLineThickness: 7,
					dataPoints: <?php 

  $data_points1 = array();
    
 /*  if(isset($_POST['submit'])) {
$query1=$mysqli->query("SELECT 
 status,
  count(*) as jumlah
FROM
  trx_notif WHERE  status!='5' AND status!='6' and status!='8' AND YEAR(trxdatetime)='".$_POST['tahun']."' and MONTH(trxdatetime)='".$_POST['bulan']."'  group by status;"); 
  } 
  else {
  
 $query1=$mysqli->query("SELECT status, count(*) as jumlah FROM trx_notif WHERE status !='5' and status!='6' and status!='8' group by status;");
  } */
    
    foreach($chart_user as $row1 ): endforeach;
            
        $point1 = array("label" => 'BBM' , "y" => $row1->bbm);
		$point2 = array("label" => 'PARKIR' , "y" => $row1->parkir);
		$point3 = array("label" => 'TOL' , "y" => $row1->tol);
		$point4 = array("label" => 'LAIN-LAIN' , "y" => $row1->lain_lain);
        
        array_push($data_points1, $point1,$point2,$point3,$point4);        
    
    
    echo json_encode($data_points1, JSON_NUMERIC_CHECK);


?>
				}]
			});
			chart.render();
		 
        });
	
    </script>
    

<script type="text/javascript">
   $(document).ready(function () {
			var chart = new CanvasJS.Chart("chartContainer2", {
			 theme: "theme2",
				title: {
					text: "History All Request Budget ",
					fontFamily: "verdana",					
					fontSize:"16"
				},
				axisY: {
					
					gridColor: "white"
				},
				 axisX:{
   labelFontSize: 11,
 },
				dataPointWidth: 80,
				data: [{
					type: "column",
					indexLabelLineThickness: 7,
					dataPoints: <?php 

  $data_points = array();
    
 /*  if(isset($_POST['submit'])) {
$query=$mysqli->query("SELECT 
 namaReq,
  count(*) as jumlah
FROM
  trx_notif WHERE  YEAR(trxdatetime)='".$_POST['tahun']."' and MONTH(trxdatetime)='".$_POST['bulan']."' AND status='5'  group by namaReq;");
  }
  else {
 $query=$mysqli->query("SELECT 
 namaReq,
  count(*) as jumlah
FROM
  trx_notif where  status='5' group by namaReq;");
  }
    */
   foreach($chart_sepo as $row2 )
    {        
        $point = array("label" => $row2->nama , "y" => $row2->jumlah);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);

?>
				}]
			});
			chart.render();
		 
        });
	
    </script>
  
  <div style="padding:3px 10px; font-size:24px; border-bottom:1px solid #efefef; margin-bottom:15px"> Dashboard 
</div>
 <form class="pull-right col-xs-12" method="get" action="">
 <div class="form-inline">
<small>Filter</small>
<select name="month" class="form-control input-sm">
<?php
$bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
for($y=1;$y<=12;$y++){
if($y==date("m")){ $pilih="selected";}
else {$pilih="";}
echo("<option value=\"$y\" $pilih>$bulan[$y]</option>"."\n");
}
?>
</select>
<select name="year" class="form-control input-sm">
<?php
// untuk tahun sama saja seperti membuat tanggal
// lakukan dengan perulangan biasa
// mulai dari tahun berapa(1995) sampai dengan tahun berapa(2016)
$no=date('Y');
for($i=2017;$i<=$no;$i++){
echo "<option value=$i> $i </option>";
}
?>
</select>

 <button type="submit"  class="btn btn-sm btn-default" style="margin-top:5px"><i class="fa fa-search"></i></button>
 </div>
 </form>

<br />
<br />
<br />
<div class="clearfix"></div>

<div class="row">

 <?php if($this->session->userdata('pettylevel') =='rmo') { ?> 
        <div class="col-md-4 col-xs-12">
        	<a class="info-tiles tiles-vimeo has-footer" href="#">
			    <div class="tiles-heading">
			        <div class="pull-left">Saldo Anda</div>
			        <div class="pull-right">
			        	<div id="tilerevenues" class="sparkline-block"><canvas width="40" height="13" style="display: inline-block; width: 40px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php foreach($saldo as $row) : endforeach;
echo rupiah($row->saldo_outstanding);?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left"></div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
    	</div>    
        
         <div class="col-md-4 col-xs-12">
        	<a class="info-tiles tiles-warning has-footer" href="#">
			    <div class="tiles-heading">
			        <div class="pull-left">  NEXT REQUEST </div>
			        <div class="pull-right">
			        	<div id="tilerevenues" class="sparkline-block"><canvas width="40" height="13" style="display: inline-block; width: 40px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php foreach($sisasaldo as $data) : endforeach;
echo rupiah($data->REQUEST);?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left"></div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
    	</div>    
        
        <?php } ?>
         <?php if($this->session->userdata('pettylevel') !='rmo') { ?> 
        <div class="col-md-4 col-xs-12">
        	<a class="info-tiles tiles-warning has-footer" href="<?=base_url();?>index.php/system/saldo/pending">
			    <div class="tiles-heading">
			        <div class="pull-left">Saldo Admin</div>
			        <div class="pull-right">
			        	<div id="tiletickets" class="sparkline-block"><canvas width="13" height="13" style="display: inline-block; width: 13px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php foreach($outstanding as $data) : endforeach;
echo rupiah($data->amount);?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left"></div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
    	</div>

        <div class="col-md-4 col-xs-12">
        	<a class="info-tiles tiles-info has-footer" href="<?=base_url();?>index.php/system/saldo/actual_last_month/<?=$dt->format('Y-m');?>">
			    <div class="tiles-heading">
			        <div class="pull-left"> Last Month</div>
			        <div class="pull-right">
			        	<div id="tilemembers" class="sparkline-block"><canvas width="39" height="13" style="display: inline-block; width: 39px; height: 13px; vertical-align: top;"></canvas></div>
			        </div>
			    </div>
			    <div class="tiles-body">
			        <div class="text-center"><?php foreach($actual as $saldo) : endforeach;
echo rupiah($saldo->budget_actual);?></div>
			    </div>
			    <div class="tiles-footer">
			    	<div class="pull-left"></div>
			    	<div class="pull-right percent-change"></div>
			    </div>
			</a>
    	</div>
        <?php } ?>
	</div>
    


<div class="clearfix"></div>

 <div class="panel panel-default" styl="border-left:3px solid #339933">
 <div class="panel-body">
  <div clas="table-responsive">
 <div id="chart" style=" height: 380px;"></div> 
</div>
</div>
</div>


 <div class="panel panel-default" styl="border-left:3px solid #339933">
 <div class="panel-body">
  <div clas="table-responsive">
 <div id="chartContainer" style=" height: 380px;"></div> 
</div>
</div>
</div>

 <div class="panel panel-default" styl="border-left:3px solid #660099">
 <div class="panel-body">
 <div clas="table-responsive">
 <div id="chartContainer2" style=" height: 380px;"></div> 
</div>
</div>
</div>

   
 <?php if($this->session->userdata('pettylevel') !='rmo') { ?> 
 <div class="x_panel">
                  <div class="x_title">
                    <h2> Outstanding Request </h2>
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
<a href="" class="btn btn-warning">  All  </a>
</span>
</div>
<div class="form-group">

</div>
</form>
-->
<div class="table-responsive">
 <table id="example" class="table table-striped table-condensed table-bordere table-hover" width="100%">
                      <thead>
                        <tr>
                       
                          <th width="7%">Tanggal</th>
                          <th width="7%">Nopol</th>                         
                          <th width="18%">Customer</th>
                          <th width="11%">Driver</th>
                          <th width="8%">Start </th>
                          <th width="9%"> End</th>
                          <th width="7%">Day</th>
                          <th width="10%">Jumlah</th>
                          <th width="10%">User </th>
                          <th width="8%">Status</th>
                         <th width="5%"> </th>                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  
					 
					    //$data=$mysqli->query("SELECT *,DATEDIFF(end,start) as day FROM trx_notif as a  where typetrx='Ganti Sementara' AND (status!='8' OR status!='5') ORDER BY idtrx DESC") or die ("Error Query".$mysqli->error); 
					  
					  $no=1;
                      foreach ($data_pending as $display) { ?>
                        <tr>
                         
                          <td><?=$display->tglrequest;?></td>
                          <td><?=$display->nopol;?></td>                         
                          <td><?=$display->customer;?></td>
                          <td><?=$display->driver;?></td>
                          <td><?=$display->startdate;?></td>
                          <td><?=$display->enddate;?></td>
                          <td><?=$display->leadtime;?></td>
                          <td><?=rupiah($display->jumlah);?></td>
                          <td><?=$display->username;?></td>
                          <td><?=status($display->status);?></td>
                        <td> <a href="<?=base_url();?>index.php/system/order/detail_purchase_order/<?=md5($display->idclaim);?>" class="btn btn-sm btn-default" title="Detail Request"> <i class="fa fa-search"></i> </a> </td>
                        </tr>
                       <?php $no ++; } ?>
                        </tbody>
                        </table>
                        
                       
                        
   </div>
</div>
</div>
<?php } ?>


  <!-- Chart Scripts -->
    <script src="<?=base_url();?>js/canvasjs.min.js"></script>