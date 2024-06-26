<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of campaign
 *
 * @author Thusitha
 */
class Campaign extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('campaign_model');
		  $this->load->library('Menu_Lib');
    }

    public function index() {
		$data['campaigns'] = $this->campaign_model->get_campaign();
		        $this->menu_lib->get_active_menu(13,1);
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Campaign";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('campaign/campaign_list', $data);
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