<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		
	}
	public function update_quantity($id, $quantity){
		$query ="UPDATE `tbl_product` SET `quantity` = quantity - ".$quantity." WHERE `id` = '$id'";
		$this->db->query($query);
	}
	// $tbl: tên bảng
 	// $data: dl cần select
 	// $condition: điều kiện select
 	// $is_multi: 1(select nhiều), 0(select 1)
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
 	public function insert_data($tbl, $data){
 		$this->db->insert($tbl, $data);
 		// var_dump($this->db->last_query());
 	}
 	public function update_data($tbl, $data, $condition){
		$this->db->update($tbl, $data,$condition);
		// var_dump($this->db->last_query());
 	}
 	public function delete_data($tbl,$condition){
        $this->db->delete($tbl,$condition);
	}
	//test select
	public function select_demo($tbl, $data, $condition=null,$join=null,$orderBy,$start, $limit, $is_multi = 1){
 		var_dump($start);
 		var_dump($limit); 
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
 			 $this->db->get()->result_array();
 		}else{
 			 $this->db->get()->row_array();
 		}
 		var_dump($this->db->last_query());die;	
 	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */