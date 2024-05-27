<?php
/**
 * @author Chaminda
 */
class Administration_reports extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->model('report_model');
        $this->load->model('account_model');
        $this->load->model('user_model');
        $this->load->model('scheduling_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {

    }

    public function activities() {
        $data['title'] = "Activity Report";
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['products'] = $this->scheduling_model->get_products();
        $this->menu_lib->get_active_menu(19,20);
        
        $this->form_validation->set_rules("acc_id", "Account ID", "trim");
        $this->form_validation->set_rules("assign_to", "Assign To", "trim");
        $this->form_validation->set_rules("activity_type", "Activity Type", "trim");
        $this->form_validation->set_rules("product_id", "Product", "trim");
        $this->form_validation->set_rules("from_date", "From Date", "trim");
        $this->form_validation->set_rules("to_date", "To Date", "trim");
        
        $data['acc_id_current'] = $search['acc_id'] = '';
        $data['assign_to_current'] = $search['assign_to'] = '';
        $data['activity_id_current'] = $search['activity_id'] = '';
        $data['product_id_current'] = $search['product_id'] = '';
        $data['from_date'] = $search['from_date'] = '';
        $data['to_date'] = $search['to_date'] = '';
        if ($this->form_validation->run()) {
            $data['acc_id_current'] = $search['acc_id'] = $this->form_validation->set_value("acc_id");
            $data['assign_to_current'] = $search['assign_to'] = $this->form_validation->set_value("assign_to");
            $data['activity_id_current'] = $search['activity_id'] = $this->form_validation->set_value("activity_type");
            $data['product_id_current'] = $search['product_id'] = $this->form_validation->set_value("product_id");
            $data['from_date'] = $search['from_date'] = $this->form_validation->set_value("from_date");
            $data['to_date'] = $search['to_date'] = $this->form_validation->set_value("to_date");
            $data['activities'] = $this->report_model->get_activities($search);
            $data['report_display'] = TRUE;
        }else{
            $data['activities'] = [];
            $data['report_display'] = FALSE;
//            $data['activities'] = $this->report_model->get_activities($search);
        }
        $this->load->view('layout/header_rep', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('administration_reports/activity_report', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('footer_scripts/data_table', $data);
    }

    public function account_activity() {
        $data['title'] = "Account Activity Report";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('administration_reports/account_activity', $data);
        $this->load->view('layout/footer', $data);
        $this->load->view('footer_scripts/data_table', $data);
    }

    public function activity_summary() {
        $data['title'] = "Activity Summary Report";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('administration_reports/activity_summary', $data);
        $this->load->view('layout/footer', $data);
    }

    public function new_account() {
        $data['title'] = "New Account Report";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('administration_reports/new_account', $data);
        $this->load->view('layout/footer', $data);
    }

}