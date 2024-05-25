<?php/** * Description of selling_account_model * * @author Thusitha */class Price_model extends CI_Model {    public $table = 'item_price';    public function __construct() {        parent::__construct();        $this->_database = $this->db;        $this->_table = $this->table;        $this->load->model('item_desc_code_gen_model');    }        public function get_prices(){         $account_id=$this->session->userdata('account_id');        $this->db->select('item_price.*,item.item_name,item.item_code,supplier.supplier_name');       $this->db->join('item', 'item_price.item_id=item.item_id');       $this->db->join('supplier', 'item_price.supplier_id=supplier.supplier_id');       $this->db->order_by("item_price.item_price_id", "DESC");       $this->db->where('item.account_id',$account_id);       $stats = array('1', '2');        $this->db->where_in('item_price.status', $stats);       //$this->db->where('item_price.status','1');        // $this->db->limit($limit, $start);        $query = $this->db->get('item_price');                return $query->result();    }    public function add_item_price() {       $msg='';        $id = $this->input->post('item_price_id');        $qty = $this->input->post('quantity');        $data = array(//'selling_account_id' => $this->input->post('selling_account'),            'item_id' => $this->input->post('item_id'),            'cost' => $this->input->post('c_price'),            'supplier_id' => $this->input->post('supplier'),            'unit1' => $this->input->post('unit1'),            'unit2' => $this->input->post('unit2'),            'category_id' => $this->input->post('category'),            'p_date'=>date('Y-m-d', strtotime($this->input->post('p_date')))        );        $date = new DateTime();        $date->setTimezone(new DateTimeZone('Asia/Colombo'));        $fdate = $date->format('Y-m-d H:i:s');         $this->db->trans_begin();        if ($id != 0) {            $this->db->set('update_by',$this->session->userdata('user_id'));            $this->db->set('update_date',$fdate);            $this->db->where('item_price_id', $id);            //$this->db->where('user_group_id','1');            $this->db->update($this->table, $data);            $msg="true";        } else {             $a=0;           // if(isset($_POST['bulk_type'])){                if(true){                while($a<$qty){                    $itemdesc_code=$this->item_desc_code_gen_model->generate_desc_code($fdate);                    $this->db->set('item_desc_code',$itemdesc_code);                    $this->db->set('created_by',$this->session->userdata('user_id'));                    $this->db->set('created_date',$fdate);                    $this->db->insert($this->table, $data);            $a++;                }                            }else{                $itemdesc_code=$this->item_desc_code_gen_model->generate_desc_code($fdate);                $this->db->set('item_desc_code',$itemdesc_code);                $this->db->set('quantity',$qty);                $this->db->set('created_by',$this->session->userdata('user_id'));                $this->db->set('created_date',$fdate);                $this->db->insert($this->table, $data);            }                       $msg="true";        }            if ($this->db->trans_status() === FALSE)            {                    $this->db->trans_rollback();            }            else            {                    $this->db->trans_commit();            }            return $msg;    }    function get_price_json($item_price_id=NULL) {        $account_id=$this->session->userdata('account_id');        $itemarray = array();        $this->db->select('item_price.item_id,item_price.unit1,item_price.unit2,item.item_code,item.item_name,item_price.item_desc_code,item_price.cost,item_price.item_price_id');        $this->db->join('item', 'item_price.item_id=item.item_id');        $this->db->where('item.account_id', $account_id);         $this->db->where('item_price.status','1');         if($item_price_id!=NULL){         $this->db->where('item_price.item_price_id <>',$item_price_id);             }        $this->db->order_by('item_price_id', 'asc');        $query = $this->db->get('item_price');        if ($query->num_rows() > 0) {            foreach ($query->result() as $row) {                $i_weight=$row->unit1.".".$row->unit2;                $entry = array(                    'label' => $row->item_name."(".$row->item_code." ".$row->item_desc_code.")",                    'value' => $row->item_id."~".$row->cost."~".$row->item_price_id."~".$i_weight."~".$row->unit1."~".substr(sprintf('%03d', $row->unit2),0,3),                );                array_push($itemarray, $entry);            }        }        return json_encode($itemarray);    }    public function get_item_detail($category,$item, $e_date,$stat=NULL,$year=NULL) {        $account_id=$this->session->userdata('account_id');        $this->_table = 'item_price';        $this->db->select('item_price.*,b.item_name,b.item_code,u.user_fname,p.*,i.invoice_code,i.invoice_date,d.item_cost as selling_price,d.created_date as order_date,e.app_code,c.app_in_status,e.app_out_date');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');        $this->db->join('purchase_order p', 'item_price.po_id=p.po_id', 'left');        $this->db->join('user u', 'item_price.created_by=u.user_id', 'left');        $this->db->join('order_details d', 'item_price.item_price_id=d.item_price_id', 'left');        $this->db->join('orders o', 'd.order_id=o.order_id', 'left');        $this->db->join('invoice i', 'o.order_id=i.order_id', 'left');        $this->db->join('approval_item c', 'item_price.item_price_id=c.item_price_id AND c.`app_in_status` <> 1', 'left');        $this->db->join('approval e', 'c.app_id=e.app_id', 'left');        if($e_date!='NULL'){        $this->db->where("item_price.p_date <= ",date('Y-m-d', strtotime($e_date)));       // $this->db->where("item_price.status",'1');        }        if($category!=0){            $this->db->where('item_price.category_id', $category);        }if($item!=0){            $this->db->where('item_price.item_id', $item);        }         if($year!=0){            $ny = $year+1;            $this->db->where("item_price.p_date between CAST('$year-04-01' AS DATE) AND CAST('$ny-03-31' AS DATE)");        }        if($stat==1){            $this->db->where('item_price.status', 3);        }        if($stat==2){            $statx=array('1', '2','4');            $this->db->where_in('item_price.status', $statx);        }              $this->db->where('b.account_id', $account_id);        $this->db->order_by('item_price.item_price_id', 'ASC');        $query = $this->db->get('item_price');                return $query->result();    }    public function get_daily_stock_detail($category,$item, $e_date){        $account_id=$this->session->userdata('account_id');        $this->_table = 'item_price';        $this->db->select('item_price.*,b.item_name,b.item_code');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');                if($e_date!='NULL'){        $this->db->where("item_price.created_date =",date('Y-m-d', strtotime($e_date)));        }        if($category!=0){            $this->db->where('item_price.category_id', $category);        }if($item!=0){            $this->db->where('item_price.item_id', $item);        }                $this->db->where('b.account_id', $account_id);        $this->db->order_by('b.item_id', 'ASC');        $this->db->group_by('b.item_id');        $query = $this->db->get('item_price');        return $query->result();    }    public function get_sales_items($item_id,$date){        $account_id=$this->session->userdata('account_id');                //$y_date=date('Y-m-d', strtotime($date. '-1'.' days'));        $this->_table = 'item_price';        $this->db->select('item_price.*');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');        $this->db->join('order_details d', 'item_price.item_price_id=d.item_price_id', 'left');        $this->db->join('orders o', 'd.order_id=o.order_id', 'left');        $this->db->where('item_price.item_id', $item_id);        $this->db->where('o.order_status', '1');        $this->db->where('o.order_date =', date('Y-m-d', strtotime($date)));        $this->db->where('b.account_id', $account_id);        $query=$this->db->get('item_price');            $num=$query->num_rows();            return $num;    }    public function get_old_sales_items($item_id,$date){        $account_id=$this->session->userdata('account_id');                $y_date=date('Y-m-d', strtotime($date. '-1'.' days'));        $this->_table = 'item_price';        $this->db->select('item_price.*');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');        $this->db->join('order_details d', 'item_price.item_price_id=d.item_price_id', 'left');        $this->db->join('orders o', 'd.order_id=o.order_id', 'left');        $this->db->where('item_price.item_id', $item_id);        $this->db->where('o.order_date <=', $y_date);        $this->db->where('b.account_id', $account_id);        $query=$this->db->get('item_price');            $num=$query->num_rows();            return $num;    }    public function get_tot_items($item_id,$date){        $account_id=$this->session->userdata('account_id');        $this->_table = 'item_price';        $this->db->select('item_price.*');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');        $this->db->join('order_details d', 'item_price.item_price_id=d.item_price_id', 'left');        $this->db->join('orders o', 'd.order_id=o.order_id', 'left');        $this->db->where('item_price.item_id', $item_id);        $this->db->where('item_price.p_date <', date('Y-m-d', strtotime($date)));        $this->db->where('b.account_id', $account_id);        $query=$this->db->get('item_price');            $num=$query->num_rows();            return $num;    }      public function get_item_dec_code($item_price_id){          $this->_table = 'item_price';        $this->db->where('item_price_id', $item_price_id);        $query = $this->db->get('item_price')->result();        $code = $query[0]->item_desc_code;        return $code;    }        public function get_stock_item_detail($item, $g_date) {        $account_id=$this->session->userdata('account_id');        $this->_table = 'item_price';        $this->db->select('sum(item_price.unit1)as unit1,sum(item_price.unit2)as unit2,b.item_name,b.item_code');        $this->db->join('item b', 'item_price.item_id=b.item_id', 'left');        $this->db->join('purchase_order p', 'item_price.po_id=p.po_id', 'left');        $this->db->join('user u', 'item_price.created_by=u.user_id', 'left');                        if($g_date!='NULL'){        $this->db->where("item_price.p_date <= ",date('Y-m-d', strtotime($g_date)));                }        if($item[0]!=0){            $this->db->where_in('item_price.item_id', $item);        }        $this->db->where("item_price.status",'1');        $this->db->where('b.account_id', $account_id);        $this->db->group_by('item_price.item_id', 'ASC');        $this->db->order_by('item_price.item_id', 'ASC');        $query = $this->db->get('item_price');        return $query->result();    }}