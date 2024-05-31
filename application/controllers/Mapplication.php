<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of application
 *
 * @author Thusitha
 */
class Mapplication extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('mapplication_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['applications'] = $this->mapplication_model->get_application();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Application";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('application/application_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['application'] = array("application_id" => 0);

        $data['title'] = "Application Add";
        $data['link_back'] = anchor('application/listing/', 'Back to list of application Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('application/application_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {

        $this->form_validation->set_rules('applicant_initial', 'applicant initial', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->mapplication_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['application'] = $this->mapplication_model->get_detail($id);
        $data['title'] = "application";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('application/listing/', 'Back to list of application', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('application/application_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['application_id'];
        $status = $this->mapplication_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file application.php */
/* Location: ./application/controllers/application.php */
?>
