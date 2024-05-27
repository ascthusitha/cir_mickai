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
class Task_detail extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('task_detail_model');
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
        $data['tasks'] = $this->task_detail_model->get_task_detail_data();
        $this->menu_lib->get_active_menu(8,13);
        $data['title'] = "Alert/Reminder list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('task/task_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add() {
           $data['user'] = $this->session->userdata('first_name');

        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();
        
        $data['subjects'] = $this->scheduling_model->get_subjects(3);
        $data['stats'] = $this->scheduling_model->get_stats(3);
        $data['products'] = $this->scheduling_model->get_products();

        $this->menu_lib->get_active_menu(8,14);
        $data['title'] = "Alert/Reminder";
        $data['title1'] = "Alert/Reminder schedule";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('task/task_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
   		
                    if($this->task_detail_model->add_task_details()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
		
}
 public function view($td_id){
//         //load view
//       // $this->output->enable_profiler(TRUE);

              
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();

        $data['subjects'] = $this->scheduling_model->get_subjects(3);
        $data['stats'] = $this->scheduling_model->get_stats(3);
        $data['products'] = $this->scheduling_model->get_products();

        $data['title'] = "Alert/Reminder";
        $data['title1'] = "Alert/Reminder View";
               
         $data['task']=  $this->task_detail_model->get_task_detail($td_id);
         $data['contacts'] = $this->contact_model->get_contact_dropdown_by_acc($data['task']['acc_id']);
         
         $data['btn_value']='Update';
        
         $this->load->view('layout/header', $data);
         $this->load->view('layout/menu_bar');
         $this->load->view('task/task_add',$data);
         $this->load->view('layout/footer', $data);    
     }
     
         function delete() {
        $id = $_POST['td_id'];
  
        if ($this->task_detail_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }
}
