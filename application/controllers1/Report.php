<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of report
 *
 * @author Thusitha
 */
class Report extends MY_Controller {

    public function __construct() {
        parent::__construct();

        //load library
        $this->load->library(array('form_validation'));
        //load helper
        $this->load->helper('url');
        $this->load->model('item_model');
        $this->load->model('user_model');
        $this->load->model('price_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('purchase_order_model');
        $this->load->model('approval_model');
        $this->load->model('stock_value_model');
        $this->load->model('rate_model');
        $this->load->model('company_model');
    }

    public function stock() {
        $category = '0';
        $item='0';
         $e_date = date('Y-m-d');
        $year = date('Y');
        $user_id = 0;//$this->session->userdata('user_id');
        $l_type = 1;//this->input->post('l_type');
        //load view
        $data['item_lists']=$this->item_model->get_all_item_dropdown();
        $data['categories']=$this->category_model->get_all_category_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['items'] = $this->price_model->get_item_detail($category,$item, $e_date,2,$year);
        $data['user'] = $this->session->userdata('first_name');
        
        $data['s_date']=date('Y-m-d', strtotime($e_date));
        $data['title'] = "Stock Book";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('report/stock_view', $data);
        $this->load->view('layout/footer', $data);
    }

public function daily_sales(){
       $category = '0';
        $item='0';
        $e_date = date('Y-m-d');
        $user_id = 0;//$this->session->userdata('user_id');
        $l_type = 1;//this->input->post('l_type');
        //load view
      $data['item_lists']=$this->item_model->get_all_item_dropdown();
        $data['categories']=$this->category_model->get_all_category_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['date']=$e_date;
        $data['orders'] = $this->order_model->get_daily_sales_details($category,$item, $e_date);
        $data['cancel_orders'] = $this->order_model->get_cancel_daily_sales_details($category,$item, $e_date);
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Daily Sales Summary";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('report/daily_sales_view', $data);
        $this->load->view('layout/footer', $data);
}
public function sales(){
       $category = '0';
        $item='0';
        $s_date = date('Y-m-d');
        $e_date = date('Y-m-d');
        $user_id = 0;//$this->session->userdata('user_id');
        $l_type = 1;//this->input->post('l_type');
        //load view
      $data['item_lists']=$this->item_model->get_all_item_dropdown();
        $data['categories']=$this->category_model->get_all_category_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['orders'] = $this->order_model->get_sales_details($category,$item, $s_date,$e_date);
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Sales Summary";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('report/sales_view', $data);
        $this->load->view('layout/footer', $data);
}
    public function get_daily_sales_details() {
        $category = $this->input->post('category');
        $item = $this->input->post('item');
        $e_date = $this->input->post('e_date');
        $data['date']=date('Y-m-d', strtotime($e_date));//$e_date;
        $data['orders'] = $this->order_model->get_daily_sales_details($category,$item, $e_date);
        $this->load->view('report/daily_sales_list', $data);
    }
    public function get_sales_details() {
        $category = $this->input->post('category');
        $item = $this->input->post('item');
         $s_date = $this->input->post('s_date');
        $e_date = $this->input->post('e_date');
        $data['sdate']=$s_date;
        $data['edate']=$e_date;
        $data['orders'] = $this->order_model->get_sales_details($category,$item,$s_date, $e_date);
        $this->load->view('report/sales_list', $data);
    }
     public function daily_sales_print(){
                $data['title'] = "Daily Sales Summary";
        $category = $_POST['category'];
        $e_date = $_POST['e_date'];
        $item_id = $_POST['item_id'];
        
        $data['e_date'] = $e_date;
       
        $data['orders'] = $this->order_model->get_daily_sales_details($category,$item_id, $e_date);
        $this->load->view('report/print/daily_sales', $data);
    }
    public function sales_print(){
                $data['title'] = "Sales Summary";
        $category = $_POST['category'];
        $s_date = $_POST['s_date'];
        $e_date = $_POST['e_date'];
        $item_id = $_POST['item_id'];
        $data['s_date'] = date('Y-m-d', strtotime($s_date));//$s_date;
        $data['e_date'] = date('Y-m-d', strtotime($e_date));//$e_date;
       
        $data['orders'] = $this->order_model->get_sales_details($category,$item_id,$s_date,$e_date);
        $this->load->view('report/print/sales', $data);
    }
    public function get_item_details() {
        $category = $this->input->post('category');
        $item = $this->input->post('item');
        $e_date = $this->input->post('e_date');
        $stat = $this->input->post('stat');
        $year = $this->input->post('year');
        $data['s_date']=date('Y-m-d', strtotime($e_date));
        $data['items'] = $this->price_model->get_item_detail($category,$item, $e_date,$stat,$year);
        $this->load->view('report/stock_list', $data);
    }
    public function stock_book_print(){
                $data['title'] = "Stock Book";
        $category = $_POST['category'];
        $e_date = date("Y-m-d") ;//$_POST['e_date'];
        $item_id = $_POST['item_id'];
        $stat = $_POST['stat'];
        $year = $_POST['year'];
        $data['s_date']=date('Y-m-d', strtotime($e_date));
       
        $data['items'] = $this->price_model->get_item_detail($category,$item_id, $e_date,$stat,$year);
        $this->load->view('report/print/stock_book', $data);
    }

public function daily_stock(){
       $category = '0';
        $item='0';
        $e_date = date('Y-m-d');
        $user_id = 0;//$this->session->userdata('user_id');
        $l_type = 1;//this->input->post('l_type');
        $data['date']=$e_date;
        $data['item_lists']=$this->item_model->get_all_item_dropdown();
        $data['categories']=$this->category_model->get_all_category_dropdown();
        //$data['users'] = $this->user_model->get_user_dropdown1();
        $data['items'] =$this->item_model->get_item_details(); //$this->price_model->get_daily_stock_detail($category,$item, $e_date);
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "Daily Stock Summary";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('report/daily_stock_view', $data);
        $this->load->view('layout/footer', $data);
}

public function get_d_stock_details() {
        $category = $this->input->post('category');
        $item = $this->input->post('item');
        $e_date = $this->input->post('e_date');
        $data['date']=date('Y-m-d', strtotime($e_date));//$e_date;
        $data['items'] = $this->item_model->get_item_details($item);//$this->price_model->get_daily_stock_detail($category,$item, $e_date);
        $this->load->view('report/daily_stock_list', $data);
    }
    public function daily_stock_print(){
        $category = $this->input->post('category');
        $item = $this->input->post('item');
        $e_date = $this->input->post('e_date');
        $data['date']=date('Y-m-d', strtotime($e_date));//$e_date;
        $data['items'] = $this->item_model->get_item_details($item);
        $data['title'] = "Daily Stock Summary";
        $data['orders'] = $this->order_model->get_daily_order_details($category,$item,$e_date);
        $this->load->view('report/print/daily_stock', $data);
    }
public function stock_value() {
        
        $item='0';
        $date = date('Y-m-d');
        $user_id = 0;//$this->session->userdata('user_id');
        $l_type = 1;//this->input->post('l_type');
        //load view
        $data['item_lists']=$this->item_model->get_all_item_dropdown();
        
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['items'] = $this->price_model->get_stock_item_detail($item, $date);
        $data['user'] = $this->session->userdata('first_name');
 
        $data['date']=date('Y-m-d', strtotime($date));
        $data['title'] = "Stock Value Report";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('report/stock_value_view', $data);
        $this->load->view('layout/footer', $data);
    }
    public function get_stock_value_details() {
        $data['p_rate'] = $this->input->post('p_rate');
        $item = $this->input->post('item');
        $g_date = $this->input->post('g_date');
        $data['date']=date('Y-m-d', strtotime($g_date));
        $data['items'] = $this->price_model->get_stock_item_detail($item, $g_date);
        $this->load->view('report/stock_value_list', $data);
    }
    public function stock_value_save(){
         if ($this->stock_value_model->add_stock_value()) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
    public function stock_value_print($sv_id){
        $data['title'] = "Stock Value Report";
        $sv_data=$this->stock_value_model->get_stock_value_docs($sv_id);
        $p_rate = $sv_data[0]->p_rate;
        $g_date = $sv_data[0]->created_date;
        $item_id = $this->stock_value_model->get_stock_value_item($sv_id);
        
        $data['g_date']=date('Y-m-d', strtotime($g_date));
        $data['p_rate']=$p_rate;
        $data['items'] = $this->price_model->get_stock_item_detail($item_id, $g_date);
        $this->load->view('report/print/stock_value_report', $data);
    }
    public function get_stock_file_details(){
        $data['docs'] = $this->stock_value_model->get_stock_value_docs();
        $this->load->view('report/stock_value_file', $data);
    }
}

?>
