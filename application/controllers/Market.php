<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of market
 *
 * @author Chaminda
 */
class Market extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('market_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['markets'] = $this->market_model->get_market();
        $this->menu_lib->get_active_menu(28,34);
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Market";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('market/market_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['market'] = array("market_id" => 0);
        $this->menu_lib->get_active_menu(28,34);

        $data['title'] = "Market Add";
        $data['link_back'] = anchor('market/listing/', 'Back to list of market Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('market/market_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('market_name', 'market Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->market_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['market'] = $this->market_model->get_detail($id);
        $data['title'] = "market";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('market/listing/', 'Back to list of market', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('market/market_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['market_id'];
        $status = $this->market_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file market.php */
/* Location: ./application/controllers/market.php */
?>