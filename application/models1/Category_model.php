<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category_model
 *
 * @author Thusitha
 */
class Category_model extends CI_Model {
    public $table = 'category';
    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }
    
    public function add_category() {
        $id = $this->input->post('category_id');
        $data = array('category_code' => $this->input->post('c_code'),
            'category_name' => $this->input->post('category_name'),
            'category_status' => $this->input->post('c_status')
            
            
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        if ($id != 0) {
            $this->db->set('update_by',$this->session->userdata('user_id'));
            $this->db->set('update_date',$fdate);
            $this->db->where('category_id', $id);
            //$this->db->where('user_group_id','1');
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->set('created_by',$this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
            return TRUE;
        }
    }
    public function get_category_detail($category_id){
        $this->db->select('category.*');
        $this->db->from('category');
        $this->db->where('category_id', $category_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function delete_category($id) {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_date',$fdate);
        $this->db->set('update_by',$this->session->userdata('user_id'));
        $this->db->where('category_id', $id);
        $this->db->update($this->table);
        return TRUE;
    }
    public function get_category_details(){
        $this->db->select('category.*');
        $this->db->where('deleted','0');
        $query = $this->db->get('category');
                return $query->result();
    }
    function get_category_dropdown() {
        $categoryarray = array();
        $this->db->select('category_id,category_name');
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get('category');
        $categoryarray[0] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $categoryarray[$row->category_id] = $row->category_name;
            }
        }
        return $categoryarray;
    }
    function get_all_category_dropdown() {
        $categoryarray = array();
        $this->db->select('category_id,category_name');
        $this->db->order_by('category_name', 'asc');
        $query = $this->db->get('category');
        $categoryarray[0] = 'All';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $categoryarray[$row->category_id] = $row->category_name;
            }
        }
        return $categoryarray;
    }
    
}
