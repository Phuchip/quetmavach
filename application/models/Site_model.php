<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function select_data($tbl, $data, $condition=null,$join=null,$orderBy,$start, $limit, $is_multi = 1){
 		$this->db->select($data);
 		$this->db->from($tbl);
 		if ($join != null) {
 			foreach ($join as $key => $value) {
	 			$this->db->join($key, $value);
	 		}
 		}
 		if ($condition != null) {
 			foreach ($condition as $key => $value) {
 				$this->db->where($key, $value);
 			}
 		}
 		if ($orderBy != null) {
 			foreach ($orderBy as $key => $value) {
	 			$this->db->order_by($key, $value);
	 		}
 		}
 		if ($start != null || $limit != null) {
 			$this->db->limit($start,$limit);
 		}
 		if ($is_multi == 1) {
 			return $this->db->get()->result_array();
 		}else{
 			return $this->db->get()->row_array();
 		}
 	}
 	public function limit_data($tbl, $data, $condition=null,$join=null,$orderBy,$in,$start, $limit, $is_multi = 1){
 		$this->db->select($data);
 		if ($join != null) {
 			foreach ($join as $key => $value) {
	 			$this->db->join($key, $value);
	 		}
 		}
 		if ($condition != null) {
 			foreach ($condition as $key => $value) {
 				$this->db->where($key, $value);
 			}
 		}
 		if ($orderBy != null) {
 			foreach ($orderBy as $key => $value) {
	 			$this->db->order_by($key, $value);
	 		}
 		}
 		if ($in != null) {
 			foreach ($in as $key => $value) {
	 			$this->db->where_in($key, $value);
	 		}
 		}
 		if ($is_multi == 1) {
 			return $this->db->get($tbl,$limit)->result_array();
 		}else{
 			return $this->db->get()->row_array();
 		}

 	}
 	public function insert_data($tbl, $data){
 		$this->db->insert($tbl, $data);
 	}
 	public function update_data($tbl, $data, $condition){
		$this->db->update($tbl, $data,$condition);
 	}
 	public function delete_data($tbl,$condition){
        $this->db->delete($tbl,$condition);
	}
	function check_quantity($tbl,$id)
	{
		$this->db->select('name,alias,image,quantity,price_old,discount');
		$this->db->where('id',$id);
		$sql = $this->db->get($tbl);
		return $sql;
	}
	function array_manu()
	{
		$sql = "SELECT id, name,alias, (SELECT COUNT(*) FROM tbl_product WHERE manufacturer = tbl_manufacturer.id AND `status` = 1 AND `delete` = 0) as quantity FROM tbl_manufacturer WHERE status = 1 ORDER BY quantity DESC";
		$data = $this->db->query($sql);
		return $data->result_array();
	}
	function get_data_page($where,$order,$pagination,$str='')
	{
		$sql = "SELECT id,name,alias,price_old,discount,quantity,image,code_product FROM `tbl_product` WHERE `delete` = 0 AND `status` = 1";
		if (isset($str) AND $str != '') {
			$sql .= $str;
		}
		$sql .= $where." ORDER BY modify_time DESC ".$order;
		if ($pagination != null) {
			$sql .= $pagination;
		}
		$data = $this->db->query($sql);
		return $data->result_array();
	}
}

/* End of file Site_model.php */
/* Location: ./application/models/Site_model.php */