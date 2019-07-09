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

	function urutan_pesanan(){
		$this->db->select('nomor_pesanan');
        $this->db->order_by("nomor_pesanan","DESC");
        $this->db->like('nomor_pesanan', "ERP".date('dmY')."-", 'after');
        return $this->db->get('pesanan');
	}

	function tambah_pesanan($data){
		if($this->db->insert('pesanan',$data)){
			return true;
		}else{
			return false;
		}
	}

	function tambah_item_pesanan($data){
		if($this->db->insert('item_pesanan',$data)){
			return true;
		}else{
			return false;
		}
	}

	function tampil_status_pesanan($kondisi){
		$this->db->where($kondisi);
		$this->db->where('status','1');
		return $this->db->get('pesanan')->num_rows();
	}

	function tampil_pesanan_aktif($id=null){
		$this->db->join('item_pesanan ip','ip.id_pesanan=p.nomor_pesanan','LEFT');
		$this->db->join('daftar_menu df','df.id_menu=ip.id_menu');
		if(!is_null($id)){
			$this->db->where('p.nomor_pesanan',$id);
		}
		return $this->db->get_where('pesanan p',array('p.status'=>'1'));
	}
	
	function update_pesanan($no_pesanan,$data){
		$this->db->where('nomor_pesanan',$no_pesanan);
		$this->db->update('pesanan',$data);
	}

	function hapus_item_pesanan($no_pesanan,$kondisi){
		$this->db->where($no_pesanan);
		$this->db->where_not_in('id_menu',$kondisi);
		$this->db->delete('item_pesanan');
	}
	function check_item_pesanan($no_pesanan,$id_menu){
		$this->db->where($no_pesanan);
		$this->db->where($id_menu);
		return $this->db->get('item_pesanan')->num_rows();
	}
}