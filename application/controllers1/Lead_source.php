<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of lead_source
 *
 * @author Thusitha
 */
class Lead_source extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('lead_source_model');
    }

    public function index() {
        //$this->output->enable_profiler(TRUE);

        $data['lead_sources'] = $this->lead_source_model->get_lead_source();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Lead Source";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('lead_source/lead_source_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['lead_source'] = array("ls_id" => 0);

        $data['title'] = "Lead Source Add";
        $data['link_back'] = anchor('lead_source/listing/', 'Back to list of lead source Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('lead_source/lead_source_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('lead_source_name', 'lead source Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->lead_source_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['lead_source'] = $this->lead_source_model->get_detail($id);
        $data['title'] = "Lead Source";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('lead_source/listing/', 'Back to list of lead source', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('lead_source/lead_source_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['ls_id'];
        $status = $this->lead_source_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file lead_source.php */
/* Location: ./application/controllers/lead_source.php */
?>