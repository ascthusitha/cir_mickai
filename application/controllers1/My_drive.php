<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @author Chaminda
 */

class My_drive extends MY_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->library('My_Drive_Lib');
        $this->load->helper('url');
        $this->load->library('Menu_Lib');
    }
    
    public function index(){
        $data['user'] = $this->session->userdata('first_name');
        $data['title'] = "My Drive";
        $user_id = $this->session->userdata('user_id');
        $this->menu_lib->get_active_menu('',38);
        if($this->uri->segment(3)==""){
            $data['path'] = "/";
            $data['parent_id'] = 0;
        }else{
            $data['path'] = $this->my_drive_lib->get_folder_path($this->uri->segment(3));
            $data['parent_id'] = $this->uri->segment(3);
        }
        $data['folders'] = $this->my_drive_lib->get_folders($user_id,$this->config->item('index_page'));

        $this->load->view('layout/header_mydrive', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('my_drive/main', $data);
        $this->load->view('layout/footer', $data);
    }

    function add_folder() {
        if(!is_null($this->input->post('dname'))){
            $dname = $this->input->post('dname');
            $parent = $this->input->post('parent_id');
            $created_by = $this->session->userdata('user_id');
            $result = array('result' => $this->my_drive_lib->add_folder($dname,$parent,$created_by));
        }else{
            $result = false;
        }
        echo json_encode($result);
    }

    function rename_folder() {
        if(!is_null($this->input->post('dname'))){
            $dname = $this->input->post('dname');
            $id = $this->input->post('parent_id');
            $updated_by = $this->session->userdata('user_id');
            $result = array('result' => $this->my_drive_lib->rename_folder($dname,$id,$updated_by));
        }else{
            $result = false;
        }
        echo json_encode($result);
    }

    function upload_file() {
        $filename = $_FILES['file']['name'];
        $location = "upload/".$filename;
        $fileType = pathinfo($location,PATHINFO_EXTENSION);
        $new_file_name = rand(100,1000).'_'.time().'.'.$fileType;
        $new_file = "upload/".$new_file_name;
        $valid_file = $this->is_valid_file_type($fileType);
        if(!$valid_file){
            $result = 0;
        }else{
            if(move_uploaded_file($_FILES['file']['tmp_name'], $new_file)){
                $parent_id =  $_POST["parent_id"];
                $user_id = $this->session->userdata('user_id');
                $this->my_drive_lib->upload_file($user_id, $parent_id, $new_file_name, $filename);
                $result = $new_file;
            }else{
                $result = 0;
            }
        }
        echo json_encode($result);
    }

    function delete_folder() {
        if(!is_null($this->input->post('id'))){
            $id = $this->input->post('id');
            $updated_by = $this->session->userdata('user_id');
            $result = array('result' => $this->my_drive_lib->delete_folder($id,$updated_by));
        }else{
            $result = false;
        }
        echo json_encode($result);
    }

    function delete_file() {
        if(!is_null($this->input->post('id'))){
            $id = $this->input->post('id');
            $updated_by = $this->session->userdata('user_id');
            $result = array('result' => $this->my_drive_lib->delete_file($id,$updated_by));
        }else{
            $result = false;
        }
        echo json_encode($result);
    }

    private function is_valid_file_type($fileType){
        $validFileTypes = array(
            "jpg", "png", "jpeg", "gif",
            "pdf", "xlsx", "docx"
        );
        return in_array($fileType, $validFileTypes);
    }

}
