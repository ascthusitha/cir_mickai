<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author Thusitha
 */
class Category extends MY_Controller{
    public function __construct() {
        parent::__construct();
        
        $this->load->model('category_model');
    }
    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['categories']=$this->category_model->get_category_details();
        $data['title'] = "Category Details";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('category/category_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save_category(){
   		
                    if($this->category_model->add_category()){
                       echo  'success';
                    }else{
                        echo 'error';
                    }
		
}
public function add(){
   
        $data['user'] = $this->session->userdata('first_name');
        
        $data['title'] = "Category Details";
        $data['btn_value']='add';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('category/category_add',$data);
        $this->load->view('layout/footer', $data);    
    }
public function view($category_id){

        $data['user'] = $this->session->userdata('first_name');
  
        $data['category']=  $this->category_model->get_category_detail($category_id);
        $data['title'] = "Category Details";
        $data['btn_value']='Update';
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('category/category_add',$data);
        $this->load->view('layout/footer', $data);    
    }
    public function delete(){
        $id = $_POST['c_id'];

        $status=$this->category_model->delete_category($id);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
        }
    }
    
}
