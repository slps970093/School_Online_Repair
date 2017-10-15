<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Device_repair extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Website_model');
  }
  public function admin_index(){
    $this->authhelper->isAdmin();
    //分頁
    $urlPattern = site_url('admin/device/repair').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->db->get('device_repair')->num_rows();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['title'] = $data['webinfo']['website_title']."－裝置報修管理介面";
    $data['result'] = $this->Device_repair_Model->get_data($itemsPerPage);
    $data['year_result'] = $this->Year_interval_Model->get_data();
    $data['status_result'] = $this->Status_model->get_data();
    $this->load->view('repair/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('repair/admin_main',$data);
  }
  public function admin_search(){
    $this->authhelper->isAdmin();
    $urlPattern = site_url('admin/device/repair/search')."?location=".$this->security->xss_clean($this->input->get('location'))."&year_id=".$this->security->xss_clean($this->input->get('year_id'))."&status=".$this->security->xss_clean($this->input->get('status')).'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->Device_repair_Model->ad_advanced_search_countall();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置報修管理介面";
    $data['year_result'] = $this->Year_interval_Model->get_data();
    $data['status_result'] = $this->Status_model->get_data();
    $data['result'] = $this->Device_repair_Model->ad_advanced_search($itemsPerPage);
    $this->load->view('repair/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('repair/admin_main',$data);
  }
  public function inspector_search(){
    $this->authhelper->isInspector();
    $urlPattern = site_url('inspector/device/repair/search')."?location=".$this->security->xss_clean($this->input->get('location'))."&year_id=".$this->security->xss_clean($this->input->get('year_id'))."&status=".$this->security->xss_clean($this->input->get('status')).'&page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $data_range = $this->Data_management_model->get_data($this->authhelper->get_user_id());
    $totalItems  = $this->Device_repair_Model->inspector_advanced_search_countall($data_range);
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置報修管理介面";
    $data['status_result'] = $this->Status_model->get_data();
    $data['result'] = $this->Device_repair_Model->inspector_advanced_search($itemsPerPage,$data_range);
    $this->load->view('repair/head',$data);
    $this->load->view('nav/inspector_nav');
    $this->load->view('repair/inspector_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－線上報修";
    $data['year_lst'] = $this->Year_interval_Model->get_data();
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $data['fault_category_lst'] = $this->Fault_category_Model->get_data();
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('fault', 'fault', 'required');
    $this->form_validation->set_rules('remark', 'remark', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('repair/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('repair/add');
    }else{
      $result = $this->Device_repair_Model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/repair')."?failed'</script>";
      }
    }
  }
  public function guest_add(){
    $this->load->library('user_agent');
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title'];
    $data['default_year'] = $this->Year_interval_Model->getDefault();
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $data['fault_category_lst'] = $this->Fault_category_Model->get_data();
    $data['ajax_fault_category_url'] = site_url('ajax/fault/category/get/');
    $this->form_validation->set_rules('year_id', 'year_id', 'required');
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('fault', 'fault', 'required');
    //$this->form_validation->set_rules('remark', 'remark', 'required');
    if($this->form_validation->run()===FALSE){
      if ($this->agent->is_mobile()){
        /*
        $this->load->view('repair/m_head',$data);
        $this->load->view('nav/usr_nav');
        $this->load->view('repair/m_usr_add',$data);
        */
        $this->load->view('repair/mobile/repair',$data);
      }else{
        $this->load->view('repair/head',$data);
        $this->load->view('nav/usr_nav');
        $this->load->view('repair/usr_add',$data);
      }
    }else{
      $time = $this->Year_interval_Model->getDefault();
      if(strtotime($time['start_date']) <= strtotime(date('Y-m-d')) && strtotime($time['end_date']) >= strtotime(date('Y-m-d'))){
        $result = $this->Device_repair_Model->add();
        if($result){
          echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('device/repair')."?success';</script>";
        }else{
          echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('device/repair')."?failed'</script>";
        }
      }else{
        echo "<script type='text/javascript'>alert('已超過報修時間或未達開始登計時間！無法報修'); window.location='".site_url('device/repair')."?failed';</script>";
      }
    }
  }
  public function guest_fastrepair(){
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."QR-CODE通報系統";
    $data['default_year'] = $this->Year_interval_Model->getDefault();
    /*
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    */
    $data['fault_category_lst'] = $this->Fault_category_Model->get_fastrepair_target_data((int) $this->input->get('name'));
    $data['ajax_fault_category_url'] = site_url('ajax/fault/category/get/');
    $this->form_validation->set_rules('year_id', 'year_id', 'required');
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('fault', 'fault', 'required');
    //$this->form_validation->set_rules('remark', 'remark', 'required');
    if($this->form_validation->run()===FALSE){
        /*
        $this->load->view('repair/m_head',$data);
        $this->load->view('nav/usr_nav');
        $this->load->view('repair/m_usr_add',$data);
        */
        $this->load->view('repair/mobile/fast_repair',$data);

    }else{
      $result = $this->Device_repair_Model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('device/repair')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('device/repair')."?failed'</script>";
      }
    }
  }
  public function view($id){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']."－檢視資料";
    $data['result'] = $this->Device_repair_Model->get_target_join_data($id);
    $this->load->view('repair/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('repair/view',$data);
  }
  public function update($id=NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－線上報修資料修改";
    $data['year_lst'] = $this->Year_interval_Model->get_data();
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $data['fault_category_lst'] = $this->Fault_category_Model->get_data();
    $data['result'] = $this->Device_repair_Model->get_target_data($id);
    $data['repair_status_lst'] = $this->Status_model->get_data();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('year_id', 'year_id', 'required');
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('fault', 'fault', 'required');
    $this->form_validation->set_rules('remark', 'remark', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('repair/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('repair/update',$data);
    }else{
      $result = $this->Device_repair_Model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/repair')."?failed'</script>";
      }
    }
  }
  public function inspector_admincp(){
    $this->authhelper->isInspector();
    //分頁
    $urlPattern = site_url('inspector/device/repair').'?page=(:num)';
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->Device_repair_Model->inspector_get_data_countall();
    $data_range = $this->Data_management_model->get_data($this->authhelper->get_user_id());
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－裝置報修管理介面";
    $data['result'] = $this->Device_repair_Model->inspector_get_data($itemsPerPage,$data_range);
    $this->load->view('repair/head',$data);
    $this->load->view('nav/inspector_nav');
    $this->load->view('repair/inspector_main',$data);
  }
  public function inspector_view($id=NULL){
    $this->authhelper->isInspector();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－檢視資料";
    $data['result'] = $this->Device_repair_Model->get_target_join_data($id);
    $this->load->view('repair/head',$data);
    $this->load->view('nav/inspector_nav');
    $this->load->view('repair/view',$data);
  }
  public function inspector_update($id = NULL){
    $this->authhelper->isInspector();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."更新報修資料";
    $data['row'] = $this->Device_repair_Model->get_target_join_data($id);
    $data['result'] = $this->Device_repair_Model->get_target_data($id);
    $data['repair_status_lst'] = $this->Status_model->get_data();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('status', 'status', 'required');
    $this->form_validation->set_rules('description', 'description', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('repair/head',$data);
      $this->load->view('nav/inspector_nav');
      $this->load->view('repair/inspector_update',$data);
    }else{
      $result = $this->Device_repair_Model->inspector_update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('inspector/device/repair')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('inspector/device/repair')."?failed'</script>";
      }
    }
  }
  public function delete($id=NULL){
    if(empty($this->session->username)){
      $url = site_url('admin');
      header("Location:$url");
    }
    if($this->session->competence != "admin"){
      $url = site_url('admin');
      header("Location:$url");
    }
    $this->form_validation->set_rules('id', 'id', 'required');
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－線上報修";
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $data['fault_category_lst'] = $this->Fault_category_Model->get_data();
    $data['result'] = $this->Device_repair_Model->get_target_join_data($id);
    if($this->form_validation->run()===FALSE){
      $this->load->view('repair/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('repair/delete',$data);
    }else{
      $result = $this->Device_repair_Model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/device/repair')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/device/repair')."?failed'</script>";
      }
    }
  }
  public function show_repair_status(){
    $this->load->library('user_agent');
    $itemsPerPage = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('device/repair/showlst').'?page=(:num)';
    $totalItems  = $this->Device_repair_Model->usr_get_data_countall();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title'];
    $data['status_result'] = $this->Status_model->get_data();
    $default_year = $this->Year_interval_Model->getDefault();
    $data['result'] = $this->Device_repair_Model->usr_get_data($default_year['id'],$itemsPerPage);
    if ($this->agent->is_mobile()){
      $this->load->view('repair/mobile/showusrrepair',$data);
    }else{
      $this->load->view('repair/head',$data);
      $this->load->view('nav/usr_nav');
      $this->load->view('repair/showusrrepair',$data);
    }
  }
  public function search_repair_status(){
    $this->load->library('user_agent');
    //分頁
    $urlPattern = site_url('device/repair/showlst/search').'?page=(:num)&location='.$this->security->xss_clean($this->input->get('location')).'&status='.$this->security->xss_clean($this->input->get('status'));
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $itemsPerPage = 6;
    $totalItems  = $this->Device_repair_Model->usr_advanced_search_countall();
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title'];
    $data['status_result'] = $this->Status_model->get_data();
    $data['result'] = $this->Device_repair_Model->usr_advanced_search($itemsPerPage);
    if ($this->agent->is_mobile()){
      $this->load->view('repair/mobile/showusrrepair',$data);
    }else{
      $this->load->view('repair/head',$data);
      $this->load->view('nav/usr_nav');
      $this->load->view('repair/showusrrepair',$data);
    }
  }
}
