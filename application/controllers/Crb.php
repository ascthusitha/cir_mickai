<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of crb
 *
 * @author Thusitha
 */
class Crb extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('crb_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['crbies'] = $this->crb_model->get_crb();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "crb";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('crb/crb_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['crb'] = array("crb_id" => 0);

        $data['title'] = "crb Add";
        $data['link_back'] = anchor('crb/listing/', 'Back to list of crb Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('crb/crb_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('crb_name', 'crb Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->crb_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['crb'] = $this->crb_model->get_detail($id);
        $data['title'] = "crb";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('crb/listing/', 'Back to list of crb', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('crb/crb_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['crb_id'];
        $status = $this->crb_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file crb.php */
/* Location: ./application/controllers/crb.php */
?>