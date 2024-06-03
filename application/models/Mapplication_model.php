<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Description of user currency_model
 *
 * @author Thusitha
 */
class Mapplication_model extends CI_Model
{

	protected $table = 'mortgage_application';

	protected $table_employment = 'mortgage_application_employment';
	protected $table_financial = 'mortgage_application_financial';
	protected $table_general = 'mortgage_application_general';
	protected $table_income = 'mortgage_application_income';
	protected $table_loan = 'mortgage_application_loan';
	protected $table_mortgage = 'mortgage_application_mortgage';
	protected $table_property = 'mortgage_application_property';

	public function __construct()
	{

		parent::__construct();

		$this->_database = $this->db;
		$this->_table = $this->table;
		$this->_table_employment = $this->table_employment;
		$this->_table_financial = $this->table_financial;
		$this->_table_general = $this->table_general;
		$this->_table_income = $this->table_income;
		$this->_table_loan = $this->table_loan;
		$this->_table_mortgage = $this->table_mortgage;
		$this->_table_property = $this->table_property;
	}

	function application_count()
	{
		return $this->db->count_all_results('mortgage_application');
	}

	function get_application()
	{
		$this->db->select('*');
		$this->db->where('deleted', 0);
		$this->db->where('create_status', 'completed');
		$query = $this->db->get('mortgage_application');
		return $query->result();
	}

	function add()
	{
		$where = array('created_by' => $this->session->userdata('user_id'), 'create_status' => 'pending');

		$this->db->where($where);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			$this->db->where('id', $query->row()->id);
			$this->db->delete($this->table);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_employment);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_income);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_loan);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_property);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_mortgage);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_financial);

			$this->db->where('mortgage_application_id', $query->row()->id);
			$this->db->delete($this->table_general);
		}

		/**
		 * This is mortgage applicant details save
		 */
		$data = array(
			'applicant_initial' => $this->input->post('applicant_initial'),
			'co_applicant_initial' => $this->input->post('co_applicant_initial'),
			'applicant_other_initial' => $this->input->post('applicant_other_initial'),
			'applicant_name' => $this->input->post('applicant_name'),
			'applicant_current_city' => $this->input->post('applicant_current_city'),
			'applicant_current_province' => $this->input->post('applicant_current_province'),
			'applicant_current_postal_code' => $this->input->post('applicant_current_postal_code'),
			'applicant_current_address_type' => $this->input->post('applicant_current_address_type'),
			'co_applicant_current_address_type' => $this->input->post('co_applicant_current_address_type'),
			'applicant_rent' => $this->input->post('applicant_rent'),
			'applicant_current_address_spend_year' => $this->input->post('applicant_current_address_spend_year'),
			'applicant_current_address_spend_month' => $this->input->post('applicant_current_address_spend_month'),
			'applicant_prior_city' => $this->input->post('applicant_prior_city'),
			'applicant_prior_province' => $this->input->post('applicant_prior_province'),
			'applicant_prior_postal_code' => $this->input->post('applicant_prior_postal_code'),
			'applicant_prior_address_type' => $this->input->post('applicant_prior_address_type'),
			'co_applicant_prior_address_type' => $this->input->post('co_applicant_prior_address_type'),
			'applicant_prior_rent' => $this->input->post('applicant_prior_rent'),
			'applicant_prior_address_spend_year' => $this->input->post('applicant_prior_address_spend_year'),
			'applicant_prior_address_spend_month' => $this->input->post('applicant_prior_address_spend_month'),
			'applicant_home_number' => $this->input->post('applicant_home_number'),
			'applicant_cell_number' => $this->input->post('applicant_cell_number'),
			'applicant_birth_date' => $this->input->post('applicant_birth_date'),
			'applicant_sin' => $this->input->post('applicant_sin'),
			'applicant_gender' => $this->input->post('applicant_gender'),
			'co_applicant_gender' => $this->input->post('co_applicant_gender'),
			'applicant_number_of_dependents' => $this->input->post('applicant_number_of_dependents'),
			'applicant_marital_status' => $this->input->post('applicant_marital_status'),
			'co_applicant_marital_status' => $this->input->post('co_applicant_marital_status'),
			'applicant_email' => $this->input->post('applicant_email'),
			'co_applicant_other_initial' => $this->input->post('co_applicant_other_initial'),
			'co_applicant_name' => $this->input->post('co_applicant_name'),
			'co_applicant_current_city' => $this->input->post('co_applicant_current_city'),
			'co_applicant_current_province' => $this->input->post('co_applicant_current_province'),
			'co_applicant_current_postal_code' => $this->input->post('co_applicant_current_postal_code'),
			'co_applicant_rent' => $this->input->post('co_applicant_rent'),
			'co_applicant_current_address_spend_year' => $this->input->post('co_applicant_current_address_spend_year'),
			'co_applicant_current_address_spend_month' => $this->input->post('co_applicant_current_address_spend_month'),
			'co_applicant_prior_city' => $this->input->post('co_applicant_prior_city'),
			'co_applicant_prior_province' => $this->input->post('co_applicant_prior_province'),
			'co_applicant_prior_postal_code' => $this->input->post('co_applicant_prior_postal_code'),
			'co_applicant_prior_rent' => $this->input->post('co_applicant_prior_rent'),
			'co_applicant_prior_address_spend_year' => $this->input->post('co_applicant_prior_address_spend_year'),
			'co_applicant_prior_address_spend_month' => $this->input->post('co_applicant_prior_address_spend_month'),
			'co_applicant_home_number' => $this->input->post('co_applicant_home_number'),
			'co_applicant_cell_number' => $this->input->post('co_applicant_cell_number'),
			'co_applicant_birth_date' => $this->input->post('co_applicant_birth_date'),
			'co_applicant_sin' => $this->input->post('co_applicant_sin'),
			'co_applicant_number_of_dependents' => $this->input->post('co_applicant_number_of_dependents'),
			'co_applicant_email' => $this->input->post('co_applicant_email'),
			'created_by' => $this->session->userdata('user_id'),
			'create_status' => 'completed',
		);

		$this->db->trans_begin();
		$this->db->insert($this->table, $data);
		$last_id = $this->db->insert_id();

		/**
		 * This is mortgage applicant employment details save
		 */
		$data_employemnt = array(
			'mortgage_application_id' => $last_id,
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

		$this->db->insert($this->table_employment, $data_employemnt);


		/**
		 * This is mortgage applicant financial details save
		 */
		$data_financial = array(
			'mortgage_application_id' => $last_id,
			'financial_value_of_property_institution' => $this->input->post('financial_value_of_property_institution'),
			'financial_value_of_property_amount' => $this->input->post('financial_value_of_property_amount'),
			'financial_cash_in_bank_institution' => $this->input->post('financial_cash_in_bank_institution'),
			'financial_cash_in_bank_amount' => $this->input->post('financial_cash_in_bank_amount'),
			'financial_deposit_on_purchase_institution' => $this->input->post('financial_deposit_on_purchase_institution'),
			'financial_deposit_on_purchase_amount' => $this->input->post('financial_deposit_on_purchase_amount'),
			'financial_other_real_estates_institution' => $this->input->post('financial_other_real_estates_institution'),
			'financial_other_real_estates_amount' => $this->input->post('financial_other_real_estates_amount'),
			'financial_household_goods_institution' => $this->input->post('financial_household_goods_institution'),
			'financial_household_goods_amount' => $this->input->post('financial_household_goods_amount'),
			'financial_car_1_institution' => $this->input->post('financial_car_1_institution'),
			'financial_car_1_amount' => $this->input->post('financial_car_1_amount'),
			'financial_car_2_institution' => $this->input->post('financial_car_2_institution'),
			'financial_car_2_amount' => $this->input->post('financial_car_2_amount'),
			'financial_rrsp_institution' => $this->input->post('financial_rrsp_institution'),
			'financial_rrsp_amount' => $this->input->post('financial_rrsp_amount'),
			'financial_stock_bonds_etc_institution' => $this->input->post('financial_stock_bonds_etc_institution'),
			'financial_stock_bonds_etc_amount' => $this->input->post('financial_stock_bonds_etc_amount'),
			'financial_other_1_institution' => $this->input->post('financial_other_1_institution'),
			'financial_other_1_amount' => $this->input->post('financial_other_1_amount'),
			'financial_other_2_institution' => $this->input->post('financial_other_2_institution'),
			'financial_other_2_amount' => $this->input->post('financial_other_2_amount'),
			'financial_other_3_institution' => $this->input->post('financial_other_3_institution'),
			'financial_other_3_amount' => $this->input->post('financial_other_3_amount'),
			'financial_monthly_payment_mortgage_on_home' => $this->input->post('financial_monthly_payment_mortgage_on_home'),
			'financial_balance_owing_mortgage_on_home' => $this->input->post('financial_balance_owing_mortgage_on_home'),
			'financial_monthly_payment_personal_loans' => $this->input->post('financial_monthly_payment_personal_loans'),
			'financial_balance_owing_personal_loans' => $this->input->post('financial_balance_owing_personal_loans'),
			'financial_monthly_payment_other_loans' => $this->input->post('financial_monthly_payment_other_loans'),
			'financial_balance_owing_other_loans' => $this->input->post('financial_balance_owing_other_loans'),
			'financial_monthly_payment_car_loan' => $this->input->post('financial_monthly_payment_car_loan'),
			'financial_balance_owing_car_loan' => $this->input->post('financial_balance_owing_car_loan'),
			'financial_monthly_payment_credit_cards' => $this->input->post('financial_monthly_payment_credit_cards'),
			'financial_balance_owing_credit_cards' => $this->input->post('financial_balance_owing_credit_cards'),
			'financial_monthly_payment_child_supports' => $this->input->post('financial_monthly_payment_child_supports'),
			'financial_balance_owing_child_supports' => $this->input->post('financial_balance_owing_child_supports'),
		);

		$this->db->insert($this->table_financial, $data_financial);


		/**
		 * This is mortgage applicant general details save
		 */
		$data_general = array(
			'mortgage_application_id' => $last_id,
			'general_is_judgements' => $this->input->post('general_is_judgements'),
			'general_judgements' => $this->input->post('general_judgements'),
			'general_is_bankruptcy' => $this->input->post('general_is_bankruptcy'),
			'general_bankruptcy' => $this->input->post('general_bankruptcy'),
			'general_is_assets_pledged' => $this->input->post('general_is_assets_pledged'),
			'general_assets_pledged' => $this->input->post('general_assets_pledged'),
			'general_is_marriage_agreement' => $this->input->post('general_is_marriage_agreement'),
			'general_marriage_agreement' => $this->input->post('general_marriage_agreement'),
			'general_is_guarantor' => $this->input->post('general_is_guarantor'),
			'general_guarantor' => $this->input->post('general_guarantor'),
			'general_is_guarantor_for_lease' => $this->input->post('general_is_guarantor_for_lease'),
			'general_guarantor_for_lease' => $this->input->post('general_guarantor_for_lease'),
		);

		$this->db->insert($this->table_general, $data_general);


		$data_income = array(
			'mortgage_application_id' => $last_id,
			'applicant_income_full_time' => $this->input->post('applicant_income_full_time'),
			'applicant_income_self_employed' => $this->input->post('applicant_income_self_employed'),
			'applicant_income_contract' => $this->input->post('applicant_income_contract'),
			'applicant_income_commission' => $this->input->post('applicant_income_commission'),
			'applicant_income_part_time_w_guaranteed' => $this->input->post('applicant_income_part_time_w_guaranteed'),
			'applicant_income_part_time_w_o_guaranteed' => $this->input->post('applicant_income_part_time_w_o_guaranteed'),
			'applicant_income_rental' => $this->input->post('applicant_income_rental'),
			'applicant_income_investment' => $this->input->post('applicant_income_investment'),
			'applicant_income_other' => $this->input->post('applicant_income_other'),
			'applicant_income_total' => $this->input->post('applicant_income_total'),
			'co_applicant_income_full_time' => $this->input->post('co_applicant_income_full_time'),
			'co_applicant_income_self_employed' => $this->input->post('co_applicant_income_self_employed'),
			'co_applicant_income_contract' => $this->input->post('co_applicant_income_contract'),
			'co_applicant_income_commission' => $this->input->post('co_applicant_income_commission'),
			'co_applicant_income_part_time_w_guaranteed' => $this->input->post('co_applicant_income_part_time_w_guaranteed'),
			'co_applicant_income_part_time_w_o_guaranteed' => $this->input->post('co_applicant_income_part_time_w_o_guaranteed'),
			'co_applicant_income_rental' => $this->input->post('co_applicant_income_rental'),
			'co_applicant_income_investment' => $this->input->post('co_applicant_income_investment'),
			'co_applicant_income_other' => $this->input->post('co_applicant_income_other'),
			'co_applicant_income_total' => $this->input->post('co_applicant_income_total'),
		);

		$this->db->insert($this->table_income, $data_income);

		/**
		 * This is mortgage applicant loan details save
		 */
		$data_loan = array(
			'mortgage_application_id' => $last_id,
			'purpose_of_loan' => $this->input->post('purpose_of_loan'),
			'applicant_loan_reason' => $this->input->post('applicant_loan_reason'),
			'sales_price' => $this->input->post('sales_price'),
			'down_payment' => $this->input->post('down_payment'),
			'mortgage_amount' => $this->input->post('mortgage_amount'),
			'date_fund' => $this->input->post('date_fund'),
			'loan_gift' => $this->input->post('loan_gift'),
			'loan_investment' => $this->input->post('loan_investment'),
			'loan_bank_account' => $this->input->post('loan_bank_account'),
			'loan_borrowed_funds' => $this->input->post('loan_borrowed_funds'),
			'loan_sweat_equity' => $this->input->post('loan_sweat_equity'),
			'loan_other' => $this->input->post('loan_other'),
		);

		$this->db->insert($this->table_loan, $data_loan);

		/**
		 * This is mortgage applicant mortgage details save
		 */
		$data_mortgage = array(
			'mortgage_application_id' => $last_id,
			'mortgage_type' => $this->input->post('mortgage_type'),
			'mortgage_original_mtg_amount' => $this->input->post('mortgage_original_mtg_amount'),
			'mortgage_balance' => $this->input->post('mortgage_balance'),
			'mortgage_payment' => $this->input->post('mortgage_payment'),
			'mortgage_payment_frequency' => $this->input->post('mortgage_payment_frequency'),
			'mortgage_maturity_date' => $this->input->post('mortgage_maturity_date'),
			'mortgage_term_type' => $this->input->post('mortgage_term_type'),
			'mortgage_amortization' => $this->input->post('mortgage_amortization'),
			'mortgage_remaining_amortization' => $this->input->post('mortgage_remaining_amortization'),
			'mortgage_rate_type' => $this->input->post('mortgage_rate_type'),
			'mortgage_interest_rate' => $this->input->post('mortgage_interest_rate'),
			'mortgage_insurer_cmhc_number' => $this->input->post('mortgage_insurer_cmhc_number'),
			'mortgage_holder' => $this->input->post('mortgage_holder'),
			'mortgage_holder_other' => $this->input->post('mortgage_holder_other'),
			'mortgage_number' => $this->input->post('mortgage_number'),
		);

		$this->db->insert($this->table_mortgage, $data_mortgage);

		/**
		 * This is mortgage applicant property details save
		 */
		$data_property = array(
			'mortgage_application_id' => $last_id,
			'property_street' => $this->input->post('property_street'),
			'property_city' => $this->input->post('property_city'),
			'property_province' => $this->input->post('property_province'),
			'property_postal_code' => $this->input->post('property_postal_code'),
			'property_lot' => $this->input->post('property_lot'),
			'property_plan' => $this->input->post('property_plan'),
			'property_type_of_heating' => $this->input->post('property_type_of_heating'),
			'property_type_of_heating_other' => $this->input->post('property_type_of_heating_other'),
			'property_type' => $this->input->post('property_type'),
			'property_type_other' => $this->input->post('property_type_other'),
			'property_zoning' => $this->input->post('property_zoning'),
			'property_zoning_other' => $this->input->post('property_zoning_other'),
			'property_title' => $this->input->post('property_title'),
			'property_garage_type' => $this->input->post('property_garage_type'),
			'property_garage_size' => $this->input->post('property_garage_size'),
			'property_garage_size_specify' => $this->input->post('property_garage_size_specify'),
			'property_number_of_storey' => $this->input->post('property_number_of_storey'),
			'property_insurance_cost_per_month' => $this->input->post('property_insurance_cost_per_month'),
			'property_heating_cost_per_month' => $this->input->post('property_heating_cost_per_month'),
			'property_hydro_cost_per_month' => $this->input->post('property_hydro_cost_per_month'),
			'property_maintenance_fee_per_month' => $this->input->post('property_maintenance_fee_per_month'),
			'property_tax' => $this->input->post('property_tax'),
			'property_lot_size' => $this->input->post('property_lot_size'),
			'property_liveable_space' => $this->input->post('property_liveable_space'),
			'property_current_estimated_value' => $this->input->post('property_current_estimated_value'),
			'property_age' => $this->input->post('property_age'),
			'property_date_of_purchase' => $this->input->post('property_date_of_purchase'),
			'property_original_purchase_price' => $this->input->post('property_original_purchase_price'),
		);

		$this->db->insert($this->table_property, $data_property);


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		return TRUE;

	}

	function tempAdd()
	{
		/**
		 * This is mortgage applicant details save
		 */
		$data = array(
			'applicant_initial' => $this->input->post('applicant_initial'),
			'co_applicant_initial' => $this->input->post('co_applicant_initial'),
			'applicant_other_initial' => $this->input->post('applicant_other_initial'),
			'applicant_name' => $this->input->post('applicant_name'),
			'applicant_current_city' => $this->input->post('applicant_current_city'),
			'applicant_current_province' => $this->input->post('applicant_current_province'),
			'applicant_current_postal_code' => $this->input->post('applicant_current_postal_code'),
			'applicant_current_address_type' => $this->input->post('applicant_current_address_type'),
			'co_applicant_current_address_type' => $this->input->post('co_applicant_current_address_type'),
			'applicant_rent' => $this->input->post('applicant_rent'),
			'applicant_current_address_spend_year' => $this->input->post('applicant_current_address_spend_year'),
			'applicant_current_address_spend_month' => $this->input->post('applicant_current_address_spend_month'),
			'applicant_prior_city' => $this->input->post('applicant_prior_city'),
			'applicant_prior_province' => $this->input->post('applicant_prior_province'),
			'applicant_prior_postal_code' => $this->input->post('applicant_prior_postal_code'),
			'applicant_prior_address_type' => $this->input->post('applicant_prior_address_type'),
			'co_applicant_prior_address_type' => $this->input->post('co_applicant_prior_address_type'),
			'applicant_prior_rent' => $this->input->post('applicant_prior_rent'),
			'applicant_prior_address_spend_year' => $this->input->post('applicant_prior_address_spend_year'),
			'applicant_prior_address_spend_month' => $this->input->post('applicant_prior_address_spend_month'),
			'applicant_home_number' => $this->input->post('applicant_home_number'),
			'applicant_cell_number' => $this->input->post('applicant_cell_number'),
			'applicant_birth_date' => $this->input->post('applicant_birth_date'),
			'applicant_sin' => $this->input->post('applicant_sin'),
			'applicant_gender' => $this->input->post('applicant_gender'),
			'co_applicant_gender' => $this->input->post('co_applicant_gender'),
			'applicant_number_of_dependents' => $this->input->post('applicant_number_of_dependents'),
			'applicant_marital_status' => $this->input->post('applicant_marital_status'),
			'co_applicant_marital_status' => $this->input->post('co_applicant_marital_status'),
			'applicant_email' => $this->input->post('applicant_email'),
			'co_applicant_other_initial' => $this->input->post('co_applicant_other_initial'),
			'co_applicant_name' => $this->input->post('co_applicant_name'),
			'co_applicant_current_city' => $this->input->post('co_applicant_current_city'),
			'co_applicant_current_province' => $this->input->post('co_applicant_current_province'),
			'co_applicant_current_postal_code' => $this->input->post('co_applicant_current_postal_code'),
			'co_applicant_rent' => $this->input->post('co_applicant_rent'),
			'co_applicant_current_address_spend_year' => $this->input->post('co_applicant_current_address_spend_year'),
			'co_applicant_current_address_spend_month' => $this->input->post('co_applicant_current_address_spend_month'),
			'co_applicant_prior_city' => $this->input->post('co_applicant_prior_city'),
			'co_applicant_prior_province' => $this->input->post('co_applicant_prior_province'),
			'co_applicant_prior_postal_code' => $this->input->post('co_applicant_prior_postal_code'),
			'co_applicant_prior_rent' => $this->input->post('co_applicant_prior_rent'),
			'co_applicant_prior_address_spend_year' => $this->input->post('co_applicant_prior_address_spend_year'),
			'co_applicant_prior_address_spend_month' => $this->input->post('co_applicant_prior_address_spend_month'),
			'co_applicant_home_number' => $this->input->post('co_applicant_home_number'),
			'co_applicant_cell_number' => $this->input->post('co_applicant_cell_number'),
			'co_applicant_birth_date' => $this->input->post('co_applicant_birth_date'),
			'co_applicant_sin' => $this->input->post('co_applicant_sin'),
			'co_applicant_number_of_dependents' => $this->input->post('co_applicant_number_of_dependents'),
			'co_applicant_email' => $this->input->post('co_applicant_email'),
			'created_by' => $this->session->userdata('user_id'),
			'create_status' => 'pending',
		);

		$this->db->trans_begin();

		$where = array('created_by' => $this->session->userdata('user_id'), 'create_status' => 'pending');

		$this->db->where($where);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table, $data);
			$last_id = $query->row()->id;
		} else {
			$this->db->insert($this->table, $data);
			$last_id = $this->db->insert_id();
		}


		/**
		 * This is mortgage applicant employment details save
		 */
		$data_employemnt = array(
			'mortgage_application_id' => $last_id,
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


		$where = array('mortgage_application_id' => $last_id);

		$this->db->where($where);
		$query = $this->db->get($this->table_employment);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_employment, $data_employemnt);
		} else {
			$this->db->insert($this->table_employment, $data_employemnt);
		}



		/**
		 * This is mortgage applicant financial details save
		 */
		$data_financial = array(
			'mortgage_application_id' => $last_id,
			'financial_value_of_property_institution' => $this->input->post('financial_value_of_property_institution'),
			'financial_value_of_property_amount' => $this->input->post('financial_value_of_property_amount'),
			'financial_cash_in_bank_institution' => $this->input->post('financial_cash_in_bank_institution'),
			'financial_cash_in_bank_amount' => $this->input->post('financial_cash_in_bank_amount'),
			'financial_deposit_on_purchase_institution' => $this->input->post('financial_deposit_on_purchase_institution'),
			'financial_deposit_on_purchase_amount' => $this->input->post('financial_deposit_on_purchase_amount'),
			'financial_other_real_estates_institution' => $this->input->post('financial_other_real_estates_institution'),
			'financial_other_real_estates_amount' => $this->input->post('financial_other_real_estates_amount'),
			'financial_household_goods_institution' => $this->input->post('financial_household_goods_institution'),
			'financial_household_goods_amount' => $this->input->post('financial_household_goods_amount'),
			'financial_car_1_institution' => $this->input->post('financial_car_1_institution'),
			'financial_car_1_amount' => $this->input->post('financial_car_1_amount'),
			'financial_car_2_institution' => $this->input->post('financial_car_2_institution'),
			'financial_car_2_amount' => $this->input->post('financial_car_2_amount'),
			'financial_rrsp_institution' => $this->input->post('financial_rrsp_institution'),
			'financial_rrsp_amount' => $this->input->post('financial_rrsp_amount'),
			'financial_stock_bonds_etc_institution' => $this->input->post('financial_stock_bonds_etc_institution'),
			'financial_stock_bonds_etc_amount' => $this->input->post('financial_stock_bonds_etc_amount'),
			'financial_other_1_institution' => $this->input->post('financial_other_1_institution'),
			'financial_other_1_amount' => $this->input->post('financial_other_1_amount'),
			'financial_other_2_institution' => $this->input->post('financial_other_2_institution'),
			'financial_other_2_amount' => $this->input->post('financial_other_2_amount'),
			'financial_other_3_institution' => $this->input->post('financial_other_3_institution'),
			'financial_other_3_amount' => $this->input->post('financial_other_3_amount'),
			'financial_monthly_payment_mortgage_on_home' => $this->input->post('financial_monthly_payment_mortgage_on_home'),
			'financial_balance_owing_mortgage_on_home' => $this->input->post('financial_balance_owing_mortgage_on_home'),
			'financial_monthly_payment_personal_loans' => $this->input->post('financial_monthly_payment_personal_loans'),
			'financial_balance_owing_personal_loans' => $this->input->post('financial_balance_owing_personal_loans'),
			'financial_monthly_payment_other_loans' => $this->input->post('financial_monthly_payment_other_loans'),
			'financial_balance_owing_other_loans' => $this->input->post('financial_balance_owing_other_loans'),
			'financial_monthly_payment_car_loan' => $this->input->post('financial_monthly_payment_car_loan'),
			'financial_balance_owing_car_loan' => $this->input->post('financial_balance_owing_car_loan'),
			'financial_monthly_payment_credit_cards' => $this->input->post('financial_monthly_payment_credit_cards'),
			'financial_balance_owing_credit_cards' => $this->input->post('financial_balance_owing_credit_cards'),
			'financial_monthly_payment_child_supports' => $this->input->post('financial_monthly_payment_child_supports'),
			'financial_balance_owing_child_supports' => $this->input->post('financial_balance_owing_child_supports'),
		);

		$where = array('mortgage_application_id' => $last_id);

		$this->db->where($where);
		$query = $this->db->get($this->table_financial);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_financial, $data_financial);
		} else {
			$this->db->insert($this->table_financial, $data_financial);
		}



		/**
		 * This is mortgage applicant general details save
		 */
		$data_general = array(
			'mortgage_application_id' => $last_id,
			'general_is_judgements' => $this->input->post('general_is_judgements'),
			'general_judgements' => $this->input->post('general_judgements'),
			'general_is_bankruptcy' => $this->input->post('general_is_bankruptcy'),
			'general_bankruptcy' => $this->input->post('general_bankruptcy'),
			'general_is_assets_pledged' => $this->input->post('general_is_assets_pledged'),
			'general_assets_pledged' => $this->input->post('general_assets_pledged'),
			'general_is_marriage_agreement' => $this->input->post('general_is_marriage_agreement'),
			'general_marriage_agreement' => $this->input->post('general_marriage_agreement'),
			'general_is_guarantor' => $this->input->post('general_is_guarantor'),
			'general_guarantor' => $this->input->post('general_guarantor'),
			'general_is_guarantor_for_lease' => $this->input->post('general_is_guarantor_for_lease'),
			'general_guarantor_for_lease' => $this->input->post('general_guarantor_for_lease'),
		);

		$where = array('mortgage_application_id' => $last_id);

		$this->db->where($where);
		$query = $this->db->get($this->table_general);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_general, $data_general);
		} else {
			$this->db->insert($this->table_general, $data_general);
		}


		$data_income = array(
			'mortgage_application_id' => $last_id,
			'applicant_income_full_time' => $this->input->post('applicant_income_full_time'),
			'applicant_income_self_employed' => $this->input->post('applicant_income_self_employed'),
			'applicant_income_contract' => $this->input->post('applicant_income_contract'),
			'applicant_income_commission' => $this->input->post('applicant_income_commission'),
			'applicant_income_part_time_w_guaranteed' => $this->input->post('applicant_income_part_time_w_guaranteed'),
			'applicant_income_part_time_w_o_guaranteed' => $this->input->post('applicant_income_part_time_w_o_guaranteed'),
			'applicant_income_rental' => $this->input->post('applicant_income_rental'),
			'applicant_income_investment' => $this->input->post('applicant_income_investment'),
			'applicant_income_other' => $this->input->post('applicant_income_other'),
			'applicant_income_total' => $this->input->post('applicant_income_total'),
			'co_applicant_income_full_time' => $this->input->post('co_applicant_income_full_time'),
			'co_applicant_income_self_employed' => $this->input->post('co_applicant_income_self_employed'),
			'co_applicant_income_contract' => $this->input->post('co_applicant_income_contract'),
			'co_applicant_income_commission' => $this->input->post('co_applicant_income_commission'),
			'co_applicant_income_part_time_w_guaranteed' => $this->input->post('co_applicant_income_part_time_w_guaranteed'),
			'co_applicant_income_part_time_w_o_guaranteed' => $this->input->post('co_applicant_income_part_time_w_o_guaranteed'),
			'co_applicant_income_rental' => $this->input->post('co_applicant_income_rental'),
			'co_applicant_income_investment' => $this->input->post('co_applicant_income_investment'),
			'co_applicant_income_other' => $this->input->post('co_applicant_income_other'),
			'co_applicant_income_total' => $this->input->post('co_applicant_income_total'),
		);

		$this->db->where($where);
		$query = $this->db->get($this->table_income);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_income, $data_income);
		} else {
			$this->db->insert($this->table_income, $data_income);
		}


		/**
		 * This is mortgage applicant loan details save
		 */
		$data_loan = array(
			'mortgage_application_id' => $last_id,
			'purpose_of_loan' => $this->input->post('purpose_of_loan'),
			'applicant_loan_reason' => $this->input->post('applicant_loan_reason'),
			'sales_price' => $this->input->post('sales_price'),
			'down_payment' => $this->input->post('down_payment'),
			'mortgage_amount' => $this->input->post('mortgage_amount'),
			'date_fund' => $this->input->post('date_fund'),
			'loan_gift' => $this->input->post('loan_gift'),
			'loan_investment' => $this->input->post('loan_investment'),
			'loan_bank_account' => $this->input->post('loan_bank_account'),
			'loan_borrowed_funds' => $this->input->post('loan_borrowed_funds'),
			'loan_sweat_equity' => $this->input->post('loan_sweat_equity'),
			'loan_other' => $this->input->post('loan_other'),
		);


		$this->db->where($where);
		$query = $this->db->get($this->table_loan);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_loan, $data_loan);
		} else {
			$this->db->insert($this->table_loan, $data_loan);
		}

		/**
		 * This is mortgage applicant mortgage details save
		 */
		$data_mortgage = array(
			'mortgage_application_id' => $last_id,
			'mortgage_type' => $this->input->post('mortgage_type'),
			'mortgage_original_mtg_amount' => $this->input->post('mortgage_original_mtg_amount'),
			'mortgage_balance' => $this->input->post('mortgage_balance'),
			'mortgage_payment' => $this->input->post('mortgage_payment'),
			'mortgage_payment_frequency' => $this->input->post('mortgage_payment_frequency'),
			'mortgage_maturity_date' => $this->input->post('mortgage_maturity_date'),
			'mortgage_term_type' => $this->input->post('mortgage_term_type'),
			'mortgage_amortization' => $this->input->post('mortgage_amortization'),
			'mortgage_remaining_amortization' => $this->input->post('mortgage_remaining_amortization'),
			'mortgage_rate_type' => $this->input->post('mortgage_rate_type'),
			'mortgage_interest_rate' => $this->input->post('mortgage_interest_rate'),
			'mortgage_insurer_cmhc_number' => $this->input->post('mortgage_insurer_cmhc_number'),
			'mortgage_holder' => $this->input->post('mortgage_holder'),
			'mortgage_holder_other' => $this->input->post('mortgage_holder_other'),
			'mortgage_number' => $this->input->post('mortgage_number'),
		);

		$this->db->where($where);
		$query = $this->db->get($this->table_mortgage);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_mortgage, $data_mortgage);
		} else {
			$this->db->insert($this->table_mortgage, $data_mortgage);
		}

		/**
		 * This is mortgage applicant property details save
		 */
		$data_property = array(
			'mortgage_application_id' => $last_id,
			'property_street' => $this->input->post('property_street'),
			'property_city' => $this->input->post('property_city'),
			'property_province' => $this->input->post('property_province'),
			'property_postal_code' => $this->input->post('property_postal_code'),
			'property_lot' => $this->input->post('property_lot'),
			'property_plan' => $this->input->post('property_plan'),
			'property_type_of_heating' => $this->input->post('property_type_of_heating'),
			'property_type_of_heating_other' => $this->input->post('property_type_of_heating_other'),
			'property_type' => $this->input->post('property_type'),
			'property_type_other' => $this->input->post('property_type_other'),
			'property_zoning' => $this->input->post('property_zoning'),
			'property_zoning_other' => $this->input->post('property_zoning_other'),
			'property_title' => $this->input->post('property_title'),
			'property_garage_type' => $this->input->post('property_garage_type'),
			'property_garage_size' => $this->input->post('property_garage_size'),
			'property_garage_size_specify' => $this->input->post('property_garage_size_specify'),
			'property_number_of_storey' => $this->input->post('property_number_of_storey'),
			'property_insurance_cost_per_month' => $this->input->post('property_insurance_cost_per_month'),
			'property_heating_cost_per_month' => $this->input->post('property_heating_cost_per_month'),
			'property_hydro_cost_per_month' => $this->input->post('property_hydro_cost_per_month'),
			'property_maintenance_fee_per_month' => $this->input->post('property_maintenance_fee_per_month'),
			'property_tax' => $this->input->post('property_tax'),
			'property_lot_size' => $this->input->post('property_lot_size'),
			'property_liveable_space' => $this->input->post('property_liveable_space'),
			'property_current_estimated_value' => $this->input->post('property_current_estimated_value'),
			'property_age' => $this->input->post('property_age'),
			'property_date_of_purchase' => $this->input->post('property_date_of_purchase'),
			'property_original_purchase_price' => $this->input->post('property_original_purchase_price'),
		);

		$this->db->where($where);
		$query = $this->db->get($this->table_property);

		if ($query->num_rows() > 0) {
			$this->db->where($where);
			$this->db->update($this->table_property, $data_property);
		} else {
			$this->db->insert($this->table_property, $data_property);
		}


		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
		return TRUE;

	}

	public function get_detail($id)
	{
		$this->db->select('mortgage_application.*');
		$this->db->from('mortgage_application');
		$this->db->where('deleted', 0);
		$this->db->where('id', $id);

		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}

	function delete($id)
	{
		$this->db->set('deleted', 1);
		$this->db->where('id', $id);
		$this->db->update($this->table);
		return TRUE;

	}

	/**
	 * This function used to get temp stored details
	 * @return mixed
	 */
	public function getTempApplicationData()
	{
		$this->db->select('mortgage_application.*, 
                       mortgage_application_employment.*, 
                       mortgage_application_financial.*, 
                       mortgage_application_general.*, 
                       mortgage_application_income.*, 
                       mortgage_application_loan.*, 
                       mortgage_application_mortgage.*, 
                       mortgage_application_property.*');
		$this->db->from('mortgage_application');
		$this->db->join('mortgage_application_employment', 'mortgage_application.id = mortgage_application_employment.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_financial', 'mortgage_application.id = mortgage_application_financial.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_general', 'mortgage_application.id = mortgage_application_general.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_income', 'mortgage_application.id = mortgage_application_income.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_loan', 'mortgage_application.id = mortgage_application_loan.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_mortgage', 'mortgage_application.id = mortgage_application_mortgage.mortgage_application_id', 'left');
		$this->db->join('mortgage_application_property', 'mortgage_application.id = mortgage_application_property.mortgage_application_id', 'left');
		$this->db->where('mortgage_application.created_by', $this->session->userdata('user_id'));
		$this->db->where('mortgage_application.create_status', 'pending');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();
	}

}

/* End of file currency_model.php */
/* Location: ./application/models/currency_model.php */
?>
