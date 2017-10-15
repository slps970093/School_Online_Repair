<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."-Welcome!!";
    $this->load->view('device_name/head',$data);
    $this->load->view('nav/admin_nav',$data);
  }
  public function inspector_index(){
    $this->authhelper->isInspector();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."-Welcome!!";
    $this->load->view('device_name/head',$data);
    $this->load->view('nav/inspector_nav',$data);
  }
}
