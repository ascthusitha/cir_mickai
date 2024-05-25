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
}
