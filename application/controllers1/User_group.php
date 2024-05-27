<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of usergroup
 *
 * @author Thusitha
 */
class User_group extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('user_group_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['user_groups'] = $this->user_group_model->get_user_group();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $this->menu_lib->get_active_menu(2,4);
        $data['title'] = "User Group";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('user_group/user_group_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['user_group'] = array("user_group_id" => 0);

        $data['title'] = "User Group Add";
        $data['link_back'] = anchor('user_group/listing/', 'Back to list of user group', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('user_group/user_group_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function saveGroup() {
        $this->form_validation->set_rules('u_group', 'User Group Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->user_group_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['user_group'] = $this->user_group_model->get_detail($id);
        $data['title'] = "User Group";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('user_group/listing/', 'Back to list of user group', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('user_group/user_group_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['user_group_id'];
        $status = $this->user_group_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file user_group.php */
/* Location: ./application/controllers/user_group.php */
?>