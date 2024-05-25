<?php

/**
 * Description of item_model
 *
 * @author Thusitha
 */
class Item_model extends CI_Model {
    public $table = 'item';
    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }
    
    public function add_item($name) {
       
        $id = $this->input->post('item_id');
        $data = array('item_code' => $this->input->post('c_code'),
            'item_name' => $this->input->post('item_name'),
           // 'supplier_id' => $this->input->post('supplier'),
            'category_id' => $this->input->post('category'),
            'item_status' => $this->input->post('c_status'),
            'image'=>$name
            
        );
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        if ($id != 0) {
            $this->db->set('update_by',$this->session->userdata('user_id'));
            $this->db->set('update_date',$fdate);
            $this->db->where('item_id', $id);
            //$this->db->where('user_group_id','1');
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
        
            $this->db->set('created_by',$this->session->userdata('user_id'));
            
            $this->db->set('created_date',$fdate);
            $this->db->insert($this->table, $data);
            return TRUE;
        }
    }
    public function get_item_detail($item_id){
        $this->db->select('item.*');
        $this->db->from('item');
        $this->db->where('item_id', $item_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function delete_item($id) {
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('Asia/Colombo'));
        $fdate = $date->format('Y-m-d H:i:s'); 
        $this->db->set('deleted', '1');
        $this->db->set('update_date',$fdate);
        $this->db->set('update_by',$this->session->userdata('user_id'));
        $this->db->where('item_id', $id);
        $this->db->update($this->table);
        return TRUE;
    }
    public function get_item_details($item_id=NULL){
        $this->db->select('item.*');
        $this->db->where('deleted','0');
        if($item_id!=NULL && $item_id!=0){
             $this->db->where('item_id',$item_id);
        }
        $query = $this->db->get('item');
                return $query->result();
    }
    function get_item_dropdown() {
        $item_array = array();
        $this->db->select('item_id, item_name');
        $this->db->order_by('item_name', 'asc');
        $query = $this->db->get('item');
        $item_array[0] = '-- Select --';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $item_array[$row->item_id] = $row->item_name;
            }
        }
        return $item_array;
    }
    function get_all_item_dropdown() {

        $item_array = array();
        $this->db->select('item_id, item_name');
        $this->db->order_by('item_name', 'asc');
        $query = $this->db->get('item');
        $item_array[0] = 'All';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $item_array[$row->item_id] = $row->item_name;
            }
        }
        return $item_array;
    }

    function get_item_json() {
        $itemarray = array();
        $this->db->select('item_id, item_name');
        $this->db->order_by('item_id', 'asc');
        $query = $this->db->get('item');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $entry = array(
                    'label' => $row->item_name,
                    'value' => $row->item_id
                );
                array_push($itemarray, $entry);
            }
        }

        return json_encode($itemarray);
    }
    public function get_cat_item_detail($cat_id){
        $this->db->select('item.*,category.*');
        $this->db->join('category','item.category_id=category.category_id','left');
        $this->db->where('item.deleted','0');
        $this->db->where('item.category_id',$cat_id);
        $query = $this->db->get('item');
                return $query->result();
    }

     public function get_cat_pitem_detail($item_id){
          $this->_table ='item_price';

        $this->db->select('item_price.*,item.item_name,supplier.supplier_name');
       $this->db->join('item', 'item_price.item_id=item.item_id');
       $this->db->join('supplier', 'item_price.supplier_id=supplier.supplier_id');
        $this->db->where('item_price.item_id',$item_id);
        $this->db->where('item_price.status',1);
       $this->db->order_by("item_price.item_price_id", "DESC");
        // $this->db->limit($limit, $start);
        $query = $this->db->get('item_price');
                return $query->result();
    }
    public function get_item_list($cat_id) {

        $itmarray = array();
        $this->db->select('DISTINCT(item_id), item_name');
        $this->db->where('category_id', $cat_id);
        $this->db->where('deleted', 0);
        $this->db->order_by('item_name', 'asc');
        $query = $this->db->get('item');
        $itmarray[0] = 'All';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $itmarray[$row->item_id] = $row->item_name;
            }
        }
        return $itmarray;
    }
    public function get_cat_items($cat_id){

        $this->db->select('DISTINCT(item_id), item_name');
       $this->db->where('category_id',$cat_id);
       $this->db->where('deleted','0');
        $this->db->order_by('item_id');
        $query = $this->db->get('item');
                return $query->result();
    }
    public function get_item_code($item_id){
          $this->_table = 'item';
        $this->db->where('item_id', $item_id);
        $query = $this->db->get('item')->result();

        $code = $query[0]->item_code;

        return $code;
    }
}
