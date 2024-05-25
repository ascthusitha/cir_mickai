<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendar
 *
 * @author Thusitha
 */
class Calendar extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('calendar_model');

        $this->load->model('user_model');
        $this->load->model('calendar_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_dropdown();
        $this->menu_lib->get_active_menu(17);
        if($this->uri->segment(3)){
            $user_id = $data['user_id'] = $this->uri->segment(3);
        }else{
            $user_id = $this->session->userdata('user_id');
        }
        $user_id = $data['user_id'] = $this->uri->segment(3);
        $data['calendar_activities']=  $this->calendar_model->get_activities($user_id);
         
        $data['title'] = "Calendar";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('calendar/calendar_list', $data);
        $this->load->view('layout/footer', $data);
    }

    
}
