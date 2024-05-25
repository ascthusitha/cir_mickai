<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of company_model
 *
 * @author Thusitha
 */
class Company_model extends CI_Model{

    //put your code here
    protected $table = 'company';

    public function __construct() {
        parent::__construct();
        $this->_database = $this->db;
        $this->_table = $this->table;
    }

    public function addCompany() {
        $id = $this->input->post('company_id');
        $data = array('company_name' => $this->input->post('company_name'),
            'company_address' => $this->input->post('address'),
            'company_telephone' => $this->input->post('telephone'),
            'company_website' => $this->input->post('website'),
            'country_id' => $this->input->post('country'),
            
        );
        if ($id != 0) {

            $this->db->where('company_id', $id);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $this->db->set('base_currency_id', $this->input->post('currency'));
            $this->db->insert($this->table, $data);
            return TRUE;
        }
    }

    function get_company_detail($id) {
        $this->db->select('company.*');
        $this->db->from('company');


        $this->db->where('company_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_company_details() {
        $this->db->select('company.*,currency.currency_code,company_bank_details.*');
        $this->db->from('company');
        $this->db->join('company_bank_details', 'company.company_id=company_bank_details.company_id','left');
        $this->db->join('currency', 'company.base_currency_id=currency.currency_id','left');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_company_dropdown() {

        $companyarray = array();
        $this->db->select('company_id, company_name');
        $query = $this->db->get('company');
        $companyarray[''] = '--Select--';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $companyarray[$row->company_id] = $row->company_name;
            }
        }
        return $companyarray;
    }

    function getshort_name() {
        $this->db->limit(1);
        $query = $this->db->get('company')->result();

        $short_name = $query[0]->short_name;

        return $short_name;
    }
    public function get_f_year(){

        $this->db->select('f_year');

         $this->db->where('base_currency_id','1');
 

        $this->db->limit(1);

       $res = $this->db->get('company');

       return $res->row('f_year');

    }

}

?>
