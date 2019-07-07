<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MX_Controller{
	function __construct(){
		parent::__construct();
	}

	function index(){
		if($this->session->userdata('jwt')){
			redirect('home','refresh');
		}
		if($this->input->post()){
			$postdata = http_build_query(
			    array(
			        'username' => $this->input->post('username'),
			        'password' => $this->input->post('password')
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
			$data = json_decode(file_get_contents(base_url('api/login'),false,$context));
			if($data->status){
				$session = array('jwt'=>$data->jwt,'nama'=>$data->nama,'role'=>$data->role);
				$this->session->set_userdata($session);
				redirect('home','refresh');
			}else{
				$this->session->set_flashdata('alert','<div class="alert alert-danger">
						  <strong>Error!</strong> Username atau password salah.
						</div>');
			}
		}
		$this->load->view('index');		
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}