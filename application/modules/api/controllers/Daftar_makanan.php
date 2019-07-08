<?php 
date_default_timezone_set('Asia/Jakarta');
use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
$key='';
class Daftar_makanan extends MX_Controller{
	 use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }
  function __construct(){
  	parent::__construct();
  	$this->__resTraitConstruct();	
	  $this->key = "erporate_key";
	  $this->load->model('menu_model');
  }

  function menu_post(){
  		$jwt = $this->post('jwt');
      if($jwt){
        try{
          $decode = JWT::decode($jwt,$this->key,array('HS256'));
          $data['nama_menu'] = strip_tags($this->post('nama_menu'));
          $data['tipe'] = strip_tags($this->post('tipe'));
          $data['harga'] = strip_tags($this->post('harga'));
          $data['created_at'] = date('Y-m-d H:i:s');
          $data['updated_at'] = date('Y-m-d H:i:s');
          if($this->menu_model->tambah_menu($data)){
            $message['message'] = "berhasil menambah menu";
            $message['status'] = TRUE;
            $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Menambah menu','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
            $this->response($message,200);
          }else{
            $message['message'] = "gagal menambah menu";
            $this->response($message,400);
          }
          
        }catch(Exception $e){
          $message['message'] = "Access Denied!";
          $this->response($message,401);
        }
      }else{
        $message['message'] = "Access Denied!";
        $this->response($message,401);
      }
  }

  function menu_get($id=null){
    $token = explode(" ", getallheaders()['Authorization']);
    $jwt = $token[1];
    $tipe = $this->get('jenis');
    if($jwt){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if(!is_null($tipe)) $this->db->where(array('tipe'=>$tipe,'status'=>'1'));
        if(!is_null($id)){
          $this->db->where('id_menu',$id);
          $menu = $this->menu_model->daftar_menu()->row();
        }else{
          $menu = $this->menu_model->daftar_menu()->result();
        }        
        $this->response($menu,200);
      }catch(Exception $e){
        $message['message'] = "Access Denied!";
        $this->response($message,401);
      }
    }else{
      $message['message'] = "Access Denied!";
      $this->response($message,401);
    }
  }

  function menu_delete($id=null){
    $token = explode(" ", getallheaders()['Authorization']);
    $jwt = $token[1];
    if($jwt && $id){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        $this->menu_model->hapus_menu(array('id_menu'=>$id));
        $message['message'] = "Menu telah dihapus!";
        $message['status'] = TRUE;
        $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Menghapus menu','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
        $this->response($message,200);
      }catch(Exception $e){
        $message['message'] = "Access Denied!";
        $this->response($jwt,401);
      }
    }else{
      $message['message'] = $jwt;
      $this->response($message,401);
    }
  }

  function menu_put(){
    $jwt = $this->put('jwt');
    $id = $this->put('id_menu');
    if($jwt && $id){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        $kondisi['id_menu'] = $id;
        $data['nama_menu'] = strip_tags($this->put('nama_menu'));
        $data['harga'] = strip_tags($this->put('harga'));
        $data['tipe'] = strip_tags($this->put('tipe'));
        $data['status'] = strip_tags($this->put('status'));
        $this->menu_model->update_menu($kondisi,$data);
        $message['message'] = "Menu telah diupdate!";
        $message['status'] = TRUE;
        $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Mengupdate menu','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
        $this->response($message,200);
      }catch(Exception $e){
        $message['message'] = "Access Denied!";
        $this->response($message,401);
      }
    }else{
      $message['message'] = "sAccess Denied!";
      $this->response($message,401);
    }
  }
}