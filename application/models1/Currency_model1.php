<?php

class Currency_model extends CI_Model{
    public $table = 'currency';
    public function __construct() {
        parent::__construct();
        $this->_database=  $this->db;

        $this->_table=  $this->table;
    }

    public function get_currencies(){
        $this->db->select('currency.*');
         $this->db->where('deleted', 0);
        $this->db->where('currency_code <>','');
        return $this->get_all();
    }

    public function currency_count(){
        return $this->db->count_all_results('currency');
    }

    public function getCurrencyDetail($id){
        $this->db->select('currency.*');
        $this->db->from('currency');
        $this->db->where('currency_id', $id);
         $this->db->where('deleted', 0);

        $this->db->limit(1);
        $query=$this->db->get();
        return $query->row_array();

    }

    public function getCurrencyRate($currency_id)
    {
        $this->db->select('currency_details.*');
        $this->db->from('currency_details');
        $this->db->where('currency_details.currency_id', $currency_id);
        $query=$this->db->get();
        return $query->result();
    }

    public function addCurrency(){
        $id=$this->input->post('currencyId');
        $data=array('currency_name'=>  $this->input->post('currency_name'),
            'currency_code'=>  $this->input->post('currency_code'),
            'currency_added'=>  $this->input->post('currency_added'),
            'created_by'=>  $this->session->userdata('user_id')
        );

        $this->db->trans_begin();
        if($id!=0){
            $this->db->where('currency_id', $id);
            $this->db->update($this->table,$data);
            $return = $id;
        }else{
            $this->db->insert($this->table,$data);
            $return = $this->db->insert_id();
        }
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();

        } else {
            $this->db->trans_commit();

        }
        return $return;
    }

    function deleteCurrency($id){
           $this->db->set('deleted', 1);
        $this->db->where('currency_id', $id);
        $this->db->update($this->table);
        
            return TRUE;
    }

    function getCurrencyDropdown(){
        $currencyArray = array();
        $this->db->select('currency_id, currency_code');
         $this->db->where('deleted', 0);

        $this->db->order_by('currency_name','asc');
        $query = $this->db->get('currency');
        $currencyArray[0] = '-- Select currency--';
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $currencyArray[$row->currency_id] = $row->currency_code;
            }
        }
        return $currencyArray;
    }

    public function currencyJson(){
        $currencyArray = array();
        $this->db->select('currency_id, currency_name');
         $this->db->where('deleted', 0);

        $query = $this->db->get('currency');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $entry = array(
                    'label'  => $row->currency_name,
                    'value'  => $row->currency_id
                );
                array_push($currencyArray,$entry);
            }
        }
        echo json_encode($currencyArray);

    }

    function isCurrencyNameExist($currencyName)
    {
        $this->db->select('currency_id');
        $this->db->where('currency_code', $currencyName);
         $this->db->where('deleted', 0);

        $query = $this->db->get('currency');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_currency_rate($currency)
    {
        $this->db->select('currency_details.*');
        $this->db->from('currency_details');
        $this->db->where('currency_details.currency_id', $currency);

        $query=$this->db->get();
        return $query->result();
    }

    public function deleteCurrencyRate($id)
    {
        $this->db->where('currency_details_id', $id);
        $this->db->delete('currency_details');
    }

    

    public function get_max_currency_details_id($currency_id)
    {
        $this->db->select_max('currency_details.currency_details_id');
        $this->db->from('currency_details');
        $this->db->where('currency_details.currency_id',$currency_id);
        $query=$this->db->get();
        return $query->row_array();
    }
public function get_currency_code($cur_id){
        $this->db->select('currency_code');
       
        $this->db->where('currency.currency_id', $cur_id);
         $this->db->where('deleted', 0);

        $this->db->limit(1);
       $res = $this->db->get('currency')->result();
       return $res[0]->currency_code;
    }
    public function get_currency_array(){
        $currency_array=array();
        $this->db->select('currency.*');
        $this->db->from('currency');
        $this->db->where('currency_code <>',' ');
        $this->db->where('currency_id <>',$this->session->userdata('base_currency'));
         $this->db->where('deleted', 0);

        $this->db->order_by('currency_id','desc');
        $query= $this->db->get();
        
         foreach ($query->result_array() as $row){
             $currency_array[] = $row['currency_code'];
             
         }

            return $currency_array;
    }
    public function get_currency_new(){
        $this->db->select('currency.*');
        $this->db->where('currency_code <>','');
        $this->db->where('currency_id <>',$this->session->userdata('base_currency'));
         $this->db->where('deleted', 0);

        $this->db->order_by('currency_id','asc');
        return $this->get_all();
    }
    public function get_currency_id($curr_code){
        $this->db->select('currency_id,currency_added');
        $this->db->from('currency');
        $this->db->where('currency_code',$curr_code);
         $this->db->where('deleted', 0);
        
        $this->db->limit(1);
       $query=$this->db->get();
        return $query->row_array();
    }

}
