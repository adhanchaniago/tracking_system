<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_saldo extends CI_Model {
 
    var $tabel = 'users'; //variabel tabel
 
    function __construct() {
        parent::__construct();
    }
	
    function get_allsaldo() {
        $this->db->from($this->tabel);
		$this->db->where('level','rmo');
		$this->db->order_by('nama','asc');
        $query = $this->db->get();
		return $query->result();
        
    }
	
	function get_saldo_outstanding() {	  
        $this->db->select('saldo AS amount', FALSE);
        $this->db->from('saldorental');
		$this->db->where('idsaldo','1');
        $query = $this->db->get();
 
        //cek apakah ada ba
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
	
function pending_budget() {	  
        $this->db->select('saldo_outstanding,nama', FALSE);
        $this->db->from('users');
		$this->db->where('level','rmo');
        $query = $this->db->get();
 		return $query->result();
        //cek apakah ada ba
       
    }

function get_user() {	  
        $this->db->select('id_user,nama,saldo_outstanding', FALSE);
        $this->db->from('users');
		$this->db->where('level','rmo');
		$this->db->order_by('nama','asc');
        $query = $this->db->get();
 		return $query->result();
        //cek apakah ada ba
       
    }
	
function get_petty_cash() {
       $query=$this->db->query("select t.nama as NAMA_USER,t.saldo AS SALDO, sum(if(t.status >='3' and t.status<='4', t.jumlah, 0)) as PENDINGCLAIM, sum(if(t.status = '5', t.jumlah_selesai, 0)) as ACTUALCLAIM, t.saldo_outstanding as SISASALDO,sum(if(t.status >='1' and t.status<='2', t.jumlah, 0)) as total_request, (t.saldo_outstanding - sum(if(t.status >='1' and t.status<='2', t.jumlah, 0))) as REQUEST from ( select c.nama, r.jumlah_selesai,r.idclaim,c.saldo,r.jumlah,r.status,c.id_user,c.level,c.saldo_outstanding from users c left join trx_claim r on c.id_user = r.id_user )t where t.level='rmo' group by t.id_user order by t.nama;");	      
        return $query->result();
		        //cek apakah ada ba       
    }
	

	
	function get_sisa_actual($id) {
       $query=$this->db->query("select t.nama as NAMA_USER,t.saldo AS SALDO,t.sisa,sum(if(t.status >='1' and t.status<='2', t.jumlah, 0)) as total_request, (t.sisa - sum(if(t.status >='1' and t.status<='2', t.jumlah, 0))) as REQUEST from ( select c.nama, r.jumlah_selesai,r.idclaim,c.saldo,r.jumlah,r.status,c.id_user,c.level,c.saldo_outstanding as sisa from users c left join trx_claim r on c.id_user = r.id_user )t where t.level='rmo' and t.id_user='$id' group by t.id_user order by t.nama;",FALSE);	      
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
			return false;
		}
	 
        //cek apakah ada ba
      }
	
function get_actual_budget() {	  
        $this->db->select('sum(jumlah_selesai) as budget_actual', FALSE);
        $this->db->from('trx_claim');
		$this->db->where('YEAR(tglrequest) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)');
		$this->db->where('MONTH(tglrequest) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)');
		$this->db->where('status','5');
        $query = $this->db->get();
 		return $query->result();
        //cek apakah ada ba

    }
 
function get_last_month($id) {	 
		$year=substr($id,0,4); 
		$month=substr($id,5,2);
        $this->db->select('no_booking,customer,tglrequest,nama,jumlah_selesai,jumlah,idclaim', FALSE);
        $this->db->from('trx_claim a');
		$this->db->join('users b', 'a.id_user = b.id_user');
		$this->db->where('YEAR(tglrequest)',$year);
		$this->db->where('MONTH(tglrequest)',$month);
        $query = $this->db->get();
 		return $query->result();
        //cek apakah ada ba
       
    }
function get_allsaldo_permo($id) {
        $this->db->from($this->tabel);
        $this->db->where('id_user', $id);
 
        $query = $this->db->get();
 
        if ($query->num_rows() == 1) {
            return $query->result();
        }
    }
 
    function get_insert($data){
       $this->db->insert($this->tabel, $data);
       return TRUE;
    }
 
   function get_update($id,$data) {
 
        $this->db->where('nopol', $id);
        $this->db->update($this->tabel, $data);
 
        return TRUE;
    }
    function del_unit($id) {
        $this->db->where('nopol', $id);
        $this->db->delete($this->tabel);
        if ($this->db->affected_rows() == 1) {
 
            return TRUE;
        }
        return FALSE;
    }
}
?>