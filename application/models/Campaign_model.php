<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Campaign_model extends CI_Model {

    protected $table = 'campaign';

    public function __construct() {

        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    function campaign_count() {
        return $this->db->count_all_results('campaign');
    }

    function get_campaign() {
        $this->db->select('*');
     	//$this->db->where('status','active');
         $this->db->where('deleted',0);
        $query = $this->db->get('campaign');
                return $query->result();
    }

    function add() {
        $id = $this->input->post('campaign_id');
        $data = array('campaign_name' => $this->input->post('campaign_name'),
         'campaign_type' => $this->input->post('campaign_type'),
		 'message' => $this->input->post('message'),
		 'message_type' => $this->input->post('message_type'),
		 'start_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
		 'end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
            'start_time'=>$this->input->post('start_time'),
		 'status' => $this->input->post('status'),
            'created_by'=>  $this->session->userdata('user_id')
        );
        if ($id != 0) {

            $this->db->where('campaign_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->insert($this->table, $data);
            $last_id = $this->db->insert_id();
            $data1 = array('campaign_id' => $last_id
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
        $this->db->select('campaign.*');
        $this->db->from('campaign');
        $this->db->where('deleted',0);
			$this->db->where('status','active');
        $this->db->where('campaign_id', $id);
       
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function delete($id) {
        $this->db->set('deleted', 1);
        $this->db->where('campaign_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
      
    }



    public function get_campaign_list($today) {
       $this->db->select('campaign.*');
        $this->db->from('campaign');
        $this->db->where('deleted',0);
		$this->db->where('status','active');
        $this->db->where("'$today' BETWEEN start_date AND end_date", NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>
