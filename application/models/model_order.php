<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_order extends CI_Model {
 
    var $tabel = 'temp_order'; //variabel tabel
 
    function __construct() {
        parent::__construct();
    }
	
// GRAFIK 	

  function get_chart_outstanding() {
		$this->db->select('a.status,count(a.idclaim) as jumlah');
        $this->db->from('trx_claim a');		
		$this->db->where('a.status!=','0');
		$this->db->where('a.status!=','6');
		$this->db->where('a.status!=','8');
		$this->db->group_by('a.status');
        $query = $this->db->get();
 		return $query->result();
        
    }
function chart_pending_budget() {
		$this->db->select('b.nama,b.saldo_outstanding as jumlah');
        $this->db->from('users b');		
		$this->db->where('b.level','rmo');	
		$this->db->group_by('b.nama');
		$this->db->order_by('b.nama','asc');
        $query = $this->db->get();
 		return $query->result();
        
    }
	function get_chart_type_budget() {
		$year=$this->input->get('year');
		$month=$this->input->get('month');
		$thn=date('Y');
		$bln=date('m');
		$this->db->select('sum(budget_bbm) as bbm, sum(budget_parkir) as parkir, sum(budget_tol) as tol, sum(budget_lain) as lain_lain');
        $this->db->from('trx_claim');
		$this->db->where('status','5');
		$this->db->or_where('status','6');
		if(isset($year)) {
		$this->db->where('YEAR(tglrequest)',$year);
		$this->db->where('MONTH(tglrequest)',$month);
		} else {
		$this->db->where('YEAR(tglrequest)',$thn);
		$this->db->where('MONTH(tglrequest)',$bln);
		}
		//$this->db->group_by('idclaim');
        $query = $this->db->get();
 		return $query->result();
        
    }
	
function get_chart_sepo() {
		$year=$this->input->get('year');
		$month=$this->input->get('month');
		$thn=date('Y');
		$bln=date('m');
		$this->db->select('b.nama,a.status,count(a.idclaim) as jumlah');
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->where('a.status','5');
		$this->db->or_where('a.status','6');
		if(isset($year)) {
		$this->db->where('YEAR(tglrequest)',$year);
		$this->db->where('MONTH(tglrequest)',$month);
		} else {
		$this->db->where('YEAR(tglrequest)',$thn);
		$this->db->where('MONTH(tglrequest)',$bln);
		}
		$this->db->group_by('b.id_user');
        $query = $this->db->get();
 		return $query->result();
        
    }
	
	
    function get_alltemp($id) {
        $this->db->from($this->tabel);
		$this->db->where('userid',$id);
        $query = $this->db->get();
 
        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
	
  function get_allrequest() {
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->where('a.status','1');
		$this->db->or_where('status','2');
        $query = $this->db->get();
 		return $query->result();
        
    }
	
 function get_allrequest_dashboard() {
 		$this->db->select('*,DATEDIFF(enddate,CURDATE()) as leadtime');
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->where('a.status!=','5');
		$this->db->where('a.status!=','0');
		$this->db->where('a.status!=','6');
        $query = $this->db->get();
 		return $query->result();
        
    }
	
	  function get_sum_daily() {
	    $this->db->select("COUNT(idtrack) AS TOTAL");
        $this->db->from('tbltrack');		
		$this->db->where('DATE(tglpost)=CURDATE()');				
        $query = $this->db->get();
 		return $query->result();        
    }
	
  function get_sum_shipment() {
	    $this->db->select("COUNT(idtrack) AS TOTAL");
        $this->db->from('tbltrack');		
		$this->db->where('status','1');		
		$this->db->where('flag','1');	
        $query = $this->db->get();
 		return $query->result();        
    }
	
  function get_sum_return() {
	    $this->db->select("COUNT(idtrack) AS TOTAL");
        $this->db->from('tbltrack');		
		$this->db->where('status','1');		
		$this->db->where('flag','2');		
        $query = $this->db->get();
 		return $query->result();        
    }
	
	function get_allrequest_by_site() {
       $query= $this->db->query(" SELECT * FROM `tbltrack` as a  INNER JOIN detailtrack as b ON a.idtrack=b.idtrack  WHERE status!='3' GROUP BY  a.idtrack ORDER BY  a.idtrack DESC ");	       
        return $query->result();       
    }
	
function Model_History_Report($a,$b,$c,$d) {
		if($c=='ALL' && $d!='all_state') {
		$d="WHERE a.status='$d' AND DATE(a.tglpost) >='$a' AND DATE(a.tglpost)<='$b'";	
		}elseif($c!='ALL' && $d=='all_state') {
		$d="WHERE   DATE(a.tglpost) >='$a' AND DATE(a.tglpost)<='$b' AND a.tujuan='$c' ";	
		}elseif($c=='ALL' && $d=='all_state') {
		$d="WHERE  DATE(a.tglpost) >='$a' AND DATE(a.tglpost)<='$b'";	
		} elseif($c!='ALL' && $d!='all_state'){
		$d="WHERE a.status='$d' AND DATE(a.tglpost) >='$a' AND DATE(a.tglpost)<='$b' AND a.tujuan='$c' ";		
		}
       $query= $this->db->query(" SELECT a.*,b.noresi,b.driver,b.stts_kirim,b.vehicle,GROUP_CONCAT(qty,' ', satuan,' ', item ORDER BY  item ASC SEPARATOR ', ')  AS barang   FROM `tbltrack` as a  INNER JOIN detailtrack as b ON a.idtrack=b.idtrack ".$d." GROUP BY  a.idtrack ORDER BY  a.idtrack DESC");	       
        return $query->result();       
    }
	
function get_All_Site() {
       $query= $this->db->query(" SELECT kode_site,keterangan FROM `tbluser`  GROUP BY kode_site ORDER BY keterangan ASC");	       
        return $query->result();       
    }
	
	function get_allrequest_done() {
        $this->db->from('trx_claim');
		$this->db->where('status','5');
		$this->db->or_where('status','6');
		$this->db->where('DATE(tglrequest) > CURDATE() - INTERVAL 7 DAY');
		$this->db->where('id_user',$this->session->userdata('pettyiduser'));
        $query = $this->db->get();
        return $query->result();
        //cek apakah ada ba
       
    }
	
	function get_allrequest_claim() {
        $this->db->from('trx_claim');
		$this->db->join('users','trx_claim.id_user=users.id_user');
		$this->db->where('status','5');
		$this->db->where('level','rmo');
	//	$this->db->where('DATE(tglrequest) > CURDATE() - INTERVAL 7 DAY');		
		$this->db->group_by('idclaim');
        $query = $this->db->get();
        return $query->result();
        //cek apakah ada ba       
    }
	

	
	
	function get_user_request_history($a,$b) {
        $this->db->from('trx_claim');
		$this->db->where('status','5');		
		$this->db->or_where('status','6');	
		$this->db->where('id_user',$this->session->userdata('pettyiduser'));
		if(!empty($a) && !empty($b)) {		
		$this->db->where('tglrequest >=',$a);	
		$this->db->where('tglrequest <=',$b);	
		}
        $query = $this->db->get();
        return $query->result();
        //cek apakah ada ba
       
    }
	
	function get_all_history() {
		$a=$this->input->get('get_user',TRUE);
	    $b=$this->input->get('startdate',TRUE);
	    $c=$this->input->get('enddate',TRUE);
		
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->join('customer c', 'a.cmd = c.no_cmd');		
		$this->db->where('(a.status=6 OR a.status=5)');			
		if(!empty($a) && !empty($b)  && !empty($c)) {	
		$this->db->where('b.id_user',$a);	
		$this->db->where('a.tglrequest >=',$b);	
		$this->db->where('a.tglrequest <=',$c);	
		
		}
        $query = $this->db->get();
        return $query->result();
        //cek apakah ada ba
       
    }
	
	function get_all_reject($a,$b) {
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->where('a.status','0');			
		if(!empty($a) && !empty($b)) {		
		$this->db->where('a.tglrequest >=',$a);	
		$this->db->where('a.tglrequest <=',$b);	
		}
        $query = $this->db->get();
        return $query->result();
        //cek apakah ada ba
       
    }
	
	function get_user_request_reject() {
        $this->db->from('trx_claim');
		$this->db->where('status','0');			
		$this->db->where('id_user',$this->session->userdata('pettyiduser'));
		$query = $this->db->get();
        return $query->result();
        //cek apakah ada ba
       
    }
 
    function get_user($id) {
        $this->db->from('tbluser');
        $this->db->where('iduser', $id);
 
        $query = $this->db->get();
 
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
 
 function get_order_detail($id) {
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
        $this->db->where('md5(a.idclaim)', $id);
 
        $query = $this->db->get();
 
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
		return "empty";
		}
    }
	
 function get_data_po($id) {
        $this->db->from('tbltrack');		
        $this->db->where('idtrack',$id); 
        $query = $this->db->get(); 
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
		return "empty";
		}
    }
	
function search_document($id) {
       $query= $this->db->query(" SELECT * FROM `tbltrack` as a INNER JOIN detailtrack as b ON a.idtrack=b.idtrack WHERE `nomor_po` = '$id' AND       a.site='".$this->session->userdata('pettysite')."'  GROUP BY a.nomor_po");	
       return $query->result();
    }
	
function search_document_by_return($id) {
       $query= $this->db->query(" SELECT * FROM `tbltrack` as a  WHERE `nomor_po` = '$id' AND       a.site='".$this->session->userdata('pettysite')."' AND a.status='2'  GROUP BY a.nomor_po");	
       return $query->result();
    }	
function search_detail_document($id,$b) {
       $query= $this->db->query(" SELECT * FROM `tbltrack` as a INNER JOIN detailtrack as b ON a.idtrack=b.idtrack WHERE a.`idtrack` = '$id' and       noresi='$b' GROUP BY a.idtrack");	
       return $query->result();
    }

function trace_data1($a,$id) {
		if($a=='NOPO') {
		 $c="nomor_po= '$id'";	
		} elseif($a=='NOREF') {
		 $c="noref= '$id'";		
		} elseif ($a=='NORESI') {
		 $c="noresi= '$id'";		
		}
       $query= $this->db->query("SELECT a.*, b.noresi  FROM (select * from `tbltrack` ORDER BY idtrack ASC) a  INNER  JOIN detailtrack b ON a.idtrack=b.idtrack WHERE  $c  GROUP BY nomor_po ORDER BY a.idtrack DESC");	
       return $query->result();
    }
		
function trace_data2($id,$b) {
       $query= $this->db->query("SELECT *,DATE(a.tglpost) as tglpost FROM `tbltrack` as a  INNER JOIN detailtrack as b ON a.idtrack=b.idtrack  INNER JOIN tbluser c ON b.iduser=c.iduser WHERE a.`nomor_po` = '$id' and b.idtrack='$b'  GROUP BY b.idtrack");	
       return $query->result();
    }
	
function get_profile() {
        $this->db->from('users');
        $this->db->where('id_user',$this->session->userdata('pettyiduser')); 
        $query = $this->db->get();
        return $query->result();
    }
	
    function post_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
 
   function post_order($data){
       $this->db->insert('tbltrack', $data);
       return TRUE;
    }
	
	 function post_order_detail($data){
       $this->db->insert('detailtrack', $data);
       return TRUE;
    }
	
 function update_header_text($data,$id) { 
        $this->db->where($id);
        $this->db->update('tbltrack', $data); 
        return TRUE;
    }
 
 function update_unit($data,$id) {
 
        $this->db->where($id);
        $this->db->update('master_unit', $data);
 
        return TRUE;
    }
 
 
    function password_update($data,$id) {
 
        $this->db->where($id);
        $this->db->update('tbluser', $data);
 
        return TRUE;
    }
    function del_temp($id) {
        $this->db->where('idtemp', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
 
            return TRUE;
        }
        return FALSE;
    }
	
	function del_temp_order($id) {
        $this->db->where('userid', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
 
            return TRUE;
        }
        return FALSE;
    }
	
	 function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('request_po');
        $this->db->where('status','2');
        $this->db->order_by('idrequest','desc');
        if(array_key_exists('idrequest',$params) && !empty($params['idrequest'])){
            $this->db->where('idrequest',$params['idrequest']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }
	
	function getkodeunik($param=NULL) { 
	
          $query= $this->db->query("SELECT MAX(`idtrack`) AS ID  FROM tbltrack"); // ambil data maximal dari id transaksi
       foreach ($query->result_array() as $dataMax): endforeach;
        if($dataMax['ID']=='') { // bila data kosong
            $ID = $param."00001";
        }else {
            $MaksID = $dataMax['ID'];
            $MaksID++;
            if($MaksID < 10) $ID = $param."0000".$MaksID; // nilai kurang dari 10
            else if($MaksID < 100) $ID = $param."000".$MaksID; // nilai kurang dari 100
            else if($MaksID < 1000) $ID = $param."00".$MaksID; // nilai kurang dari 1000
            else if($MaksID < 10000) $ID = $param."0".$MaksID; // nilai kurang dari 10000
            else $ID = $MaksID; // lebih dari 10000
        }

        return $ID;
   }  

}
?>