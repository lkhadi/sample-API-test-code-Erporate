<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function daftar_menu(){
		return $this->db->get('daftar_menu');
	}

	function tambah_menu($data){
		if($this->db->insert('daftar_menu',$data)){
			return true;
		}else{
			return false;
		}
	}

	function hapus_menu($kondisi){
		$this->db->where($kondisi);
		$this->db->delete('daftar_menu');
	}

	function update_menu($kondisi,$data){
		$this->db->where($kondisi);
		$this->db->update('daftar_menu',$data);
	}
	
}