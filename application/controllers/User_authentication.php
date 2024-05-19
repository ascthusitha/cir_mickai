<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of userAuthentication
 *
 * @author Thusitha
 */
class User_authentication extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('customer_model');
        
        $this->load->model('user_model');
        $this->load->model('company_model');
//        $this->load->model('pos_model');
     
//        $this->load->model('order_model');
    }

    public function userLogin() {
        $today = Date('Y-m-d');
        //logged user
        if ($this->isLogged() == 1) {
            $data['user'] = $this->session->userdata('first_name');
            redirect('dashboard/');
//            $data['title'] = "Dashbord";
//            $this->dashboard();
        } else if (isset($_POST['uname']) && isset($_POST['password'])) {
            // $checked = (isset($_POST['loging_type']))?1:0;  
            $user = $_POST['uname'];
            $password = $_POST['password'];

            $this->load->model('user_model');
            $loginData = $this->user_model->checkAuthentication($user,$password);
            $data['status'] = 0;
            if ($loginData == 1) {
                //get user data
                $userData = $this->user_model->getUserData($user);
                $permissionData = $this->user_model->getPermission($userData['user_group_id']);
                $comp_data=$this->company_model->get_company_details();
            
                $sessionData = array(
                    'user_name' => $userData['username'],
                    'first_name' => $userData['fname'],
                    'last_name' => $userData['lname'],
                    'email' => $userData['email'],
                    'usergroup_id' => $userData['user_group_id'],
                    'user_id' => $userData['user_id'],
                    'user_group_name' => $userData['user_group_name'],
                    
                    
                    //permission data
                    'pos' => $userData['pos'],
                    
                    'customer' => $userData['customer'],
                    'cus_add' => $userData['cus_add'],
                    'cus_list' => $userData['cus_list'],
                    'cus_list_all' => $userData['cus_list_all'],
                    'order' => $userData['order'],
                    'order_list' => $userData['order_list'],
                     'item' => $userData['item'],
                    'item_add' => $userData['item_add'],
                    'item_list' => $userData['item_list'],
                    'import' => $userData['import'],
                    'bar_code' => $userData['bar_code'],
                    'inventory' => $userData['inventory'],
                    'inv_purch' => $userData['inv_purch'],
                    'inv_purch_add' => $userData['inv_purch_add'],
                    'inv_list' => $userData['inv_list'],
                    'sup_add' => $userData['sup_add'],
                    'sup_list' => $userData['sup_list'],
                    'category' => $userData['category'],
                    'cat_add' => $userData['cat_add'],
                    'cat_list' => $userData['cat_list'],
                    'report' => $userData['report'],
                    'r_stock_book' => $userData['r_stock_book'],
                    'r_stock' => $userData['r_stock'],
                    'r_sales' => $userData['r_sales'],
                    'r_profit' => $userData['r_profit'],
                    
                    'master_details' => $userData['master_details'],
                    'company' => $userData['company'],
                    'u_list' => $userData['u_list'],
                    'u_add' => $userData['u_add'],
                    'cur_list' => $userData['cur_list'],
                    'cur_add' => $userData['cur_add'],
                    'u_group_add' => $userData['u_group_add'],
                    'u_permission' => $userData['u_permission'],
                    'admin' => $userData['admin'],

                    'permissionData' => $permissionData,
                    
                    'manage' => $userData['manage'],
                    'base_cur_code' => $comp_data['currency_code'],
                    'base_cur_id' => $comp_data['base_currency_id'],
                    'userLogged' => TRUE,
                );
                //print_r($sessionData);die();

                $this->session->set_userdata($sessionData);

                $data['title'] = "Dashbord";
                $data['user'] = $this->session->userdata('first_name');
                $data['group'] = $this->session->userdata('user_group_name');
                $data['controller'] = $this;

                redirect('dashboard/');
//                $this->dashboard();
            } else {
                $data['title'] = "Login";
                $data['errorMsgLogin'] = "User name or password do not match.";
                $data['title'] = ucfirst('login'); // Capitalize the first letter				
                $this->load->view('login', $data);
            }
        } else {
            $data['title'] = "Login";
            // $data['errorMsgLogin'] = "User name or password do not match.";
            $data['title'] = ucfirst('login'); // Capitalize the first letter				
            $this->load->view('login', $data);
        }
    }

    public function forgottenPassword() {

        if ($this->isLogged() == 1) {
            $data['user'] = $this->session->userdata('first_name');
            $data['title'] = "Dashbord";
            $this->dashboard();
        } else if (isset($_POST['emailid'])) {
            $hash_value = md5($_POST['emailid'] . 'neth' . strtotime(date("Y-m-d H:i:s")));
            $to_mail = trim($_POST['emailid']);
            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->form_validation->set_rules('emailid', 'Email', 'required|valid_email|callback_email_exists');
            $this->form_validation->set_message('email_exists', 'Email not exist in our records');
            $mail_body = '<h2> Change user password </h2>
                  <p> Click below link to proceed, This link will expire end of the day.  </p></br>
                  <a href="' . base_url() . 'user_authentication/changePassword/' . $hash_value . '">Click Link</a>';
            $status = 0;
            if ($this->form_validation->run()) {
                $this->load->model('User_model');
                $this->load->library('email');
                $this->email->set_newline("\r\n");
                $this->email->from('admin@mickai.com');
                $this->email->to($to_mail);
                $this->email->subject(' Reset Password');
                $this->email->message($mail_body);

                if (!$this->email->send()) {
                    $msg = 'Some thing wrong';
                } else {
                    $status = 1;
                    $msg = 'Message has been sent.Please check your email Now...';
                    $this->User_model->update_reset_pass($to_mail, $hash_value);
                }
                $data = array();
                $data['msg'] = $msg;
                $data['status'] = $status;
                $this->load->view('login', $data);
                //echo json_encode($data);
            }

            $data['success'] = false;

            //$loginData = $this->User_model->checkEmail($email);
        } else {
            $data['status'] = $status;
            $this->load->view('login');
        }
    }

    public function changePassword() {
        $this->load->model('User_model');
        $key = $this->uri->segment(3);

        if ($key) {
            $user_id = $this->User_model->check_key($key);
            if ($user_id) {

                if ($this->isLogged() == 1) {
                    $data['user'] = $this->session->userdata('first_name');
                    $data['title'] = "Dashbord";
                    $this->dashboard();
                } else {
                    $data['key'] = $key;
                    $this->load->view('resetPassword', $data);
                }
            } else {
                $data['msg'] = 'Link expired, try again';
                $this->load->view('login', $data);
            }
        }
//        if($key){
//            $user_id = $this->User_model->check_key($key);
//           if($user_id){
        if (isset($_POST['password_confirm']) && isset($_POST['password'])) {

            $this->load->library('form_validation');
            $this->load->helper('form');
            $this->form_validation->set_rules('password_confirm', 'Password', 'required|callback_check_pass');
            $this->form_validation->set_message('check_pass', 'Password not match');
            $key = $this->input->post('key');
            if ($this->form_validation->run()) {
                $this->load->model('User_model');
                $this->User_model->change_pass($_POST['password_confirm'], $key);
                $data['msg'] = 'Password Changed successfully.</br> <a href="' . base_url() . 'user_authentication/userLogin">Log In</a>';
                $data['status'] = 1;
                $this->load->view('mail_sent', $data);
            }
            $data['key'] = $key;
            $this->load->view('resetPassword', $data);
        }
//           }else{
//        $data['msg'] = 'Reset Link expire, Try again';
//        $this->load->view('login',$data);
//           }
        //  }
    }

    public function check_pass($pass) {
        $pass = $this->input->post('password');
        $pass_confirm = $this->input->post('password_confirm');
        if ($pass == $pass_confirm) {
            return true;
        }
        return false;
    }

    public function userLogout() {
        $data['status'] = 0;
        $this->session->sess_destroy();
        $data['title'] = ucfirst('login'); // Capitalize the first letter
        //redirect(base_url(),'refresh');
        $this->load->view('login', $data);
    }

    public function dashboard() {
        $today = Date('Y-m-d');
        
        $data['title'] = "Dashbord";
        $data['user'] = $this->session->userdata('first_name');
        $data['group'] = $this->session->userdata('user_group_name');
 
        $data['customers_count'] = $this->customer_model->get_customer_count();
        $data['users_count'] = $this->user_model->user_count();
        

        

        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar', $data);
        $this->load->view('dashboard/admin_dashboard', $data);
        $this->load->view('layout/footer', $data);
    }

    public function main_navigation() {
        $data['title'] = "Navigation";
        $data['user'] = $this->session->userdata('first_name');
        $data['group'] = $this->session->userdata('user_group_name');
        $this->load->view('layout/header', $data);
        $this->load->view('layout/menu_bar');
        $this->load->view('main_navigation', $data);
        $this->load->view('layout/footer', $data);
    }

//logout when session expired
    function check_session() {
        //$this->server_status();
        $id = $this->session->userdata('user_id');
        if ($id) {
            echo 0;
        } else {
            echo 1;
        }

        die();
    }

    public function email_exists($email) {
        $this->load->model('User_model');
        if ($this->User_model->isValidEmail($email)) {
            return true;
        } else {
            return false;
        }
    }

}

?>
