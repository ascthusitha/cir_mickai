<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of campaign
 *
 * @author Thusitha
 */
class Campaign_activity extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('alert_sms_model');
	$this->load->library('Menu_Lib');
    }

    public function index() {
	$data['alerts'] = $this->alert_sms_model->get_alert_details1();
	$this->menu_lib->get_active_menu(50, 54);
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Campaign Activity";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('campaign/campaign_activity_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['campaign'] = array("campaign_id" => 0);

        $data['title'] = "Campaign Add";
        $data['link_back'] = anchor('campaign/listing/', 'Back to list of campaign Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('campaign/campaign_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('campaign_name', 'campaign Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->campaign_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['campaign'] = $this->campaign_model->get_detail($id);
        $data['title'] = "campaign";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('campaign/listing/', 'Back to list of campaign', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('campaign/campaign_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['campaign_id'];
        $status = $this->campaign_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file campaign.php */
/* Location: ./application/controllers/campaign.php */
?>