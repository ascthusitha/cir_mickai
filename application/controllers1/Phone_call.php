<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Doctor Appointment
 *
 * @author Thusitha
 */
class Phone_call extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('phone_call_model');
        $this->load->model('scheduling_model');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('contact_model');
        $this->load->model('market_model');
        $this->load->model('country_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['phone_call'] = $this->phone_call_model->get_phone_call();
        $data['users'] = $this->user_model->get_user_dropdown();
        $this->menu_lib->get_active_menu(8,9);
        $data['title'] = "Doctor Appointment list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('phone_call/phone_call_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {
        $data['user'] = $this->session->userdata('first_name');

        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();

        $data['subjects'] = $this->scheduling_model->get_subjects(1);
        $data['stats'] = $this->scheduling_model->get_stats(1);
        $data['sales_stages'] = $this->scheduling_model->get_sales_stages();
        $data['lead_sources'] = $this->scheduling_model->get_lead_sources();
        $data['products'] = $this->scheduling_model->get_products();

        $this->menu_lib->get_active_menu(8,10);
        $data['title'] = "Doctor Appointment";
        $data['title1'] = "Doctor Appointment schedule";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('phone_call/phone_call_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save(){
        if($this->phone_call_model->add_phone_call()){
            echo  'success';
        }else{
            echo 'error';
        }
    }

    public function view($pc_id){
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();

        $data['title'] = "Doctor Appointment";
        $data['title1'] = "Doctor Appointment View";
               
        $data['phone_call']=  $this->phone_call_model->get_phone_call_detail($pc_id);
        $data['contacts'] = $this->contact_model->get_contact_dropdown_by_acc($data['phone_call']['acc_id']);
         
        $data['subjects'] = $this->scheduling_model->get_subjects(1);
        $data['stats'] = $this->scheduling_model->get_stats(1);
        $data['sales_stages'] = $this->scheduling_model->get_sales_stages();
        $data['lead_sources'] = $this->scheduling_model->get_lead_sources();
        $data['products'] = $this->scheduling_model->get_products();

        $data['btn_value']='Update';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('phone_call/phone_call_add',$data);
        $this->load->view('layout/footer', $data);    
    }
     
    function delete() {
        $id = $_POST['pc_id'];
        if ($this->phone_call_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}
