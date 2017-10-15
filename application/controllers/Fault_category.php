<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Fault_category extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function admin_index(){
    $this->authhelper->isAdmin();
    //分頁
    $urlPattern = site_url('admin/fault/category').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('fault_category')->num_rows();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['title'] = $data['webinfo']['website_title']."－故障分類管理";
    $data['result'] = $this->Fault_category_Model->get_data($itemsPerPage);
    $this->load->view('fault_category/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('fault_category/admin_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－故障分類新增";
    $data['extends_device_name'] = $this->Device_name_Model->get_data();
    $this->form_validation->set_rules('extends', 'extends', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('fault_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('fault_category/add');
    }else{
      $result = $this->Fault_category_Model->add();
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
    $data['title'] = $data['webinfo']['website_title']."－故障分類修改";
    $data['result'] = $this->Fault_category_Model->get_target_data($id);
    $data['extends_device_name'] = $this->Device_name_Model->get_data();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('extends', 'extends', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('fault_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('fault_category/update',$data);
    }else{
      $result = $this->Fault_category_Model->update();
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
    $data['title'] = $data['webinfo']['website_title']."－故障分類修改";
    $data['result'] = $this->Fault_category_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('fault_category/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('fault_category/delete',$data);
    }else{
      $result = $this->Fault_category_Model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/category')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/category')."?failed'</script>";
      }
    }
  }
  //Ajax 請求
  public function getOptionData($id = NULL){
    if(is_null($id)){
      show_404();
    }else{
      $result = $this->Fault_category_Model->ajax_get_target_data($id);
      $data;
      $tmp = 0;
      foreach ($result as $row) {
        $data[$tmp]['id'] = $row['id'];
        $data[$tmp]['name'] = $row['fc_name'];
        $tmp++;
      }
      echo json_encode($data);
    }
  }
}
