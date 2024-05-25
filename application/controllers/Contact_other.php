<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of country
 *
 * @author Thusitha
 */
class Contact_other extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('contact_other_m');
    }




    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $data['country'] = array("country_id" => 0);

        $data['title'] = "Country Add";
        $data['link_back'] = anchor('country/listing/', 'Back to list of country Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('country/country_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

           // echo validation_errors();
            echo "error";
        } else {
            if ($this->contact_other_m->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }



    function delete() {
        $id = $_POST['co_id'];
        $status = $this->contact_other_m->delete($id);
        if ($status) {
            echo 'success';
        } else {
            echo $status;
        }
    }
    
    public function edit(){
        $id = $_POST['co_id'];
         $other_contact = $this->contact_other_m->get_detail($id);
         echo json_encode($other_contact);
    }

}

/* End of file country.php */
/* Location: ./application/controllers/country.php */
?>