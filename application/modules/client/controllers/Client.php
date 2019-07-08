<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends MX_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper('cookie');
		$postdata = http_build_query(
			    array(
			        'jwt' => $this->input->cookie('jwt')
			    )
			);
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'  => 'Content-Type: application/x-www-form-urlencoded',
			        'content' => $postdata
			    )
			);

			$context  = stream_context_create($opts);
			if(!@file_get_contents(base_url('api/auth/validation'), false, $context)){
				redirect('login','refresh');
			}
	}

	function index(){
		$data['title'] = "Home";
		$data['script'] ='';
		$this->load->view('header',$data);
		$this->load->view('contents/index',$data);
		$this->load->view('footer',$data);
	}

	function menu(){
		$data['title'] = "Daftar Menu";
		$data['script'] ='daftar_menu';
		$this->load->view('header',$data);
		$this->load->view('contents/menu',$data);
		$this->load->view('footer',$data);
		
	}

	function pesanan(){
		$data['title'] = "Pesanan";
		$data['script'] ='pesanan';
		$data['daftar_makanan'] = json_decode(file_get_contents(base_url("api/tampil_menu?jwt=".$this->session->userdata("jwt")."&jenis=makanan")));
		$data['daftar_minuman'] = json_decode(file_get_contents(base_url("api/tampil_menu?jwt=".$this->session->userdata("jwt")."&jenis=minuman")));
		$this->load->view('header',$data);
		$this->load->view('contents/pesanan',$data);
		$this->load->view('footer',$data);
	}

	function logout(){
		delete_cookie('jwt');
		redirect('login','refresh');
	}
}