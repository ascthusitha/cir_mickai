<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of selling_account
 *
 * @author Thusitha
 */
class Purchase_order  extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('price_model');
        $this->load->model('purchase_order_model');
        $this->load->model('supplier_model');
        $this->load->model('item_model');
        $this->load->model('category_model');
    }
    
    public function index(){
        $data['po_lists'] = $this->purchase_order_model->get_po_details();

        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Purchase Order";
        $this->load->view('layout/header', $data);
       $this->load->view('layout/menu_bar');
        $this->load->view('purchase_order/po_list', $data);
        $this->load->view('layout/footer', $data);
    }
    public function add(){
        $data['user'] = $this->session->userdata('first_name');
        $data['po_code'] = $this->code_generation_m->getCode('PO');
        $data['title'] = "New Purchase Order";
        $data['btn_value']='add';
        $data['items']=$this->item_model->get_item_dropdown();
        $data['suppliers']=$this->supplier_model->get_supplier_dropdown();
         $data['auto_num'] = $this->code_generation_m->getAutoNum();
        $data['categories']=$this->category_model->get_category_dropdown();
        $data['gcategories']=$this->category_model->get_gcategory_dropdown();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('purchase_order/po_add',$data);
        $this->load->view('layout/footer', $data);
    }
        public function save_po(){
        
        $status=$this->purchase_order_model->add_po();
        if ($status) {
            
            echo 'success';     
        } else {
            echo 'error';
        }
        }
          public function save_po_item_tmp(){
    $auto_id=$_POST['auto_num'];
        $status=$this->purchase_order_model->add_po_item_tmp();
        if ($status) {
            
            echo $this->load_current_tmp_po($auto_id);     
        } else {
            echo 'error';
        }
   
        
}
public function delete_tmp(){
        $tmp_id=$_POST['tmp_id'];
        $auto_id=$_POST['auto_id'];
        $status=$this->purchase_order_model->delete_po_tmp($tmp_id);
        if ($status) {
            echo $this->load_current_tmp_po($auto_id); 
        } else {
            echo $status;
        }
    

} 
public function load_current_tmp_po($auto_id) {
        $data['po_items']= $this->purchase_order_model->get_tmp_item_detail($auto_id);
        $this->load->view('purchase_order/po_grid', $data,FALSE);
    }
    public function po_view($po_id,$po_code){
        $data['po_lists'] = $this->purchase_order_model->get_po_item_details($po_id);
        $data['po_data'] =$this->purchase_order_model->get_po_details($po_id);
        $data['po_code']=$po_code;
        $data['po_id']=$po_id;
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Purchase Order view";
        $this->load->view('layout/header', $data);
       $this->load->view('layout/menu_bar');
        $this->load->view('purchase_order/po_view', $data);
        $this->load->view('layout/footer', $data);
    }
    public function po_print($po_id,$po_code){
        $data['po_lists'] = $this->purchase_order_model->get_po_item_details($po_id);
        $data['po_data'] =$this->purchase_order_model->get_po_details($po_id);
        $data['po_code']=$po_code;
        //load view
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Purchase Order view";
        $this->load->view('report/print/po_print', $data);
        
    }
}
