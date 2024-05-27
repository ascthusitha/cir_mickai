<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invoice
 *
 * @author Thusitha
 */
class Invoice extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('contact_model');
        $this->load->model('invoice_model');
        $this->load->model('customer_model');
    }
    public function index(){
        $data['title'] = "Invoice Details";
        $data['user'] = $this->session->userdata('first_name');
        $data['invoices'] = $this->invoice_model->get_invoice();
        
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar', $data);
        $this->load->view('invoice/invoice_list', $data);
        $this->load->view('layout/footer', $data);
    }
   
        public function add() {
           $data['user'] = $this->session->userdata('first_name');
       $data['accounts'] = $this->account_model->get_account_dropdown();
       $data['contacts'] = $this->contact_model->get_contact_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['title'] = "invoice ";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('invoice/invoice_add', $data);
        $this->load->view('layout/footer', $data);
    }
    public function save(){
   		
                    if($inv_id=$this->invoice_model->addInvoice()){
                       echo "success";
                       //$this->print_invoice($inv_id);
                    }else{
                        echo 'error';
                    }
		
}
public function print_invoice($inv_id,$can_stat=NULL){
        $data['title'] = "Invoice";


     
        $data['invoice']= $this->invoice_model->get_invoice_detail($inv_id);
        
        // $data['pay_details'] = $actual_cost;

        echo $this->load->view('report/print/invoice', $data);
    }
}
