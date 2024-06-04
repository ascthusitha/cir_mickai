<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Mapplication_employment_model extends CI_Model
{

	protected $table = 'mortgage_application_employment';

	public function __construct()
	{

		parent::__construct();

		$this->_database = $this->db;
		$this->_table = $this->table;
	}

	function add($application_id)
	{
		$data = array(
			'mortgage_application_id' => $application_id,
			'applicant_current_employer' => $this->input->post('applicant_current_employer'),
			'applicant_current_job_title' => $this->input->post('applicant_current_job_title'),
			'applicant_employment_current_city' => $this->input->post('applicant_employment_current_city'),
			'applicant_employment_current_province' => $this->input->post('applicant_employment_current_province'),
			'applicant_employment_current_postal_code' => $this->input->post('applicant_employment_current_postal_code'),
			'applicant_current_income' => $this->input->post('applicant_current_income'),
			'applicant_employment_current_phone' => $this->input->post('applicant_employment_current_phone'),
			'applicant_employment_current_fax' => $this->input->post('applicant_employment_current_fax'),
			'applicant_employment_current_year' => $this->input->post('applicant_employment_current_year'),
			'applicant_employment_current_month' => $this->input->post('applicant_employment_current_month'),
			'applicant_previous_employer' => $this->input->post('applicant_previous_employer'),
			'applicant_previous_job_title' => $this->input->post('applicant_previous_job_title'),
			'applicant_employment_previous_city' => $this->input->post('applicant_employment_previous_city'),
			'applicant_employment_previous_province' => $this->input->post('applicant_employment_previous_province'),
			'applicant_employment_previous_postal_code' => $this->input->post('applicant_employment_previous_postal_code'),
			'applicant_previous_income' => $this->input->post('applicant_previous_income'),
			'applicant_employment_previous_phone' => $this->input->post('applicant_employment_previous_phone'),
			'applicant_employment_previous_fax' => $this->input->post('applicant_employment_previous_fax'),
			'applicant_employment_previous_year' => $this->input->post('applicant_employment_previous_year'),
			'applicant_employment_previous_month' => $this->input->post('applicant_employment_previous_month'),
			'co_applicant_current_employer' => $this->input->post('co_applicant_current_employer'),
			'co_applicant_current_job_title' => $this->input->post('co_applicant_current_job_title'),
			'co_applicant_employment_current_city' => $this->input->post('co_applicant_employment_current_city'),
			'co_applicant_employment_current_province' => $this->input->post('co_applicant_employment_current_province'),
			'co_applicant_employment_current_postal_code' => $this->input->post('co_applicant_employment_current_postal_code'),
			'co_applicant_current_income' => $this->input->post('co_applicant_current_income'),
			'co_applicant_employment_current_phone' => $this->input->post('co_applicant_employment_current_phone'),
			'co_applicant_employment_current_fax' => $this->input->post('co_applicant_employment_current_fax'),
			'co_applicant_employment_current_year' => $this->input->post('co_applicant_employment_current_year'),
			'co_applicant_employment_current_month' => $this->input->post('co_applicant_employment_current_month'),
			'co_applicant_previous_employer' => $this->input->post('co_applicant_previous_employer'),
			'co_applicant_previous_job_title' => $this->input->post('co_applicant_previous_job_title'),
			'co_applicant_employment_previous_city' => $this->input->post('co_applicant_employment_previous_city'),
			'co_applicant_employment_previous_province' => $this->input->post('co_applicant_employment_previous_province'),
			'co_applicant_employment_previous_postal_code' => $this->input->post('co_applicant_employment_previous_postal_code'),
			'co_applicant_previous_income' => $this->input->post('co_applicant_previous_income'),
			'co_applicant_employment_previous_phone' => $this->input->post('co_applicant_employment_previous_phone'),
			'co_applicant_employment_previous_fax' => $this->input->post('co_applicant_employment_previous_fax'),
			'co_applicant_employment_previous_year' => $this->input->post('co_applicant_employment_previous_year'),
			'co_applicant_employment_previous_month' => $this->input->post('co_applicant_employment_previous_month'),
		);

		$this->db->trans_begin();
		$this->db->insert($this->table, $data);
		$last_id = $this->db->insert_id();
		$data1 = array('id' => $last_id
		);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		return TRUE;

	}


}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>
