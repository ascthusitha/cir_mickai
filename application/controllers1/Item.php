<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of item
 *
 * @author Thusitha
 */
class Item extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('category_model');
        $this->load->model('item_model');
        $this->load->model('supplier_model');
    }
    
     public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['items']=$this->item_model->get_item_details();
        $data['title'] = "Item Details";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('item/item_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save_item(){
   		 //--------save image-------------
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 1024 * 8;

        $config['file_name'] = time()."_".str_replace(' ', '_', $_FILES['img_item']['name']);

        $name = $config['file_name'];
        $status=$this->item_model->add_item($name);
        if ($status) {
            

            $config['upload_path'] = "./assets/img/item/";
            $this->load->library('upload', $config);
            $this->upload->do_upload('img_item');
            echo 'success';           
        } else {
            echo 'error';
        }


            //------end image------------
                   
		
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
    public function get_items(){
        $cat_id=$_POST['cat_id'];
        
        $item_lists = array();
        $item_lists = $this->item_model->get_item_list($cat_id);
        // echo $states;
        echo json_encode($item_lists);
    }
    public function load_cat_items(){
        $cat_id=$_POST['cat_id'];
        $res = $this->item_model->get_cat_items($cat_id);

        echo json_encode($res);
    }
}
