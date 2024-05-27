<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Sales_stage
 *
 * @author Thusitha
 */
class Sales_stage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('sales_stage_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['sales_stages'] = $this->sales_stage_model->get_sales_stage();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Sales stage";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('sales_stage/sales_stage_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['sales_stage'] = array("ss_id" => 0);

        $data['title'] = "Sales Stage Add";
        $data['link_back'] = anchor('sales_stage/listing/', 'Back to list of sales_stage Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('sales_stage/sales_stage_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('sales_stage', 'Sales stage ', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->sales_stage_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['sales_stage'] = $this->sales_stage_model->get_detail($id);
        $data['title'] = "Sales stage";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('sales_stage/listing/', 'Back to list of sales stage', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('sales_stage/sales_stage_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['ss_id'];
        $status = $this->sales_stage_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file sales_stage.php */
/* Location: ./application/controllers/sales_stage.php */
?>