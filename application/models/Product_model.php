<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of contact
 *
 * @author THUSITHA
 */
Class Product_model extends CI_Model {

    protected $table = 'products';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        
        
    }
    public function get_task_detail_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('products');
    }
   public function get_products() {

        $this->db->select('p.*');
        $this->db->from('products p');
        
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_product_detail($product_id) {

        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->where('product_id', $product_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function add_product() {

        $product_id = $this->input->post('product_id');
        $data = array(
            
            'name' => $this->input->post('name'),
         
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($product_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('id', $product_id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            
            
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
           

            return TRUE;
        }
    }

    function delete($product_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('id', $product_id);
        $this->db->update($this->table);
           return TRUE;
           
    }

     function get_product_dropdown() {
        $cusarray = array();
        $this->db->select('id,name');
        $this->db->where('deleted', '0');
               $this->db->order_by('name', 'ASC');
        $query = $this->db->get('products');
              $cusarray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->id] = $row->name ;//. " " . $row->cus_lname
            }
        }
        return $cusarray;
    }
 function get_product_dropdown1() {
        $cusarray = array();
        $this->db->select('id,name');
        $this->db->where('deleted', '0');
               $this->db->order_by('name', 'ASC');
        $query = $this->db->get('products');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->id] = $row->name ;//. " " . $row->cus_lname
            }
        }
        return $cusarray;
    }
  
}
