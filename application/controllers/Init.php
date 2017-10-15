<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Init extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function index(){
    $count = (int) $this->Website_model->countall();
    if($count == 0){
      $this->form_validation->set_rules('title', 'title', 'required');
      $this->form_validation->set_rules('username', 'username', 'required');
      $this->form_validation->set_rules('password', 'password', 'required');
      if($this->form_validation->run()===FALSE){
        $this->load->view('init/init_website');
      }else{
        $result = $this->Website_model->init();
        if($result){
          $result = $this->Admin_model->init();
          if($result){
            echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url()."?settingsuccess';</script>";
          }else{
            $this->db->truncate('admin');
            $this->db->truncate('website');
            echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！（設定階段錯誤2）'); window.location='".site_url('init')."?failed'</script>";
          }
        }else{
          $this->db->truncate('website');
          echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！(設定階段錯誤1)'); window.location='".site_url('init')."?failed'</script>";
        }
      }
    }else{
      $url = site_url();
      header("Location:$url");
    }
  }
  public function reset(){
    $this->authhelper->isAdmin();
  }
}
