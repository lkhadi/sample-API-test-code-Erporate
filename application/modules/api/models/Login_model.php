<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function user($kondisi){
		return $this->db->get_where('users',$kondisi);
	}
	
}