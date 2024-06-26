<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Alert_price_model extends CI_Model {

    protected $table = 'alert_rates';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

   function get_price() {
        $this->db->select('c.*, CONCAT(u.user_fname," ",u.user_lname) AS created_user');
        $this->db->from('alert_rates c');
        $this->db->join('user u', 'c.created_by=u.user_id', 'left');
        $this->db->where('c.deleted',0);
        $query = $this->db->get();
        return $query->result();
    }
    function add() {
        $id = $this->input->post('ar_id');
        $data = array('sms_rate' => $this->input->post('sms_rate'),
            'email_rate' => $this->input->post('email_rate'),
            'voice_rate' => $this->input->post('voice_rate'),
            'start_date' => date('Y-m-d', strtotime($this->input->post('s_date'))),
            'end_date' => date('Y-m-d', strtotime($this->input->post('e_date'))),
        );
                $date = new DateTime();

        $fdate = $date->format('Y-m-d H:i:s');
        if ($id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('ar_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
               $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date', $fdate);
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('ar_id' => $last_id
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
        $this->db->select('alert_rates.*');
        $this->db->from('alert_rates');
        $this->db->where('deleted',0);
        $this->db->where('ar_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('ar_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }



}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>