<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user Sales_stage_model
 *
 * @author Thusitha
 */
class Sales_stage_model extends CI_Model {

    protected $table = 'sales_stage';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function sales_stage_count() {
        return $this->db->count_all_results('sales_stage');
    }

    function get_sales_stage() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('sales_stage');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('ss_id');
        $data = array('sales_stage' => $this->input->post('sales_stage'),
                'probability'=>  $this->input->post('probability'),

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('ss_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('ss_id' => $last_id
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
        $this->db->select('sales_stage.*');
        $this->db->from('sales_stage');
        $this->db->where('deleted',0);
        $this->db->where('ss_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('ss_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_sales_stage_dropdown() {

        $langArray = array();
        $this->db->select('ss_id, sales_stage');

         $this->db->where('deleted',0);
        $query = $this->db->get('sales_stage');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->ss_id] = $row->sales_stage;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT ss_id, sales_stage
				FROM sales_stage WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file sales_stage_model.php */
/* Location: ./application/models/sales_stage_model.php */
?>