<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author THUSITHA
 */
class Alert_sms_model extends CI_Model
{

    protected $table = 'alert_details';

    public function __construct()
    {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    public function add_alert($contact_id,$app_date,$type, $contact_value, $twilioNumber, $message,$tw_id,$c_id)
    {

        $data = array(

            'contact_id' => $contact_id,
            'alert_type' => $type,
            'contact_value' => $contact_value,
            'sender' => $twilioNumber,
            'message' => $message,
            'app_date'=>$app_date,
            'tw_id'=>$tw_id
        );
        $date = new DateTime();

        $fdate = $date->format('Y-m-d H:i:s');
		 $today = Date('Y-m-d');
        $this->db->set('alert_date', $fdate);
        $this->db->set('alert_time', $fdate);
        $this->db->insert($this->table, $data);
 //update campaign inactivate
		$this->load->model('campaign_model');
		$c_data=$this->campaign_model->get_detail($c_id);

		 if(($c_data['message_type'] == 'once')&& ($c_data['end_date']==$today)){
			$this->db->set('updated_by', $this->session->userdata('user_id'));
			$this->db->set('updated_at', $fdate);
			$this->db->set('status', 'inactive');
			$this->db->where('campaign_id', $c_id);
			$this->db->update('campaign');
		}else  if(($c_data['message_type'] == 'day')&& ($c_data['end_date']==$today)){
			$this->db->set('updated_by', $this->session->userdata('user_id'));
			$this->db->set('updated_at', $fdate);
			$this->db->set('status', 'inactive');
			$this->db->where('campaign_id', $c_id);
			$this->db->update('campaign');
		}
        return TRUE;
    }
    public function get_alert_details1()
    {
$this->db->select('*');
        $query = $this->db->get('alert_details');
                return $query->result();



    }
    public function get_alert_detail($contact_id)
    {

         $this->db->select('alert_details.*');
         $this->db->from('alert_details');
         $this->db->where('alert_details.contact_id', $contact_id);
         $query = $this->db->get();
         return $query->result();


    }
    public function get_alert_count($type = null,$from, $to)
    {

        $this->db->where('alert_details.alert_date BETWEEN "'.$from.'" AND "'.$to.'"');
        $this->db->where('alert_details.alert_type', $type);

        return $this->db->count_all_results('alert_details');
    }
	public function updateSMSStatus($messageSid, $messageStatus){
		 $date = new DateTime();
		$fdate = $date->format('Y-m-d H:i:s');
		
			$this->db->set('updated_at', $fdate);
			$this->db->set('sms_status', $messageStatus);
			$this->db->where('tw_id', $messageSid);
			$this->db->update('alert_details');
	}
}