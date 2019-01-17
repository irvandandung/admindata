<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
 function __construct(){
     parent::__construct();		
     $this->load->model('m_login');

 }

 function index(){
     $this->load->view('login');
 }

 function register(){
    $this->load->view('register');
 }
 

 function aksi_login(){
     $username = $this->input->post('username');
     $password = $this->input->post('password');
     $where = array(
         'username' => $username,
         'password' => md5($password)
         );
     $cek = $this->m_login->cek_login("user",$where)->num_rows();
     if($cek > 0){

         $data_session = array(
             'nama' => $username,
             'status' => "login"
             );

         $this->session->set_userdata($data_session);

         redirect(base_url("index.php/admin/managebarang"));
     }else{  
         redirect('login');
     }
 }

 function logout(){
     $this->session->sess_destroy();
     redirect(base_url('index.php/login'));
 }

 function add_register(){
    $this->m_login->submit($data);
    redirect('login');
    }
}