<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class My_Drive_Lib {
    private $error = array();

    function __construct() {
        $this->ci =& get_instance();

        $this->ci->load->library('session');
        $this->ci->load->database();
        $this->ci->load->model('my_drive_model');
    }

    function get_folders($user_id,$index_page) {
        $root_folders = $this->ci->my_drive_model->get_root_folders($user_id);
        $result = '';
        foreach ($root_folders as $root_folder) { 
            $result .= '<li data-icon-cls="fa fa-folder" data-expanded="true"><a href="'.base_url().$index_page.'my_drive/index/'.$root_folder->id.'">'.$root_folder->name.'</a>';
            $result .= $this->get_sub_folders($root_folder->id,$index_page);
            $result .= '</li>';
        }
        $root_files = $this->get_files(0);
        $result .= $root_files;
        return $result;
    }

    function get_sub_folders($root_id,$index_page) {
        $result = '';
        $data = $this->ci->my_drive_model->get_sub_folders($root_id);
        $data2 = $this->get_files($root_id);
        if(!empty($data)){
            $result .= '<ul>';
            foreach ($data as $data_temp) { 
                $result .= '<li data-icon-cls="fa fa-folder" data-expanded="true"><a href="'.base_url().$index_page.'my_drive/index/'.$data_temp->id.'">'.$data_temp->name.'</a>';
                $result .= $this->get_sub_folders($data_temp->id,$index_page);
                $result .= $this->get_files($data_temp->id);
                $result .= '</li>';
            }
            $result .= '</ul>';
        }
        if(!is_null($data2)){
            $result .= '<ul>';
            $result .= $this->get_files($root_id);
            $result .= '</ul>';
        }

        return $result;
    }

    function get_folder_path($id,$i = 0) {
        $temp = $this->generate_folder_path($id,$i);
        $result = $this->get_folder_path_txt($temp);
        return $result;
    }

    function get_folder_path_txt($data){
        $result = '';
        foreach($data as $key => $child) {
            if(is_array($child)){
                $result = $this->get_folder_path_txt($child).'/'.$result;
            }else{
                $result = $child.$result;
            }
        }
        return $result;
    }
    
    function generate_folder_path($id,$i = 0) {
        $data = $this->ci->my_drive_model->get_parent($id);
        $result[$i] = $data->name;
        $i = $i+1;
        if(!empty($data)){
            $res = $this->generate_folder_path($data->parent_id,$i);
            array_push($result,$res);
        }
        return $result;
    }

    function add_folder($dname,$parent,$created_by) {
        $result = $this->ci->my_drive_model->add_folder($dname,$parent,$created_by);
        return $result;
    }
    
    function rename_folder($dname,$id,$updated_by) {
        $result = $this->ci->my_drive_model->rename_folder($dname,$id,$updated_by);
        return $result;
    }

    function delete_folder($id,$updated_by) {
        $result = $this->ci->my_drive_model->delete_folder($id,$updated_by);
        return $result;
    }
    
    function delete_file($id,$updated_by) {
        $result = $this->ci->my_drive_model->delete_file($id,$updated_by);
        return $result;
    }
    
    function upload_file($user_id, $parent_id, $new_file_name, $filename) {
        $result = $this->ci->my_drive_model->upload_file($user_id, $parent_id, $new_file_name, $filename);
        return $result;
    }

    private function get_files($parent_id) {
        $result = '';
        $data = $this->ci->my_drive_model->get_files($parent_id);
        if(!empty($data)){
            foreach ($data as $data_temp) { 
                $result .= '<li data-icon-cls="fa fa-file"><a id="'.$data_temp->id.'" href="'.base_url().'upload/'.$data_temp->real_name.'" target="_blank">'.$data_temp->name.'</a></li> ';
            }
        }
        return $result;
    }
    
    private function get_files2($parent_id) {
        $data = $this->ci->my_drive_model->get_files($parent_id);
        $result = '';
        if(!empty($data)){
            $result .= '<ul>';
            foreach ($data as $data_temp) { 
                $result .= '<li data-icon-cls="fa fa-file"><a id="'.$data_temp->id.'" href="'.base_url().'upload/'.$data_temp->real_name.'" target="_blank">'.$data_temp->name.'</a></li>';
            }
            $result .= '/<ul>';
        }
        return $result;
    }

    private function get_files_icon($ext) {
        switch ($ext) {
            case 'doc':
                $result = "fa-file";
                break;
            case 'jpg':
                $result = "fa-file";
                break;
            default:
                $result = "fa-file";
        }
        return $result;
    }


}

/* End of file My_Drive_Lib.php */
/* Location: ./application/libraries/My_Drive_Lib.php */