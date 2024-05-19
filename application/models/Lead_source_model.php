<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user lead_source_model
 *
 * @author Thusitha
 */
class Lead_source_model extends CI_Model {

    protected $table = 'lead_source';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function lead_source_count() {
        return $this->db->count_all_results('lead_source');
    }

    function get_lead_source() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('lead_source');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('ls_id');
        $data = array('lead_source_name' => $this->input->post('lead_source_name'),
               

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('ls_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('ls_id' => $last_id
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
        $this->db->select('lead_source.*');
        $this->db->from('lead_source');
        $this->db->where('deleted',0);
        $this->db->where('ls_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('ls_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_lead_source_dropdown() {

        $langArray = array();
        $this->db->select('ls_id, lead_source_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('lead_source');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->id] = $row->lead_source_name;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT lead_source_id, lead_source_name
				FROM lead_source WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file lead_source_model.php */
/* Location: ./application/models/lead_source_model.php */
?>