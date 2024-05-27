<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of order
 *
 * @author thusitha
 */
class Order extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('category_model');
        $this->load->model('item_model');
        $this->load->model('order_model');
        $this->load->model('pos_model');
        $this->load->model('item_desc_code_gen_model');
        $this->load->model('price_model');
    }
    public function index(){
        $data['user'] = $this->session->userdata('first_name');
        $data['orders']=$this->order_model->get_order_details();
        $data['title'] = "Order List";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('order/order_list', $data);
        $this->load->view('layout/footer', $data);
    }
    
    public function order_save(){
        
        $status=$this->order_model->save_order();
        if ($status!='NULL') {
            
            echo $status;     
        } else {
            echo 'error';
        }
    }
    
            public function load_order(){
   	$auto_id=$_POST['auto_num'];
        $ord_id=$_POST['ord_id'];
        $status=$this->order_model->load_order_tmp();
        if ($status) {
            
            echo $this->load_current_tmp_order($auto_id);     
        } else {
            echo 'error';
        }
   
		
}
 public function load_current_tmp_order($auto_id) {
        $data['tmp_items']= $this->pos_model->get_tmp_item_detail($auto_id);
       
        $this->load->view('pos/order_tmp_list', $data,FALSE);
    }
     public function view($order_id){
        
        $data['user'] = $this->session->userdata('first_name');
        $data['order']=$this->order_model->get_order_data($order_id);
        $data['order_sales']=$this->order_model->get_load_item_details($order_id);
       
        $data['payments']= $this->pos_model->get_advance_detail($order_id);
        $data['advances']= $this->pos_model->get_advance_paid($order_id);
        $data['title'] = "Order View";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('order/order_view', $data);
        $this->load->view('layout/footer', $data);
    }
     public function order_cancel(){
        $status=$this->order_model->cancel_order();
        if ($status!='NULL') {
            
            echo $status;     
        } else {
            echo 'error';
        }
    }
    public function cancel_list(){
        $stat='2';//cancel
        $data['user'] = $this->session->userdata('first_name');
        $data['orders']=$this->order_model->get_order_details('','',$stat);
        $data['title'] = "Canceled Order List";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('order/cancel_order_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function cancel_view($order_id){
        
        $data['user'] = $this->session->userdata('first_name');
        $data['order']=$this->order_model->get_order_data($order_id);
        $data['order_sales']=$this->order_model->get_cancel_load_item_details($order_id);
       
        $data['payments']= $this->pos_model->get_advance_detail($order_id,'1');//1-canceled payment
        $data['advances']= $this->pos_model->get_advance_paid($order_id);
        $data['title'] = "Canceled Order View";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('order/cancel_order_view', $data);
        $this->load->view('layout/footer', $data);
    }
    
}
