<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of selling_account
 *
 * @author Thusitha
 */
class Price  extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('price_model');
        $this->load->model('selling_account_model');
        $this->load->model('supplier_model');
        $this->load->model('item_model');
        $this->load->model('category_model');
    }
    
    public function listing(){
        $data['prices'] = $this->price_model->get_prices();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Item Purchase";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('item_price/price_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add(){
        $data['user'] = $this->session->userdata('first_name');
        
        $data['title'] = "New Purchase";
        $data['btn_value']='add';
        $data['items']=$this->item_model->get_item_dropdown();
        $data['suppliers']=$this->supplier_model->get_supplier_dropdown();
        
        $data['categories']=$this->category_model->get_category_dropdown();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('item_price/price_add',$data);
        $this->load->view('layout/footer', $data);
    }
    public function save_item_price(){
        $status=$this->price_model->add_item_price();
        if ($status) {
            echo 'success';           
        } else {
            echo 'error';
        }
    }
           
}
