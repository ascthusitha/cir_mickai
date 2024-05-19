<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      
      $this->isLogged();
      date_default_timezone_set('Asia/Colombo');

   }
   public function isLogged(){

       if($this->session->userdata('userLogged')){
           return 1;
       }else{
           //
           return 0;
       }
   }
   //user group id
   public function getUserGroup(){
       $user_group=$this->session->userdata('usergroup_id');
       if(isset($user_group)){
           return $user_group;
       }else{
           return 0;
       }
   }
   
   //user id
   public function getUserId()
	{
		$user_id = $this->session->userdata('user_id');
		if(isset($user_id))
		{
			return $user_id;
		}
		else
		{
			return 0;
		}
	}
   //   //user id
   public function getUserName()
	{
		$user_name = $this->session->userdata('user_name');
		if(isset($user_name))
		{
			return $user_name;
		}
		else
		{
			return 0;
		}
	}
        
        public function loadUserHomePage(){
           
            if($this->isLogged()==1){
                
                if(null !=$this->getUserGroup() ){
                    switch ($this->getUserGroup()) {
                        case 1:
                            //header('Location: '.base_url()."index.php/userAuthentication/userLogin");
                            return 'admin_dashbord';
                            break;
                        case 2:
                           //header('Location: '.base_url()."index.php/userAuthentication/userLogin");
                            return 'agent_dashbord';
                            break;
                        case 3:
                            //header('Location: '.base_url()."index.php/userAuthentication/userLogin");
                            return 'user_dashbord';
                            break;
                        default:
                            //header('Location: '.base_url()."index.php/user/index"); 
                            return 'admin_dashbord';
                            break;
                    }
                }else{
                   header('Location: '.base_url()."index.php/user/index"); 
                }
            }else{
//               $data['title'] = ucfirst('login'); // Capitalize the first letter				
//                $this->load->view('include/header', $data);
//                $this->load->view('login', $data);
//                $this->load->view('include/footer', $data); 
                header('Location: '.base_url()."index.php/user/index");
            }
            
        }

       public function market_check()
    {
            if ($this->input->post('market') ===0)  {
            $this->form_validation->set_message('market_check', 'Please choose your market.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
    
    public function get_type(){
        $estimate_type=array(
            "0"=>"Select One",
            "2"=>"Agent",
            "1"=>"Direct"
            
            
        );
        return $estimate_type;
    }
    public function get_user_title(){
        $state_type=array(
            "1"=>"Mr.",
            "2"=>"Mrs.",
            "3"=>"Miss."
        );
        return $state_type;
    }
    function get_loan_type(){
        $status_type=array(
           
            "1"=>"Weekly",
            "2"=>"Daily"
        );
        return $status_type;
    }
    function get_loan_types(){
        $status_type=array(
           "0"=>"All",
            "1"=>"Weekly",
            "2"=>"Daily"
        );
        return $status_type;
    }

}
