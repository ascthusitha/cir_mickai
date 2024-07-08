<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of contact
 *
 * @author THUSITHA
 */
Class Contact_model extends CI_Model {

    protected $table = 'contact';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        $this->load->model('code_generation_m');
        
    }

    public function get_contact_count() {
        
        $this->db->where('deleted', '0');

        return $this->db->count_all_results('contact');
    }
   public function get_contact() {

        $this->db->select('p.*,k.user_fname,a.acc_name');
        $this->db->from('contact p');
        $this->db->join('user k', 'p.created_by=k.user_id', 'left');
         $this->db->join('account a', 'p.acc_id=a.acc_id', 'left');
        $this->db->where('p.deleted', '0');
        $query = $this->db->get();
        return $query->result();
        // return $this->get_all();
    }
    

    public function get_contact_detail($contact_id) {

        $this->db->select('contact.*');
        $this->db->from('contact');
        $this->db->where('contact_id', $contact_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_contact_details($acc_id) {

        $this->db->select('contact.*');
        $this->db->from('contact');
        $this->db->where('acc_id', $acc_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function addcontact() {

        $contact_id = $this->input->post('contact_id');
        $data = array(
            
            'contact_name' => $this->input->post('contact_name'),
            'contact_lname' => $this->input->post('contact_lname'),
            'acc_id' => $this->input->post('acc_id'),
            'office_phone' => $this->input->post('office_phone'),
            'mobile' => $this->input->post('mobile'),
            'home_phone' => $this->input->post('home_phone'),
            'alternate_phone' => $this->input->post('alternate_phone'),
            'email' => $this->input->post('email'),
            'fax' => $this->input->post('fax'),
            'department' => $this->input->post('department'),
            'designation' => $this->input->post('designation'),
            'car_id' => $this->input->post('car_id'),
            'birthdate' => date('Y-m-d', strtotime($this->input->post('birthdate'))),
            'crr_id' => $this->input->post('crr_id'),
            'assistant' => $this->input->post('assistant'),
            'assistant_phone' => $this->input->post('assistant_phone'),
            'primary_address' => $this->input->post('primary_address'),
            'other_address' => $this->input->post('other_address'),
            'primary_city' => $this->input->post('primary_city'),
            'other_city' => $this->input->post('other_city'),
            'primary_state' => $this->input->post('primary_state'),
            'other_state' => $this->input->post('other_state'),
            'primary_postal_code' => $this->input->post('p_post'),
            'other_postal_code' => $this->input->post('o_post'),
            'primary_country' => $this->input->post('primary_country'),
            'other_country' => $this->input->post('other_country'),
            'description' => $this->input->post('description'),
            'assign_to' => $this->input->post('assign_to'),
            'r_date' => date('Y-m-d', strtotime($this->input->post('r_date'))),
            'c_date' => date('Y-m-d', strtotime($this->input->post('c_date'))),
            'm_status' => $this->input->post('m_status'),
        );
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($contact_id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', $fdate);
            $this->db->where('contact_id', $contact_id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            
            
           
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
            

            return TRUE;
        }
    }

    function delete($contact_id) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date',$fdate);
        $this->db->where('contact_id', $contact_id);
        $this->db->update($this->table);
        return TRUE;
    }

    function get_contact_dropdown() {
        $cusarray = array();
        $this->db->select('contact_id,contact_name');
        $this->db->where('deleted', '0');
               $this->db->order_by('contact_name', 'ASC');
        $query = $this->db->get('contact');
        $cusarray[''] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->contact_id] = $row->contact_name ;//. " " . $row->cus_lname
            }
        }
        return $cusarray;
    }
 function get_contact_dropdown1() {
        $cusarray = array();
        $this->db->select('contact_id,contact_name');
        $this->db->where('deleted', '0');
               $this->db->order_by('contact_name', 'ASC');
        $query = $this->db->get('contact');
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $cusarray[$row->contact_id] = $row->contact_name ;//. " " . $row->cus_lname
            }
        }
        return $cusarray;
    }
    function get_image($contact_id){
          $this->db->where('contact_id', $contact_id);
      
        $query = $this->db->get('contact')->result();

        $img = $query[0]->std_photo;

        return $img;
    }
    public function get_contacts($acc_id){
        $cusarray = array();
        $this->db->select('contact_id,contact_name');
        $this->db->where('deleted', '0');
        $this->db->where('acc_id',$acc_id);
        $this->db->order_by('contact_name', 'ASC');
        $query = $this->db->get('contact');
   
       
            foreach ($query->result() as $row) {
                $cusarray[$row->contact_id] = $row->contact_name ;
            }
        
        
        return $cusarray;
    }


//     function addPosCustomer($cus_id,$title,$cus_fname,$cus_lname,$id_number,$address,$mobile,$telephone,$email) {

//         $id = $cus_id;
//         $data = array(
//             'title' => $title,
//             'cus_fname' => $cus_fname,
//             'cus_lname' => $cus_lname,
//             'id_number' => $id_number,
//             'address' => $address,
//             'mobile' => $mobile,
//             'telephone' => $telephone,
//             'email' => $email,
//         );
//         $date = new DateTime();
// $date->setTimezone(new DateTimeZone('Asia/Colombo'));
// $fdate = $date->format('Y-m-d H:i:s'); 
//        $contact_id=$this->session->userdata('contact_id');
//             $code = $this->code_generation_m->getCode('CUS');
//             $this->db->set('cus_code', $code);
//             $this->db->set('created_by', $this->session->userdata('user_id'));
//             $this->db->set('created_date',$fdate);
//             $this->db->set('contact_id', $contact_id);
//             $this->db->insert($this->table, $data);
//             $insert_id = $this->db->insert_id(); 
//             $this->code_generation_m->updateCode('CUS');

//             return $insert_id;
        
//     }
}
