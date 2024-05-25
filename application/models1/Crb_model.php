<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user crb_model
 *
 * @author Thusitha
 */
class Crb_model extends CI_Model {

    protected $table = 'crb';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function crb_count() {
        return $this->db->count_all_results('crb');
    }

    function get_crb() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('crb');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('crb_id');
        $data = array('crb_name' => $this->input->post('crb_name'),
                

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('crb_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('crb_id' => $last_id
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
        $this->db->select('crb.*');
        $this->db->from('crb');
        $this->db->where('deleted',0);
        $this->db->where('crb_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('crb_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_crb_dropdown() {

        $langArray = array();
        $this->db->select('crb_id, crb_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('crb');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->id] = $row->crb;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT crb_id, crb_name
				FROM crb WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file crb_model.php */
/* Location: ./application/models/crb_model.php */
?>