<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Year_interval extends CI_Controller {
  public function __construct(){
    parent::__construct();
  }
  public function add(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－學年度資料新增";
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('isEnable', 'isEnable', 'required');
    $this->form_validation->set_rules('start_date', 'start_date', 'required');
    $this->form_validation->set_rules('end_date', 'end_date', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('year_interval/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('year_interval/add');
    }else{
      $result = $this->Year_interval_Model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/year/interval')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/year/interval')."?failed'</script>";
      }
    }
  }
  public function admin_cp(){
    $this->authhelper->isAdmin();
    //分頁
    $urlPattern = site_url('admin/year/interval').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('year_interval')->num_rows();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－學年度資料管理";
    $data['result'] = $this->Year_interval_Model->get_data($itemsPerPage);
    $this->load->view('year_interval/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('year_interval/admin_cp',$data);
  }
  public function setDefault($id = NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－學年度預設值修改";
    $data['result'] = $this->Year_interval_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('isEnable', 'isEnable', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('year_interval/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('year_interval/isEnable',$data);
    }else{
      $result = $this->Year_interval_Model->setDefault();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/year/interval')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/year/interval')."?failed'</script>";
      }
    }
  }
  public function update($id = NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－學年度資料修改";
    $data['result'] = $this->Year_interval_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('isEnable', 'isEnable', 'required');
    $this->form_validation->set_rules('start_date', 'start_date', 'required');
    $this->form_validation->set_rules('end_date', 'end_date', 'required');
    if($this->form_validation->run() === FALSE){
      $this->load->view('year_interval/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('year_interval/update',$data);
    }else{
      $result = $this->Year_interval_Model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/year/interval')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/year/interval')."?failed'</script>";
      }
    }
  }
  public function delete($id = NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－學年度資料修改";
    $data['result'] = $this->Year_interval_Model->get_target_data($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $data['title'] = "刪除學年資料";
      $this->load->view('year_interval/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('year_interval/delete',$data);
    }else{
      $result = $this->Year_interval_Model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/year/interval')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/year/interval')."?failed'</script>";
      }
    }
  }
}
