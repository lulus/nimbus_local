<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_Data extends CI_Model{
    function __construct(){
         parent::__construct();
    }

    public function GetData($table,$field,$type){
        $this->db->order_by($field,$type);
        $res=$this->db->get($table);
        return $res->result_array(); 
    }
    
    public function GetDataUserByDate($sdate,$edate){
        $query = $this->db->query('SELECT  *
                                    FROM tbl_users
                                    WHERE created BETWEEN "'.$sdate.'" and DATE_ADD("'.$edate.'", INTERVAL 1 DAY) ORDER BY id DESC');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataGuestManager(){
        $query = $this->db->query('SELECT tbl_guest_manager.nas_type as id_vendor, tbl_guest_manager.guest_login as id_guest, tbl_guest_manager.ip, tbl_vendor.vendor, tbl_guest_login.description
                                    FROM tbl_guest_manager
                                    INNER JOIN tbl_vendor
                                    ON tbl_guest_manager.nas_type = tbl_vendor.id
                                    INNER JOIN tbl_guest_login
                                    ON tbl_guest_manager.guest_login = tbl_guest_login.id
                                    WHERE tbl_guest_manager.id="0"');
        $res=$query->result_array();
        return $res; 
    }

    public function GetDataLimit($table,$field,$type,$limit){
        $this->db->order_by($field,$type);
        $this->db->limit($limit);
        $res=$this->db->get($table);
        return $res->result_array(); 
    }

   public function GetDataGraph(){
        $query = $this->db->query('SELECT DATE(authdate) as tanggal,COUNT(*) as jumlah
                                    FROM radpostauth 
                                    GROUP BY DATE_FORMAT(authdate, "%d-%m")
                                    ORDER BY authdate ASC');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataSelect($table,$field,$value){
        $this->db->where($field,$value);
        $this->db->from($table);
        $res=$this->db->get();
        return $res->result_array(); 
    }

    public function MasterGetDataSelect($table,$field,$value){
        if($value == ""){
            $this->db->where($field);
        }else{
            $this->db->where($field,$value);
        }
        $this->db->from($table);
        $res=$this->db->get();
        return $res->result_array(); 
    }

    public function GetDataClient($value){
        $query = $this->db->query('SELECT  radcheck.id,radcheck.username,radcheck.value,radusergroup.groupname
                                    FROM radcheck
                                    INNER JOIN radusergroup
                                    ON radcheck.username = radusergroup.username
                                    WHERE radcheck.id="'.$value.'"');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataClients(){
        $query = $this->db->query('SELECT  radcheck.id,radcheck.username,radcheck.value,radusergroup.groupname
                                    FROM radcheck
                                    INNER JOIN radusergroup
                                    ON radcheck.username = radusergroup.username');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataSelectGroup($table,$field,$value,$group){
        $this->db->where($field,$value);
        $this->db->from($table);
        $this->db->group_by($group);
        $res=$this->db->get();
        return $res->result_array(); 
    }

    public function GetDataService($groupservice){
        $query = $this->db->query('SELECT  radgroupcheck.id,radgroupcheck.attribute,radgroupcheck.value,dictionary.vendor
                                    FROM radgroupcheck
                                    INNER JOIN dictionary
                                    ON radgroupcheck.attribute = dictionary.attribute
                                    WHERE groupservice="'.$groupservice.'" GROUP BY dictionary.attribute ORDER BY radgroupcheck.id ASC');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataPages(){
        $query = $this->db->query('SELECT tbl_guest_background.background, tbl_guest_page.title, tbl_guest_page.subtitle, tbl_guest_page.id_background, tbl_guest_page.top_page, tbl_guest_page.left_page
                                    FROM tbl_guest_page
                                    INNER JOIN tbl_guest_background
                                    ON tbl_guest_background.id = tbl_guest_page.id_background');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataPagesInternal(){
        $query = $this->db->query('SELECT tbl_guest_background.background, tbl_internal_page.title, tbl_internal_page.subtitle, tbl_internal_page.id_background, tbl_internal_page.top_page, tbl_internal_page.left_page
                                    FROM tbl_internal_page
                                    INNER JOIN tbl_guest_background
                                    ON tbl_guest_background.id = tbl_internal_page.id_background');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataPolicies($groupservice){
        $query = $this->db->query('SELECT  radgroupreply.id,radgroupreply.attribute,radgroupreply.value,dictionary.vendor
                                    FROM radgroupreply
                                    INNER JOIN dictionary
                                    ON radgroupreply.attribute = dictionary.attribute
                                    WHERE groupname="'.$groupservice.'" GROUP BY dictionary.attribute ORDER BY radgroupreply.id ASC');
        $res=$query->result_array();
        return $res;
    }

    public function GetDataUsers(){
        $query = $this->db->query('SELECT  radcheck.id,radcheck.username,radroles.rolename
                                    FROM radcheck
                                    INNER JOIN radroles
                                    ON radcheck.username = radroles.username
                                    GROUP BY radcheck.username ORDER BY radcheck.id ASC');
        $res=$query->result_array();
        return $res;
    }

    public function CheckDataAttribute($table,$attribute,$groupservice){
        $query = $this->db->query('SELECT  * FROM  '.$table.' WHERE attribute="'.$attribute.'" AND groupservice="'.$groupservice.'"');
        $res=$query->result_array();
        if(!is_null($res) && count($res)){
            return true;
        }else{
            return false;
        } 
    }

    public function CheckDataAttributePolicies($table,$attribute,$groupname){
        $query = $this->db->query('SELECT  * FROM  '.$table.' WHERE attribute="'.$attribute.'" AND groupname="'.$groupname.'"');
        $res=$query->result_array();
        if(!is_null($res) && count($res)){
            return true;
        }else{
            return false;
        } 
    }

    public function CheckDataAttributeGroup($table,$rolename,$groupservice){
        $query = $this->db->query('SELECT  * FROM  '.$table.' WHERE rolename="'.$rolename.'" AND groupservice="'.$groupservice.'"');
        $res=$query->result_array();
        if(!is_null($res) && count($res)){
            return true;
        }else{
            return false;
        } 
    }

    public function GetDataVendor($table){
        $this->db->group_by('vendor');
        $this->db->order_by('vendor','ASC');
        $res=$this->db->get($table);
        return $res->result_array(); 
    }

    public function GetDataGroupby($table,$group){
        $this->db->group_by($group);
        $res=$this->db->get($table);
        return $res->result_array(); 
    }

    public function GetDataVendorAtribute($table,$key){
        if($key == 'All' || $key == 'all' || $key == null){
            $this->db->group_by('attribute');
            $res=$this->db->get($table);
        }else if($key != null){
            $this->db->where('vendor',$key);
            $this->db->group_by('attribute');
            $res=$this->db->get($table);
        }
        return $res->result_array(); 
    }

    function InputData($table,$data){
        if($this->db->insert($table,$data)){
            return true;
        }else{
            return false;
        }
    }

    function MasterInputData($table,$data){
        if($this->db->insert($table,$data)){
            return true;
        }else{
            return false;
        }
    }


    function UpdataData($where,$table,$data){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function MasterUpdataData($where,$table,$data){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function cek_password($table,$where){		
		return $this->db->get_where($table,$where);
	}

    function Total($table){
        $query = $this->db->query('SELECT  COUNT(id) as total FROM  '.$table);
        $res=$query->result_array();
        return $res;
    }
    function Today($table){
        $query = $this->db->query('SELECT  COUNT(date(authdate)) as today from  '.$table.' WHERE date(authdate) = CURDATE()');
        $res=$query->result_array();
        return $res;
    }

    function Week($table){
        $query = $this->db->query('SELECT  COUNT(date(authdate)) as week from  '.$table.' WHERE authdate >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)');
        $res=$query->result_array();
        return $res;
    }

    function Month($table){
        $query = $this->db->query('SELECT  COUNT(date(authdate)) as months from  '.$table.' WHERE authdate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)');
        $res=$query->result_array();
        return $res;
    }

    function CheckData($table,$field,$value){
        $this->db->where($field,$value);
        $this->db->from($table);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function DeleteData($table,$field,$value){
        $this->db->where($field,$value);
        $this->db->from($table);
        $res=$this->db->delete();
        return $res;
    }
}
?>