<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of region
 *
 * @author Chaminda
 */
class Region extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('region_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['regions'] = $this->region_model->get_region();
        $this->menu_lib->get_active_menu(28,35);
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Region";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('region/region_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['region'] = array("region_id" => 0);
        $this->menu_lib->get_active_menu(28,35);

        $data['title'] = "Region Add";
        $data['link_back'] = anchor('region/listing/', 'Back to list of region Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('region/region_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('region_name', 'region Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->region_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['region'] = $this->region_model->get_detail($id);
        $data['title'] = "region";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('region/listing/', 'Back to list of region', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('region/region_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['region_id'];
        $status = $this->region_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file region.php */
/* Location: ./application/controllers/region.php */
?>