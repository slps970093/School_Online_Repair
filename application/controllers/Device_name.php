<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Device_name extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function admin_index(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $urlPattern = site_url('admin/device/name').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('device_name')->num_rows();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['title'] = $data['webinfo']['website_title']."－裝置名稱管理";
    $data['result'] = $this->Device_name_Model->get_data($itemsPerPage);
    $this->load->view('device_name/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('device_name/admin_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置名稱新增";
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_name/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_name/add',$data);
    }else{
      $result = $this->Device_name_Model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/fault/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/fault/category')."?failed'</script>";
      }
    }
  }
  public function update($id=NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置名稱更新";
    $data['result'] = $this->Device_name_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_name/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_name/update',$data);
    }else{
      $result = $this->Device_name_Model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/fault/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/fault/category')."?failed'</script>";
      }
    }
  }
  public function delete($id=NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置名稱刪除";
    $data['result'] = $this->Device_name_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_name/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_name/delete',$data);
    }else{
      $result = $this->Device_name_Model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/fault/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/fault/category')."?failed'</script>";
      }
    }
  }
}
