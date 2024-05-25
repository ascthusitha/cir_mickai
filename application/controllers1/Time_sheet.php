<?php
/**
 * Description of Task Details
 *
 * @author Chaminda
 */

class Time_sheet extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('time_sheet_model');
        $this->load->model('scheduling_model');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('contact_model');
        $this->load->model('market_model');
        $this->load->model('country_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['time_sheets'] = $this->time_sheet_model->get_time_sheets();
        $this->menu_lib->get_active_menu(8,37);
        $data['title'] = "Time Sheet";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('time_sheet/time_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {
        $data['user'] = $this->session->userdata('first_name');

        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['contacts'] = $this->contact_model->get_contact_dropdown();
        
        $data['subjects'] = $this->scheduling_model->get_subjects(3);
        $data['stats'] = $this->scheduling_model->get_stats(3);
        $data['products'] = $this->scheduling_model->get_products();

        $this->menu_lib->get_active_menu(8,36);
        $data['title'] = "Time Sheet";
        $data['title1'] = "Time Sheet";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('time_sheet/time_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save(){
        if($ts_id = $this->time_sheet_model->add_time_sheet()){
            echo $ts_id;
        }else{
            echo 'error';
        }
    }

    public function view($ts_id){
        $data['users'] = $this->user_model->get_user_dropdown();
        $data['accounts'] = $this->account_model->get_account_dropdown();

        $data['subjects'] = $this->scheduling_model->get_subjects(3);
        $data['stats'] = $this->scheduling_model->get_stats(3);
        $data['products'] = $this->scheduling_model->get_products();

        $data['title'] = "Time Sheet";
        $data['title1'] = "Time Sheet";

        $data['time_sheet'] =  $this->time_sheet_model->get_time_sheet($ts_id);
        $data['time_tracker'] =  $this->time_sheet_model->get_time_tracker($ts_id);
        $data['contacts'] = $this->contact_model->get_contact_dropdown_by_acc($data['time_sheet']['acc_id']);
        $data['btn_value']='Update';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('time_sheet/time_add',$data);
        $this->load->view('layout/footer', $data);    
    }

    function start_time() {
        $id = $_POST['ts_id'];
        if ($res = $this->time_sheet_model->start_time($id)) {
            echo $res;
        } else {
            echo FALSE;
        }
    }

    function stop_time() {
        $id     = $_POST['ts_id'];
        $tt_id  = $_POST['tt_id'];
        $hours  = $_POST['hours'];
        $min    = $_POST['min'];
        $sec    = $_POST['sec'];
        if ($this->time_sheet_model->stop_time($id,$tt_id,$hours,$min,$sec)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

    function add_manual_time() {
        $id         = $_POST['ts_id'];
        $start_date = $_POST['start_date'];
        $start_time = $_POST['start_time'];
        $end_date   = $_POST['end_date'];
        $end_time   = $_POST['end_time'];
        $source     = $_POST['source'];

        $curr_sheet = $this->time_sheet_model->get_time_sheet($id);
        $timer_h = $curr_sheet['timer_h'];
        $timer_m = $curr_sheet['timer_m'];
        $timer_s = $curr_sheet['timer_s'];

        $sdate = new DateTime($start_date.' '.$start_time);
        $sdate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $start = $sdate->format('Y-m-d H:i:s');

        $edate = new DateTime($end_date.' '.$end_time);
        $edate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $end = $edate->format('Y-m-d H:i:s');
        $time_diff = $sdate->diff($edate);
        $temp_timer_d = intval($time_diff->format('%d'));
        $temp_timer_d = 24*$temp_timer_d;
        $temp_timer_h = intval($time_diff->format('%h'))+$temp_timer_d;
        $temp_timer_m = intval($time_diff->format('%i'));
        $temp_timer_s = intval($time_diff->format('%s'));

        $correct_timer_s = intval($timer_s)+$temp_timer_s;
        $timer_s = $correct_timer_s % 60;
        $timer_m_temp = floor(($correct_timer_s / 60) % 60)+intval($timer_m)+$temp_timer_m;
        $timer_m = $timer_m_temp % 60;
        $timer_h_temp = floor(($timer_m_temp / 60) % 60)+intval($timer_h)+$temp_timer_h;
        $timer_h = str_pad($timer_h_temp, 2, '0', STR_PAD_LEFT);
        if ($res = $this->time_sheet_model->add_manual_time($id,$start,$end,$source,$timer_h,$timer_m,$timer_s)) {
            echo $res;
        } else {
            echo FALSE;
        }
    }

    function delete() {
        $id = $_POST['ts_id'];
        if ($this->time_sheet_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}
