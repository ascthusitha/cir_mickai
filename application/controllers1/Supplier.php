<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of supplier
 *
 * @author Thusitha
 */
class Supplier extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        //load library
        $this->load->library(array('form_validation'));
        //load helper
        $this->load->helper('url');
        $this->load->model('supplier_model');
        $this->load->model('code_generation_m');
    }
    
    public function add(){
        
       // $this->output->enable_profiler(TRUE);
        $data['user'] = $this->session->userdata('first_name');
        $data['code'] = $this->code_generation_m->getCode('SUP');
        $data['supplier']=array("supplier_id"=>0,"supplier_image"=>0);
        
        $data['title'] = "Supplier";
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('supplier/supplier_add',$data);
        $this->load->view('layout/footer', $data);
    }
    public function view($supplier_id){
        //load view
       //$this->output->enable_profiler(TRUE);
        
        $data['user'] = $this->session->userdata('first_name');

        $data['code'] = $this->code_generation_m->getCode('SUP');
        
        $data['supplier']=  $this->supplier_model->get_supplier_detail($supplier_id);
        $data['title'] = "Supplier";
        $data['btn_value']='Update';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('supplier/supplier_add',$data);
        $this->load->view('layout/footer', $data);    
    }
    public function index(){
        //$this->output->enable_profiler(TRUE);
        $data['suppliers']=$this->supplier_model->get_supplier();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Supplier";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('supplier/supplier_list',$data);
        $this->load->view('layout/footer', $data);      
       
    }
    
    public function saveSupplier(){
      
        $supplier_code=$_POST['supplier_code'];
        $supplier_name=$_POST['supplier_name'];
        $address=$_POST['address'];
        $profile=$_POST['profile'];
        $credit_period=$_POST['credit_period'];
        $active_vat=$_POST['active_vat'];
        $tax_add=$_POST['tax_add'];//added td 2015-5-27
        $vat_reg_num=$_POST['vat_reg_num'];
        $email=$_POST['email'];
        $supplier_telephone=$_POST['supplier_telephone'];
        $supplier_mobile=$_POST['supplier_mobile'];
        $supplier_website=$_POST['supplier_website'];

        $supplier_id=$_POST['supplier_id'];
        $contact_name=$_POST['supplier_contact'];

        $image_name0 = $supplier_name;
        $image_name1 = '';
        $config['upload_path'] = './assets/img/supplier/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024 * 8;
        $this->load->library('upload', $config);
        for ($i=0; $i<2 ; $i++) {
            $file_element_name = 'userfile'.$i;
            $old_img=$_POST['old_img'.$i];
            if ($old_img != '' && !empty($_FILES['userfile'.$i]['name'])) {
                $filename = './assets/img/supplier/' . $old_img;

                if (file_exists($filename)) {
                    unlink($filename);
                }
            }

            if ($old_img != '' && empty($_FILES['userfile'.$i]['name'])) {
                ${'image_name'.$i} = $old_img;
            } else {
                $data = $this->upload->do_upload($file_element_name);
                ${'image_name'.$i} = $_FILES['userfile'.$i]['name'];
                @unlink($_FILES['userfile'.$i]);
            }
        }

        $file_id = $this->supplier_model->addSupplier(
            $image_name0,
            
            $supplier_code,
            $supplier_name,
            $address,
            $email,
            $supplier_telephone,
            $supplier_mobile,
            $supplier_website,
            
            $supplier_id,$contact_name)  ;
         if($file_id)
         {
           echo "success";
         }
         else
         {
            unlink($data['full_path']);
            echo "error";
         }
    }
    
    function delete($id){
        //$this->output->enable_profiler(TRUE);
        $this->supplier_model->deleteSupplier($id);
        // redirect to agency list page
        redirect('supplier/listing/','refresh');
    }
    //upload goes here
    function upload($file_element_name)
	{
        
		$config['upload_path'] = './assets/img/upload/supplier';
      $config['allowed_types'] = 'gif|jpg|png|doc|txt';
      $config['max_size']  = 1024 * 8;
      $config['encrypt_name'] =false;
 
      $this->load->library('upload', $config);
 
      if (!$this->upload->do_upload($file_element_name))
      {
         $status = 'error';
         $msg = $this->upload->display_errors('', '');
      }
      else
      {
         $data = $this->upload->data();
         return $data;
      }
	}

    
}

?>
