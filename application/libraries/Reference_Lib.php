<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reference_Lib {
    private $error = array();

    function __construct() {
        $this->ci =& get_instance();

        $this->ci->load->library('session');
        $this->ci->load->database();
        $this->ci->load->model('reference_model');
    }

    function getCode($name) {
        $res = $this->ci->reference_model->getCode($name);
        $code = $res->pre_code.sprintf("%05d", $res->number);;
        return $code;
    }

    function increaseCode($name) {
        $res = $this->ci->reference_model->increaseCode($name);
        return $res;
    }
    

}

/* End of file Reference_Lib.php */
/* Location: ./application/libraries/Reference_Lib.php */