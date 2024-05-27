<?php
/**
 * Description of calendar
 *
 * @author Chaminda
 */
class Settings extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        

        $this->load->model('user_model');
           $this->load->model('calendar_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_fullname_dropdown();
        $this->menu_lib->get_active_menu(17);
        if($this->uri->segment(3)){
            $user_id = $data['user_id'] = $this->uri->segment(3);
        }else{
            $user_id = $this->session->userdata('user_id');
        }
//        $user_id = $data['user_id'] = $this->uri->segment(3);
        $data['calendar_activities']=  $this->calendar_model->get_activities($user_id);
//        $data['calendar_activities']=  $this->calendar_model->get_activities();
         
        $data['title'] = "Calendar";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('settings/my_settings', $data);
        $this->load->view('layout/footer', $data);
    }

    public function profile() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_fullname_dropdown();
        $this->menu_lib->get_active_menu('');
        $user_id = $this->session->userdata('user_id');
        $data['my_profile'] = $this->user_model->get_user_detail($user_id);
         
        $data['title'] = "My Profile";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('settings/my_profile', $data);
        $this->load->view('layout/footer', $data);
    }

    public function edit_profile() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_fullname_dropdown();
        $this->menu_lib->get_active_menu('');
        $user_id = $this->session->userdata('user_id');
        $data['my_profile'] = $this->user_model->get_user_detail($user_id);
         
        $data['title'] = "My Profile";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('settings/edit_profile', $data);
        $this->load->view('layout/footer', $data);
    }

    public function change_password() {
        $data['user'] = $this->session->userdata('first_name');
        $data['users'] = $this->user_model->get_user_fullname_dropdown();
        $this->menu_lib->get_active_menu('');
        $user_id = $this->session->userdata('user_id');
        $data['my_profile'] = $this->user_model->get_user_detail($user_id);
         
        $data['title'] = "My Profile";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('settings/change_password', $data);
        $this->load->view('layout/footer', $data);
    }

    public function updateUser() {
        if ($this->user_model->updateUser()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function updatePassword() {
        if ($this->user_model->updatePassword()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

}
