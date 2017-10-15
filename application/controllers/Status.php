<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Status extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function admin_index(){
    $this->authhelper->isAdmin();
    //Bootstrap 3 theme setting
    $urlPattern = site_url('admin/device/repair/status').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('repair_status')->num_rows();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['title'] = $data['webinfo']['website_title']."－狀態管理界面";
    $data['result'] = $this->Status_model->get_data($itemsPerPage);
    $this->load->view('status/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('status/admin_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('name', 'nane', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－新增狀態";
      $this->load->view('status/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('status/add',$data);
    }else{
      $result = $this->Status_model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair/status')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗！'); window.location='".site_url('admin/device/repair/status')."?failed'</script>";
      }
    }
  }
  public function update($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('name', 'nane', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－修改狀態";
      $data['result'] = $this->Status_model->get_target_data($id);
      $this->load->view('status/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('status/update',$data);
    }else{
      $result = $this->Status_model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair/status')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗！'); window.location='".site_url('admin/device/repair/status')."?failed'</script>";
      }
    }
  }
  public function delete($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run() === FALSE){
      if($id == 1){
        echo "<script type='text/javascript'>alert('此資料受到系統保護！'); window.location='".site_url('admin/device/repair/status')."'</script>";
      }
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－刪除狀態";
      $data['result'] = $this->Status_model->get_target_data($id);
      $this->load->view('status/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('status/delete',$data);
    }else{
      $result = $this->Status_model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair/status')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗！'); window.location='".site_url('admin/device/repair/status')."?failed'</script>";
      }
    }
  }
}
