<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of region_model
 *
 * @author td
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
}
