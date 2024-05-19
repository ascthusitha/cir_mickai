<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Market_model
 *
 * @author td
 */
class Market_model extends CI_Model {

    public $table = 'market';

    public function __construct() {
        $this->load->database();
        parent::__construct();
        $this->_database = $this->db;

        $this->_table = $this->table;
    }
     function get_market_dropdown() {
        $userarray = array();
        $this->db->select('market_id, market_name');
        
        $query = $this->db->get('market');
        $userarray[' '] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->market_id] = $row->market_name;
            }
        }
        return $userarray;
    }

    function get_market_dropdown1() {
        
        $userarray = array();
        $this->db->select('market_id, market_name');
       
        $query = $this->db->get('market');
        $userarray['0'] = ' All ';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->market_id] = $row->market_name;
            }
        }
        return $userarray;
    }

    function market_count() {
        return $this->db->count_all_results('market');
    }

    function get_market() {
        $this->db->select('m.*, CONCAT(u.user_fname," ",u.user_lname) AS created_user');
        $this->db->from('market m');
        $this->db->join('user u', 'm.created_by=u.user_id', 'left');
        $this->db->where('m.deleted',0);
        $query = $this->db->get();
        return $query->result();
    }

    function add() {
        $id = $this->input->post('market_id');
        $data = array('market_name' => $this->input->post('market_name'),
         

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('market_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('market_id' => $last_id
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
        $this->db->select('market.*');
        $this->db->from('market');
        $this->db->where('deleted',0);
        $this->db->where('market_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('market_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    




}
