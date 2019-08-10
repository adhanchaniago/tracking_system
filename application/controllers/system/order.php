<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Order extends CI_Controller {
public function __construct() {
error_reporting(0);
 	    parent::__construct();
       $this->load->library(array('session','pagination','PHPMailerAutoload','PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('url','mylibrary','download');
		$this->load->model(array('model_unit','model_order','model_manage','model_saldo'));
    	
 }
	public function index()
	{
		
		$data['breadcrumb']="";
		$data['main']='system_view/dashboard';
		$this->load->view('system_view/front_layout',$data);
	}

	public function kirim_barang()
	{	
		$data['breadcrumb']="Shipment Form";
	    $data['site']=$this->model_order->get_All_Site();
		$data['kodeunik']=$this->model_order->getkodeunik();
		$data['main']='system_view/form_request';
		$this->load->view('system_view/front_layout',$data);
	}	
	
	public function view_status()
	{	
		$data['breadcrumb']="Outstanding Shipment";
		$data['data']=$this->model_order->get_allrequest_by_site();
		$data['main']='system_view/request_data';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function return_barang()
	{	
		$data['breadcrumb']="Return Barang";
		$b=$this->input->get('nomorpo');
		$c=$this->input->get('id');
		$d=$this->input->get('resi');		
		if(isset($b) ) {
		$data['data']=$this->model_order->search_document_by_return($b);
			$data['data2']=$this->model_order->search_detail_document($c,$d);
		}
		
		$data['main']='system_view/return_barang';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function form_return()
	{	
		$data['breadcrumb']="Return Form";
		$b=$this->input->get('nomorpo');		
		$data['site']=$this->model_order->get_All_Site();
		$data['kodeunik']=$this->model_order->getkodeunik();
		if(isset($b) ) {
		$data['data']=$this->model_order->search_document_by_return($b);
	
		}
		
		$data['main']='system_view/form_return_barang';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function history()
	{	
		$data['breadcrumb']="History All Shipment";
		$a=$this->input->get('from');
	  $b=$this->input->get('to');
		$c=$this->input->get('shipment');
		$d=$this->input->get('state');
		$data['site']=$this->model_order->get_All_Site();
		$data['data']=$this->model_order->Model_History_Report($a,$b,$c,$d);
		$data['main']='system_view/history_pengiriman';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function supply()
	{	
		error_reporting(0);
		$data['breadcrumb']="Track Shipment";
		$b=$this->input->get('keywoard');
		$c=$this->input->get('traceby');
		if(isset($b)) {
		$data['data']=$this->model_order->trace_data1($c,$b);
		} 
		$data['main']='system_view/view_supply_monitoring';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function receive_data()
	{	
		error_reporting(0);
		$data['breadcrumb']="Receive/Send Shipment";
		$b=$this->input->get('nomorpo');
		$c=$this->input->get('id');
		$d=$this->input->get('resi');
		if(isset($b) ) {
		$data['data']=$this->model_order->search_document($b);
		$data['data2']=$this->model_order->search_detail_document($c,$d);
		$data['site']=$this->model_order->get_All_Site();
		$data['kodeunik']=$this->model_order->getkodeunik();
		}
		$data['main']='system_view/view_receive';
		$this->load->view('system_view/front_layout',$data);
	}
	
	
	
	public function cetak_surat_jalan()
	{	
		$b=$this->input->get('nomorpo');
		$c=$this->input->get('id');
		$data['data']=$this->model_order->trace_data2($b,$c);
		//$data['main']='system_view/pending_approval';
		$this->load->view('system_view/cetak_surat_jalan',$data);
	}
	
	public function completed($a)
	{	
					$data = array(					
					'status' => '3'
					);
					//Transfering data to table Request PO
					$id['idtrack'] = $a;  
					$save=$this->model_order->update_header_text($data,$id);
					if($save==true) {
					redirect('index.php/system/order/view_status');	
					} else {
						echo " Error";
					}
	}
	
	
public function export_to_excel()
	{	
	
	$b=$this->input->get('keywoard');
	$c=$this->input->get('traceby');
	//error_reporting(0);
	header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=REKAP_HISTORY_".$b.".xls");
	echo'
	<center> <h3> TRACKING SHIPMENT BARANG  '.$b.' </h3> </center>';
	
foreach($this->model_order->trace_data1($c,$b) as $row) :  endforeach;
	
	echo '<table width="100%" class="table-condense table table-striped table-bordered">
  <tr>
    <td colspan="2" bgcolor="#003366" style="color:white"> HEADER DATA </td>
    </tr>
  <tr>
    <td width="19%">No. PO</td>
    <td width="81%">: '.$row->nomor_po.'</td>
  </tr>
   <tr>
    <td>No. Reference </td>
    <td>: '.$row->noref.'</td>
  </tr>
  <tr>
    <td>Tujuan </td>
    <td>: '.$row->tujuan.'</td>
  </tr>
  <tr>
    <td>Waktu kirim</td>
    <td>: '.$row->tglpost.'</td>
  </tr>
  <tr>
    <td>Last Position </td>
    <td>: '.$row->site.'</td>
  </tr>
  <tr>
    <td>Status </td>
    <td>: '.status_kirim($row->status).'</td>
  </tr>
  <tr>
    <td> &nbsp; </td>
    <td></td>
  </tr>
</table>';
	
	echo'
	<table width="100%" class="table table-condense table-striped table-hove" border="1">
 
  <tr style="font-weight:bold; background-color:#003366;color:white">
  <td width="3%">No</td>
    <td width="14%">Waktu Update</td>
    <td width="16%">No Resi</td>
    <td width="8%">Vehicle</td>
    <td width="11%">Driver</td>
    <td width="11%">Item Barang</td>
    <td width="5%">Qty</td>
    <td width="12%">Remarks</td>
    <td width="9%">User</td>
    <td width="6%">Unit</td>
    <td width="5%">Status</td>
  </tr>';

  $data2=$this->db->query("SELECT * FROM detailtrack  a INNER JOIN tbluser b ON a.iduser=b.iduser WHERE po_number='$row->nomor_po' ORDER BY iddetail ASC");
  $no=1;
  foreach ($data2->result() as $view) {

  echo '
  <tr>
    <td><b>'.$no.'</b></td>
    <td>'.$view->tglupdate.'</td>
    <td>'.$view->noresi.'</td>
    <td>'.$view->vehicle.'</td>
    <td>'.$view->driver.'</td>
    <td>'.$view->item.'</td>
    <td>'.$view->qty.' '.$view->satuan.'</td>
    <td>'.$view->remarks.'</td>
    <td>'.strtoupper($view->nama).'</td>
    <td>'.$view->kode_site.'</td>
    <td>'.status($view->stts_kirim).'</td>
  </tr>';
$no++; } 
echo '</table>';
	}
	
public function export_history()
	{	
	    $a=$this->input->get('from');
	    $b=$this->input->get('to');
		  $c=$this->input->get('shipment');
		  $d=$this->input->get('state');	
		  $sql=$this->model_order->Model_History_Report($a,$b,$c,$d);
	//error_reporting(0);
	header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=REKAP_HISTORY_PENGIRIMAN_BARANG.xls");
	
				echo'<center> <h3> HISTORY REKAP PENGIRIMAN BARANG  DATA '.$c.' PERIODE '.$a.' - '.$b.'</h3> </center>';	
				echo'  	<table width="100%" class="table table-condense table-striped table-hove" border="1">
 
  						<tr style="font-weight:bold; background-color:#003366;color:white">
  						  <th width="12%">Tanggal</th>
                          <th width="10%">No. PO</th>
                          <th width="12%">No. Ref</th>
                          <th width="12%">No. Resi</th>
                          <th width="10%">Tujuan </th>
                          <th width="7%">Estapet</th>
                          <th width="9%">Vehicle</th>
                          <th width="11%">Driver</th>
                          <th width="11%">Remarks</th>
                          <th width="7%">Status </th> 
                          <th width="7%">Detail Barang </th> 

                         
  						</tr>';


  $no=1;
  
  foreach ($sql as $row) {

  echo    '<tr>
        	<td>'.$row->tglpost.'</td>
				  <td>'.$row->nomor_po.'</td>
				  <td>'.$row->noref.'</td>
				  <td>'.$row->noresi.'</td>
				  <td>'.$row->tujuan.'</td>
				  <td>'.$row->site.'</td>
				  <td>'.$row->vehicle.'</td>
				  <td>'.strtoupper($row->driver).'</td>
           <td>'.$row->note.'</td>
				  <td>'.status_kirim($row->status).'</td>
           <td>'.$row->barang.'</td>
         
				  </tr>';
				  $no++; } 

  echo 		'</table>';
	
	}
		
public function history_report()
	{			
		$data['users']= $this->model_saldo->get_user();
		$data['data']=$this->model_order->get_all_history();
		$data['main']='system_view/history_report';
		$this->load->view('system_view/front_layout',$data);
	}
	
	
	


public function get_temp() {
	
	$datas=$this->model_order->get_alltemp($this->session->userdata('iduser'));
	 // Design initial table header 
    $data = '
	<div class="table-responsive">
	<table class=" table-condensed table"  id="example"  width="100%">
						<thead>
                        <tr>
                           
                            <th>Nama </th>
                            
                            <th>Jumlah</th>
							<th>Ket.</th>
                          
                            <th>Hapus</th>
                      <tbody>' ;
 
 
 
    if (!$datas) {
       // exit($mysqli->error);
    }
 
    // if query results contains rows then featch those rows 
    if($datas > 0)
    {
        $number = 1;
         foreach ($datas as $row) 
        {
		 
		 // $subtotal=$row->harga * $row->jumlah;
            $data .= '<tr>
               
                <td>'.$row->barang.'</td>
				 
                <td>'.$row->jumlah.'</td>
                <td>'.$row->descript.'</td>
					
               
                <td>
				   
                    <a href="#" onclick="DeleteUser('.$row->idtemp.')" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                </td>
            </tr>';
            $number++;
        }
    }
    else
    {
        // records now found 
        $data .= '<tr><td colspan="6"><font color="red">Records not found! </font></td></tr>';
    }
 
    $data .= ' </tbody></table> </div>';
 
    echo $data;
	
	}
	
		public function addtemp () {
			$data = array(
		'barang' => $this->input->post('nama'),		
		'jumlah' => $this->input->post('jumlah'),
		'descript' => $this->input->post('keterangan'),
		'userid' => $this->session->userdata('iduser')
		);
	//Transfering data to Model
	$this->model_order->post_insert($data);
		}
		
	public function delete_temp() 
		{
	
		$this->model_order->del_temp($this->input->post('idtemp'));
		
	}
	
   // QUERY REMINDER REKAP HARIAN PENGIRIMAN BARANG 
  
  public function rekap_harian() {

	$isi='  <table width="100%" cellpadding="0" cellspacing="0" style=" border-collapse: collapse;padding:5px">
  <tr style="color:white; background-color:#990000; padding:5px; font-size:16px">
    <td colspan="13"> REKAP HARIAN PENGIRIMAN BARANG PT. SRIWIJAYA PALM OIL GROUP TANGGAL '.strtoupper(tanggal(date('Y-m-d'))).'</td>
    </tr>
  <tr style="font-weight:bold;background-color:#efefef; padding:5px; font-size:14px">
  <td width="2%" style=" border: 1px solid #ccc;">No</td>
    <td width="11%" style=" border: 1px solid #ccc;">Waktu Kirim</td>
    <td width="11%" style=" border: 1px solid #ccc;">No. PO</td>
    <td width="11%" style=" border: 1px solid #ccc;">No Resi</td>
	<td width="11%" style=" border: 1px solid #ccc;">Tujuan</td>
    <td width="10%" style=" border: 1px solid #ccc;">Vehicle</td>
    <td width="10%" style=" border: 1px solid #ccc;">Driver</td>
    <td width="9%" style=" border: 1px solid #ccc;">Item </td>
    <td width="6%" style=" border: 1px solid #ccc;">Qty</td>
    <td width="10%" style=" border: 1px solid #ccc;">Remarks</td>
    <td width="6%" style=" border: 1px solid #ccc;">User</td>
    <td width="8%" style=" border: 1px solid #ccc;">Unit</td>
    <td width="6%" style=" border: 1px solid #ccc;">Status</td>
  </tr> ';

  $data=$this->db->query("SELECT  a.tglpost,a.nomor_po, a.tujuan,b.satuan, b.noresi, b.vehicle, b.driver, b.item, b.qty, c.nama, c.kode_site, b.stts_kirim, b.remarks
FROM tbltrack AS a
Inner Join (SELECT * FROM detailtrack ORDER BY iddetail DESC )  AS b ON a.idtrack = b.idtrack
Inner Join tbluser AS c ON b.iduser = c.iduser WHERE c.kode_site='HO' 
ORDER BY a.idtrack ASC

");
  $no=1;
  foreach ($data->result() as $view) {
  
  $isi.='<tr>
    <td style=" border: 1px solid #ccc;"><b>'.$no.'</b></td>
    <td style=" border: 1px solid #ccc;">'.$view->tglpost.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->nomor_po.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->noresi.'</td>
	<td style=" border: 1px solid #ccc;">'.$view->tujuan.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->vehicle.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->driver.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->item.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->qty.' '.$view->satuan.'</td>
    <td style=" border: 1px solid #ccc;">'.$view->remarks.'</td>
    <td style=" border: 1px solid #ccc;">'.strtoupper($view->nama).'</td>
    <td style=" border: 1px solid #ccc;">'.$view->kode_site.'</td>
    <td style=" border: 1px solid #ccc;">Kirim</td>
  </tr>';
   $no++; } 
$isi.='</table>
<br><center><font color="red" style="font-size:11px">* Mohon tidak membalas email ini, email dikirim otomatis oleh sistem </font></center>';

			
		$mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';							
		// set smtp
        $mail->isSMTP();
        $mail->Host = 'mail.spog.co.id';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
        $mail->Username = 'noreply@spog.co.id';
        $mail->Password = 'spog123';
      //  $mail->WordWrap = 50;  	
		// set email content	
	  /* $recipients = array(
       'ardiansaputra44@gmail.com' => 'Ardian Saputra',
	   'toteles.jogja@gmail.com' => 'Aris Toteles'
         );	*/
		 
        $mail->setFrom('noreply@spog.co.id', 'E-Tracking System');
		
        $sql=$this->db->get_where('PushMail', array('setMail' =>'3') );	
        foreach($sql->result() as $row) {
        $mail->AddAddress($row->email, $row->nama);
        }
        $mail->Subject = 'Daily Report '.tanggal(date('Y-m-d')).'';
		$mail->isHTML(true);
        $mail->MsgHTML($isi);
			
		if($mail->send()) 
      {
		  echo " TERKIRIM";
	  } else {
		  echo $mail->ErrorInfo;
	  } 
	  
  }
  


   // QUERY TERIMA DAN KIRIM BARANG

    public function save_terima_barang() {
	
	                if(isset($_POST['save'])) {
						
					$d=$this->model_order->get_data_po($this->input->post('idtrack'));
					foreach($d as $e) : endforeach;
			//		if($e->site == $this->session->userdata('pettysite') ) {
						
					$qty = $this->input->post('qty');
    				$data2 = array();
    				foreach($qty AS $key => $val){						
					$data2[] = array(
					'iduser' => $this->session->userdata('pettyiduser'),
					'tglupdate' => date('Y-m-d H:i:s'),							
					'idtrack'   => $this->input->post('idtrack'),
					'po_number' => $this->input->post('nomorpo'),
					'noresi' => $this->input->post('resi'),
					'item' => $_POST['item'][$key],
					'qty' => $_POST['qty'][$key],
					'satuan' => $_POST['satuan'][$key],
					'remarks' => $_POST['ket'][$key],
					'vehicle' => $this->input->post('vehicle'),
					'stts_kirim' => $this->input->post('status'),
					'driver' => $this->input->post('namadriver')					
					);
					}
					$save= $this->db->insert_batch('detailtrack', $data2); 
					//$save=$this->model_order->post_order_detail($data2);
					
					if($e->tujuan==$this->session->userdata('pettysite')) {					
					$data = array(	
					'status' =>'2',												
					'site' => $this->input->post('estapet')				
					);
					} else {
					$data = array(													
					'site' => $this->input->post('estapet')				
					);	
					}
					//UPDATE STATUS KIRIM BARANG
					$id['idtrack'] = $this->input->post('idtrack');  
					$save=$this->model_order->update_header_text($data,$id);
				
					if($save==true)
   				{ 
				if($this->input->post('status')==0) {
				$stts="BARANG TELAH DITERIMA";
				} elseif($this->input->post('status')==1) {
				$stts="BARANG TELAH DIKIRIM";
				}
				
				if($e->tujuan==$this->session->userdata('pettysite')) {			
				
				 	$isi='<table width="100%" cellpadding="2" border="0"  cellspacing="0" style="background:#efefef;  text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr>
				<td width="11%" bgcolor="#fafafa">&nbsp;</td>
	<td colspan="3" bgcolor="#990000" >&nbsp;</td>
	<td width="10%" bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px"><p>INFORMASI PENERIMAAN</p></td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			   
   <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td width="1%" bgcolor="#ffffff">&nbsp;</td>
				<td width="13%" bgcolor="#ffffff">No. PO</td>
				<td width="65%" bgcolor="#ffffff">: '.$this->input->post('nomorpo').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No. Resi</td>
				<td bgcolor="#ffffff">: '.$this->input->post('resi').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td bgcolor="#ffffff">Waktu Terima</td>
			    <td bgcolor="#ffffff">:  '.date('Y-m-d H:i:s').' </td>
			    <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Vehicle</td>
				<td bgcolor="#ffffff">: '.$this->input->post('vehicle').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Driver</td>
				<td bgcolor="#ffffff">: '.$this->input->post('namadriver').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Tujuan </td>
				<td bgcolor="#ffffff">: '.$this->input->post('tujuan').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Remarks</td>
				<td bgcolor="#ffffff">: '.$this->input->post('remarks').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
		        <td bgcolor="#fafafa">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">DETAIL BARANG</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td colspan="2" bgcolor="#ffffff">
				
				<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
			      <tr style="background-color:#CCC">
			        <td width="4%">No</td>
			        <td width="40%">Item Barang</td>
			        <td width="12%">Qty</td>
					<td width="44%">Keterangan</td>
		          </tr>';
				 
				$no=1;					
            	$jumlah=count($qty);			 
         		for($i=0;$i<=$jumlah;$i++){
				$warna=($no % 2 == 0) ? "#FFFFCC" : "#fafafa";
			      $isi.='<tr bgcolor="'.$warna.'">
			        <td>'.$no.'</td>
			        <td>'.$_POST['item'][$i].'</td>
			        <td>'.$_POST['qty'][$i].' '.$_POST['satuan'][$i].'</td>
					<td>'.$_POST['ket'][$i].'</td>
		          </tr> '; 
					$no++; }
				  $isi.='
		        </table></td>
			    <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff"></td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  				</tr>

			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3"bgcolor="#990000" style="color:white; text-align:center">PT. SRIWIJAYA PALM OIL GROUP INDONESIA</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			</table> 
<br>
			<center><font color="red">* Mohon tidak membalas email ini, email dikirim otomatis oleh sistem </font></center>';	
			
				$mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';						
		$mail->isSMTP();
        $mail->Host = 'mail.spog.co.id';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
        $mail->Username = 'noreply@spog.co.id';
        $mail->Password = 'spog123';
      //  $mail->WordWrap = 50;  	
		// set email content	
	  /* $recipients = array(
       'ardiansaputra44@gmail.com' => 'Ardian Saputra',
	   'toteles.jogja@gmail.com' => 'Aris Toteles'

         );	 */
		 
        $mail->setFrom('noreply@spog.co.id', 'E-Tracking System');
		$sql=$this->db->get_where('PushMail', array('setMail' =>'2') );	
        foreach($sql->result() as $row) {
        $mail->AddAddress($row->email, $row->nama);
        }
        foreach($recipients as $email => $name) {
        $mail->AddAddress($email, $name);
        }
        $mail->Subject = 'Terima Barang Nomor PO : '.$this->input->post('nomorpo').'';
		$mail->isHTML(true);
        $mail->MsgHTML($isi);	
			
		if($mail->send())    {	
	 	
		$this->session->set_flashdata('sukses','<div class="sukses"> '.$stts.' </div>');

		redirect('index.php/system/order/receive_data?nomorpo='.$this->input->post('nomorpo').'');	
	
		} else {
		
		$this->session->set_flashdata('sukses','<div class="error"> Ada kesalahan notif email, Namun Data telah tersimpan : <br> '. $mail->        ErrorInfo.'</div>');
		redirect('index.php/system/order/receive_data?nomorpo='.$this->input->post('nomorpo').'');
			
	   		}  
			
	   } else {
		  
		 $this->session->set_flashdata('sukses','<div class="sukses"> '.$stts.' </div>');
		 redirect('index.php/system/order/receive_data?nomorpo='.$this->input->post('nomorpo').'');	  
	   }
		 
	}  else {
			
			$this->session->set_flashdata('sukses','<div class="error"> ERROR QUERY SQL </div>');
        	redirect('index.php/system/order/receive_data');	
			
		 }  
		 
		/* } else {
			 
			$this->session->set_flashdata('sukses','<div class="error"> ANDA TIDAK MEMILIKI AKSES </div>');
        	redirect('index.php/system/order/receive_data');	 
		 } */

		 }
      }
	
		
// QUERY PENGIRIMAN BARANG DARI HEAD OFFICE
	
public function proccess()
	{
	
		if(isset($_POST['save'])) 
		
	   {		
			
		/*	$config=[
						'protocol' =>'smtp',
						'smtp_host'=>'smtp.gmail.com',
						'smtp_user'=>'ardiansaputra44@gmail.com',
						'smtp_pass'=>'',
						'smtp_port'=>'587',
						'smtp_crypto'=>'tls',
						'smtp_timeout'=>500,
						'charset'=>'iso-8859-1',
						//'wordwrap'=>TRUE,
						'mailtype'=>'html',
						'newline'=>"\r\n",
						'validation' => TRUE
						];   */
						 
	 
			//		$this->email->initialize($config);
				
   			/*	 $query=$this->model_saldo->get_sisa_actual($this->session->userdata('pettyiduser'));	
				 foreach($query as $saldo): endforeach;
				 if($saldo->REQUEST < $this->input->post('jumlah'))  {
				 
				 $this->session->set_flashdata('sukses','<div class="error"> Maaf, Saldo anda tidak mencukupi jumlah request </div>');
			     redirect('index.php/system/order/request_budget');			 
				 
				 } else {	 */
   
					//INSERT HEADER TEXT
					$sesid=$this->session->userdata('pettyiduser');
					$query2=$this->db->get_where('temptable', array('iduser' => $sesid) );	
					//return $sql1->result();
					//foreach ($sql1 as $cek) : endforeach;
					foreach ($query2->result() as $cek) { }
						
				 if(!empty($cek->itembarang)) {					
						
					$data = array(					
					'tglpost' => date('Y-m-d H:i:s'),							
					'nomor_po' => $this->input->post('nomorpo'),	
					'noref' => $this->input->post('noref'),								
					'tujuan' => $this->input->post('tujuan'),					
					'site' => $this->input->post('estapet'),
					'note' => $this->input->post('remarks'),
					'status' => '1',
					'flag'	=> '1'					
					);
				
					$save=$this->model_order->post_order($data);
					
					$insert_id = $this->db->insert_id();
					
					//INSERT DETAIL TEXT
					
					$sql=$this->db->query("SELECT * FROM temptable WHERE iduser='$sesid'");
				
					foreach ($sql->result() as $loop ) {
					$data2 = array(
					'iduser' => $loop->iduser,
					'tglupdate' => date('Y-m-d H:i:s'),							
					'idtrack'   => $insert_id,
					'po_number' => $this->input->post('nomorpo'),
					'stts_kirim'   => '1',
					'noresi' => $this->input->post('resi'),
					'item' => $loop->itembarang,
					'qty' => $loop->jumlah_item,
					'satuan' => $loop->satuan,
					'remarks' => $loop->ket,
					'vehicle' => $this->input->post('vehicle'),
					'driver' => $this->input->post('namadriver')
					
					);
					
					$save=$this->model_order->post_order_detail($data2);
					}
								
				if($save==true)
   				{ 		 
				
				$this->db->query("DELETE FROM temptable WHERE iduser='$sesid'");
		 
		 	$isi='<table width="100%" cellpadding="2" border="0"  cellspacing="0" style="background:#efefef;  text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr>
				<td width="11%" bgcolor="#fafafa">&nbsp;</td>
	<td colspan="3" bgcolor="#990000" >&nbsp;</td>
	<td width="10%" bgcolor="#fafafa">&nbsp;</td>
  			  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px"><p>INFORMASI PENGIRIMAN</p></td>
				<td bgcolor="#fafafa">&nbsp;</td>
              </tr>
			   
              <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td width="1%" bgcolor="#ffffff">&nbsp;</td>
				<td width="13%" bgcolor="#ffffff">No. PO</td>
				<td width="65%" bgcolor="#ffffff">: '.$this->input->post('nomorpo').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
 			 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No. Resi</td>
				<td bgcolor="#ffffff">: '.$this->input->post('resi').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			<tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No. Ref</td>
				<td bgcolor="#ffffff">: '.$this->input->post('noref').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td bgcolor="#ffffff">Waktu Kirim</td>
			    <td bgcolor="#ffffff">:  '.date('Y-m-d H:i:s').' </td>
			    <td bgcolor="#fafafa">&nbsp;</td>
 			 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Vehicle</td>
				<td bgcolor="#ffffff">: '.$this->input->post('vehicle').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
 		 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Driver</td>
				<td bgcolor="#ffffff">: '.$this->input->post('namadriver').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  		</tr>
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Tujuan </td>
				<td bgcolor="#ffffff">: '.$this->input->post('tujuan').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Remarks</td>
				<td bgcolor="#ffffff">: '.$this->input->post('remarks').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
		        <td bgcolor="#fafafa">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">DETAIL BARANG</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td colspan="2" bgcolor="#ffffff">
				
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
			      <tr style="background-color:#CCC">
			        <td width="4%">No</td>
			        <td width="39%">Item Barang</td>
			        <td width="13%">Qty</td>
					 <td width="44%">Ket.</td>
		          </tr>';
				  $sql=$this->db->query("SELECT * FROM temptable WHERE iduser='$sesid'");
				$no=1;
				foreach ($sql->result() as $loop ) {
				$warna=($no % 2 == 0) ? "#FFFFCC" : "#fafafa";
			      $isi.='<tr bgcolor="'.$warna.'">
			        <td>'.$no.'</td>
			        <td>'.$loop->itembarang.'</td>
			        <td>'.$loop->jumlah_item.' '.$loop->satuan.'</td>
					<td>'.$loop->ket.'</td>
		          </tr> ';
					$no++; }
				  $isi.='
		        </table></td>
			    <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff"></td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  				</tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3"bgcolor="#990000" style="color:white; text-align:center">PT. SRIWIJAYA PALM OIL GROUP INDONESIA</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			</table> 
<br>
			<center><font color="red">* Mohon tidak membalas email ini, email dikirim otomatis oleh sistem </font></center>';		
					
				/*	$judul='Notification Request PO';		
					$tujuan = array(
					'ardiansaputra44@gmail.com','adminga_palembang@trac.astra.co.id'
					);		
					$this->email->from('ardiansaputra44@gmail.com','Ardian Saputra');		
					$this->email->to($tujuan);		
					$this->email->subject($judul);
					$this->email->message($isi);  */
					
		$mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';	
						
		 $mail->isSMTP();
        $mail->Host = 'mail.spog.co.id';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
        $mail->Username = 'noreply@spog.co.id';
        $mail->Password = 'spog123';
      //  $mail->WordWrap = 50;  	
		// set email content	
	/*   $recipients = array(
       'ardiansaputra44@gmail.com' => 'Ardian Saputra',
	   'toteles.jogja@gmail.com' => 'Aris Toteles'

         );	 */
		 
        $mail->setFrom('noreply@spog.co.id', 'E-Tracking System');
		$sql=$this->db->get_where('PushMail', array('setMail' =>'1') );	
        foreach($sql->result() as $row) {
        $mail->AddAddress($row->email, $row->nama);
        }
        $mail->Subject = 'Kirim Barang Nomor PO : '.$this->input->post('nomorpo').'';
		$mail->isHTML(true);
        $mail->MsgHTML($isi);
					
		if($mail->send())   {	  	
				
		$this->session->unset_userdata('nomorpo');
		$this->session->unset_userdata('tujuan');				
		$this->session->unset_userdata('vehicle');
		$this->session->unset_userdata('namadriver');
		$this->session->unset_userdata('remarks');
		$this->session->unset_userdata('estapet');	
		$this->session->unset_userdata('noref');	
		?>  <script language="JavaScript">alert('PENGIRIMAN BARANG BERHASIL DIPROSES');
            document.location='<?=base_url();?>index.php/system/order/cetak_surat_jalan?nomorpo=<?=$this->input->post('nomorpo');?>&id=<?=$insert_id;?>','_blank'</script>
         <?php
		//$this->session->set_flashdata('sukses','<div class="sukses"> DATA TELAH TERSIMPAN DAN BARANG DALAM PROSES PENGIRIMAN </div>');
		//redirect('index.php/system/order/kirim_barang');
			
		} else {
		
		$this->session->set_flashdata('sukses','<div class="error"> Ada kesalahan notif email,Namun data telah tersimpan : <br> '.$mail->ErrorInfo.'</div>');
			redirect('index.php/system/order/kirim_barang');
			
		 		} 
					
				   }  else {
				
				$this->session->set_flashdata('sukses','<div class="error"> ERROR QUERY SQL </div>');
				redirect('index.php/system/order/kirim_barang');	
				
					}				 
		 
				 }  else {
					$this->session->set_userdata('nomorpo',$this->input->post('nomorpo'));
					$this->session->set_userdata('tujuan',$this->input->post('tujuan'));				
					$this->session->set_userdata('vehicle',$this->input->post('vehicle'));
					$this->session->set_userdata('namadriver',$this->input->post('namadriver'));
					$this->session->set_userdata('remarks',$this->input->post('remarks'));
					$this->session->set_userdata('estapet',$this->input->post('estapet'));
					$this->session->set_userdata('estapet',$this->input->post('noref'));				
					
					$this->session->set_flashdata('sukses','<div class="error"> SORRY... DETAIL BARANG BELUM ANDA INPUTKAN </div>');
        	        redirect('index.php/system/order/kirim_barang');	
					
		
					}
		 
				//   } // end check

				} // end post 
	
	}


// QUERY RETURN BARANG DARI UNIT KE HO
	
public function return_process()
	{
	
		if(isset($_POST['save'])) 
		
	     {		  
					//INSERT HEADER TEXT
					$sesid=$this->session->userdata('pettyiduser');					
						
					$data = array(					
					'tglpost' => date('Y-m-d H:i:s'),							
					'nomor_po' => $this->input->post('nomorpo'),	
					'noref' => $this->input->post('noref'),								
					'tujuan' => $this->input->post('tujuan'),					
					'site' => $this->input->post('estapet'),
					'note' => $this->input->post('note'),
					'status' => '1',
					'flag'	=> '2'					
					);
				
					$save=$this->model_order->post_order($data);
					
					$insert_id = $this->db->insert_id();
					
					//INSERT DETAIL TEXT
					
					
				
					//foreach ($sql->result() as $loop ) {
					$count=$this->input->post('cekid');
					$qty=$this->input->post('qty');					
					$id = count($count);  
  					for($i = 0; $i < $id; $i++) {
					$sql=$this->db->query("SELECT * FROM detailtrack WHERE iddetail='$count[$i]'");
					foreach ($sql->result() as $view): endforeach;	
					$data2 = array(
					'iduser' => $sesid,
					'tglupdate' => date('Y-m-d H:i:s'),							
					'idtrack'   => $insert_id,
					'po_number' => $this->input->post('nomorpo'),
					'stts_kirim'   => '1',
					'noresi' => $this->input->post('resi'),
					'item' => $view->item,
					'qty' => $qty[$i],
					'satuan' => $view->satuan,
					'remarks' => $view->remarks,
					'vehicle' => $this->input->post('vehicle'),
					'driver' => $this->input->post('namadriver')
					
					);
					
					$save=$this->model_order->post_order_detail($data2);
					}
								
				if($save==true)
   				{ 		 		
		 
		 	$isi='<table width="100%" cellpadding="2" border="0"  cellspacing="0" style="background:#efefef;  text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
<tr>
				<td width="11%" bgcolor="#fafafa">&nbsp;</td>
	<td colspan="3" bgcolor="#990000" >&nbsp;</td>
	<td width="10%" bgcolor="#fafafa">&nbsp;</td>
  			  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px"><p>INFORMASI RETURN BARANG </p></td>
				<td bgcolor="#fafafa">&nbsp;</td>
              </tr>
			   
              <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td width="1%" bgcolor="#ffffff">&nbsp;</td>
				<td width="13%" bgcolor="#ffffff">No. PO</td>
				<td width="65%" bgcolor="#ffffff">: '.$this->input->post('nomorpo').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
 			 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No. Resi</td>
				<td bgcolor="#ffffff">: '.$this->input->post('resi').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			<tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No. Ref</td>
				<td bgcolor="#ffffff">: '.$this->input->post('noref').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td bgcolor="#ffffff">Waktu Kirim</td>
			    <td bgcolor="#ffffff">:  '.date('Y-m-d H:i:s').' </td>
			    <td bgcolor="#fafafa">&nbsp;</td>
 			 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Vehicle</td>
				<td bgcolor="#ffffff">: '.$this->input->post('vehicle').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
 		 </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Driver</td>
				<td bgcolor="#ffffff">: '.$this->input->post('namadriver').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  		</tr>
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Tujuan </td>
				<td bgcolor="#ffffff">: '.$this->input->post('tujuan').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Remarks</td>
				<td bgcolor="#ffffff">: '.$this->input->post('note').'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
		        <td bgcolor="#fafafa">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#ffffff">&nbsp;</td>
		        <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
		      <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">DETAIL BARANG</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
			    <td bgcolor="#fafafa">&nbsp;</td>
			    <td bgcolor="#ffffff">&nbsp;</td>
			    <td colspan="2" bgcolor="#ffffff">
				
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
			      <tr style="background-color:#CCC">
			        <td width="4%">No</td>
			        <td width="39%">Item Barang</td>
			        <td width="13%">Qty</td>
					 <td width="44%">Ket.</td>
		          </tr>';
				 for($i = 0; $i < $id; $i++) {
				$query_sql=$this->db->query("SELECT * FROM detailtrack WHERE iddetail='$count[$i]'");
				$no=1;
				foreach ($query_sql->result() as $loop ) {
				$warna=($no % 2 == 0) ? "#FFFFCC" : "#fafafa";
			      $isi.='<tr bgcolor="'.$warna.'">
			        <td>'.$no.'</td>
			        <td>'.$loop->item.'</td>
			        <td>'.$qty[$i].' '.$loop->satuan.'</td>
					<td>'.$loop->remarks.'</td>
		          </tr> ';
					$no++; } }
				  $isi.='
		        </table></td>
			    <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff"></td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  				</tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3"bgcolor="#990000" style="color:white; text-align:center">PT. SRIWIJAYA PALM OIL GROUP INDONESIA</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  			</tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#990000">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			</table> 
<br>
			<center><font color="red">* Mohon tidak membalas email ini, email dikirim otomatis oleh sistem </font></center>';		
					
				/*	$judul='Notification Request PO';		
					$tujuan = array(
					'ardiansaputra44@gmail.com','adminga_palembang@trac.astra.co.id'
					);		
					$this->email->from('ardiansaputra44@gmail.com','Ardian Saputra');		
					$this->email->to($tujuan);		
					$this->email->subject($judul);
					$this->email->message($isi);  */
					
		$mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';	
						
		 $mail->isSMTP();
        $mail->Host = 'mail.spog.co.id';
        $mail->Port = '465';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
        $mail->Username = 'noreply@spog.co.id';
        $mail->Password = 'spog123';
      //  $mail->WordWrap = 50;  	
		// set email content	
	/*   $recipients = array(
       'ardiansaputra44@gmail.com' => 'Ardian Saputra',
	   'toteles.jogja@gmail.com' => 'Aris Toteles'

         );	 */
		 
        $mail->setFrom('noreply@spog.co.id', 'E-Tracking System');
		$sql=$this->db->get_where('PushMail', array('setMail' =>'4') );	
        foreach($sql->result() as $row) {
        $mail->AddAddress($row->email, $row->nama);
        }
        $mail->Subject = 'Return Barang dari Unit : '.$this->session->userdata('pettysite').'';
		$mail->isHTML(true);
        $mail->MsgHTML($isi);
					
		if($mail->send())   {			
			
		
		$this->session->set_flashdata('sukses','<div class="sukses"> PROSES RETURN BARANG BERHASIL </div>');
		redirect('index.php/system/order/return_barang');
			
		} else {
		
		$this->session->set_flashdata('sukses','<div class="error"> Ada kesalahan notif email,Namun data telah tersimpan : <br> '.$mail->ErrorInfo.'</div>');
			redirect('index.php/system/order/return_barang');
			
		}
					
				}  else {
				
				$this->session->set_flashdata('sukses','<div class="error"> ERROR QUERY SQL </div>');
				redirect('index.php/system/order/return_barang');	
				
					}						
		 
				//  

				} // end post 
	
			}




 public  function upload_berkas()
	{
	
		if(isset($_POST['upload'])) 
		
	  {
		  
   			if($this->input->post('request') < $this->input->post('jumlah_budget')) {
			
			$this->session->set_flashdata('sukses','<div class="error"> Actual budget tidak boleh melebihi request budget </div>');
			redirect('index.php/system/order/outstanding_request');		
			
			} else {
				
   				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'pdf|doc|xls|docx|jpg|png';
                $config['max_size']             = 22000;
                $config['max_width']            = 3000;
                $config['max_height']           = 2000;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('file_upload'))
                {
                        $this->session->set_flashdata('sukses','<div class="error">'.$this->upload->display_errors().'</div>');
                        redirect('index.php/system/order/outstanding_request');
                     
                }
                else
                {
				
				 $query=$this->model_order->get_order_detail($this->input->post('ID'));			
		   
		         foreach($query as $row) : endforeach;
				 /*
						$config=[
						'protocol' =>'smtp',
						'smtp_host'=>'smtp.gmail.com',
						'smtp_user'=>'ardiansaputra44@gmail.com',
						'smtp_pass'=>'pardasuka020792',
						'smtp_port'=>'587',
						'smtp_crypto'=>'tls',
						'smtp_timeout'=>500,
						'charset'=>'iso-8859-1',
						//'wordwrap'=>TRUE,
						'mailtype'=>'html',
						'newline'=>"\r\n",
						'validation' => TRUE
						];
					
					$this->email->initialize($config); */
	
				
                    $file =$this->upload->file_name; 
							// PROSES INPUT KE TABEL REQUEST PURCHASE ORDER 
					$data = array(					
					'no_booking' 		=> $this->input->post('no_booking'),	
					'jumlah_selesai' 	=> $this->input->post('jumlah_budget'),	
					'budget_bbm' 		=> $this->input->post('budget_bbm'),	
					'budget_parkir'		=> $this->input->post('budget_parkir'),	
					'budget_tol' 		=> $this->input->post('budget_tol'),	
					'budget_lain' 		=> $this->input->post('budget_lain'),	
					'ket_lain' 			=> $this->input->post('ket_lain'),		
					'sisa' 			    => $this->input->post('sisa'),					
					'status' 			=> '4',
					'dokumen' 			=> $file
					
					);
					//Transfering data to table Request PO
					$id['md5(idclaim)'] = $this->input->post('ID');  
					$save=$this->model_order->update_status_approved($data,$id);
	 			if($save==true) {
								$isi='<table width="100%" cellpadding="2" border="0"  cellspacing="0" style="background:#efefef;  text-align:left; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<tr>
				<td width="11%" bgcolor="#fafafa">&nbsp;</td>
	<td width="1%" bgcolor="#FF9900" >&nbsp;</td>
	<td width="13%" bgcolor="#FF9900" >&nbsp;</td>
	<td width="65%" bgcolor="#FF9900" >&nbsp;</td>
				<td width="10%" bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#FFFFFF" style="padding-left:10px"><p> </p></td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			   
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">Data Request Budget from <b>'.$row->nama.' </b>  </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
 
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  
	
   <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">No Booking</td>
				<td bgcolor="#ffffff">: '.$this->input->post('no_booking').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Nopol</td>
				<td bgcolor="#ffffff">: '.$row->nopol.'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Customer</td>
				<td bgcolor="#ffffff">: '.$row->customer.' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Driver</td>
				<td bgcolor="#ffffff">: '.$row->driver.' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Start</td>
				<td bgcolor="#ffffff">: '.$row->startdate.'</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
				<tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">End Date</td>
				<td bgcolor="#ffffff">: '.$row->enddate.' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
<tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Jumlah Request</td>
				<td bgcolor="#ffffff">: '.rupiah($row->jumlah).' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			   <tr>
				 <td bgcolor="#fafafa">&nbsp;</td>
				 <td bgcolor="#ffffff">&nbsp;</td>
				 <td bgcolor="#ffffff">&nbsp;</td>
				 <td bgcolor="#ffffff">&nbsp;</td>
				 <td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td colspan="2" bgcolor="#ffffff">Rincian Penggunaan Budget </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			   <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">BBM</td>
				<td bgcolor="#ffffff">: '.$this->input->post('budget_bbm').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Parkir</td>
				<td bgcolor="#ffffff">: '.$this->input->post('budget_parkir').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Tol</td>
				<td bgcolor="#ffffff">: '.$this->input->post('budget_tol').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Lain-lain</td>
				<td bgcolor="#ffffff">: '.$this->input->post('budget_lain').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Keterangan Lain</td>
				<td bgcolor="#ffffff">: '.$this->input->post('ket_lain').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
  
  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">Actual Total Budget</td>
				<td bgcolor="#ffffff">: '.$this->input->post('jumlah_budget').' </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#ffffff"></td>
				<td bgcolor="#ffffff">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3"bgcolor="#3399CC" style="color:white; text-align:center">PT. SERASI AUTORAYA </td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td colspan="3" bgcolor="#3399CC" style="color:white; text-align:center"> &copy; Copyright 2017 Trac Palembang By Ardian Saputra</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			  
			  <tr>
				<td bgcolor="#fafafa">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#3399CC">&nbsp;</td>
				<td bgcolor="#fafafa">&nbsp;</td>
  </tr>
			</table> 
<br>
			<center><font color="red">* Mohon tidak membalas email ini, email dikirim otomatis oleh sistem </font></center>';		
					
				/*	$judul='Approved Request PO';		
					$tujuan = array(
					$this->input->post('email')
					);		
					$this->email->from('ardiansaputra44@gmail.com','Ardian Saputra');		
					$this->email->to($tujuan);		
					$this->email->subject($judul);
					$this->email->message($isi);
					$file =  $this->upload->data();                       
					$pathToUploadedFile = $file['full_path'];
					$this->email->attach($pathToUploadedFile);
					*/
					
		$mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';	
						
	// set smtp
        $mail->isSMTP();
        $mail->Host = 'exchnlb.trac.astra.co.id';
        $mail->Port = '25';
        $mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
        $mail->Username = 'trac\adminga_palembang';
        $mail->Password = 'semangat6@';
      //  $mail->WordWrap = 50;  	
 	
		$file =  $this->upload->data();                       
		$pathToUploadedFile = $file['full_path'];
		$mail->addAttachment($pathToUploadedFile);
		$recipients = array(
        'paulus.purnama@trac.astra.co.id' => 'Paulus Purnama',
		'taupik.rahman@trac.astra.co.id' => 'Taupik Rahman',
		'gregorius.prasetianto@trac.astra.co.id' => 'gregorius dwi prasetianto',
		'mutiara.haskawina@trac.astra.co.id' => 'Mutiara Haskawina',
		'deni.shapta@trac.astra.co.id' => 'Deni Shapta Hardiansyah',
		'kemas.habibullah@trac.astra.co.id' => 'Kemas Habibullah',	
		'andika.precillia@gmail.com' => 'Andika Precillia'
         );	
        $mail->setFrom('adminga_palembang@trac.astra.co.id', 'Noreplay System');
        foreach($recipients as $email => $name) {
        $mail->AddAddress($email, $name);
        }
        $mail->Subject = 'Finishing Budget By '.$this->session->userdata('pettynama').'';
		
		$mail->isHTML(true);
        $mail->MsgHTML($isi);
		if($mail->send()) 
   {
			$this->session->set_flashdata('sukses','<div class="sukses"> Finishing budget berhasil dikirim </div>');
			redirect('index.php/system/order/outstanding_request');		
			
				
      }  else {
		
			$this->session->set_flashdata('sukses','<div class="error"> '.$mail->ErrorInfo.' </div>');
        	redirect('index.php/system/order/outstanding_request');
			
		 }
		 } else {
		 
		 echo " Error ";
		 }
		 
		 }
		 
		 }
   
	   } // end check

	} // end post 

  // end function 

public function insert_detail() {
	$page = isset($_GET['p'])? $_GET['p'] : '';
if($page=='add'){
    try{
        $id = $this->session->userdata('pettyiduser');
        $nm = $this->input->post('nm');
        $em = $this->input->post('em');
		$ket = $this->input->post('ket');
		$sat = $this->input->post('sat');
       
        $stmt =$this->db->query("INSERT INTO temptable (iduser,itembarang,jumlah_item,ket,satuan)VALUES('$id','$nm','$em','$ket','$sat')");
       	
        if($stmt==true){
            print "<div class='alert alert-success' role='alert'>Data has been added</div>";
        } else{
            print "<div class='alert alert-danger' role='alert'>Failed to add data</div>";
        }
    } catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
    } 
} else if($page=='update'){
    try{
        $id = $this->input->post('id');
        $nm = $this->input->post('nm');
        $em = $this->input->post('em');
        $ket = $this->input->post('ket');
		$sat = $this->input->post('sat');
        $stmt = $this->db->query("UPDATE temptable SET itembarang='$nm', jumlah_item='$em',ket='$ket',satuan='$sat' WHERE idtemp='$id'");
       
        if($stmt==true){
            print "<div class='alert alert-success' role='alert'>Data has been updated</div>";
        } else{
            print "<div class='alert alert-danger' role='alert'>Failed to update data</div>";
        }
    } catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
    } 
} else if($page=='delete'){
    try{
        $id = $this->input->post('id');
        $stmt =$this->db->query("DELETE FROM temptable WHERE idtemp='$id'");
       
        if($stmt==true){
            print "<div class='alert alert-success' role='alert'>Data has been deleted</div>";
        } else{
            print "<div class='alert alert-danger' role='alert'>Failed to delete data</div>";
        }
    } catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
    } 
} else{
    try{
	print '<table class="table table-bordered table-striped table-hover" id="example">
                    <thead>
                        <tr>
                       <!--     <th width="40">ID</th> -->
					   		<th>No.</th>
                            <th>Item Barang</th>
                            <th align="center">Qty</th>
							<th>Keterangan</th>
                           
                            <th width="100">Action</th>
                        </tr>
                    </thead> <tbody>';
					
        $stmt =$this->db->query("SELECT * FROM temptable");
		
      		$total="0";
			$no=1;
            foreach($stmt->result_array() as $row){
			//$total +=$row['nominal'];
            print "<tr>";
            print "<td>".$no."</td>";
            print "<td>".$row['itembarang']."</td>";
            print "<td align='center'>".$row['jumlah_item']." ".$row['satuan']."</td>";
            print "<td >".$row['ket']."</td>";
            print "<td class='text-center'><div class='btn-group' role='group' aria-label='group-".$row['idtemp']."'>";
            ?> 
            <button onClick="editData('<?php echo $row['idtemp'] ?>','<?php echo $row['itembarang'] ?>','<?php echo $row['jumlah_item'] ?>','<?php echo $row['ket'] ?>','<?php echo $row['satuan'] ?>')" class='label label-warning' title='Update'><i class='fa fa-pencil'></i></button>
            <button onClick="removeConfirm('<?php echo $row['idtemp'] ?>')" class='label label-danger' title='Delete'><i class='fa fa-trash'></i></button>
            <?php 
            print "</div></td>";
            print "</tr>";
			$no++;
        }
		echo" </tbody></table>";
    } catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
    }
}
	
	
}


}