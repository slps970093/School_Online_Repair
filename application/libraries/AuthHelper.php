<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class AuthHelper{
    //如果遇到管理者權限用戶
    public function isAdmin(){

      if(empty($_SESSION['username'])){
        $url = site_url('admin/auth/login');
        header("Location:$url");
      }
      if(empty($_SESSION['uid'])){
        $url = site_url('admin/auth/login');
        header("Location:$url");
      }else{
        if($_SESSION['competence'] != "admin"){
          $url = site_url('inspector');
          header("Location:$url");
        }
      }
    }
    //如果遇到檢修員權限用戶
    public function isInspector(){
      if(empty($_SESSION['username'])){
        $url = site_url('admin/auth/login');
        header("Location:$url");
      }
      if(empty($_SESSION['uid'])){
        $url = site_url('admin/auth/login');
        header("Location:$url");
      }else{
        if($_SESSION['competence'] != "inspector"){
          $url = site_url('admin');
          header("Location:$url");
        }
      }
    }
    //檢查登入狀態
    public function checkLogin(){
      if(!empty($_SESSION['username'])){
        if(!empty($_SESSION['competence']) && $_SESSION['competence'] == 'admin'){
          $url = site_url('admin');
          header("Location:$url");
        }else{
          $url = site_url('inspector');
          header("Location:$url");
        }
      }
    }
    public function show_login_name(){
      if(!empty($_SESSION['name'])){
          echo $_SESSION['name'];
      }
    }
    //是否登入
    public function isLogin(){
      if(empty($_SESSION['username'])){
        $url = site_url('admin/Auth/login');
        header("Location:$url");
      }
    }
    public function get_user_id(){
      return (int) $_SESSION['uid'];
    }
    // 登入狀態
    public function login_status(){
      if(!empty($_SESSION['uid']) && !empty($_SESSION['competence'])){
        return true;
      }
      return false;
    }
  }
