<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contact_other_m
 *
 * @author td
 */
class Contact_other_m extends CI_Model{
     protected $table = 'contact_other';
     
     public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }
    public   function get_scontacts($contact_id=null) {
        $this->db->select('*');
        $this->db->where('contact_id',$contact_id);
         $this->db->where('deleted',0);
        $query = $this->db->get('contact_other');
                return $query->result();
    }
     public function add() {
        $id = $this->input->post('co_id');
        $data = array('first_name' => $this->input->post('first_name'),
                     'last_name'=>  $this->input->post('last_name'),
                        'address'=>  $this->input->post('address'),
                        'phone_no'=>  $this->input->post('phone_no'),
                        'mobile'=>  $this->input->post('mobile'),
                        'dob'=>  $this->input->post('dob'),
            'contact_id'=>$this->input->post('contact_id'),
                

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('co_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('co_id' => $last_id
            );

         

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

      function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('co_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }
    public function get_detail($co_id) {

        $this->db->select('contact_other.*');
        $this->db->from('contact_other');
        $this->db->where('co_id', $co_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}
