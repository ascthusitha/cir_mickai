<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of currency
 *
 * @author Thusitha
 */
class Currency extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('currency_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['currencies'] = $this->currency_model->get_currency();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $this->menu_lib->get_active_menu(28,29);
        $data['title'] = "Currency";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('currency/currency_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['currency'] = array("currency_id" => 0);

        $data['title'] = "Currency Add";
        $data['link_back'] = anchor('currency/listing/', 'Back to list of Currency Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('currency/currency_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->currency_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['currency'] = $this->currency_model->get_detail($id);
        $data['title'] = "Currency";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('currency/listing/', 'Back to list of Currency', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('currency/currency_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['currency_id'];
        $status = $this->currency_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file currency.php */
/* Location: ./application/controllers/currency.php */
?>