<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Car_model extends CI_Model {

    protected $table = 'car';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function car_count() {
        return $this->db->count_all_results('car');
    }

    function get_car() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('car');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('car_id');
        $data = array('car_name' => $this->input->post('car_name'),
         

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('car_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('car_id' => $last_id
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
        $this->db->select('car.*');
        $this->db->from('car');
        $this->db->where('deleted',0);
        $this->db->where('car_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('car_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_car_dropdown() {

        $langArray = array();
        $this->db->select('car_id, car_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('car');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->car_id] = $row->car_name;
            }
        }
        return $langArray;
    }

    public function get_caries() {
        $sql = "SELECT car_id, car_name
				FROM car WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>