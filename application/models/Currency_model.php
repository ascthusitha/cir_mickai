<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Currency_model extends CI_Model {

    protected $table = 'currency';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function currency_count() {
        return $this->db->count_all_results('currency');
    }

    function get_currency() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('currency');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('currency_id');
        $data = array('currency_name' => $this->input->post('currency_name'),
                'currency_code'=>  $this->input->post('currency_code'),

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('currency_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('currency_id' => $last_id
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
        $this->db->select('currency.*');
        $this->db->from('currency');
        $this->db->where('deleted',0);
        $this->db->where('currency_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('currency_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_currency_dropdown() {

        $langArray = array();
        $this->db->select('currency_id,currency_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('currency');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->currency_id] = $row->currency_name;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT currency_id, currency_name
				FROM currency WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>