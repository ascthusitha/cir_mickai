<?php

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Invoice_code_generator
 *
 * @author Thusitha
 */
class Item_desc_code_gen_model extends CI_Model{
         protected $table='item_desc_code';

	public function __construct()
	{
	parent::__construct();

        $this->_database=  $this->db;
        $this->_table=  $this->table;
	$this->load->model('company_model');	
	}
        
       public function generate_desc_code($date){
            
        
            //check financial year
            $year=$this->get_finacial_year();
            
            if($year=='2'){
            $re=$this->db->query("select invoiceyear('$date') AS  year")->result();//added by td 2017-1-11 function need
            $year=$re[0]->year;
            
            }else if($year=='1'){
             $year=date("y", strtotime($date)); 
            }
          //  $query = $this->db->get('invoice_code_gen')->result();
            //date("y", strtotime($date));
            $month=date("m", strtotime($date));
            
                $code_id=$this->get_last_no($year,$month);
            
            //else load old id
            return $code_id;
        }
        
        public function get_last_no($year,$month){
        $this->db->where('year', $year);
        $this->db->where('month', '0');
        $query = $this->db->get('item_desc_code')->result();
        
        $suff='';
        $pre='';
        $num = $query[0]->suffix;
        $pre=$query[0]->prefix;
        
                if($num > 0){
                    $suff = sprintf('%1$05d',$num+1);
                     $this->db->where('month', '0');
                    $this->update_suffix($year,$suff);
                } else{
                    
                    $suff = sprintf('%1$05d',1);
                    
                   $suffix=1;
                                $data=array('year'=>$year,'month'=>'0','suffix'=>$suffix,'prefix'=>$pre);
                    $this->db->insert('item_desc_code',$data);
                    $a++;
                
                }
                $code=$pre.$year.'/'.$suff;
                return $code;
        }
        public function update_suffix($year,$suff){
                $this->db->where('year', $year);
                
		$this->db->set('suffix', $suff, FALSE);
                $this->db->where('month', '0');
		$this->db->update('item_desc_code');
        }
        public function get_finacial_year(){
                
               // $this->db->where('active', '1');
                $query = $this->db->get('company')->result();
                $f_name = $query[0]->f_year;
                return $f_name;
        }
        public function get_finacial_inv_date(){
                
               // $this->db->where('active', '1');
                $query = $this->db->get('company')->result();
                $fi_date = $query[0]->i_date;
                return $fi_date;
        }
     
}
