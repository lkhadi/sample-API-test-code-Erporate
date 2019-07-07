<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends MX_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('jwt')){
			redirect('login','refresh');
		}
	}

	function index(){
		$data['title'] = "Home";
		$this->load->view('header',$data);
		$this->load->view('contents/index',$data);
		$this->load->view('footer',$data);
	}

	function menu(){
		$data['title'] = "Daftar Menu";
		$this->load->view('header',$data);
		$this->load->view('contents/menu',$data);
		$this->load->view('footer',$data);
		
	}

	function pesanan(){
		$data['title'] = "Pesanan";
		$data['daftar_makanan'] = json_decode(file_get_contents(base_url("api/tampil_menu?jwt=".$this->session->userdata("jwt")."&jenis=makanan")));
		$data['daftar_minuman'] = json_decode(file_get_contents(base_url("api/tampil_menu?jwt=".$this->session->userdata("jwt")."&jenis=minuman")));
		$this->load->view('header',$data);
		$this->load->view('contents/pesanan',$data);
		$this->load->view('footer',$data);
	}
}