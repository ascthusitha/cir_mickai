<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user tier_model
 *
 * @author Thusitha
 */
class Tier_model extends CI_Model {

    protected $table = 'tier';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function tier_count() {
        return $this->db->count_all_results('tier');
    }

    function get_tier() {
        $this->db->select('*');
     
         $this->db->where('deleted',0);
        $query = $this->db->get('tier');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('tier_id');
        $date = new DateTime();
         $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $f_date = $date->format('Y-m-d H:i:s'); 

        $data = array('tier_name' => $this->input->post('tier_name'),
                'discount'=>  $this->input->post('discount'),
                'markup'=>  ($this->input->post('markup'))?$this->input->post('markup'):'0',
                'description'=>  $this->input->post('description'),
            'created_by'=>  $this->session->userdata('user_id'),
            
        );
        if ($id != 0) {
            $this->db->set('update_by',$this->session->userdata('user_id'));
            $this->db->set('update_date',$f_date);
            $this->db->where('tier_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
           // $this->db->trans_begin();
            $this->db->set('created_date',$f_date);
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
                    

            // if ($this->db->trans_status() === FALSE) {
            //     $this->db->trans_rollback();
            // } else {
            //     $this->db->trans_commit();
            // }
            return TRUE;
        }
    }

    public function get_detail($id) {
        $this->db->select('tier.*');
        $this->db->from('tier');
        $this->db->where('deleted',0);
        $this->db->where('tier_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('tier_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }

    function get_tier_dropdown() {

        $langArray = array();
        $this->db->select('tier_id, tier_name');

         $this->db->where('deleted',0);
        $query = $this->db->get('tier');
        $langArray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $langArray[$row->id] = $row->tier;
            }
        }
        return $langArray;
    }

    public function get_currencies() {
        $sql = "SELECT tier_id, tier_name
				FROM tier WHERE   deleted='0' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

/* End of file tier_model.php */
/* Location: ./application/models/tier_model.php */
?>