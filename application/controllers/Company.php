<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of company
 *
 * @author Thusitha
 */
class Company extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('country_model');
        $this->load->model('company_model');
        $this->load->model('currency_model');
        $this->load->library('Menu_Lib');
    }
    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['countries'] = $this->country_model->get_country_dropdown();
        $data['currencies'] = $this->currency_model->get_currency_dropdown();
        $data['title'] = "Company";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/company_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function saveCompany(){
   		
                    if($this->company_model->addCompany()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
		
}
public function view($company_id=1){
        //load view
      // $this->output->enable_profiler(TRUE);

        $data['currencies'] = $this->currency_model->get_currency_dropdown();     
        $data['user'] = $this->session->userdata('first_name');
        $data['countries'] = $this->country_model->get_country_dropdown();
        $this->menu_lib->get_active_menu(28,31);
               
        $data['company']=  $this->company_model->get_company_detail($company_id);
        $data['title'] = "Company";
        $data['btn_value']='Update';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/company_add',$data);
        $this->load->view('layout/footer', $data);    
    }

    
}
