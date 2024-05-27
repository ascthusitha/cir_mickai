<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Mapplication_model extends CI_Model {

    protected $table = 'application';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function application_count() {
        return $this->db->count_all_results('application');
    }

    function get_application() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('application');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('app_id');
        $data = array('app_name' => $this->input->post('app_name'),
                

            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('app_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('app_id' => $last_id
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
        $this->db->select('application.*');
        $this->db->from('application');
        $this->db->where('deleted',0);
        $this->db->where('app_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('app_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_application_dropdown() {

        $langArray = array();
        $this->db->select('app_id, app_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('application');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->app_id] = $row->app_name;
            }
        }
        return $langArray;
    }

    public function get_applicationies() {
        $sql = "SELECT app_id, app_name
				FROM application WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>