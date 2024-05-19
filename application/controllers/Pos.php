<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pos
 *
 * @author Thusitha
 */
class Pos extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('category_model');
        $this->load->model('item_model');
        $this->load->model('supplier_model');
        $this->load->model('pos_model');
        $this->load->model('customer_model');
        $this->load->model('price_model');
        $this->load->model('rate_model');
        $this->load->model('payment_model');
        $this->load->model('order_model');

    }
    
     public function index() {
        $today = Date('Y-m-d');
        $data['customers']=$this->customer_model->get_customer_dropdown();
        $data['user'] = $this->session->userdata('first_name');
        $data['categories']=$this->category_model->get_category_details();
        $data['categoriesdp']=$this->category_model->get_category_dropdown();
        $data['itemsdp']=$this->item_model->get_item_dropdown();
        $data['items']=$this->price_model->get_prices();
       
        //$data['item_lists']=$this->item_model->get_item_json();
         $data['item_lists']=$this->price_model->get_price_json();
         $data['order_id_lists']=$this->order_model->get_order_json();
        $data['auto_num'] = $this->code_generation_m->getAutoNum();
        $data['title'] = "Point Of Sales";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('pos/pos_view', $data);
        $this->load->view('layout/footer', $data);
    }
    public function order_tmp(){
   	$auto_id=$_POST['auto_num'];
        $status=$this->pos_model->add_sale_tmp();
        if ($status) {
            
            echo $this->load_current_tmp_order($auto_id);     
        } else {
            echo 'error';
        }
   
		
}
public function add(){
   
        $data['user'] = $this->session->userdata('first_name');
        
        $data['title'] = "Item Details";
        $data['btn_value']='add';
        $data['suppliers']=$this->supplier_model->get_supplier_dropdown();
        $data['categories']=$this->category_model->get_category_dropdown();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('item/item_add',$data);
        $this->load->view('layout/footer', $data);    
    }
public function view($item_id){

        $data['user'] = $this->session->userdata('first_name');
        $data['categories']=$this->category_model->get_category_dropdown();
        $data['suppliers']=$this->supplier_model->get_supplier_dropdown();
        $data['item']=  $this->item_model->get_item_detail($item_id);
        $data['title'] = "Item Details";
        $data['btn_value']='Update';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('item/item_add',$data);
        $this->load->view('layout/footer', $data);    
    }
    public function delete(){
        $id = $_POST['c_id'];

        $status=$this->item_model->delete_item($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }
    public function load_current_tmp_order($auto_id) {
        $data['tmp_items']= $this->pos_model->get_tmp_item_detail($auto_id);
       
        $this->load->view('pos/order_tmp_list', $data,FALSE);
    }
    
    public function new_order(){
        $auto_id=$_POST['auto_num'];
        $status=$this->pos_model->add_new_order();
         $data=array();
                    if(count($status)>0){
                        $data['ord_code']=$status['ord_code'];
                        $data['ord_id']=$status['ord_id'];
                        $data['ord_date']=$status['ord_date'];
                        $data['inv_date']=$status['inv_date'];
                        $data['res']='success';
                    }else{
                        $data['id']=0;
                        $data['res']='error';
                    }	
        echo json_encode($data);
    }
    public function hold_order(){
        $auto_id=$_POST['auto_num'];
        $status=$this->pos_model->add_hold_order();
        if ($status) {
            
            echo 'success';     
        } else {
            echo 'error';
        }
    }


    public function get_cat_items() {
        $cat_id=$_POST['cat_id'];
        $data['categories']=$this->category_model->get_category_details();
        $data['cat_items']=  $this->item_model->get_cat_item_detail($cat_id);
        echo $this->load->view('pos/cat_items_list', $data,FALSE);
    }
    public function get_cat_pitems() {
        $item_id=$_POST['item_id'];
        $cat_id=$_POST['cat_id'];
        $data['cat_items']=  $this->item_model->get_cat_item_detail($cat_id);
        $data['p_items']=  $this->item_model->get_cat_pitem_detail($item_id);
        echo $this->load->view('pos/cat_pitems_list', $data,FALSE);
    }

    public function get_cat_list(){
         $data['categories']=$this->category_model->get_category_details();
        echo $this->load->view('pos/cat_list', $data,FALSE);
    }
    public function delete_tmp(){
        $tmp_id=$_POST['tmp_id'];
        $auto_id=$_POST['auto_id'];
        $status=$this->pos_model->delete_item_tmp($tmp_id);
        if ($status) {
            echo $this->load_current_tmp_order($auto_id); 
        } else {
            echo $status;
        }
    }
    public function delete_tmp_ns(){
        $tmp_id=$_POST['tmp_id'];
        $auto_id=$_POST['auto_id'];
        $status=$this->pos_model->delete_item_tmp_ns($tmp_id);
        if ($status) {
            echo $this->load_current_tmp_order($auto_id); 
        } else {
            echo $status;
        }
    }

}
