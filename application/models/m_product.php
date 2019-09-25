
<?php 
	class m_product extends CI_Model{
		public function get_all(){
			return $this->db->get('product')->result();
		}
		public function get_product_keyword($keyword){
			$this->db->select('*');
			$this->db->from('product');
			$this->db->like('nama',$keyword);
			$this->db->or_like('harga',$keyword);
			return $this->db->get()->result();
		}
	}