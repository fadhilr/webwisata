<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_admin extends CI_Model {

	


	/*
	Web Wisata Model
	*/
	public function get_all(){
			return $this->db->get('paketwisata')->result();
		}
		public function get_product_keyword($keyword){
			$this->db->select('*');
			$this->db->from('product');
			$this->db->like('nama',$keyword);
			$this->db->or_like('harga',$keyword);
			return $this->db->get()->result();
		}

	function get_galeri($id){
        $query = $this->db->query("SELECT * FROM galeri where idWisata='$id'");
        return $query->result_array();
    }
	function get_wisata2($id){
        $query = $this->db->query("SELECT * FROM guide where idWisata='$id'");
        return $query->result_array();
    }
    function get_wisataa($id){
        $query = $this->db->query("SELECT * FROM paketwisata where idWisata='$id'");
        return $query->result_array();
    }
    function get_wisataAdmin($where=""){
        $query = $this->db->query("SELECT * FROM paketwisata ".$where);
        return $query->result_array();
    }
	function get_wisata($where=""){
        $query = $this->db->query("SELECT * FROM paketwisata JOIN galeri ON galeri.idWisata=paketwisata.idWisata ".$where);
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
	function set_galeri($data,$table){
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
	function readGaleri(){
		$this->db->order_by("idGaleri","desc");
		$query=$this->db->get("galeri");
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
	function deleteGuide($id){
		$this->db->where("idGuide",$id);
		$this->db->delete("guide");
	}
	function deleteGaleri($id){
		$this->db->where("idGaleri",$id);
		$this->db->delete("galeri");
	}
	




	/*
	Web Wisata Model
	*/

	function set_ijazahValid($id){
		$this->db->set('status', 'valid');
		$this->db->where('id_alumni', $id);
		$this->db->update('alumni');
	}
	function jumlahMember(){
		return $this->db->count_all('alumni');
	}
	function jumlahMemberPending(){
		$this->db->where('status', 'pending');
		return $this->db->count_all_results('alumni');
	}
	function jumlahMemberMembayar(){
		$this->db->where('statusPembayaran', 'terbayar');
		return $this->db->count_all_results('pembayaran');
	}
	function get_memberMembayar(){//SELECT * FROM alumni JOIN pengiriman ON id_alumni = id_pemesan JOIN pembayaran ON id_pengiriman =  where statusPembayaran='pending'
		$this->db->select('*');
		$this->db->from('alumni');
		$this->db->join('pengiriman', 'id_alumni = id_pemesan');
		$this->db->join('pembayaran', 'id_pengiriman = id_pengirim');
		$this->db->where('statusPembayaran', 'terbayar');
		return $this->db->get();
	}

}