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
class Attendance extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('attendance_model');
        $this->load->model('user_model');
        $this->load->model('contact_model');
        
    }
    public function index() {
           $data['user'] = $this->session->userdata('first_name');
        $data['attendance'] = $this->attendance_model->get_attendance();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['title'] = "Attendance list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('attendance/attendance_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add() {
           $data['user'] = $this->session->userdata('first_name');
       $data['attendance'] = $this->attendance_model->get_attendance();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['contacts'] = $this->contact_model->get_contact_dropdown();
        $data['title'] = "Attendance";
        $data['title1'] = "Attendance Book";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('attendance/attendance_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
   		
                    if($this->attendance_model->addAttendance()){
                  
                       echo $this->get_attendance_list();
                    }else{
                       echo 'error';
                    }
		
}
public function get_attendance_list(){
    $data['attendance'] = $this->attendance_model->get_attendance();
    $this->load->view('attendance/attendance_list', $data);
}

public function update_attendace(){
    if($this->attendance_model->std_checkout()){
                  
                       echo $this->get_attendance_list();
                    }else{
                       echo 'error';
                    }
}
// public function view($company_id=1){
//         //load view
//       // $this->output->enable_profiler(TRUE);

//         $data['currencies'] = $this->currency_model->getCurrencyDropdown();     
//         $data['user'] = $this->session->userdata('first_name');
//         $data['countries'] = $this->country_model->get_country_dropdown();
               
//         $data['company']=  $this->company_model->get_company_detail($company_id);
//         $data['title'] = "Company";
//         $data['btn_value']='Update';
        
//         $this->load->view('layout/header', $data);
//         $this->load->view('layout/menu_bar');
//         $this->load->view('admin/company_add',$data);
//         $this->load->view('layout/footer', $data);    
//     }
}
