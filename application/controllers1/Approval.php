<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of approval
 *
 * @author Thusitha
 */
class Approval  extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('price_model');
        $this->load->model('approval_model');
        $this->load->model('supplier_model');
        $this->load->model('item_model');
        $this->load->model('category_model');
    }
    
    public function index(){
        $data['app_lists'] = $this->approval_model->get_app_out_details();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Approval";
        $this->load->view('layout/header', $data);
       $this->load->view('layout/menu_bar');
        $this->load->view('approval/app_out_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add(){
        $data['user'] = $this->session->userdata('first_name');
        $data['app_code'] = $this->code_generation_m->getCode('APP');
        $data['title'] = "Approval Out";
        $data['btn_value']='add';
        $data['items']=$this->item_model->get_item_dropdown();
        $data['suppliers']=$this->supplier_model->get_supplier_dropdown();
         $data['auto_num'] = $this->code_generation_m->getAutoNum();
        $data['categories']=$this->category_model->get_category_dropdown();
         $data['item_lists']=$this->price_model->get_price_json();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('approval/app_out',$data);
        $this->load->view('layout/footer', $data);
    }
    public function save_app_item_tmp(){
        $auto_id=$_POST['auto_num'];
        $status=$this->approval_model->add_app_item_tmp();
        if ($status) {
            
            echo $this->load_current_tmp_app($auto_id);     
        } else {
            echo 'error';
        }
    }
    public function load_current_tmp_app($auto_id) {
        $data['app_items']= $this->approval_model->get_tmp_item_detail($auto_id);
        $this->load->view('approval/app_grid', $data,FALSE);
    }
    public function save_app(){
        
        $status=$this->approval_model->add_app();
        if ($status) {
            
            echo 'success';     
        } else {
            echo 'error';
        }
        }
    public function delete_tmp(){
        $tmp_id=$_POST['tmp_id'];
        $auto_id=$_POST['auto_id'];
        $status=$this->approval_model->delete_app_tmp($tmp_id);
        if ($status) {
            echo $this->load_current_tmp_app($auto_id); 
        } else {
            echo $status;
        }
    

} 
public function app_view($app_id){
        
        $data['user'] = $this->session->userdata('first_name');
        $data['approval']=$this->approval_model->get_app_out_details($app_id);
        $data['app_items']=$this->approval_model->get_app_item_details($app_id);

        $data['title'] = "Approval View";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('approval/app_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public  function save_approval(){
        if($this->approval_model->confirm_approval_in()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
    }
}