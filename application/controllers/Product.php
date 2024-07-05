<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of selling_account
 *
 * @author Thusitha
 */
class Product  extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation'));
        $this->load->helper('url');
        $this->load->model('product_model');
         $this->load->library('Menu_Lib');
       
    }
    
    public function listing(){
        $data['products'] = $this->product_model->get_products();
$this->menu_lib->get_active_menu(28,55);
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Products";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('product/product_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add(){
        $data['user'] = $this->session->userdata('first_name');
        
        $data['title'] = "New Product";
        $data['btn_value']='add';
       
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('product/product_add',$data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
        $status=$this->product_model->add_product();
        if ($status) {
            echo 'success';           
        } else {
            echo 'error';
        }
    }
          function delete() {
        $id = $_POST['product_id'];
        $status = $this->product_model->delete($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }    
}
