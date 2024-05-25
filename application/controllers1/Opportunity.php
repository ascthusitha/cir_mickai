<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Task Details
 *
 * @author Thusitha
 */
class Opportunity extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('opportunity_model');
        $this->load->model('scheduling_model');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('contact_model');
        $this->load->model('market_model');
        $this->load->model('country_model');
        $this->load->model('task_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['opportunities'] = $this->opportunity_model->get_opportunities();
        $this->menu_lib->get_active_menu(8,15);
        $data['title'] = "Opportunity list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('opportunity/opportunity_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();

        $data['sales_stages'] = $this->scheduling_model->get_sales_stages();
        $data['lead_sources'] = $this->scheduling_model->get_lead_sources();
        $data['products'] = $this->scheduling_model->get_products();

        $this->menu_lib->get_active_menu(8,16);
        $data['title'] = "Opportunity";
        $data['title1'] = "Opportunity schedule";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('opportunity/opportunity_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save(){
        if($this->opportunity_model->add_opportunity()){
            echo  'success';
        }else{
            echo 'error';
        }
    }

    public function view($opp_id){
        //load view
        // $this->output->enable_profiler(TRUE);
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['title'] = "Opportunity";
        $data['title1'] = "Opportunity View";
               
         $data['opportunity']=  $this->opportunity_model->get_opportunity($opp_id);
         $data['contacts'] = $this->contact_model->get_contact_dropdown_by_acc($data['opportunity']['acc_id']);

         $data['sales_stages'] = $this->scheduling_model->get_sales_stages();
         $data['lead_sources'] = $this->scheduling_model->get_lead_sources();
         $data['products'] = $this->scheduling_model->get_products();
          
         $data['btn_value']='Update';
        
         $this->load->view('layout/header', $data);
         $this->load->view('layout/menu_bar');
         $this->load->view('opportunity/opportunity_add',$data);
         $this->load->view('layout/footer', $data);    
    }
     
    function delete() {
        $id = $_POST['opp_id'];
        if ($this->opportunity_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}
