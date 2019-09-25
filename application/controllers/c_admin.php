<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_admin');
		$this->load->helper(array('form', 'url'));
		$this->load->database();
	}

	public function index()
	{
		if($this->session->userdata('username')!=null){
			$this->tampilanAdmin();
		}
		else{
			
		$this->load->view('tampilanLoginAdmin');
		}
		
	}
	
	public function tampilanAdmin()
	{	

		$data["wisata"]=$this->m_admin->readWisata();
		$this->load->view("tampilanAdmin",$data);
	}
	
	public function adminGuide()
	{
		$data["wisata"]=$this->m_admin->readGuide();
		$this->load->view("adminGuide",$data);

	}
	public function galeriAdmin()
	{
		$data["wisata"]=$this->m_admin->readGaleri();
		$this->load->view("galeriAdmin",$data);

	}
	
	public function tampilanTambahWisata($error=''){
		$this->load->view('tampilanTambahWisata', array('error' => ' ' ));
	}
	public function tampilanTambahGuide($error=''){
		$data["wisata"]=$this->m_admin->readWisata();
		$data["error"]=$error;
		$this->load->view('tampilanTambahGuide', $data);
	}
	public function tampilanTambahGaleri($error=''){
		$data["wisata"]=$this->m_admin->readWisata();
		$data["error"]=$error;
		$this->load->view('tampilanTambahGaleri', $data);
	}
	public function tampilanInfoWisata($id){

		$wst = $this->m_admin->get_wisataAdmin("where idWisata='$id'");
		$data = array(
			"idWisata"=> $wst[0]['idWisata'], 
			"namaWisata" => $wst[0]['namaWisata'], 
			"foto" => $wst[0]['foto'], 
			"tanggal" => $wst[0]['tanggal'], 
			"preview" => $wst[0]['preview'], 
			"latitude" => $wst[0]['latitude'],
			"longitude" => $wst[0]['longitude'],
		);
		$this->load->view('tampilanInfoWisata',$data);
		
	}
		public function tampilanEditWisata($id){

		$wst = $this->m_admin->get_wisataAdmin("where idWisata='$id'");
		$data = array(
			"idWisata"=> $wst[0]['idWisata'], 
			"namaWisata" => $wst[0]['namaWisata'], 
			"foto" => $wst[0]['foto'], 
			"tanggal" => $wst[0]['tanggal'], 
			"preview" => $wst[0]['preview'], 
			"latitude" => $wst[0]['latitude'],
			"longitude" => $wst[0]['longitude'],
		);
		$this->load->view('tampilanEditWisata',$data);
		
	}
	public function tampilanEditGuide($id){

		$wst = $this->m_admin->get_guide("where idGuide='$id'");
		$data = array(
			"idGuide"=> $wst[0]['idGuide'], 
			"namaGuide" => $wst[0]['namaGuide'], 
			"fotoGuide" => $wst[0]['fotoGuide'], 
			"emailGuide" => $wst[0]['emailGuide'], 
			"notelpGuide" => $wst[0]['notelpGuide'], 
			"umurGuide" => $wst[0]['umurGuide'],
			"alamatGuide" => $wst[0]['alamatGuide'],
		);
		$this->load->view('tampilanEditGuide',$data);
		
	}
	public function tampilanInfoGuide($id){

		$wst = $this->m_admin->get_guide("where idGuide='$id'");
		$data = array(
			"idGuide"=> $wst[0]['idGuide'], 
			"namaGuide" => $wst[0]['namaGuide'], 
			"fotoGuide" => $wst[0]['fotoGuide'], 
			"emailGuide" => $wst[0]['emailGuide'], 
			"notelpGuide" => $wst[0]['notelpGuide'], 
			"umurGuide" => $wst[0]['umurGuide'],
			"alamatGuide" => $wst[0]['alamatGuide'],
		);
		$this->load->view('tampilanInfoGuide',$data);
		
	}

	public function tambahGaleri(){
		$id =  $this->input->post('idWisata');
		$data = array(
			
			'idWisata' => $id,
			);
		$data= $this->tambahFoto1($data);

		$data= $this->tambahFoto2($data);
		$data= $this->tambahFoto3($data);
		$data= $this->tambahFoto4($data);
		$this->m_admin->set_galeri($data,'galeri');
		$data = array('upload_data' => $this->upload->data());

		$this->galeriAdmin();
	}
	public function tambahFoto1($data){
		$config['upload_path']          = './assets/images/foto/galeri/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas1')){
			$error = array('error' => $this->upload->display_errors());
			$this->tampilanTambahGuide($error);
		}else{
			
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			
			$this->load->model('m_admin');
		
		$data['foto1'] = $foto;
			return $data;
			// $this->m_admin->set_galeri($data,'galeri');
			// $data = array('upload_data' => $this->upload->data());
			
		}
	}public function tambahFoto2($data){
		$config['upload_path']          = './assets/images/foto/galeri/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas2')){
			$error = array('error' => $this->upload->display_errors());
			$this->tampilanTambahGuide($error);
		}else{
			
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			
			$this->load->model('m_admin');
		
		$data['foto2'] = $foto;
		return $data;
			
		}
	}public function tambahFoto3($data){
		$config['upload_path']          = './assets/images/foto/galeri/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas3')){
			$error = array('error' => $this->upload->display_errors());
			$this->tampilanTambahGuide($error);
		}else{
			
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			
			$this->load->model('m_admin');
		
		$data['foto3'] = $foto;

			return $data;
			
		}
	}public function tambahFoto4($data){
		$config['upload_path']          = './assets/images/foto/galeri/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas4')){
			$error = array('error' => $this->upload->display_errors());
			$this->tampilanTambahGuide($error);
		}else{
			
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			
			$this->load->model('m_admin');
		
		$data['foto4'] = $foto;

			return $data;
			
		}
	}
	public function tambahGuide(){
		$config['upload_path']          = './assets/images/foto/guide/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->tampilanTambahGuide($error);
		}else{
			$idWisata =  $this->input->post('idWisata');
			$namaGuide =  $this->input->post('namaGuide');
			$upload_data = $this->upload->data();
			$fotoGuide =  $upload_data['file_name'];
			$emailGuide =  $this->input->post('emailGuide');
			$notelpGuide =  $this->input->post('notelpGuide');
			$umurGuide =  $this->input->post('umurGuide');
			$alamatGuide =  $this->input->post('alamatGuide');
			
			$this->load->model('m_admin');
		
		$data = array(
			'idWisata' => $idWisata,
			'namaGuide' => $namaGuide,
			'fotoGuide' => $fotoGuide,
			'emailGuide' => $emailGuide,
			'notelpGuide' => $notelpGuide,
			'umurGuide' => $umurGuide,
			'alamatGuide' => $alamatGuide,
			);

			$this->m_admin->set_guide($data,'guide');
			$data = array('upload_data' => $this->upload->data());
			$this->adminGuide();
		}
	}

	public function aksi_upload(){
		$config['upload_path']          = './assets/images/foto/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('v_upload', $error);
		}else{
			$nama =  $this->input->post('nama');
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			$tanggalPosting =  $this->input->post('tanggalPosting');
			$preview =  $this->input->post('preview');
			$latitude =  $this->input->post('latitude');
			$longitude =  $this->input->post('longitude');
			
			$this->load->model('m_admin');
		
		$data = array(
			'namaWisata' => $nama,
			'foto' => $foto,
			'tanggal' => $tanggalPosting,
			'preview' => $preview,
			'latitude' => $latitude,
			'longitude' => $longitude,
			);

			$this->m_admin->set_wisata($data,'paketwisata');
			$data = array('upload_data' => $this->upload->data());
			$this->tampilanAdmin();
		}
	}
	public function editWisata($id){
		$config['upload_path']          = './assets/images/foto/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('v_upload', $error);
		}else{
			
			$nama =  $this->input->post('nama');
			$upload_data = $this->upload->data();
			$foto =  $upload_data['file_name'];
			$tanggalPosting =  $this->input->post('tanggalPosting');
			$preview =  $this->input->post('preview');
			$latitude =  $this->input->post('latitude');
			$longitude =  $this->input->post('longitude');
			
			$this->load->model('m_admin');
		
		$data = array(
			'namaWisata' => $nama,
			'foto' => $foto,
			'tanggal' => $tanggalPosting,
			'preview' => $preview,
			'latitude' => $latitude,
			'longitude' => $longitude,
			);

			$this->m_admin->update_wisata($data,$id,'paketwisata');
			$data = array('upload_data' => $this->upload->data());
			$this->tampilanAdmin();
		}

	}
	public function editGuide($id){
		$config['upload_path']          = './assets/images/foto/guide/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
 
		$this->load->library('upload', $config);
 
		if ( ! $this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('v_upload', $error);
		}else{
			
			$namaGuide =  $this->input->post('namaGuide');
			$upload_data = $this->upload->data();
			$fotoGuide =  $upload_data['file_name'];
			$emailGuide =  $this->input->post('emailGuide');
			$notelpGuide =  $this->input->post('notelpGuide');
			$umurGuide =  $this->input->post('umurGuide');
			$alamatGuide =  $this->input->post('alamatGuide');
			
			$this->load->model('m_admin');
		
		$data = array(
			'namaGuide' => $namaGuide,
			'fotoGuide' => $fotoGuide,
			'emailGuide' => $emailGuide,
			'notelpGuide' => $notelpGuide,
			'umurGuide' => $umurGuide,
			'alamatGuide' => $alamatGuide,
			);

			$this->m_admin->update_guide($data,$id,'guide');
			$data = array('upload_data' => $this->upload->data());
			$this->adminGuide();
		}

	}

	public function hapus(){
		$id= $this->input->post("id");
		$this->m_admin->delete($id);
		echo "{}";
	}
	public function hapusGuide(){
		$id= $this->input->post("id");
		$this->m_admin->deleteGuide($id);
		echo "{}";
	}
	public function hapusGaleri(){
		$id= $this->input->post("id");
		$this->m_admin->deleteGaleri($id);
		echo "{}";
	}

	public function hapusWisata($id)
	{	
		$where = array('idWisata' => $id );
		$res=$this->m_admin->hapusWisata('paketwisata',$where);
		if ($res>=1) {
			$this->tampilanAdmin();
		}

	}


}