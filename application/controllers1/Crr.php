<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of country
 *
 * @author Thusitha
 */
class Country extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('country_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['countries'] = $this->country_model->get_country();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Country";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('country/country_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['country'] = array("country_id" => 0);

        $data['title'] = "Country Add";
        $data['link_back'] = anchor('country/listing/', 'Back to list of country Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('country/country_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('country_name', 'country Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->country_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['country'] = $this->country_model->get_detail($id);
        $data['title'] = "country";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('country/listing/', 'Back to list of country', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('country/country_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['country_id'];
        $status = $this->country_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file country.php */
/* Location: ./application/controllers/country.php */
?>