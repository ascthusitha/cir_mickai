<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of fyear_model
 *
 * @author Thusitha
 */
class Fyear_model extends CI_Model{

    //put your code here
    protected $table = 'financial_year';

    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    public function addFyear() {
        $id = $this->input->post('fyear');
        $data = array('checked' => 1,
           
            
        );
        if ($id != 0) {
             $this->db->set('checked',0);
            $this->db->update($this->table);

            $this->db->where('f_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
           
            $this->db->insert($this->table, $data);
            return TRUE;
        }
    }

 
   
    public function get_fyear(){

        $this->db->select('f_id');

         $this->db->where('checked','1');
 

        $this->db->limit(1);

       $res = $this->db->get('financial_year');

       return $res->row('f_id');

    }

}

?>
