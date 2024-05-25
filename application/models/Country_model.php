<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of  Country_model
 *
 * @author Thusitha
 */
class Country_model extends CI_Model {

    protected $table = 'country';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function country_count() {
        return $this->db->count_all_results('country');
    }

    function get_country() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('country');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('country_id');
        $data = array('country_name' => $this->input->post('country_name'),
                'country_code'=>  $this->input->post('country_code'),

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('country_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('country_id' => $last_id
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
        $this->db->select('country.*');
        $this->db->from('country');
        $this->db->where('deleted',0);
        $this->db->where('country_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('country_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_country_dropdown() {

        $langArray = array();
        $this->db->select('country_id, country_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('country');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->country_id] = $row->country_name;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT country_id, country_name
                FROM country WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file Country_model.php */
/* Location: ./application/models/Country_model.php */
?>