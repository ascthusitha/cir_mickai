<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menu_Lib {
    private $error = array();

    function __construct() {
        $this->ci =& get_instance();

        $this->ci->load->library('session');
    }

    function get_active_menu($act1='',$act2='') {
        for ($x = 1; $x <= 40; $x++) { 
            $data[$x] = '';
            $menu[$x] = '';
            if($act1==$x) { $data[$x] = 'active'; $menu[$x] = 'menu-open'; }
            if($act2==$x) { $data[$x] = 'active'; $menu[$x] = 'menu-open'; }
        }
        $this->ci->session->set_userdata(array(
            'menu'	    => $data,
            'menu_open'	=> $menu
        ));
    }

}

/* End of file Menu_Lib.php */
/* Location: ./application/libraries/Menu_Lib.php */