<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of user_group_permission_model
 *
 * @author Thusitha
 */
class User_group_permission_model extends CI_Model {

    public $table = 'user_group_permission';
	private $table_permission_categories		= 'permission_categories';
	private $table_permission_links		= 'permission_links';
	private $table_permission		= 'permission';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;

        $this->_table = $this->table;
        $this->table_permission_categories			= $this->table_permission_categories;
        $this->table_permission_links			= $this->table_permission_links;
        $this->table_permission			= $this->table_permission;
    }

    public function get_user_group_permission() {

        $this->db->select('user_group.*');

        $query = $this->db->get('user_group');
        return $query->row_array();
    }

    public function user_group_permission_count() {

        return $this->db->count_all_results('user_group_permission');
    }

    public function get_user_group_permission_detail($id) {
        $this->db->select('user_group_permission.*,user_group_permission_sub1.*');
        $this->db->from('user_group_permission');
        $this->db->join('user_group_permission_sub1', 'user_group_permission.user_group_id=user_group_permission_sub1.user_group_id', 'left');
        $this->db->where('user_group_permission.user_group_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function addUserGroupPermission() {
        $user_group_id = $this->input->post('user_group_id');

        $this->db->where('user_group_id', $user_group_id);
        $this->db->delete('permission');

        foreach ($_POST["pchk"] as $key=>$pchk) {
            $data = array(
                'user_group_id'=>$user_group_id,
                'pl_id'=>$key
            );
            $this->db->insert('permission',$data);
        }
        return TRUE;
    }

    public function addUserGroupPermission_() {
        $id = $this->input->post('user_group_id');

        $data = array(
            
            'pos' => isset($_POST["pos"]) ? $_POST["pos"] : 0,
            'customer' => isset($_POST["customer"]) ? $_POST["customer"] : 0,
            'approval' => isset($_POST["approval"]) ? $_POST["approval"] : 0,
            'report' => isset($_POST["report"]) ? $_POST["report"] : 0,
            'item'=> isset($_POST["item"]) ? $_POST["item"] : 0,
            'inventory'=> isset($_POST["inventory"]) ? $_POST["inventory"] : 0,
            'category' => isset($_POST["category"]) ? $_POST["category"] : 0,
            'order' => isset($_POST["order"]) ? $_POST["order"] : 0,
            'master_details' => isset($_POST["master_details"]) ? $_POST["master_details"] : 0,
            'manage' => isset($_POST["manage"]) ? $_POST["manage"] : 0
            
        );

        $data1 = array(
            'approval_list' => isset($_POST["approval_list"]) ? $_POST["approval_list"] : 0,
            'approval_out' => isset($_POST["approval_out"]) ? $_POST["approval_out"] : 0,
            'cus_add' => isset($_POST["cus_add"]) ? $_POST["cus_add"] : 0,
            'cus_list' => isset($_POST["cus_list"]) ? $_POST["cus_list"] : 0,
            'cus_list_all' => isset($_POST["cus_list_all"]) ? $_POST["cus_list_all"] : 0,
            'item_add' => isset($_POST["item_add"]) ? $_POST["item_add"] : 0,
            'order_list' => isset($_POST["order_list"]) ? $_POST["order_list"] : 0,
            'item_list' => isset($_POST["item_list"]) ? $_POST["item_list"] : 0,
            'import' => isset($_POST["import"]) ? $_POST["import"] : 0,
            'bar_code' => isset($_POST["bar_code"]) ? $_POST["bar_code"] : 0,
            'inv_purch' => isset($_POST["inv_purch"]) ? $_POST["inv_purch"] : 0,
            'inv_purch_add' => isset($_POST["inv_purch_add"]) ? $_POST["inv_purch_add"] : 0,
            'inv_list' => isset($_POST["inv_list"]) ? $_POST["inv_list"] : 0,
            'sup_list' => isset($_POST["sup_list"]) ? $_POST["sup_list"] : 0,
            'sup_add' => isset($_POST["sup_add"]) ? $_POST["sup_add"] : 0,
            'cat_list' => isset($_POST["cat_list"]) ? $_POST["cat_list"] : 0,
            'cat_add' => isset($_POST["cat_add"]) ? $_POST["cat_add"] : 0,
            'r_sales' => isset($_POST["r_sales"]) ? $_POST["r_sales"] : 0,
            'r_stock' => isset($_POST["r_stock"]) ? $_POST["r_stock"] : 0,
            'r_stock_book' => isset($_POST["r_stock_book"]) ? $_POST["r_stock_book"] : 0,
            'company' => isset($_POST["company"]) ? $_POST["company"] : 0,
            'g_rate' => isset($_POST["g_rate"]) ? $_POST["g_rate"] : 0,
            'g_rate_add' => isset($_POST["g_rate_add"]) ? $_POST["g_rate_add"] : 0,
            'u_list' => isset($_POST["user_list"]) ? $_POST["user_list"] : 0,
            'u_add' => isset($_POST["user_add"]) ? $_POST["user_add"] : 0,
            'cur_list' => isset($_POST["cur_list"]) ? $_POST["cur_list"] : 0,
            'cur_add' => isset($_POST["cur_add"]) ? $_POST["cur_add"] : 0,
            'u_group_add' => isset($_POST["u_group_add"]) ? $_POST["u_group_add"] : 0,
            'u_permission' => isset($_POST["u_permission"]) ? $_POST["u_permission"] : 0
        );
        // 'user_group_id'=>  $this->input->post('user_group'));

        if ($id != 0) {
            $this->db->trans_begin();
            //$this->db->set('user_group_id1',$this->input->post('user_group'));
            $this->db->where('user_group_id', $id);
            $this->db->update($this->table, $data);

            $this->db->where('user_group_id', $id);
            $this->db->update('user_group_permission_sub1', $data1);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        } else {
            $this->db->trans_begin();
            $this->db->set('user_group_id', $this->input->post('user_group'));
            $this->db->insert($this->table, $data);

            $this->db->set('user_group_id', $this->input->post('user_group'));
            $this->db->insert('user_group_permission_sub1', $data1);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            return TRUE;
        }
    }

    function get_user_group_dropdown() {
        $user_grouparray = array();
        $this->db->select('user_group_id, user_group_name');
        $this->db->where('user_group_id <>1');
        $this->db->order_by('user_group_name', 'ASC');
        $query = $this->db->get('user_group');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $user_grouparray[$row->user_group_id] = $row->user_group_name;
            }
        }
        return $user_grouparray;
    }

    function get_permission_categories() {
        $table1 = $this->table_permission_categories;

        $this->db->select('a.*');
        $this->db->from($table1.' a');

        $this->db->order_by("a.order", "asc");

        $query = $this->db->get();
        $result = $query->result_array();
		return $result;
    }

    function get_permission_links() {
        $table1 = $this->table_permission_links;

        $this->db->select('a.*');
        $this->db->from($table1.' a');

        $this->db->order_by("a.order", "asc");

        $query = $this->db->get();
        foreach ($query->result() as $row){
            $result[$row->permission_cat][$row->id] = array('id'=>$row->id,'name'=>$row->name);
        }
        return $result;
    }

    function get_permission($user_group_id) {
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
