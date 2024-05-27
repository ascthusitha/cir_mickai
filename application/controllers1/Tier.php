<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of tier
 *
 * @author Thusitha
 */
class Tier extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('tier_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['tiers'] = $this->tier_model->get_tier();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Tier";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('tier/tier_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['tier'] = array("tier_id" => 0);

        $data['title'] = "Tier Add";
        $data['link_back'] = anchor('tier/listing/', 'Back to list of tier Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('tier/tier_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('tier_name', 'tier Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->tier_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['tier'] = $this->tier_model->get_detail($id);
        $data['title'] = "Tier";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('tier/listing/', 'Back to list of tier', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('tier/tier_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['tier_id'];
        $status = $this->tier_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file tier.php */
/* Location: ./application/controllers/tier.php */
?>