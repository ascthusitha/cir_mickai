<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of userModel
 *
 * @author Thusitha
 */

class User_model extends CI_Model {

    public $table = 'user';
    private $table_permission		= 'permission';

    public function __construct() {
        $this->load->database();
        parent::__construct();
        $this->_database = $this->db;

        $this->_table = $this->table;
        $this->table_permission			= $this->table_permission;
    }

    public function checkAuthentication($user,$pass) {

        $sql = "SELECT * FROM user WHERE  (user_username = ?) AND user_password = ? AND user_status=0 AND deleted=0 ";

        $pass1 = sha1($pass);
        $result = $this->db->query($sql, array($user,$pass1));

        $log = 0;
        if ($result->num_rows() == 1) {
            $log = 1;
        }
        return $log;
    }

    public function getUserData($user) {

        $this->db->select('user.*,user_group_permission.*,user_group_permission_sub1.*,user_group.user_group_name');
        $this->db->from('user');
        $this->db->join('user_group_permission', 'user.user_group_id=user_group_permission.user_group_id', 'left');
        $this->db->join('user_group_permission_sub1', 'user.user_group_id=user_group_permission_sub1.user_group_id', 'left');
        $this->db->join('user_group', 'user.user_group_id=user_group.user_group_id', 'left');
        $this->db->where('user.user_username', $user);
        $this->db->or_where('user.user_email', $user);
        $this->db->where('user.user_status', 0);
        $this->db->where('user.deleted', 0);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $myDetails = array();
            $row = $query->row_array();
            //user data
            $myDetails['fname'] = $row['user_fname'];
            $myDetails['lname'] = $row['user_lname'];
            $myDetails['username'] = $row['user_username'];
            $myDetails['email'] = $row['user_email'];
            $myDetails['user_group_id'] = $row['user_group_id'];
            $myDetails['user_id'] = $row['user_id'];
            $myDetails['user_group_name'] = $row['user_group_name'];
            
            //permission data
            $myDetails['pos'] = $row['pos'];
            $myDetails['master_details'] = $row['master_details'];
            $myDetails['item'] = $row['item'];
            $myDetails['category'] = $row['category'];
            $myDetails['inventory'] = $row['inventory'];
            $myDetails['admin'] = $row['admin'];
            $myDetails['report'] = $row['report'];
            $myDetails['approval'] = $row['approval'];
            $myDetails['customer'] = $row['customer'];
            $myDetails['order'] = $row['order'];
            
            $myDetails['item_add'] = $row['item_add'];
            $myDetails['item_list'] = $row['item_list'];
            $myDetails['order_list'] = $row['order_list'];
            $myDetails['import'] = $row['import'];
            $myDetails['bar_code'] = $row['bar_code'];
            $myDetails['inv_list'] = $row['inv_list'];
            $myDetails['inv_purch'] = $row['inv_purch'];
            $myDetails['inv_purch_add'] = $row['inv_purch_add'];
            $myDetails['sup_add'] = $row['sup_add'];
            $myDetails['sup_list'] = $row['sup_list'];
            $myDetails['manage'] = $row['manage'];
            $myDetails['approval_list'] = $row['approval_list'];
            $myDetails['approval_out'] = $row['approval_out'];
            $myDetails['cat_add'] = $row['cat_add'];
            $myDetails['cat_list'] = $row['cat_list'];
            $myDetails['cus_add'] = $row['cus_add'];
            $myDetails['cus_list'] = $row['cus_list'];
            $myDetails['cus_list_all'] = $row['cus_list_all'];
            $myDetails['r_sales'] = $row['r_sales'];
            $myDetails['r_stock_book'] = $row['r_stock_book'];
            $myDetails['r_stock'] = $row['r_stock'];
            $myDetails['r_profit'] = $row['r_profit'];
            $myDetails['company'] = $row['company'];
            $myDetails['g_rate'] = $row['g_rate'];
            $myDetails['g_rate_add'] = $row['g_rate_add'];
            $myDetails['u_list'] = $row['u_list'];
            $myDetails['u_add'] = $row['u_add'];
            $myDetails['cur_list'] = $row['cur_list'];
            $myDetails['cur_add'] = $row['cur_add'];
            $myDetails['u_group_add'] = $row['u_group_add'];
            $myDetails['u_permission'] = $row['u_permission'];
            
            
            

            return $myDetails;
        } else {
            return 0;
        }
    }

    function user_count() {
        $this->db->where('deleted', '0');
        $this->db->where('user_status', '0');
        $this->db->where('user.user_id <>', '1');
        return $this->db->count_all_results('user');
    }

    function get_user() {
       
        $this->db->select('user.*,user_group.user_group_name');
        $this->db->join('user_group', 'user.user_group_id=user_group.user_group_id', 'left');
        $this->db->where('user.deleted', '0');
        $this->db->where('user.user_status', '0');
        $this->db->where('user.user_id <>', '1');
        
        $query = $this->db->get('user');
                return $query->result();
    }

    function addUser() {
        $id = $this->input->post('user_id');
        $data = array(
            'user_fname' => $this->input->post('fname'),
            'user_lname' => $this->input->post('lname'),
            'user_address' => $this->input->post('address'),
            'user_email' => $this->input->post('email'),
            'dob' => date("Y-m-d", strtotime($this->input->post('dob'))),
            'user_telephone' => $this->input->post('telephone'),
            'user_mobile' => $this->input->post('mobile'),
            'user_username' => $this->input->post('username'),
            'user_group_id' => $this->input->post('user_group'),
            'user_code' => $this->input->post('u_code'),
            'created_by' => $this->session->userdata('user_id')
        );
        if ($this->input->post('cpassword')) {
            $this->db->set('user_password', sha1($this->input->post('cpassword')));
        }
$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        if ($id != 0) {

            $this->db->set('created_date',$fdate);
            $this->db->where('user_id', $id);
            //$this->db->where('user_group_id','1');
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
            return TRUE;
        }
    }

    function updateUser() {
        $id = $this->input->post('user_id');
        $data = array(
            'user_fname' => $this->input->post('fname'),
            'user_lname' => $this->input->post('lname'),
            'user_address' => $this->input->post('address'),
            'user_email' => $this->input->post('email'),
            'dob' => date("Y-m-d", strtotime($this->input->post('dob'))),
            'user_telephone' => $this->input->post('telephone'),
            'user_mobile' => $this->input->post('mobile'),
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('created_date',$fdate);
        $this->db->where('user_id', $id);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function updatePassword() {
        $id = $this->input->post('user_id');
        if ($this->input->post('cpassword')) {
            $this->db->set('user_password', sha1($this->input->post('cpassword')));
        }
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('created_date',$fdate);
        $this->db->where('user_id', $id);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    public function deleteUser($id) {
$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('created_date',$fdate);
        $this->db->where('user_id', $id);
        $this->db->update($this->table);
        return TRUE;
    }

    function get_user_detail($id) {
        $this->db->select('user.*,user_group.user_group_name');
        $this->db->from('user');
        $this->db->join('user_group', 'user.user_group_id=user_group.user_group_id', 'left');
        //$this->db->where('user.user_group_id','1');
        $this->db->where('user.user_id', $id);
        $this->db->where('user.user_id <>', '1');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_user_dropdown() {
        $userarray = array();
        $this->db->select('user_id, user_username');
        $this->db->where('user.user_id <>', '1');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->user_id] = $row->user_username;
            }
        }
        return $userarray;
    }

    function get_user_fullname_dropdown() {
        $userarray = array();
        $this->db->select('user_id, user_fname, user_lname');
        $this->db->where('user.user_id <>', '1');
        $query = $this->db->get('user');
        $userarray[' '] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->user_id] = $row->user_fname.' '.$row->user_lname;
            }
        }
        return $userarray;
    }

    function get_user_dropdown1() {
        
        $userarray = array();
        $this->db->select('user_id, user_username');
        $this->db->where('user.user_id <>', '1');
        
        $query = $this->db->get('user');
        $userarray['0'] = ' All ';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $userarray[$row->user_id] = $row->user_username;
            }
        }
        return $userarray;
    }

    function get_allUser() {
        $this->db->select('user.*,user_group.user_group_name');
        $this->db->join('user_group', 'user.user_id=user_group.user_group_id', 'left');
        $this->db->where('user.deleted', '0');
        $this->db->where('user.user_status', '0');
        $this->db->where('user.user_id <>', '1');
        return $this->get_all();
    }

    function isUsernameExist($user_name, $user_id) {
        $this->db->select('user_id');
        $this->db->where('user_username', $user_name);
        $this->db->where('user_id <>', $user_id);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function isEmailExist($email, $user_id) {
        $this->db->select('user_id');
        $this->db->where('user_email', $email);
        $this->db->where('user_id <>', $user_id);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function isValidEmail($email) {
        $this->db->select('user_id');
        $this->db->where('user_email', $email);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function check_key($key) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->select('user_id');
        $this->db->where('mail_change_hash', $key);
        $this->db->where("mail_expire_date > $fdate");
        $this->db->limit(1);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0) {
            return $this->get_all()[0]->user_id;
        } else {
            return false;
        }
    }

    function change_pass($new_pass, $key) {
        $this->db->set('mail_change_hash', '');
        $this->db->set('user_password', sha1($new_pass));
        $this->db->where('mail_change_hash', $key);
        $this->db->update($this->table);
    }

    function update_reset_pass($to_mail, $hash_value) {
        $date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Colombo'));
$fdate = $date->format('Y-m-d H:i:s'); 
        $expire = date("Y-m-d H:i:s", strtotime("+ 1 day"));
        $this->db->set('mail_expire_date', $expire);
        $this->db->set('mail_change_hash', $hash_value);
        $this->db->where('user_email', $to_mail);
        $this->db->update($this->table);
    }

    public function get_users_from_group($group) {
        $sql = "SELECT user_id, user_fname, user_lname
				FROM user
				WHERE user_group_id=$group AND user_id<>1";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_user_data($id) {
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->where('user.user_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getPermission($user_group_id) {
        $table1 = $this->table_permission;

        $this->db->select('a.pl_id');
        $this->db->from($table1.' a');
        $this->db->where('user_group_id',$user_group_id);
        $query = $this->db->get();
        $result = $query->result_array();
        $array=array_map (function($value){
            return $value['pl_id'];
        } , $result);
        return $array;
        
    }

}

?>
