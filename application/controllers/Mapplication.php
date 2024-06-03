<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of application
 *
 * @author Thusitha
 */
class Mapplication extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper('url');
		$this->load->model('mapplication_model');
	}

	public function index()
	{
		//$this->output->enable_profiler(TRUE);

		$data['applications'] = $this->mapplication_model->get_application();

		//load view
		$data['user'] = $this->session->userdata('first_name');
		$data['title'] = "Application";
		$this->load->view('layout/header', $data);
		$this->load->view('layout/menu_bar');
		$this->load->view('application/application_list', $data);
		$this->load->view('layout/footer', $data);
	}

	public function add()
	{

		$data['user'] = $this->session->userdata('first_name');
		$data['application'] = array("application_id" => 0);
		$data['data'] = $this->mapplication_model->getTempApplicationData();
		$data['initials'] = array('mr' => 'Mr.', 'mrs' => 'Mrs.', 'ms' => 'Ms.', 'dr' => 'Dr.', 'other' => 'Other');
		$data['address_types'] = array('own' => 'Own', 'parent' => 'Parent', 'rent' => 'Rent');
		$data['genders'] = array('male' => 'Male', 'female' => 'Female');
		$data['maritalStatues'] = array('single' => 'Single', 'married' => 'Married', 'widowed' => 'Widowed', 'separated' => 'Separated', 'divorced' => 'Divorced', 'common_law' => 'Common Law');
		$data['loanPurposes'] = array('pre_approval' => 'Pre-Approval', 'home_purchase' => 'Home Purchase', 'transfer_of_mortgage' => 'Transfer Of Mortgage', 'refinance_or_equity' => 'Refinance/Equity');
		$data['heatingTypes'] = array('electric_baseboard' => 'Electric Baseboard', 'water_heating' => 'Water Heating', 'force_air' => 'Force Air', 'other' => 'Other');
		$data['propertyTypes'] = array('detached' => 'Detached', 'semi_detached' => 'Semi-Detached', 'high_rise_apartment' => 'High Rise Apartment', 'bungalow' => 'Bungalow', 'row_house_or_townhouse' => 'Row House/Townhouse', 'other' => 'Other');
		$data['zoning'] = array('residential' => 'Residential', 'commercial' => 'Commercial', 'farm' => 'Farm', 'other' => 'Other');
		$data['propertyTitles'] = array('freehold' => 'Freehold', 'leasehold' => 'Leasehold', 'condominium_or_state' => 'Condominium/State');
		$data['garageTypes'] = array('attached' => 'Attached', 'owner_occupied' => 'Owner Occupied', 'detached' => 'Detached','rental_property' => 'Rental Property');
		$data['garageSizes'] = array('single' => 'Single', 'double' => 'Double', 'triple' => 'Triple','specify' => 'Specify');
		$data['holders'] = array('1' => '1st', '2' => '2nd', '3' => '3rd','other' => 'Other');

		$data['title'] = "Application Add";
		$data['link_back'] = anchor('application/listing/', 'Back to list of application Name', array('class' => 'back'));
		$this->load->view('layout/header', $data);
		$this->load->view('layout/menu_bar');
		$this->load->view('application/application_add', $data);
		$this->load->view('layout/footer', $data);
	}

	/**
	 * @return void
	 */
	public function save()
	{
		if ($this->mapplication_model->add()) {
			echo 'success';
		} else {
			echo 'error';
		}
//		$this->form_validation->set_rules('applicant_initial', 'applicant initial', 'trim|required');
//
//		if ($this->form_validation->run() == FALSE) {
//
//			echo validation_errors();
//		} else {
//			if ($this->mapplication_model->add()) {
//				echo 'success';
//			} else {
//				echo 'error';
//			}
//			//$this->listing();
//		}
	}

	/**
	 * This function used to store data temporarily
	 * @return void
	 */
	public function tempSave()
	{
		if ($this->mapplication_model->tempAdd()) {
			echo 'success';
		} else {
			echo 'error';
		}

	}

	public function view($id)
	{
		$data['user'] = $this->session->userdata('first_name');

		$data['application'] = $this->mapplication_model->get_detail($id);
		$data['title'] = "application";
		$data['btn_value'] = 'Update';
		$data['link_back'] = anchor('application/listing/', 'Back to list of application', array('class' => 'back'));
		$this->load->view('layout/header', $data);
		$this->load->view('layout/menu_bar');
		$this->load->view('application/application_add', $data);
		$this->load->view('layout/footer', $data);
	}

	function delete()
	{
		$id = $_POST['application_id'];
		$status = $this->mapplication_model->delete($id);
		if ($status) {
			echo 'Success';
		} else {
			echo $status;
		}
	}

}

/* End of file application.php */
/* Location: ./application/controllers/application.php */
?>
