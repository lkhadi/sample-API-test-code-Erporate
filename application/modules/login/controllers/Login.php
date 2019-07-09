<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MX_Controller{
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
			if($data=@file_get_contents(base_url('api/auth/validation'), false, $context)){
				$result = json_decode($data);
				redirect('home','refresh');				
			}
	}

	function index(){
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
			if($result = @file_get_contents(base_url('api/login'), false, $context)){
				$result = json_decode($result);
				$cookie = array(
	            "name" => "jwt",
	            "value" => $result->jwt,
	            "expire" => "2592000",
	            "domain" => $_SERVER['HTTP_HOST'],
	            "path" => "/",
	            "secure" => FALSE,
	            "httponly" => TRUE
	         	 );
	          	$this->input->set_cookie($cookie);
	          	redirect('home','refresh');
          	}else{
          		$this->load->view('index');
          	}
      	}else{
      		$this->load->view('index');				
		}
    }
}