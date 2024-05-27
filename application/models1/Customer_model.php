<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Customer
 *
 * @author THUSITHA
 */
Class Customer_model extends CI_Model {

    protected $table = 'customer';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        $this->load->model('code_generation_m');
        
    }

    public function get_customer_count() {
       
        $this->db->where('status', '0');

        return $this->db->count_all_results('customer');
    }
    public function get_tcustomer_count() {
        
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));

$today = date('Y-m-d');
        $this->db->where('status', '0');
        $this->db->like('added_date', $today);
        return $this->db->count_all_results('customer');
    }
    
            function get_customer() {

        $this->db->select('p.*,k.user_fname');
        $this->db->from('customer p');
        $this->db->join('user k', 'p.added_by=k.user_id', 'left');
        $this->db->where('p.status', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }

    public function get_customer_detail($id) {

        $this->db->select('customer.*');
        $this->db->from('customer');
        $this->db->where('cus_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_customer_details($id) {
        $this->db->select('p.*,k.customer_type_name,q.promotion_name,r.amount,r.start_date,r.end_date ');
        $this->db->from('customer p');
        $this->db->join('customer_type k', 'p.cus_type_id=k.customer_type_id', 'left');
        $this->db->join('promotion_details r', 'p.cus_type_id=r.customer_type', 'left');
        $this->db->join('promotion q', 'r.promotion_id=q.promotion_id', 'left');
        $this->db->where('cus_code', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function addCustomer() {

        $id = $this->input->post('cus_id');
        $data = array(
            'title' => $this->input->post('title'),
            'cus_fname' => $this->input->post('f_name'),
            'cus_lname' => $this->input->post('l_name'),
            'id_number' => $this->input->post('id_number'),
            'address' => $this->input->post('address'),
            'mobile' => $this->input->post('mobile'),
            'telephone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('cus_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            
            $code = $this->code_generation_m->getCode('CUS');
            $this->db->set('cus_code', $code);
            $this->db->set('added_by', $this->session->userdata('user_id'));
            $this->db->set('added_date',$fdate);
            $this->db->insert($this->table, $data);
            $this->code_generation_m->updateCode('CUS');

            return TRUE;
        }
    }

    function delete($id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('status', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('cus_id', $id);
        $this->db->update($this->table);
    }

    function get_customer_dropdown() {
        $cusarray = array();
        $this->db->select('cus_id,cus_fname,cus_lname');
        $this->db->where('status', '0');
        $this->db->order_by('cus_fname', 'ASC');
        $query = $this->db->get('customer');
        $cusarray['0'] = 'Cash';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->cus_id] = $row->cus_fname ;//. " " . $row->cus_lname
            }
        }
        return $cusarray;
    }

    public function get_cus_mobile($cus_id) {
        $this->db->where('cus_id', $cus_id);
        $query = $this->db->get('customer')->result();

        $num = $query[0]->mobile;

        return $num;
    }
public function get_customer_id($id_number,$cus_id){
        $this->db->where('id_number', $id_number);
        if($cus_id>0){
        $this->db->where('cus_id <>', $cus_id);
        }
        $query = $this->db->get('customer');

    			if($query->num_rows() > 0){
				return true; //  already exists
			}else{
                            return false; // can be added
			}

        
    }
    public function get_customer_se_detail($cus_code, $f_name, $user_id,$id_no){
        
		$this->db->select('c.*');
		$this->db->from('customer c');
		// $this->db->join('user k', 'c.added_by=k.user_id', 'left');
		// $this->db->where('c.status',0);
       
		// if($cus_code){
		// 	$this->db->where('c.cus_code',$cus_code);
		// }

		// if($f_name){
		// 	$this->db->like('c.cus_fname',$f_name);
		// }

		// if($id_no){
		// 	$this->db->where('c.id_number',$id_no);
		// }

		// if($user_id){
		// 	$this->db->where('c.added_by',$user_id);
		// }
		

		// $this->db->order_by('c.cus_id','ASC');
		
		$query = $this->db->get();

         return $query->result();
    }

    function addPosCustomer($cus_id,$title,$cus_fname,$cus_lname,$id_number,$address,$mobile,$telephone,$email) {

        $id = $cus_id;
        $data = array(
            'title' => $title,
            'cus_fname' => $cus_fname,
            'cus_lname' => $cus_lname,
            'id_number' => $id_number,
            'address' => $address,
            'mobile' => $mobile,
            'telephone' => $telephone,
            'email' => $email,
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
            $code = $this->code_generation_m->getCode('CUS');
            $this->db->set('cus_code', $code);
            $this->db->set('added_by', $this->session->userdata('user_id'));
            $this->db->set('added_date',$fdate);
            $this->db->insert($this->table, $data);
            $insert_id = $this->db->insert_id(); 
            $this->code_generation_m->updateCode('CUS');

            return $insert_id;
        
    }
}
