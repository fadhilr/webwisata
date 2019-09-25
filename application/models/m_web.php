<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_web extends CI_Model {

	

	/*
	Web Wisata Model
	*/

	public function get_all(){
			return $this->db->get('paketwisata')->result();
		}

		public function get_product_keyword($keyword){
			$this->db->select('*');
			$this->db->from('paketwisata');
			$this->db->like('namaWisata',$keyword);
			// $this->db->or_like('harga',$keyword);
			return $this->db->get()->result();
		}
		public function get_product_keyword1($keyword){
			$this->db->select('*');
			$this->db->from('guide');
			$this->db->like('namaGuide',$keyword);
			// $this->db->or_like('harga',$keyword);
			return $this->db->get()->result();
		}

	function get_wisata($where=""){
        $query = $this->db->query("SELECT * FROM paketwisata ".$where);
        return $query->result_array();
    }
    function get_guide($where=""){
        $query = $this->db->query("SELECT * FROM guide ".$where);
        return $query->result_array();
    }
	function set_wisata($data,$table){
		$query = $this->db->insert($table,$data);
		return $query;
	}
	function set_guide($data,$table){
		$query = $this->db->insert($table,$data);
		return $query;
	}
	public function update_wisata($data, $id, $table)
	{
	   $this->db->where('idWisata', $id);
	   $this->db->update($table,$data); 
	}
	public function update_guide($data, $id, $table)
	{
	   $this->db->where('idGuide', $id);
	   $this->db->update($table,$data); 
	}
	
	//Admin
	function readWisata(){
		$this->db->order_by("idWisata","desc");
		$query=$this->db->get("paketwisata");
		return $query->result_array();
	}
	function readGuide(){
		$this->db->order_by("idGuide","desc");
		$query=$this->db->get("guide");
		return $query->result_array();
	}
	function hapusWisata($table,$where){
		$res=$this->db->delete($table,$where);
		return $res;
	}

	function delete($id){
		$this->db->where("idWisata",$id);
		$this->db->delete("paketwisata");
	}
	


}