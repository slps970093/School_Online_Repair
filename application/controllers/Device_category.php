<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Device_category extends CI_Controller {
  public function admin_index(){
    $this->authhelper->isAdmin();
    //分頁
    $urlPattern = site_url('admin/device/category').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('device_category')->num_rows();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['title'] = $data['webinfo']['website_title']."－設備分類管理";
    $data['result'] = $this->Device_category_Model->get_data($itemsPerPage);
    $this->load->view('device_category/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('device_category/admin_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－設備分類新增";
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_category/add',$data);
    }else{
      $result = $this->Device_category_Model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/category')."?failed'</script>";
      }
    }
  }
  public function update($id=NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－設備分類修改";
    $data['result'] = $this->Device_category_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_category/update',$data);
    }else{
      $result = $this->Device_category_Model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/category')."?failed'</script>";
      }
    }

  }
  public function delete($id=NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－設備分類刪除";
    $data['result'] = $this->Device_category_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('device_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('device_category/delete',$data);
    }else{
      $result = $this->Device_category_Model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/category')."?failed'</script>";
      }
    }
  }
}
