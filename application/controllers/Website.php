<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function index(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－設備分類管理";
    $this->form_validation->set_rules('title', 'title', 'required');
    $this->form_validation->set_rules('mobile', 'mobile', 'required');
    $this->form_validation->set_rules('website', 'website', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('website/head',$data);
      $this->load->view('nav/admin_nav',$data);
      $this->load->view('website/main',$data);
    }else{
      $result = $this->Website_model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/website')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/website')."?success';</script>";
      }
    }
  }
}
