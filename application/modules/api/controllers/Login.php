<?php 
date_default_timezone_set('Asia/Jakarta');
use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
$key='';
class Login extends MX_Controller{
	 use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }
  function __construct(){
  	parent::__construct();
  	$this->__resTraitConstruct();	
	$this->key = "erporate_key";
	$this->load->model('login_model');
  }

  function index_post(){
  	$username = strip_tags($this->post('username'));
  	$password = strip_tags($this->post('password'));
  	$kondisi = array('username'=>$username);
  	$status = $this->login_model->user($kondisi);
  	if($status->num_rows()>0){
  		$user = $status->row();
        if(password_verify($password, $user->password)){
      		$token = array(
    	    "iss" => "http://test_code.org",
    	    "aud" => "http://test_code.com",
    	    "iat" => 1356999524,
    	    "nbf" => 1357000000,
    	    "data" => array("id_user"=>$user->id_user)
    		  );
      		$data['jwt'] = JWT::encode($token,$this->key);
      		$data['nama'] = $user->nama;
      		$data['role'] = $user->role;
      		$data['status'] = TRUE;
      		$this->db->insert('logs',array('user_id'=>$user->id_user,'log'=>'masuk ke dalam sistem','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
      		$this->response($data,200);
      }else{
        $data['message'] = "Username atau password salah";
        $data['status'] = FALSE;
        $this->response($data,401);
      }
  	}else{
  		$data['message'] = "Username atau password salah";
  		$data['status'] = FALSE;
  		$this->response($data,401);
  	} 	
  }

  function validation_post(){
    $jwt = $this->post("jwt");
    if($jwt){
      try{
        JWT::decode($jwt,$this->key,array('HS256'));
        $data['message'] = "Invalid Token";
        $data['status'] = TRUE;
        $this->response($data,200);
      }catch(Exception $e){
        $data['message'] = "Invalid Token";
        $data['status'] = FALSE;
        $this->response($data,401);
      }
    }else{
      $data['message'] = "Invalid Token";
      $data['status'] = FALSE;
      $this->response($data,401);
    }
  }
}