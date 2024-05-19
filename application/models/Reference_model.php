<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author CHAMINDA
 */
Class Reference_model extends CI_Model {

    public $table_reference	= 'reference_table';

    public function __construct() {
        parent::__construct();

        $this->table_reference		= $this->table_reference;
    }

    public function getCode($name) {
        $table1 = $this->table_reference;
        $this->db->select('a.pre_code, a.number');
        $this->db->from($table1.' a');
        $this->db->where('a.name', $name);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function increaseCode($name) {
        $this->db->set('number', '`number`+ 1', FALSE);
        $this->db->where('name', $name);
        $this->db->update($this->table_reference);
        return $this->db->affected_rows() > 0;  
    }

}