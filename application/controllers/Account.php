<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Account
 *
 * @author Thusitha
 */
class Account extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('account_model');
        $this->load->model('user_model');
        $this->load->model('region_model');
        $this->load->model('market_model');
        $this->load->model('country_model');
        $this->load->library('Menu_Lib');
    }
    public function index() {
           $data['user'] = $this->session->userdata('first_name');
        $data['account'] = $this->account_model->get_account();
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['regions'] = $this->region_model->get_region_dropdown();
        $data['markets'] = $this->market_model->get_market_dropdown();
        $this->menu_lib->get_active_menu(21,22);
        $data['title'] = "Account list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('account/account_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add() {
           $data['user'] = $this->session->userdata('first_name');
       $data['regions'] = $this->region_model->get_region_dropdown();
        $data['markets'] = $this->market_model->get_market_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['countries'] = $this->country_model->get_country_dropdown();
        $this->menu_lib->get_active_menu(21,23);
        $data['title'] = "Account";
        $data['title1'] = "Account Add";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('account/account_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
   		
                    if($this->account_model->addAccount()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
		
}
    public function quick_save(){
        $name=$_POST['account_name'];
   		$response = array();
   		$id=$this->account_model->addQAccount();
   
                    if($id>0){
                       $response['msg']='success';
                       $response['id']=$id;
                       $response['name']=$name;
                    }else{
                       $response['msg']='error';
                       $response['id']=0;
                       $response['name']='';
                    }
                    echo json_encode($response);
		
}
 public function view($acc_id){
//         //load view
//       // $this->output->enable_profiler(TRUE);

               $data['regions'] = $this->region_model->get_region_dropdown();
        $data['markets'] = $this->market_model->get_market_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['countries'] = $this->country_model->get_country_dropdown();
        $data['title'] = "Account";
        $data['title1'] = "Account View";
               
         $data['account']=  $this->account_model->get_account_detail($acc_id);
         
         $data['btn_value']='Update';
        
         $this->load->view('layout/header', $data);
         $this->load->view('layout/menu_bar');
         $this->load->view('account/account_add',$data);
         $this->load->view('layout/footer', $data);    
     }
     
         function delete() {
        $id = $_POST['acc_id'];
  
        if ($this->account_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }
}
