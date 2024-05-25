<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Account
 *
 * @author THUSITHA
 */
Class Account_model extends CI_Model {

    protected $table = 'account';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        $this->load->model('code_generation_m');
        
    }

    public function get_account_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('account');
    }
   public function get_account() {

        $this->db->select('p.*,k.user_fname');
        $this->db->from('account p');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_account_detail($acc_id) {

        $this->db->select('account.*');
        $this->db->from('account');
        $this->db->where('acc_id', $acc_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addAccount() {

        $acc_id = $this->input->post('acc_id');
        $data = array(
            
            'acc_name' => $this->input->post('acc_name'),
            'b_name' => $this->input->post('b_name'),
            'email' => $this->input->post('email'),
            'fax' => $this->input->post('fax'),
            'office_phone' => $this->input->post('mobile'),
            'alternate_phone' => $this->input->post('telephone'),
            'website' => $this->input->post('website'),
            'region_id' => $this->input->post('region_id'),
            'market_id' => $this->input->post('market_id'),
            'vat_no' => $this->input->post('vat_no'),
            'p_user' => $this->input->post('ps_id'),
            'i_user' => $this->input->post('is_id'),
            'o_address' => $this->input->post('o_address'),
            's_address' => $this->input->post('s_address'),
            'o_city' => $this->input->post('o_city'),
            's_city' => $this->input->post('s_city'),
            'o_province' => $this->input->post('o_province'),
            's_province' => $this->input->post('s_province'),
            'o_postal_code' => $this->input->post('o_post'),
            's_postal_code' => $this->input->post('s_post'),
            'o_country' => $this->input->post('o_country'),
            's_country' => $this->input->post('s_country'),
            'description' => $this->input->post('description'),
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($acc_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('acc_id', $acc_id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            
            $code = $this->code_generation_m->getCode('ACC');
            $this->db->set('acc_code', $code);
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
            $this->code_generation_m->updateCode('ACC');

            return TRUE;
        }
    }

    function delete($acc_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('acc_id', $acc_id);
        $this->db->update($this->table);
           return TRUE;
    }

    function get_account_dropdown() {
        $cusarray = array();
        $this->db->select('acc_id,acc_name');
        $this->db->where('deleted', '0');
               $this->db->order_by('acc_name', 'ASC');
        $query = $this->db->get('account');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->acc_id] = $row->acc_name;
            }
        }
        return $cusarray;
    }


}
