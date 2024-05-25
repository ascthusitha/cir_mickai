<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales Call
 *
 * @author Thusitha
 */
class Sales_call extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('sales_call_model');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('contact_model');
        $this->load->model('market_model');
        $this->load->model('country_model');
        $this->load->model('product_model');
        $this->load->library('Menu_Lib');
    }
    public function index() {
           $data['user'] = $this->session->userdata('first_name');
        $data['sales_call'] = $this->sales_call_model->get_sales_call();
        $data['users'] = $this->user_model->get_user_dropdown();
        $this->menu_lib->get_active_menu(8,11);
        $data['title'] = "Meeting list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('sales_call/sales_call_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add() {
           $data['user'] = $this->session->userdata('first_name');
 $data['products'] = $this->product_model->get_product_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['contacts'] = $this->contact_model->get_contact_dropdown();
        $this->menu_lib->get_active_menu(8,12);
        $data['title'] = "Meeting";
        $data['title1'] = "Meeting schedule";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('sales_call/sales_call_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
   		
                    if($this->sales_call_model->add_sales_call()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
		
}
 public function view($sc_id){
//         //load view
//       // $this->output->enable_profiler(TRUE);

              
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['contacts'] = $this->contact_model->get_contact_dropdown();
        $data['title'] = "Meeting";
        $data['title1'] = "Meeting View";
           $data['products'] = $this->product_model->get_product_dropdown();     
         $data['sales_call']=  $this->sales_call_model->get_sales_call_detail($sc_id);
         
         $data['btn_value']='Update';
        
         $this->load->view('layout/header', $data);
         $this->load->view('layout/menu_bar');
         $this->load->view('sales_call/sales_call_add',$data);
         $this->load->view('layout/footer', $data);    
     }
     
         function delete() {
        $id = $_POST['sc_id'];
  
        if ($this->sales_call_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }
}
