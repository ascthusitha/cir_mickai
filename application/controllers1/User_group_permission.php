<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_group_permission
 *
 * @author Thusitha
 */
class User_group_permission extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //load library
        $this->load->library(array('form_validation'));
        //load helper
        $this->load->helper('url');

        $this->load->model('user_group_permission_model');
        $this->load->model('user_group_model');
        $this->load->library('Menu_Lib');
    }

    public function index($page = 0) {
        //$this->output->enable_profiler(TRUE);
        //load pagging lib
        $this->load->library('pagination');
        $config = array();
        $config["base_url"] = base_url() . "user_group_permission";
        $config["total_rows"] = $this->user_group_model->user_group_count();
        $this->menu_lib->get_active_menu(2,5);



        $data['user_groups'] = $this->user_group_model->get_user_group();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "User group permission";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_group_permission_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        // $this->output->enable_profiler(TRUE);
        $data['user'] = $this->session->userdata('first_name');
        $data['user_groups'] = $this->user_group_permission_model->get_user_group_dropdown();
        $data['user_group'] = array("user_group_id" => 0);

        $data['title'] = "User group permission";
        $data['link_back'] = anchor('agency/listing/', 'Back to list of Agency', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_group_permission_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($user_group_id) {
        //load view
        //$this->output->enable_profiler(TRUE);

        $data['user'] = $this->session->userdata('first_name');
        $data['user_groups'] = $this->user_group_permission_model->get_user_group_dropdown();
        $data['permission_categories'] = $this->user_group_permission_model->get_permission_categories();
        $data['permission_links'] = $this->user_group_permission_model->get_permission_links();

        $data['user_group_permission'] = $this->user_group_permission_model->get_user_group_permission_detail($user_group_id);
        $data['user_group_permissions'] = $this->user_group_permission_model->get_permission($user_group_id);
        $data['title'] = "User group permission";
        $data['btn_value'] = 'Update';

        //$this->load->view('layout/header', $data);
        // $this->load->view('layout/menu_bar');
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('admin/user_group_permission_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function saveUserGroupPermission() {
        if ($this->user_group_permission_model->addUserGroupPermission()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function saveEstUserGroupPermission() {

        //validation
        $this->form_validation->set_rules('estimates', 'estimates Details', 'trim');

        if ($this->form_validation->run() == FALSE) {

            $data['user'] = $this->session->userdata('first_name');
        } else {
            if ($this->user_group_permission_model->addUserGroupPermissionEstimation()) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    function delete($id) {
        //$this->output->enable_profiler(TRUE);
        $this->user_group_permission_model->deleteUserGroupPermission($id);
        // redirect to agency list page
        redirect('user_group_permission/listing/', 'refresh');
    }

    function load_user_permission($user_group) {
        $data = $this->user_group_permission_model->get_user_group_permission_detail($user_group);
        echo json_encode($data);
    }

}

?>
