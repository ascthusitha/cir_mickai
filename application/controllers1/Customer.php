<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Customer
 *
 * @author THUSITHA
 */
Class Customer extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('customer_model');
        $this->load->model('code_generation_m');
        $this->load->model('user_model');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['customer'] = $this->customer_model->get_customer();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['title'] = "Customer list";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('customer/customer_view', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {

        $data['customer'] = array("cus_id" => 0);
        $data['code'] = $this->code_generation_m->getCode('CUS');
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Add Customer";
        $data['link_back'] = anchor('customer/customer_add', '', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('customer/customer_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function view($id) {
        //load view
        //$this->output->enable_profiler(TRUE);
        $data['user'] = $this->session->userdata('first_name');

        //$data['countries'] = $this->country_model->get_country_dropdown();
        $data['customer'] = $this->customer_model->get_customer_detail($id);

        $data['title'] = "Customer ";
        $data['btn_value'] = 'Update';
        $data['link_back'] = anchor('customer', '', array('class' => 'back'));
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('customer/customer_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save() {

        if ($this->customer_model->addCustomer()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    public function save_pos() {
        $cus_id=$_POST['cus_id'];
        $title=isset($_POST['title'])?$_POST['title']:'Mr.';
        $cus_fname=$_POST['f_name'];
                $cus_lname=isset($_POST['l_name'])?$_POST['l_name']:'';
                $id_number=isset($_POST['id_number'])?$_POST['id_number']:'';
                $address=isset($_POST['address'])?$_POST['address']:'';
                $mobile=isset($_POST['mobile'])?$_POST['mobile']:'';
                $telephone=isset($_POST['phone'])?$_POST['phone']:'';
                $email=isset($_POST['email'])?$_POST['email']:'';
        $cus_id=$this->customer_model->addPosCustomer($cus_id,$title,$cus_fname,$cus_lname,$id_number,$address,$mobile,$telephone,$email);
        
        if ($cus_id!='null') {
            echo $cus_id;
        } else {
            echo 'error';
        }
    }

    function delete($id) {
        $this->customer_model->delete($id);
        redirect('customer', 'refresh');
    }

    function loadCustomer() {
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($customers = $this->customer_model->get_customer_dropdown()));
    }

    function get_mobile_data() {
        $cus_id = $this->input->post('cus_id');
        $mobile = $this->customer_model->get_cus_mobile($cus_id);
        echo $mobile;
    }
    public function customer_id(){
        $id_number = $this->input->post('id_number');
        $cus_id= $this->input->post('cus_id');
        $data = $this->customer_model->get_customer_id($id_number,$cus_id);
        if ( $data == TRUE ) {
        $res= 'false';
        } else {
        $res= 'true';
        }
        echo json_encode(array(
    'valid' => $res,
));
    }
    public function get_customer_details(){
        $cus_code = $this->input->post('cus_code');
        $f_name = $this->input->post('f_name');
        $user_id = $this->input->post('user_id');
        $id_no = $this->input->post('id_no');
  
        $data['customer'] = $this->customer_model->get_customer_se_detail($cus_code, $f_name, $user_id,$id_no);
       
         $this->load->view('customer/customer_list', $data);
    }



}
