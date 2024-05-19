<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author CHAMINDA
 */
Class Scheduling_model extends CI_Model {

    protected $table = 'opportunity';
    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    public function get_products() {
        $this->db->select('p.*');
        $this->db->from('products p');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_sales_stages() {
        $this->db->select('ss.*');
        $this->db->from('sales_stage ss');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_lead_sources() {
        $this->db->select('ls.*');
        $this->db->from('lead_source ls');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_subjects($type) {
        $this->db->select('sub.*');
        $this->db->from('subjects sub');
        $this->db->where('sub.type', $type);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_stats($type) {
        $this->db->select('st.*');
        $this->db->from('status st');
        $this->db->where('st.type', $type);
        $query = $this->db->get();
        return $query->result();
    }

}
