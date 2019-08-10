<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class front_end extends CI_Controller {

 // SET SUPER GLOBAL
 var $CI = NULL;
 public function __construct() {
 	    parent::__construct();
        $this->load->library(array('session','pagination'));
		$this->load->helper('url');
		$this->load->model(array('model_order'));
    	$this->CI =& get_instance();

 }

// Load View Login
public function sign_in() {
		
		$b=$this->input->get('keywoard');
		$c=$this->input->get('traceby');
		$data['data']="";
		if(isset($b)) {
		$data['data']=$this->model_order->trace_data1($c,$b);
		} 
		$this->load->view('login_form',$data);
}


 // Fungsi login
 public function login() {
 $username = $this->input->post('username');
 $password = $this->input->post('password');
 $query = $this->db->get_where('tbluser',array('username'=>$username,'password' => md5($password)));
 if($query->num_rows() == 1) {
 $row = $this->CI->db->query("SELECT * FROM tbluser where username ='$username'");
 $admin = $row->row();
 $id = $admin->iduser;
 $this->CI->session->set_userdata('pettyusername', $admin->username);
 $this->CI->session->set_userdata('pettynama', strtoupper($admin->nama));
 $this->CI->session->set_userdata('pettylevel', $admin->level);
 $this->CI->session->set_userdata('pettysite', $admin->kode_site);
 $this->CI->session->set_userdata('pettyid_login', uniqid(rand()));
 $this->CI->session->set_userdata('pettyiduser', $id);
 redirect('index.php/system/dashboard');
 }else {
 $this->CI->session->set_flashdata('sukses','<div class="error">  Username atau password salah <button type=\'button\' class="close" data-dismiss="alert" aria-hidden=\'true\'><i class=\'fa fa-times-circle\'></i></button></div>');
 redirect('index.php/front_end/sign_in/false');
 }
 return false;
 }

 // Proteksi halaman
 public function cek_login() {
 if($this->session->userdata('iduser') == '') {
 $this->session->set_flashdata('sukses','Anda harus login terlebih dahulu');
 redirect('index.php/front_end/sign_in/false');
 }
 }
 // Fungsi logout
 public function logout() {
 $this->session->unset_userdata('pettyusername');
 $this->session->unset_userdata('pettynama');
 $this->session->unset_userdata('pettycabang');
 $this->session->unset_userdata('pettyid_login');
 $this->session->unset_userdata('pettyiduser');
 $this->session->unset_userdata('pettyatasnama');
 $this->session->unset_userdata('pettybank');
 $this->session->unset_userdata('pettynorek');
 $this->session->set_flashdata('sukses',' <div class="sukses">  Anda telah keluar dari sistem </div>');
 
 redirect('index.php/front_end/sign_in');
 }


}
