<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of supplier_model
 *
 * @author Thusitha
 */
class Supplier_model extends CI_Model {

    public $table = 'supplier';

    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;

        $this->_table = $this->table;
        $this->load->model('code_generation_m');

        $this->load->model('User_model');
    }

    public function get_supplier() {
        //$account_id=$this->session->userdata('account_id');
        $this->db->select('supplier.*');
        
        $this->db->where('supplier.supplier_status', '1');
        //$this->db->where('supplier.account_id',$account_id);
       $query = $this->db->get('supplier');
                return $query->result();
    }

    public function get_supplier_count() {
        $this->db->where('status', '0');
        return $this->db->count_all_results('supplier');
    }

    public function get_supplier_detail($id) {
        $this->db->select('supplier.*');
        $this->db->from('supplier');
        $this->db->where('supplier_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addSupplier($new_name, $supplier_code, $supplier_name, $address, $email, $supplier_telephone, $supplier_mobile, $supplier_website, $supplier_id, $contact_name) {
        $return = 0;
        $id = $supplier_id;


        $array = explode('.', $_FILES['image1']['name']);
        $ext = end($array);
        $new_name = $new_name . "." . $ext;
        $data = array(
            'supplier_name' => $supplier_name,
            'supplier_address' => $address,
            'supplier_email' => $email,
            'supplier_telephone' => $supplier_telephone,
            'supplier_mobile' => $supplier_mobile,
            'supplier_website' => $supplier_website,
            'supplier_image' => $new_name,
            'contact_name' => $contact_name,
        );
        $this->db->trans_begin();
        if ($id != 0) {
            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', 'NOW()', FALSE);
            $this->db->where('supplier_id1', $id);
            $this->db->update($this->table, $data);
            $return = $id;
        } else {
            //get last supplier code
            $supplier_code = $this->code_generation_m->getCode('SUP');
           // $account_id=$this->session->userdata('account_id');

           // $this->db->set('account_id', $account_id);
            $this->db->set('supplier_code', $supplier_code);
            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert($this->table, $data);
            $return = $this->db->insert_id();
            $this->code_generation_m->updateCode('SUP');
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return $return;
    }

    function deleteSupplier($id) {
        $this->db->set('status', '1');
        $this->db->set('update_by', $this->session->userdata('user_id'));
        $this->db->set('update_date', 'NOW()', FALSE);
        $this->db->where('supplier_id', $id);
        $this->db->update($this->table);
    }

    function get_supplier_dropdown() {
        $supplierarray = array();
        $this->db->select('supplier_id, supplier_name');
        $this->db->order_by('supplier_name', 'asc');
        $query = $this->db->get('supplier');
        $supplierarray[0] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $supplierarray[$row->supplier_id] = $row->supplier_name;
            }
        }
        return $supplierarray;
    }

    function get_suppliers() {
        $supplierarray = array();
        $this->db->select('supplier_id, supplier_name');
        $this->db->order_by('supplier_name', 'asc');
        $query = $this->db->get('supplier');
        $supplierarray[0] = '-- All --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $supplierarray[$row->supplier_id] = $row->supplier_name;
            }
        }
        return $supplierarray;
    }

    public function get_supplier_users() {

        $this->_table = 'supplier_user';
        $this->db->select('supplier_user.*,supplier.supplier_name');
        $this->db->join('supplier', 'supplier_user.supplier_id=supplier.supplier_id', 'left');
        $this->db->where('supplier_user.status', '0');
        return $this->get_all();
    }

    function add_sup_user() {

        $id = $this->input->post('supplier_user_id');
        $data = array('sup_fname' => $this->input->post('fname'),
            'sup_lname' => $this->input->post('lname'),
            'sup_email' => $this->input->post('email'),
            'sup_telephone' => $this->input->post('telephone'),
            'sup_mobile' => $this->input->post('mobile'),
            'sup_uname' => $this->input->post('username'),
            'supplier_id' => $this->input->post('supplier')
        );
        if ($this->input->post('cpassword')) {
            $this->db->set('sup_pwd', sha1($this->input->post('cpassword')));
        }

        if ($id != 0) {

            $this->db->set('update_by', $this->session->userdata('user_id'));
            $this->db->set('update_date', 'NOW()', FALSE);
            $this->db->where('sup_user_id', $id);
            $this->db->update('supplier_user', $data);
            return TRUE;
        } else {

            $this->db->set('created_by', $this->session->userdata('user_id'));
            $this->db->set('created_date', 'NOW()', FALSE);
            $this->db->insert('supplier_user', $data);
            return TRUE;
        }
    }

    public function get_sup_user_detail($sup_user_id) {
        $this->db->select('supplier_user.*');
        $this->db->from('supplier_user');
        $this->db->where('supplier_user.sup_user_id', $sup_user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function is_username_exist($user_name, $user_id) {
        $this->db->select('sup_user_id');
        $this->db->where('sup_uname', $user_name);
        $this->db->where('sup_user_id <>', $user_id);
        $query = $this->db->get('supplier_user');

        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function checkAuthentication($user, $pass) {

        $sql = "SELECT * FROM supplier_user WHERE  (sup_uname = ? ) AND sup_pwd = ?  AND status=0 ";

        $pass1 = sha1($pass);
        $result = $this->db->query($sql, array($user, $pass1));

        $log = 0;
        if ($result->num_rows() == 1) {
            $log = 1;
        }
        return $log;
    }

    public function get_user_data($user) {

        $this->db->select('supplier_user.*,supplier.supplier_name');
        $this->db->from('supplier_user');
        $this->db->join('supplier', 'supplier_user.supplier_id=supplier.supplier_id', 'left');
        $this->db->where('supplier_user.sup_uname', $user);

        $this->db->where('supplier_user.status', 0);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $myDetails = array();
            $row = $query->row_array();
            $myDetails['fname'] = $row['sup_fname'];
            $myDetails['lname'] = $row['sup_lname'];
            $myDetails['sup_uname'] = $row['sup_uname'];
            $myDetails['email'] = $row['sup_email'];
            $myDetails['supplier_id'] = $row['supplier_id'];
            $myDetails['supplier_name'] = $row['supplier_name'];
            $myDetails['sup_user_id'] = $row['sup_user_id'];

            return $myDetails;
        } else {
            return 0;
        }
    }

}

?>
