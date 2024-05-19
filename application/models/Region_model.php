<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of region_model
 *
 * @author Chaminda
 */
class region_model extends CI_Model {

    public $table = 'region';

    public function __construct() {
        $this->load->database();
        parent::__construct();
        $this->_database = $this->db;

        $this->_table = $this->table;
    }
     function get_region_dropdown() {
        $userarray = array();
        $this->db->select('region_id, region_name');

        $query = $this->db->get('region');
        $userarray[' '] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->region_id] = $row->region_name;
            }
        }
        return $userarray;
    }

    function get_region_dropdown1() {
        
        $userarray = array();
        $this->db->select('region_id, region_name');
        
        
        $query = $this->db->get('region');
        $userarray['0'] = ' All ';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->region_id] = $row->region_name;
            }
        }
        return $userarray;
    }

    function region_count() {
        return $this->db->count_all_results('region');
    }

    function get_region() {
        $this->db->select('r.*, CONCAT(u.user_fname," ",u.user_lname) AS created_user');
        $this->db->from('region r');
        $this->db->join('user u', 'r.created_by=u.user_id', 'left');
        $this->db->where('r.deleted',0);
        $query = $this->db->get();
        return $query->result();
    }

    function add() {
        $id = $this->input->post('region_id');
        $data = array('region_name' => $this->input->post('region_name'),
         

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('region_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('region_id' => $last_id
            );

         

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

    public function get_detail($id) {
        $this->db->select('region.*');
        $this->db->from('region');
        $this->db->where('deleted',0);
        $this->db->where('region_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('region_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }


}
