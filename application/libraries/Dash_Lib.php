<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dash_Lib {
    private $error = array();

    function __construct() {
        $this->ci =& get_instance();

        $this->ci->load->library('session');
        $this->ci->load->database();
        $this->ci->load->model('dashboard_model');
    }

    function get_default_dashboard($user_id=0) {
        $data['phone_calls_count'] = $this->ci->dashboard_model->get_phone_calls_count();
        $data['sales_calls_count'] = $this->ci->dashboard_model->get_sales_calls_count();
        $data['tasks_count'] = $this->ci->dashboard_model->get_tasks_count();
        $data['Opportunities_count'] = $this->ci->dashboard_model->get_opportunities_count();

        $data['my_phone_calls'] = $this->ci->dashboard_model->get_phone_calls($user_id);
        $data['my_sales_calls'] = $this->ci->dashboard_model->get_sales_calls($user_id);
        $data['my_tasks'] = $this->ci->dashboard_model->get_tasks($user_id);
        $data['my_opportunities'] = $this->ci->dashboard_model->get_opportunities($user_id);

        return $data;
    }

}

/* End of file Dash_Lib.php */
/* Location: ./application/libraries/Dash_Lib.php */