<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of car
 *
 * @author Thusitha
 */
class Car extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('car_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['cars'] = $this->car_model->get_car();
        $this->menu_lib->get_active_menu(28,33);
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Car";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('car/car_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['user'] = $this->session->userdata('first_name');
        $this->menu_lib->get_active_menu(28,33);
        $data['car'] = array("car_id" => 0);

        $data['title'] = "Car Add";
        $data['link_back'] = anchor('car/listing/', 'Back to list of car Name', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('car/car_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {
        $this->form_validation->set_rules('car_name', 'car Name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {

            echo validation_errors();
        } else {
            if ($this->car_model->add()) {
                echo 'success';
            } else {
                echo 'error';
            }
            //$this->listing();
        }
    }

    public function view($id) {
        $data['user'] = $this->session->userdata('first_name');

        $data['car'] = $this->car_model->get_detail($id);
        $data['title'] = "car";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('car/listing/', 'Back to list of car', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('car/car_add', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete() {
        $id = $_POST['car_id'];
        $status = $this->car_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

}

/* End of file car.php */
/* Location: ./application/controllers/car.php */
?>