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
class Dashboard extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        #$this->load->model('calendar_model');
        #$this->load->model('user_model');
        $this->load->library('Menu_Lib');
        $this->load->library('Dash_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $user_id = $this->session->userdata('user_id');
//        $data['dash'] = $this->dash_lib->get_default_dashboard($user_id);
        $data['dash'] = $this->dash_lib->get_default_dashboard();
        $this->menu_lib->get_active_menu(1);
        $data['title'] = "Admin Dashbord";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('dashboard/admin_dashboard', $data);
        $this->load->view('layout/footer', $data);
    }
}