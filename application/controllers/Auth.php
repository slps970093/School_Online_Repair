<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Auth extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Admin_model');
  }
  //管理者登入介面
  public function login(){
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->authhelper->checkLogin();
    $this->form_validation->set_rules('username', 'username', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."─登入介面";
      $this->load->view('auth/head',$data);
      $this->load->view('auth/login',$data);
    }else{
      $result = $this->Admin_model->Auth();
      $user_id = $result['uid'];
      $username = $result['uUsername'];
      $competence = $result['competence'];
      $name = $result['uName'];
      if(password_verify($this->input->post('password'),$result['uPassword'])){
        $this->session->uid = $user_id;
        $this->session->username = $username;
        $this->session->competence = $competence;
        $this->session->name = $name;
        if($this->session->competence == "inspector"){
          $url = site_url('inspector');
          header("Location:$url");
        }else{
          $url = site_url('admin');
          header("Location:$url");
        }
      }else{
        echo "<script type='text/javascript'>alert('你輸入的帳號或是密碼錯誤');window.history.go(-1);</script>";
      }
    }
  }
  public function index(){
    $this->authhelper->isAdmin();
    //分頁
    $urlPattern = site_url('admin/auth').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('admin')->num_rows();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['usr_data'] = $this->Admin_model->get_data($itemsPerPage);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－管理員用戶管理系統";
    $this->load->view('auth/head',$data);
    $this->load->view('nav/admin_nav',$data);
    $this->load->view('auth/main',$data);
  }
  public function competence($id = NULL){
    $this->authhelper->isAdmin();
    if($id == 1 || $this->input->post('id') == 1){
      $url = site_url('admin/auth');
      echo "<script type='text/javascript'>alert('操作已拒絕，請檢查你是否有足夠的權限進行此操作');window.location.href = '".$url."';</script>";
    }
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('competence', 'competence', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－權限修改";
      $data['target_data'] = $this->Admin_model->get_target_data($id);
      $this->load->view('auth/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('auth/competence',$data);
    }else{
      $result = $this->Admin_model->competence();
      if($result){
        $url = site_url('admin/auth');
        echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
      }else{
        $url = site_url('admin/auth');
        echo "<script type='text/javascript'>alert('操作失敗！');window.location.href = '".$url."';</script>";
      }
    }
  }
  public function add(){
    $this->authhelper->isAdmin();
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'username', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    if($this->form_validation->run()==FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."-管理者新增";
      $this->load->view('auth/head',$data);
      $this->load->view('nav/admin_nav',$data);
      $this->load->view('auth/add');
    }else{
      $this->Admin_model->add();
      $url = site_url('admin/auth');
      echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
    }
  }
  public function delete($id = NULL){
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->authhelper->isAdmin();
      $data['target_data'] = $this->Admin_model->get_target_data($id);
      $this->form_validation->set_rules('id', 'id', 'required');
        if($this->form_validation->run()===FALSE){
          //檢查 id 是否為系統預設保留編號
          if($id == 1){
            $url = site_url('admin/auth');
            echo "<script type='text/javascript'>alert('此用戶受到系統保護！');window.location.href = '".$url."';</script>";
          }
          if(!is_null($id) && is_numeric($id)){
            $data['webinfo'] = $this->Website_model->webinfo();
            $data['usr_data'] = $this->Admin_model->get_data();
            $data['title'] = $data['webinfo']['website_title']."-刪除管理者";
            $this->load->view('auth/head',$data);
            $this->load->view('nav/admin_nav',$data);
            $this->load->view('auth/delete',$data);
          }else{
            $url = site_url('admin/auth');
            echo "<script type='text/javascript'>window.location.href='".$url."';</script>";
          }
        }else{
          //防止 系統預設用戶 被刪除
          if($this->input->post('id') == 1){
            $url = site_url('admin/auth');
            echo "<script type='text/javascript'>alert('拒絕此操作！');window.location.href = '".$url."';</script>";
          }else{
            $this->Admin_model->delete();
            $url = site_url('admin/auth');
            echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
          }
        }
    }

  public function update_username($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('username', 'username', 'required');
    if($this->form_validation->run()===FALSE){
      if(!is_null($id)){
        $data['webinfo'] = $this->Website_model->webinfo();
        $data['title'] = $data['webinfo']['website_title']."-管理者更改帳戶";
        $data['target_data'] = $this->Admin_model->get_target_data($id);
        $this->load->view('auth/head',$data);
        $this->load->view('nav/admin_nav',$data);
        $this->load->view('auth/updateusr',$data);
      }
    }else{
      $result = $this->Admin_model->update_usr();
      if($result){
        $url = site_url('admin/auth');
        echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
      }
    }
  }
  public function inspector_data_policy(){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('device_category', 'device_category', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."-管理者更改帳戶";
      $data['result'] = $this->Data_management_model->get_data();
    }else{
      if($this->Admin_model->isInspector($this->input->post('uid'))){
        if($this->Data_management_model->get_total((int)$this->input->post('uid')) != 0){
          $result = $this->Data_management_model->clean_user($this->input->post('uid'));
          if($result){
            $result = $this->Data_management_model->add($this->input->post('uid'));
            if($result){
              echo "<script type='text/javascript'>alert('資料權限設定完成');history.go(-1);</script>";
            }else{
              echo "<script type='text/javascript'>alert('資料權限設定發生錯誤');history.go(-1);</script>";
            }
          }
        }else{
          $result = $this->Data_management_model->add($this->input->post('uid'));
          if($result){
            echo "<script type='text/javascript'>alert('資料權限設定完成');history.go(-1);</script>";
          }
        }
      }
    }
  }

  public function update_name($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."-管理者更改帳戶";
      $data['target_data'] = $this->Admin_model->get_target_data($id);
      $this->load->view('auth/head',$data);
      $this->load->view('nav/admin_nav',$data);
      $this->load->view('auth/updateName',$data);
    }else{
      $this->Admin_model->update_name();
      $url = site_url('admin/auth');
      echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
    }
  }
  public function update_password($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    if(empty($this->session->username)){
      $url = site_url('admin/Auth/login');
      header("Location:$url");
    }
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－管理者修改密碼";
      $data['target_data'] = $this->Admin_model->get_target_data($id);
      $this->load->view('auth/head',$data);
      $this->load->view('nav/admin_nav',$data);
      $this->load->view('auth/updatepwd',$data);
    }else{
      $this->Admin_model->update_pwd();
      $url = site_url('admin/auth');
      echo "<script type='text/javascript'>alert('操作已完成');window.location.href = '".$url."';</script>";
    }
  }
  //管理者登出介面
  public function logout(){
    $this->session->sess_destroy();
    $url = site_url('admin/auth/login');
    echo "<script type='text/javascript'>alert('你已經登出成功');window.location.href = '".$url."';</script>";
  }
}
