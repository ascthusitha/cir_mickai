<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of code model
 *
 * @author Thusitha
 */
class Code_generation_m extends CI_Model {

    protected $table = 'code_generation';
    private $dbx = '';

    public function __construct() {
        parent::__construct();

        $this->_database = $this->db;
        $this->_table = $this->table;
        
    }

    function getCode($pre) {
        
        $this->db->where('prefix', $pre);
        if($pre!="SUP"){
        
        }
        $query = $this->db->get('code_generation')->result();

        $num = $query[0]->number;
        $pre = $query[0]->prefix;

        $num = sprintf('%1$05d', $num);
        return $pre . $num;
    }


    function updateCode($pre) {
       

        $this->db->trans_start();
        $this->db->where('prefix', $pre);
      
        $this->db->set('number', 'number+1',FALSE);
        $this->db->update('code_generation');
        $this->db->trans_complete();
    }

    

    function getAutoNum() {
        $query = $this->db->get('auto_num')->result();
        $num = $query[0]->auto_id;

        $this->updateAutoNum($num);
        return $num;
    }

    function updateAutoNum($num) {
        $this->db->where('auto_id', $num);
        $this->db->set('auto_id', 'auto_id+1', FALSE);
        $this->db->update('auto_num');
    }

    FUNCTION get_tmp_auto_code() {
        $query = $this->db->get('auto_num')->result();
        $num = $query[0]->tmp_id;

        $this->updateTmpAutoNum($num);
        return $num;
    }

    function updateTmpAutoNum($num) {
        $this->db->where('tmp_id', $num);
        $this->db->set('tmp_id', 'tmp_id+1', FALSE);
        $this->db->update('auto_num');
    }
    function new_code_generate($prefix,$ord_id=NULL){
        
         //check  already invoiced or not
        if($ord_id!=NULL){
            $inv_id_stat=$this->check_order_invoice_stat($ord_id);
        }else{
            $inv_id_stat=0;
        }
        //check financial year
        $fdate = new DateTime();
        $fdate->setTimezone(new DateTimeZone('Asia/Colombo'));
        $date = $fdate->format('Y-m-d H:i:s'); 
            $year=$this->item_desc_code_gen_model->get_finacial_year();
            
            if($year=='2'){
            $re=$this->db->query("select invoiceyear('$date') AS  year")->result();//added by td 2017-1-11 function need
            $year=$re[0]->year;
            
            }else if($year=='1'){
             $year=date("y", strtotime($date)); 
            }
         
                
             if($inv_id_stat==0){
                $code_id=$this->get_last_no($year,$prefix);
            }else{
                $code_id=$inv_id_stat;
            }
            return $code_id;
    }
    
    public function get_last_no($year,$prefix){
         
          $this->db->select('d.suffix');
         $this->db->join('code_generation_details d', 'c.id=d.code_gen_id');
        $this->db->where('d.year', $year);
        
        $this->db->where('c.prefix',$prefix);
        $query = $this->db->get('code_generation c');
        $res= $query->row_array();
        $suff='';
        $pre='';
        $num = $res['suffix'];
        $pre=$prefix;
    
        $code_gen_id=$this->code_gen_id($pre);
                if($num > 0){
                    $suff = sprintf('%1$05d',$num+1);
                    
                    $this->update_suffix($year,$suff,$code_gen_id);
                }else{
                    
                    $suff = sprintf('%1$05d',1);
                    
                   $suffix=1;
                    
                    $data=array('year'=>$year,'code_gen_id'=>$code_gen_id,'suffix'=>$suffix);
                    $this->db->insert('code_generation_details',$data);
                    
                
                }
                $code=$pre." ".$year.'/'.$suff;
                return $code;
        }
        
        public function update_suffix($year,$suff,$code_gen_id){
            
		$this->db->set('suffix', $suff, FALSE);
                $this->db->where('year', $year);
                $this->db->where('code_gen_id',$code_gen_id);
                $this->db->update('code_generation_details');
        }
        public function code_gen_id($pre){
        $this->db->where('prefix',$pre);
        $query = $this->db->get('code_generation')->result();
        $id = $query[0]->id;
        return $id;
        }
        public function check_order_invoice_stat($ord_id){
            $this->db->select('invoice_id,invoice_code');
            $this->db->where('order_id', $ord_id);
            $query = $this->db->get('invoice');
            $res= $query->row_array();
            $code=0;
            if($res['invoice_id']>0){
                $code = $res['invoice_code'];
            }
            return $code;
        }
}

/* End of file code_generation.php */
/* Location: ./application/models/code_generation.php */