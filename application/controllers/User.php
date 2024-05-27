<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //load library
        $this->load->library(array('form_validation'));
        //load helper
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('code_generation_m');
        $this->load->model('user_group_permission_model');
        $this->load->library('Menu_Lib');
    }

    public function index($page = 'login') {
        if (!file_exists("application/views/" . $page . ".php")) {
            // Whoops, we don't have a page for that!
            show_404();
        }
        $data['title'] = ucfirst($page);

        $this->load->view($page, $data);
    }

    public function listing() {

        $data['users'] = $this->user_model->get_user();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $this->menu_lib->get_active_menu(2,6);
        $data['title'] = "System User";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['user1'] = array("user_id" => 0,"user_group_id"=>0);
        $data['u_code'] = $this->code_generation_m->getCode('U');
        $data['title'] = "System User";
        $data['user_groups'] = $this->user_group_permission_model->get_user_group_dropdown();
        // $data['link_back'] = anchor('user/listing/','Back to list of Tour Operator',array('class'=>'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function saveUser() {

        if ($this->user_model->addUser()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function isUsernameExist($username, $user_id) {
        //$this->output->enable_profiler(TRUE);

        $is_exist = $this->user_model->isUsernameExist($username, $user_id);

        if ($is_exist) {
            $this->form_validation->set_message(
                    'isUsernameExist', 'Username is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }

    public function isEmailExist($email, $user_id) {
        //$this->output->enable_profiler(TRUE);
        $is_exist = $this->user_model->isEmailExist($email);

        if ($is_exist) {
            $this->form_validation->set_message(
                    'isEmailExist', 'Email is already exist.'
            );
            return false;
        } else {
            return true;
        }
    }

    public function delete() {
        $id = $_POST['user_id'];
        //$this->output->enable_profiler(TRUE);
        $status = $this->user_model->deleteUser($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

    public function view($user_id) {
        //load view
        //$this->output->enable_profiler(TRUE);

        $data['user'] = $this->session->userdata('first_name');

        $data['user1'] = $this->user_model->get_user_detail($user_id);
        $data['user_groups'] = $this->user_group_permission_model->get_user_group_dropdown();
        $data['btn_value'] = 'Update';
        $data['title'] = "System User";
        //$data['link_back'] = anchor('user/listing/','Back to list of User',array('class'=>'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function checkUserName() {
        if (isset($_POST["username"])) {
            $response = $this->isUsernameExist($_POST["username"], $_POST["userid"]);
            if ($response) {
                echo "Ok";
            } else {
                echo "No";
            }
        }
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
