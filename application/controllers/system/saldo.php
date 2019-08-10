<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo extends CI_Controller {
 public function __construct() {
 	    parent::__construct();
       $this->load->library(array('session','pagination','PHPMailerAutoload','PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('url','mylibrary','download');
		$this->load->model(array('model_saldo','model_order'));
    	
 }

public function index()
    {
    	$data['saldo']= $this->model_saldo->get_allsaldo();
		$data['outstanding']= $this->model_saldo->get_saldo_outstanding();
		$data['users']= $this->model_saldo->get_user();
		$data['actual']= $this->model_saldo->get_actual_budget();
        $data['main']='system_view/saldo_admin';
        $this->load->view('system_view/front_layout',$data);
    }
	
public function pending()
    {
    	$data['pending']= $this->model_saldo->pending_budget();	
        $data['main']='system_view/budget_pending';
        $this->load->view('system_view/front_layout',$data);
    }
	
public function actual_last_month($id)
    {
    	$data['month']= $this->model_saldo->get_last_month($id);	
        $data['main']='system_view/budget_actual_last_month';
        $this->load->view('system_view/front_layout',$data);
    }
	
public function petty_cash()
	{	
		$data['data']=$this->model_saldo->get_petty_cash();	
		$data['main']='system_view/Petty_Cash_Flow';
		$this->load->view('system_view/front_layout',$data);
	}	

public function transfer_completed() {

				if(isset($_POST['submit'])) {
				
					$ID_att = $this->input->post('ID');
					$result = array();
					foreach ($ID_att AS $key => $val) { 
						$result[] = array(
				  "idclaim" => $ID_att[$key],
				  "status"  => '6'
					 );
					}
					$this->db->update_batch('trx_claim', $result, 'idclaim');
    				/*$data = array(					
					'status' => '6'
					);
					//Transfering data to table Request PO
					$id['md5(idclaim)'] = $role;  
					$save=$this->model_order->update_status_approved($data,$id); */
					$this->session->set_flashdata('sukses','<div class="sukses" alert-dismissible fade in" role="alert"> Berkas telah di claim <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button> </div> <br>');
					redirect('index.php/system/order/claim_document');	
					
					}					
				}	
public function top_up() {
    				$data = array(
					'logdate' => date('Y-m-d'),
					'total' => $this->input->post('jumlah'),
					'remarks'=> $this->input->post('remarks'),
					'id_user' => $this->input->post('iduser'),					
					'trx' => '3'
					);
					//Transfering data to table Request PO					
					$save=$this->db->insert('kreditdebit',$data);
					$this->session->set_flashdata('sukses','<div class="sukses" alert-dismissible fade in" role="alert"> Saldo  berhasil di Top Up <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button> </div>');
					redirect('index.php/system/saldo');	
		}
		
public function withdraw() {
    				$data = array(
					'logdate' => date('Y-m-d'),
					'id_user' => $this->input->post('iduser'),		
					'total' => $this->input->post('jumlah'),
					'remarks'=> $this->input->post('remarks'),					
					'trx' => '4'
					);
					//Transfering data to table Request PO					
					$save=$this->db->insert('kreditdebit',$data);
					$this->session->set_flashdata('sukses','<div class="sukses" alert-dismissible fade in" role="alert"> Saldo  berhasil di Withdraw <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button> </div>');
					redirect('index.php/system/saldo');	
		}
		
public function refund_budget() {
    				$data = array(
					'logdate' => date('Y-m-d'),
					'total' => $this->input->post('jumlah'),
					'id_user' => $this->input->post('iduser'),
					'remarks'=> $this->input->post('remarks'),					
					'trx' => '5'
					);
					//Transfering data to table Request PO					
					$save=$this->db->insert('kreditdebit',$data);
					$this->session->set_flashdata('sukses','<div class="sukses" alert-dismissible fade in" role="alert"> Refund dana berhasil diproses <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button> </div>');
					redirect('index.php/system/saldo');	
		}
				
}