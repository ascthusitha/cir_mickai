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
