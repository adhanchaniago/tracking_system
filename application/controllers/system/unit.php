<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {
 public function __construct() {
 	    parent::__construct();
       $this->load->library(array('session','pagination','PHPMailerAutoload','PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('url','mylibrary','download');
		$this->load->model(array('model_unit','model_order'));
    	
 }

public function index()
    {
    	$data['unit']= $this->model_unit->get_allunit();
        $data['main']='system_view/data_unit';
        $this->load->view('system_view/front_layout',$data);
    }
	
public function update($id)
    {
    	$data['unit']= $this->model_unit->get_unit_byid($id);
        $data['main']='system_view/update_unit';
        $this->load->view('system_view/front_layout',$data);
    }

 public function addnew($id)
    {
	 if(isset($_POST['save'])) {
	 $data=array (
	 'nopol' =>$this->input->post('nopol'),
	 'type' =>$this->input->post('type'),
	 'branch'=> $this->session->userdata('pettycabang')
	 );	
	 $this->db->insert('unit',$data); 	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data unit telah disimpan </div><br>');      
     redirect('index.php/system/unit');
	 }
   }
   
   public function update_proccess($id)
    {
	 if(isset($_POST['update'])) {
	 $data=array (
	 'type' =>$this->input->post('type')
	 );	
	 $this->db->where('nopol', $this->input->post('nopol'));
     $this->db->update('unit',$data);	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data unit has been update</div><br>');      
     redirect('index.php/system/unit');
	 }
   }
   
public function delete($id)
    {
	 $this->model_unit->del_unit($id);    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data unit telah dihapus </div><br>');      
     redirect('index.php/system/unit');
	}
public function upload()
    {
        $data['main']='system_view/upload_unit';
        $this->load->view('system_view/front_layout',$data);
    }

   public function do_upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './berkas/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
             
        $media = $this->upload->data();
        $inputFileName = './berkas/'.$media['file_name'];
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "nopol"=> $rowData[0][0],
                    "type"=> $rowData[0][1],
					"branch"=> $this->session->userdata('pettycabang')
                );
                 
                //sesuaikan nama dengan nama tabel
                $insert_query = $this->db->insert_string("unit",$data);                
                $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
                $this->db->query($insert_query);
               // delete_files($media['file_path']);
                     
            }
            $this->session->set_flashdata('sukses','<div class="sukses"> Import data has been upload</div><br>');            
            redirect('index.php/system/unit/upload');
    }



}