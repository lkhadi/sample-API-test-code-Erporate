<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends MX_Controller{
	private $nama;
	private $role;
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
			if($data = @file_get_contents(base_url('api/auth/validation'), false, $context)){
				$result = json_decode($data);
				$this->nama = $result->nama;
				$this->role = $result->role;				
			}else{
				redirect('login','refresh');
			}
	}

	function index(){
		$data['role'] = $this->role;
		$data['title'] = "Home";
		$data['script'] ='';
		$data['nama'] = $this->nama;
		$this->load->view('header',$data);
		$this->load->view('contents/index',$data);
		$this->load->view('footer',$data);
	}

	function menu(){
		$data['role'] = $this->role;
		$data['title'] = "Daftar Menu";
		$data['script'] ='daftar_menu';
		$this->load->view('header',$data);
		$this->load->view('contents/menu',$data);
		$this->load->view('footer',$data);
		
	}

	function pesanan(){
		$data['title'] = "Pesanan";
		$data['script'] ='pesanan';
		$data['role'] = $this->role;
		$this->load->view('header',$data);
		$this->load->view('contents/pesanan',$data);
		$this->load->view('footer',$data);
	}

	function riwayat(){
		if($this->role==='pelayan'){
			$opts = array('http' =>
			    array(
			        'method'  => 'GET',
			        'header'  => 'Authorization: Bearer '.$this->input->cookie('jwt')
			    )
			);

			$context  = stream_context_create($opts);
			$result = @file_get_contents(base_url('api/riwayat'), false, $context);
			$data['title'] = "Riwayat Aktifitas";
			$data['script'] ='riwayat';
			$data['role'] = $this->role;
			$data['riwayat'] = json_decode($result);
			$this->load->view('header',$data);
			$this->load->view('contents/riwayat',$data);
			$this->load->view('footer',$data);
		}else{
			show_404();
		}
	}

	function logout(){
		delete_cookie('jwt');
		redirect('login','refresh');
	}
}