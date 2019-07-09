<?php 
date_default_timezone_set('Asia/Jakarta');
use Restserver\Libraries\REST_Controller;
use Firebase\JWT\JWT;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Daftar_makanan extends MX_Controller{
  private $key='';
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
          if($decode){
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
          }else{
            $message['message'] = "Access Denied!";
            $this->response($message,401);
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
    $token = explode(" ", getallheaders()['authorization']);
    $jwt = $token[1];
    $tipe = $this->get('jenis');
    if($jwt){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          if(!is_null($tipe)) $this->db->where(array('tipe'=>$tipe,'status'=>'1'));
          if(!is_null($id)){
            $this->db->where('id_menu',$id);
            $menu = $this->menu_model->daftar_menu()->row();
          }else{
            $menu = $this->menu_model->daftar_menu()->result();
          }        
          $this->response($menu,200);
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function menu_delete($id=null){
    $token = explode(" ", getallheaders()['authorization']);
    $jwt = $token[1];
    if($jwt && $id){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
            $this->menu_model->hapus_menu(array('id_menu'=>$id));
            $message['message'] = "Menu telah dihapus!";
            $message['status'] = TRUE;
            $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Menghapus menu','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
            $this->response($message,200);
        }else{
          $message['message'] = "Access Denied!";
         $this->response($jwt,401);
        }
        
      }catch(Exception $e){
        $message['message'] = "Access Denied!";
        $this->response($jwt,401);
      }
    }else{
      $message['message'] = $jwt;
      $this->response($message,401);
    }
  }
//Tidak menggunakan put karena bermasalah dihosting
  function mmenu_post(){
    $jwt = $this->post('jwt');
    $id = $this->post('id_menu');
    if($jwt && $id){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          $kondisi['id_menu'] = $id;
          $data['nama_menu'] = strip_tags($this->post('nama_menu'));
          $data['harga'] = strip_tags($this->post('harga'));
          $data['tipe'] = strip_tags($this->post('tipe'));
          $data['status'] = strip_tags($this->post('status'));
          $this->menu_model->update_menu($kondisi,$data);
          $message['message'] = "Menu telah diupdate!";
          $message['status'] = TRUE;
          $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Mengupdate menu','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
          $this->response($message,200);
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function pesanan_post(){
    $jwt = $this->post('jwt');
    $no_meja = $this->post('nomor_meja');
    $total_harga = $this->post('harga');
    $makanan = ($this->post('makanan[]') ? $this->post('makanan[]') : array());
    $minuman = ($this->post('minuman[]') ? $this->post('minuman[]') : array());
    if($jwt){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          if($no_meja && $total_harga){
            $urutan = $this->menu_model->urutan_pesanan()->num_rows();
            if($urutan==0){
              $urutan=$urutan+1;
            }else{              
              $x = $this->menu_model->urutan_pesanan()->row();
              $z = explode('-',$x->nomor_pesanan);
              $urutan = $z[1]+1;
            }
            $data['nomor_pesanan'] = "ERP".date('dmY')."-".$urutan;
            $data['nomor_meja'] = $no_meja;
            $data['total_harga'] = $total_harga;
            $data['id_pelayan'] = $decode->data->id_user;
            $data['created_at'] = date('Y-m-d');
            $data['updated_at'] = date('Y-m-d');
            $status_psn = $this->menu_model->tampil_status_pesanan(array('nomor_meja'=>$no_meja));
            if($status_psn==0){
              if($this->menu_model->tambah_pesanan($data)){
                if(is_array($makanan)){
                  for($i=0;$i<sizeof($makanan);$i++){
                    $in_mkn['id_pesanan'] = $data['nomor_pesanan'];
                    $in_mkn['id_menu'] = $makanan[$i];
                    $this->menu_model->tambah_item_pesanan($in_mkn);
                  }
                }else{
                    $in_mkn['id_pesanan'] = $data['nomor_pesanan'];
                    $in_mkn['id_menu'] = $makanan;
                    $this->menu_model->tambah_item_pesanan($in_mkn);
                }
                if(is_array($minuman)){
                  for($i=0;$i<sizeof($minuman);$i++){
                    $in_min['id_pesanan'] = $data['nomor_pesanan'];
                    $in_min['id_menu'] = $minuman[$i];
                    $this->menu_model->tambah_item_pesanan($in_min);
                  }
                }else{
                    $in_min['id_pesanan'] = $data['nomor_pesanan'];
                    $in_min['id_menu'] = $minuman;
                    $this->menu_model->tambah_item_pesanan($in_min);
                }                
                
                $message['message'] = "Berhasil menambah pesanan";
                $message['status'] = TRUE;
                $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'membuat pesanan baru','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                $this->response($message,200);
              }else{
                $message['message'] = "Gagal!";
                $this->response($message,500);
              }
            }else{
                $message['message'] = "Tidak bisa menambah pesanan baru. Pesanan masih aktif!";
                $this->response($message,500);
            }
            
          }else{
            $message['message'] = "Isi data!";
            $this->response($message,500);
          }
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function ppesanan_post(){
    $jwt = $this->post('jwt');
    $total_harga = $this->post('harga');
    $makanan = ($this->post('makanan[]') ? $this->post('makanan[]') : array());
    $minuman = ($this->post('minuman[]') ? $this->post('minuman[]') : array());
    $no_pesanan = $this->post('id_pesanan');
    if($jwt && $no_pesanan){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          if($total_harga){
            $data['total_harga'] = $total_harga;
            $data['id_pelayan'] = $decode->data->id_user;
            $data['updated_at'] = date('Y-m-d');
            $this->menu_model->update_pesanan($no_pesanan,$data);
                $nomor_pesanan['id_pesanan'] = $no_pesanan;
                $id_menu = array();
                if(is_array($makanan)){
                  for($i=0;$i<sizeof($makanan);$i++){
                    $id_menu[]=$makanan[$i];
                  }
                }else{
                     $id_menu[]=$makanan;
                }
                if(is_array($minuman)){
                  for($i=0;$i<sizeof($minuman);$i++){
                    $id_menu[]=$minuman[$i];
                  }
                }else{
                    $id_menu[]=$minuman;
                }                
                $this->menu_model->hapus_item_pesanan($nomor_pesanan,$id_menu);                
                for($i=0;$i<sizeof($id_menu);$i++){
                  $check = $this->menu_model->check_item_pesanan($nomor_pesanan,array('id_menu'=>$id_menu[$i]));
                  if($check==0){
                    $in_mkn['id_pesanan'] = $nomor_pesanan['id_pesanan'];
                    $in_mkn['id_menu'] = $id_menu[$i];
                    $this->menu_model->tambah_item_pesanan($in_mkn);
                  }
                }
                $message['message'] = "Berhasil mengubah pesanan";
                $message['status'] = TRUE;
                $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'mengubah pesanan','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
                $this->response($message,200);
          }else{
            $message['message'] = "Isi data!";
            $this->response($message,500);
          }
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function pesanan_get(){
    $token = explode(" ", getallheaders()['authorization']);
    $jwt = $token[1];
    $id = $this->get('id_pesanan');
    $jenis = $this->get('jenis');
    if($jwt){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          if(!is_null($id)){
            if($this->menu_model->tampil_pesanan_aktif($id,$jenis)->num_rows()>0){
               $message['data'] = $this->menu_model->tampil_pesanan_aktif($id)->result();
               $message['status'] = TRUE;
                $this->response($message,200);
            }else{
              $message['message'] = "No Data!";
              $this->response($message,500);
            }
          }else{
            if($this->menu_model->tampil_pesanan_aktif()->num_rows()>0){
              $message['data'] = $this->menu_model->tampil_pesanan_aktif()->result();
              $message['status'] = TRUE;
              $this->response($message,200);
            }else{
              $message['message'] = "No Data!";
              $this->response($message,500);
            }
          }
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function tutup_post(){
    $jwt = $this->post('jwt');
    $id = $this->post('id_pesanan');
    if($jwt && $id){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
         if($decode->data->role==='kasir'){
            $this->db->where('nomor_pesanan',$id);
            $this->db->update('pesanan',array('status'=>'0'));
            $this->db->reset_query();
            $this->db->insert('logs',array('user_id'=>$decode->data->id_user,'log'=>'Menutup Pesanan','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')));
            $message['status'] = TRUE;
            $message['message'] = "berhasil menutup pesanan";
            $this->response($message,200);
         }else{
            $message['message'] = "Access Denied!";
            $this->response($message,401);
         }
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

  function riwayat_get(){
    $token = explode(" ", getallheaders()['authorization']);
    $jwt = $token[1];
    if($jwt){
      try{
        $decode = JWT::decode($jwt,$this->key,array('HS256'));
        if($decode){
          $message = $this->db->get_where('logs',array('user_id'=>$decode->data->id_user))->result();
          $this->response($message,200);
        }else{
          $message['message'] = "Access Denied!";
          $this->response($message,401);
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

}