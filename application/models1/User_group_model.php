<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user group_model
 *
 * @author Thusitha
 */
class User_group_model extends CI_Model {

    protected $table = 'user_group';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function user_group_count() {
        return $this->db->count_all_results('user_group');
    }

    function get_user_group() {
        $this->db->select('*');
        $this->db->where('user_group_id <>1');
         $this->db->where('deleted',0);
        $query = $this->db->get('user_group');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('user_group_id');
        $data = array('user_group_name' => $this->input->post('u_group')
                //'description'=>  $this->input->post('created_by'),
        );
        if ($id != 0) {

            $this->db->where('user_group_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('user_group_id' => $last_id
            );

            $this->db->insert('user_group_permission', $data1);
            $this->db->insert('user_group_permission_sub1', $data1);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

    public function get_detail($id) {
        $this->db->select('user_group.*');
        $this->db->from('user_group');
        $this->db->where('deleted',0);
        $this->db->where('user_group_id', $id);
        $this->db->where('user_group_id <>1');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('user_group_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_user_group_dropdown() {

        $langArray = array();
        $this->db->select('user_group_id, user_group_name');
        $this->db->where('user_group.user_group_id <>', '1');
         $this->db->where('deleted',0);
        $query = $this->db->get('user_group');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->id] = $row->user_group;
            }
        }
        return $langArray;
    }

    public function get_user_groups() {
        $sql = "SELECT user_group_id, user_group_name
				FROM user_group WHERE user_group_id <>1 and deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file user_group_model.php */
/* Location: ./application/models/user_group_model.php */
?>