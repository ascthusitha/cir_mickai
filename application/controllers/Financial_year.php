<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Financial year
 *
 * @author Thusitha
 */
class Financial_year extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('fyear_model');
        $this->load->model('user_model');
        $this->load->library('Menu_Lib');
    }
    public function view() {
           $data['user'] = $this->session->userdata('first_name');
        $data['f_year'] = $this->fyear_model->get_fyear();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $this->menu_lib->get_active_menu(2,3);
        $data['title'] = "Financial Year ";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('fyear/fyear_view', $data);
        $this->load->view('layout/footer', $data);
    }
 
    public function save(){
   		
                    if($this->fyear_model->addFyear()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }

}
public function get_fyear(){
 $data['f_year'] = $this->fyear_model->get_fyear();
 echo json_encode($data);
        }

}
