<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 public function __construct() {
 	    parent::__construct();
        $this->load->library(array('session','pagination'));
		$this->load->helper('url');
		$this->load->model(array('model_order','model_saldo'));
    	

 }
	public function index() 
	{
		
	/*    $data['chart_pending']=$this->model_order->get_chart_outstanding();
		$data['budget_pending']=$this->model_order->chart_pending_budget();
		$data['chart_user']=$this->model_order->get_chart_type_budget();
		$data['chart_sepo']=$this->model_order->get_chart_sepo();		
		$data['saldo']= $this->model_saldo->get_allsaldo_permo($this->session->userdata('pettyiduser'));
		$data['sisasaldo']= $this->model_saldo->get_sisa_actual($this->session->userdata('pettyiduser'));
		$data['outstanding']= $this->model_saldo->get_saldo_outstanding();		
		$data['actual']= $this->model_saldo->get_actual_budget();
		$data['data_pending']=$this->model_order->get_allrequest_dashboard(); */
		$data['breadcrumb']="";
		$data['sum_daily']=$this->model_order->get_sum_daily();
		$data['sum_shipment']=$this->model_order->get_sum_shipment();
		$data['sum_return']=$this->model_order->get_sum_return();
		$data['main']='system_view/dashboard_second';
		$this->load->view('system_view/front_layout',$data);
	}
	
	public function change_password()
	{	
		$data['breadcrumb']="Change Password";
		$data['main']='system_view/change_password';
		$this->load->view('system_view/front_layout',$data);
	}
	
public function profile()
	{
	    $data['data']= $this->model_order->get_profile();	
		$data['main']='system_view/view_profile';
		$this->load->view('system_view/front_layout',$data);
	}

public function action_update() {
					$data = array(
						
					'username' => $this->input->post('username'),	
					'nama' => $this->input->post('nama'),	
					'email' => $this->input->post('email'),		
					'atasnama' => $this->input->post('atasnama'),
					'bank' => $this->input->post('bank'),
					'norek' => $this->input->post('norek')
					);
					//Transfering data to table Request PO
					$id['id_user'] = $this->session->userdata('pettyiduser'); 
					$save=$this->model_order->password_update($data,$id);
					$this->session->set_flashdata('sukses','<div class="sukses"> Profil anda telah diperbarui<button type=\'button\' class="close" data-dismiss="alert" aria-hidden=\'true\'><i class=\'fa fa-times-circle\'></i></button></div> <br>');
				
             redirect('index.php/system/dashboard/profile');
	}	
					
function process_change_password (){
        // $this->load->library('encrypt');
         $pwdold=$this->input->post('oldPass');
         $pwd1=$this->input->post('newPass1');
         $pwd2=$this->input->post('newPass2');

         $xy=$this->model_order->get_user($this->session->userdata('pettyiduser'));
         foreach ($xy as $row) {
            
            if($row->password!=md5($pwdold)) {
                $this->session->set_flashdata('sukses','<div class="error"> Password lama anda salah<button type=\'button\' class="close" data-dismiss="alert" aria-hidden=\'true\'><i class=\'fa fa-times-circle\'></i></button></div> <br>');
                redirect('index.php/system/dashboard/change_password');
            }
            elseif ($pwd1!=$pwd2) {
                $this->session->set_flashdata('sukses','<div class="error"> Konfirmasi password baru anda salah <button type=\'button\' class="close" data-dismiss="alert" aria-hidden=\'true\'><i class=\'fa fa-times-circle\'></i></button></div> <br>');
               redirect('index.php/system/dashboard/change_password');

            }
            else {
                $x = array(
            'password'  =>md5($pwd2)
                );

            $id['iduser'] = $this->session->userdata('pettyiduser');  

                $y=$this->model_order->password_update($x,$id);
                
                $this->session->set_flashdata('sukses','<div class="sukses"> Perubahan password anda telah disimpan<button type=\'button\' class="close" data-dismiss="alert" aria-hidden=\'true\'><i class=\'fa fa-times-circle\'></i></button></div> <br>');
				
             redirect('index.php/front_end/logout');
                
            }
         }


}

}
