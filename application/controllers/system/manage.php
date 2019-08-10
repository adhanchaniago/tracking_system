<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {
 public function __construct() {
 	    parent::__construct();
		error_reporting(0);
       $this->load->library(array('session','pagination','PHPMailerAutoload','PHPExcel','PHPExcel/IOFactory'));
		$this->load->helper('url','mylibrary','download');
		$this->load->model(array('model_manage','model_order'));
    	
 }

// EDIT AND SAVE SET MAIL

public function view_mail()
    {
		$data['breadcrumb']="Push Mail";
    	$data['unit']= $this->model_manage->get_all_mail();
        $data['main']='system_view/data_mail';
        $this->load->view('system_view/front_layout',$data);
    }
	
	
	
public function update_mail($id)
    {
		$data['breadcrumb']="Update Mail";
    	$data['unit']= $this->model_manage->Get_ID_PUSH($id);
        $data['main']='system_view/update_mail';
        $this->load->view('system_view/front_layout',$data);
    }


public function new_set_mail()
    {
	 if(isset($_POST['save'])) {
	 $data=array (
	 'nama' =>$this->input->post('nama'),
	 'email' =>$this->input->post('email'),
	 'setMail' =>$this->input->post('setmail'),
	 'kode_site' =>$this->input->post('kode')
	 );	
	 $this->db->insert('PushMail',$data); 	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Setting Email Telah Ditambahkan </div><br>');      
	 redirect('index.php/system/manage/view_mail');
	 
	 }
   }
  
   
   public function edit_save()
    {
	 if(isset($_POST['update'])) {
	 $data=array (
	 'nama' =>$this->input->post('nama'),
	 'email' =>$this->input->post('email'),
	 'setMail' =>$this->input->post('setmail'),
	 'kode_site' =>$this->input->post('kode')
	 );	
	 $this->db->where('idpush', $this->input->post('idpush'));
     $this->db->update('PushMail',$data);	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Set Mail Telah Diupdate</div><br>');      
     redirect('index.php/system/manage/view_mail');
	 }
   }
   
public function delete_mail($id)
    {
	 $this->model_manage->del_set_mail($id);    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data Telah Dihapus </div><br>');      
     redirect('index.php/system/manage/view_mail');
	}
	
// EDIT AND SAVE USER 
	

public function view_user()
    {
		$data['breadcrumb']="User Data";
    	$data['unit']= $this->model_manage->get_user();
        $data['main']='system_view/data_user';
        $this->load->view('system_view/front_layout',$data);
    }

public function update_user($id)
    {
		$data['breadcrumb']="Update User";
    	$data['unit']= $this->model_manage->Get_iduser($id);
        $data['main']='system_view/update_user';
        $this->load->view('system_view/front_layout',$data);
    }
	

public function new_user()
    {
	 if(isset($_POST['save'])) {
	 $data=array (
	 'nama' =>$this->input->post('nama'),
	 'kode_site' =>$this->input->post('kode'),
	 'keterangan' =>$this->input->post('keterangan'),
	 'username' =>$this->input->post('username'),
	 'password' => md5($this->input->post('password'))
	 );	
	 $this->db->insert('tbluser',$data); 	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data User Telah Ditambahkan </div><br>');      
	 redirect('index.php/system/manage/view_user');
	 
	 }
   }
  
public function edit_save_user()
    {
	 if(isset($_POST['update'])) {
	 $data=array (
	 'nama' =>$this->input->post('nama'),
	 'kode_site' =>$this->input->post('kode'),
	 'keterangan' =>$this->input->post('keterangan'),
	 'username' =>$this->input->post('username'),
	 );	
	 $this->db->where('iduser', $this->input->post('iduser'));
     $this->db->update('tbluser',$data);	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Data User Telah Diupdate</div><br>');      
     redirect('index.php/system/manage/view_user');
	 }
   }
   

public function reset_password($id)
    {
	
	 $data=array (
	 'password' =>md5('123')
	 );	
	 $this->db->where('iduser', $id);
     $this->db->update('tbluser',$data);	    
	 $this->session->set_flashdata('sukses','<div class="sukses"> Password telah direset </div><br>');      
     redirect('index.php/system/manage/view_user');
	 
   }
      
// IMPORT EXCEL FILE
public function import_excel_file(){
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
                    "type"=> $rowData[0][1]
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