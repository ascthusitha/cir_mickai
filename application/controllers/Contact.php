<?php
/**
 * Description of contact
 *
 * @author Thusitha
 */
class Contact extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('contact_model');
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('crr_model');
        $this->load->model('car_model');
        $this->load->model('country_model');
        $this->load->library('Menu_Lib');
    }

    public function index() {
        $data['user'] = $this->session->userdata('first_name');
        $data['contact'] = $this->contact_model->get_contact();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $this->menu_lib->get_active_menu(24,25);
        $data['title'] = "Contact List";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('contact/contact_list', $data);
        $this->load->view('layout/footer', $data);
    }

    public function add() {
        $data['user'] = $this->session->userdata('first_name');
        $data['accounts'] = $this->account_model->get_account_dropdown();
        $data['countries'] = $this->country_model->get_country_dropdown();
        $data['crrs'] = $this->crr_model->get_crr_dropdown();
        $data['cars'] = $this->car_model->get_car_dropdown();
        $data['users'] = $this->user_model->get_user_dropdown1();
        $this->menu_lib->get_active_menu(24,26);
        $data['title'] = "Contact ";
        $data['title1'] = "Contact Add";
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('contact/contact_add', $data);
        $this->load->view('layout/footer', $data);
    }

    public function save(){
		//  --------save image-------------
		//  $config['allowed_types'] = 'jpg|jpeg|png';
		//  $config['max_size'] = 1024 * 8;
		//
		//  $config['file_name'] = time()."_".str_replace(' ', '_',$_FILES['std_photo']['name']);
		//
		//  $name = $config['file_name'];
		//
        $status=$this->contact_model->addcontact();//$name
        if ($status) {
		//  $config['upload_path'] = "./assets/img/student/";
		//  $this->load->library('upload', $config);
		//  $this->upload->do_upload('std_photo');
            echo 'success';           
        } else {
            echo 'error';
        }
    }

    public function view($contact_id){
        //  load view
        //  $this->output->enable_profiler(TRUE);
        $data['users'] = $this->user_model->get_user_dropdown1();
        $data['title'] = "Contact";
        $data['title1'] = "Contact View";
        $data['accounts'] = $this->account_model->get_account_dropdown();      
        $data['contact']=  $this->contact_model->get_contact_detail($contact_id);
        $data['countries'] = $this->country_model->get_country_dropdown();
        $data['btn_value']='Update';

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('contact/contact_add',$data);
        $this->load->view('layout/footer', $data);    
     }

    public function load_img(){
         $contact_id=$_POST['contact_id'];
         $res=$this->contact_model->get_image($contact_id);
         if($res==null){
             echo 0;
         }else{
             echo $res;
         }
    }

    function delete() {
        $id = $_POST['contact_id'];
        if ($this->contact_model->delete($id)) {
            echo 'Success';
        } else {
            echo $status;
        }
    }

    public function get_contact_data($acc_id){
        $datax=$this->contact_model->get_contacts($acc_id);
        echo json_encode($datax);
    }

    function get_contact_dropdown() {
        $id = $_POST['acc_id'];
        $data = $this->contact_model->get_contact_dropdown_by_acc($id);
//        $res = '';
//        foreach ($data as $key=>$row) {
//            $res .= '<option value="'.$key.'">'.$row.'</option> ';
//        }
        echo json_encode($data);
    }


}
