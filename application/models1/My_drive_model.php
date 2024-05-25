<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of calendar_model
 *
 * @author Chaminda
 */
class My_drive_model extends CI_Model{

    protected $table_folders    = 'folders';
    protected $table_files      = 'files';

    
    function __construct() {
		parent::__construct();

		$ci =& get_instance();
		$this->table_folders	= $this->table_folders;
		$this->table_files		= $this->table_files;
    }

    public function get_root_folders($user_id) {
        if($user_id!=''){
            $this->db->select('f.*');
            $this->db->from('folders f');
            $this->db->where('created_by',$user_id); 
            $this->db->where('parent_id',''); 
            $this->db->where('status',1); 
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }
    }

    public function get_sub_folders($parent_id) {
        $this->db->select('f.*');
        $this->db->from('folders f');
        $this->db->where('parent_id',$parent_id);
        $this->db->where('status',1); 
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_parent($id) {
        $this->db->select('f.parent_id, f.name');
        $this->db->from('folders f');
        $this->db->where('id',$id); 
        $query = $this->db->get();
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
    }

    public function add_folder($dname,$parent,$created_by) {
        $data['name']        = $dname;
        $data['parent_id']   = $parent;
        $data['status']      = "1";
        $data['created_on']  = date('Y-m-d H:i:s');
        $data['created_by']  = $created_by;

        $this->db->insert($this->table_folders, $data);
        return $this->db->insert_id();
    }

    public function rename_folder($dname,$id,$updated_by) {
        $this->db->set('name', $dname);
        $this->db->set('updated_on', date('Y-m-d H:i:s'));
        $this->db->set('updated_by', $updated_by);
        $this->db->where('id', $id);
        $this->db->update($this->table_folders);
        return $this->db->affected_rows() > 0;  
    }

    public function delete_folder($id,$updated_by) {
        $this->db->set('status', 0);
        $this->db->where('id', $id);
        $this->db->update($this->table_folders);
        return $this->db->affected_rows() > 0;  
    }

    public function delete_file($id,$updated_by) {
        $this->db->set('status', 0);
        $this->db->where('real_name', $id);
        $this->db->update($this->table_files);
        return $this->db->affected_rows() > 0;  
    }

    public function upload_file($user_id, $parent_id=0, $new_file_name, $filename) {
        $data['name']        = $filename;
        $data['parent_id']   = $parent_id;
        $data['real_name']   = $new_file_name;
        $data['status']      = "1";
        $data['created_on']  = date('Y-m-d H:i:s');
        $data['created_by']  = $user_id;

        $this->db->insert($this->table_files, $data);
        return $this->db->insert_id();
    }

    public function get_files($parent_id) {
        $this->db->select('f.*');
        $this->db->from('files f');
        $this->db->where('parent_id',$parent_id);
        $this->db->where('status',1); 
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


}

?>