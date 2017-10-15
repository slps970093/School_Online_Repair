<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Property_information extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $this->authhelper->isAdmin();
    $totalItems = $this->db->get('property_information')->num_rows();
    $itemsPerPage  = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('admin/property/information')."?page=(:num)";
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－財產資料";
    $data['result'] = $this->Property_information_model->get_data($itemsPerPage);
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $this->load->view('property_info/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('property_info/admin_main',$data);
  }
  public function add(){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('property_number', 'property_number', 'required');
    $this->form_validation->set_rules('old_serial_number', 'old_serial_number', 'required');
    $this->form_validation->set_rules('device_category_id', 'device_category_id', 'required');
    $this->form_validation->set_rules('device_name_id', 'device_name_id', 'required');
    $this->form_validation->set_rules('model', 'model', 'required');
    $this->form_validation->set_rules('label', 'label', 'required');
    $this->form_validation->set_rules('qty', 'qty', 'required');
    $this->form_validation->set_rules('unit', 'unit', 'required');
    $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'required');
    $this->form_validation->set_rules('acceptance_date', 'acceptance_date', 'required');
    $this->form_validation->set_rules('warranty_date', 'warranty_date', 'required');
    $this->form_validation->set_rules('warranty_date_end', 'warranty_date_end', 'required');
    $this->form_validation->set_rules('years_of_use', 'years_of_use', 'required');
    $this->form_validation->set_rules('source_of_funding', 'source_of_funding', 'required');
    $this->form_validation->set_rules('custody_unit', 'custody_unit', 'required');
    $this->form_validation->set_rules('original_location', 'original_location', 'required');
    $this->form_validation->set_rules('now_location', 'now_location', 'required');
    $this->form_validation->set_rules('custodian', 'custodian', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－財產資料新增";
      $data['device_category_lst'] = $this->Device_category_Model->get_data();
      $data['device_name_lst'] = $this->Device_name_Model->get_data();
      $this->load->view('property_info/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('property_info/add',$data);
    }else{
      $result = $this->Property_information_model->add();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/property/information')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/property/information')."?failed'</script>";
      }
    }
  }
  public function sync(){
    $this->authhelper->isAdmin();
    if(!empty($this->input->get('section'))){
      $result = $this->Property_information_model->sys_qrcode_get_data();
      $isSuccess = false;
      foreach ($result as $row) {
        $qrcode_data = array(
          'repair_qrcode' => "repair-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
          'repair_qrcode_path' => FCPATH."/qrcode/repair-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
          'search_qrcode' => "search-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
          'search_qrcode_path' => FCPATH."/qrcode/search-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
          'device_name_id' => $this->security->xss_clean($row['device_name_id']),
          'location' => $this->security->xss_clean($row['now_location']),
          'device_category_id' => $this->security->xss_clean($row['device_category_id'])
        );
        $url = array(
          'repair' => site_url('device/qrcode/repair')."?location=".$this->security->xss_clean($row['now_location'])."&name=".$this->security->xss_clean($row['device_name_id'])."&category=".$this->security->xss_clean($row['device_category_id']),
          'search' => site_url('device/repair/showlst/search')."?location=".$this->security->xss_clean($row['now_location'])
        );
        // generate QR-CODE
        \PHPQRCode\QRcode::png($url['repair'], $qrcode_data['repair_qrcode_path'], 'L', 7, 6);
        \PHPQRCode\QRcode::png($url['search'], $qrcode_data['search_qrcode_path'], 'L', 7, 6);
        $result_qrcode = $this->Qrcode_model->sys_add($qrcode_data);
        if($result_qrcode){
          $isSuccess = true;
          $this->Property_information_model->isQrcode($row['id']);
        }else{
          $isSuccess = false;
          break;
        }
      }
      if($isSuccess){
        echo "<script type='text/javascript'>alert('success');location.href='".site_url('admin/property/information')."?success'</script>";
      }else{
        echo "<script type='text/javascript'>alert('failed');location.href='".site_url('admin/property/information')."?failed'</script>";
      }
    }else{
      // clean all qr-code table
      $result = $this->Qrcode_model->truncate();
      delete_files(FCPATH.'qrcode');
      if($result){
        $result = $this->Property_information_model->sys_qrcode_get_data();
        $isSuccess = false;
        foreach ($result as $row) {
          $qrcode_data = array(
            'repair_qrcode' => "repair-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
            'repair_qrcode_path' => FCPATH."/qrcode/repair-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
            'search_qrcode' => "search-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
            'search_qrcode_path' => FCPATH."/qrcode/search-".base64_encode($this->security->xss_clean($row['now_location']))."_".date('Y-m-d_H-i-s').".png",
            'device_name_id' => $this->security->xss_clean($row['device_name_id']),
            'location' => $this->security->xss_clean($row['now_location']),
            'device_category_id' => $this->security->xss_clean($row['device_category_id'])
          );
          $url = array(
            'repair' => site_url('device/qrcode/repair')."?location=".$this->security->xss_clean($row['now_location'])."&name=".$this->security->xss_clean($row['device_name_id'])."&category=".$this->security->xss_clean($row['device_category_id']),
            'search' => site_url('device/repair/showlst/search')."?location=".$this->security->xss_clean($row['now_location'])
          );
          // generate QR-CODE
          \PHPQRCode\QRcode::png($url['repair'], $qrcode_data['repair_qrcode_path'], 'L', 7, 6);
          \PHPQRCode\QRcode::png($url['search'], $qrcode_data['search_qrcode_path'], 'L', 7, 6);
          $result_qrcode = $this->Qrcode_model->sys_add($qrcode_data);
          if($result_qrcode){
            $isSuccess = true;
            $this->Property_information_model->isQrcode($row['id']);
          }else{
            $isSuccess = false;
            break;
          }
        }
        if($isSuccess){
          echo "<script type='text/javascript'>alert('success');location.href='".site_url('admin/property/information')."?success'</script>";
        }else{
          // clean all qr-code table
          $result = $this->Qrcode_model->truncate();
          echo "<script type='text/javascript'>alert('failed');location.href='".site_url('admin/property/information')."?failed'</script>";
        }
      }

    }
  }
  public function update($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('property_number', 'property_number', 'required');
    $this->form_validation->set_rules('old_serial_number', 'old_serial_number', 'required');
    $this->form_validation->set_rules('device_category_id', 'device_category_id', 'required');
    $this->form_validation->set_rules('device_name_id', 'device_name_id', 'required');
    $this->form_validation->set_rules('model', 'model', 'required');
    $this->form_validation->set_rules('label', 'label', 'required');
    $this->form_validation->set_rules('qty', 'qty', 'required');
    $this->form_validation->set_rules('unit', 'unit', 'required');
    $this->form_validation->set_rules('date_of_entry', 'date_of_entry', 'required');
    $this->form_validation->set_rules('acceptance_date', 'acceptance_date', 'required');
    $this->form_validation->set_rules('warranty_date', 'warranty_date', 'required');
    $this->form_validation->set_rules('warranty_date_end', 'warranty_date_end', 'required');
    $this->form_validation->set_rules('years_of_use', 'years_of_use', 'required');
    $this->form_validation->set_rules('source_of_funding', 'source_of_funding', 'required');
    $this->form_validation->set_rules('custody_unit', 'custody_unit', 'required');
    $this->form_validation->set_rules('original_location', 'original_location', 'required');
    $this->form_validation->set_rules('now_location', 'now_location', 'required');
    $this->form_validation->set_rules('custodian', 'custodian', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－財產資料新增";
      $data['device_category_lst'] = $this->Device_category_Model->get_data();
      $data['device_name_lst'] = $this->Device_name_Model->get_data();
      $data['result'] = $this->Property_information_model->get_where($id);
      $this->load->view('property_info/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('property_info/update',$data);
    }else{
      $result = $this->Property_information_model->update();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/property/information')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/property/information')."?failed'</script>";
      }
    }
  }
  public function delete($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－刪除財產資料";
      $data['result'] = $this->Property_information_model->get_where($id);
      $this->load->view('property_info/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('property_info/delete',$data);
    }else{
      $result = $this->Property_information_model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/property/information')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/property/information')."?failed'</script>";
      }
    }
  }
  public function search(){
    $this->authhelper->isAdmin();
    $totalItems = $this->Property_information_model->search_count();
    $itemsPerPage  = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('admin/property/information/search')."?page=(:num)&device_category_id=".(int)$this->security->xss_clean($this->input->get('device_category_id'))."&device_name_id=".(int)$this->security->xss_clean($this->input->get('device_name_id'))."&location=".$this->security->xss_clean($this->input->get('location'));
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－財產資料";
    $data['result'] = $this->Property_information_model->search($itemsPerPage);
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $this->load->view('property_info/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('property_info/admin_main',$data);
  }
  public function view($id = NULL){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－財產資料";
    $data['result'] = $this->Property_information_model->get_where($id);
    $this->load->view('property_info/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('property_info/view',$data);
  }
  public function nowlocation_update($id = NULL){
    $this->authhelper->isLogin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－更新目前位置財產資料";
    $data['result'] = $this->Property_information_model->get_where($id);
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    if($this->form_validation->run()===FALSE){
      $this->load->view('property_info/location_fastupdate',$data);
    }else{
      $result = $this->Property_information_model->nowlocation_update();
      if($result){
        echo "<script type='text/javascript' src='".base_url('js/property_info/submit.js')."'></script>";
      }
    }
  }
  public function inspector_admin(){
    $this->authhelper->isInspector();
    $data_range = $this->Data_management_model->get_data($this->authhelper->get_user_id());
    $totalItems = $this->Property_information_model->inspector_get_count($data_range);
    $itemsPerPage  = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('inspector/property/information')."?page=(:num)";
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－財產資料";
    $data['result'] = $this->Property_information_model->inspector_get_data($itemsPerPage,$data_range);
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $this->load->view('property_info/head',$data);
    $this->load->view('nav/inspector_nav');
    $this->load->view('property_info/inspector_main',$data);
  }
  public function inspector_search(){
    $this->authhelper->isInspector();
    $data_range = $this->Data_management_model->get_data($this->authhelper->get_user_id());
    $totalItems = $this->Property_information_model->search_count($data_range);
    $itemsPerPage  = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('inspector/property/information/search')."?page=(:num)&device_category_id=".(int)$this->security->xss_clean($this->input->get('device_category_id'))."&device_name_id=".(int)$this->security->xss_clean($this->input->get('device_name_id'))."&location=".$this->security->xss_clean($this->input->get('location'));
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－財產資料";
    $data['result'] = $this->Property_information_model->search($itemsPerPage,$data_range);
    $data['device_category_lst'] = $this->Device_category_Model->get_data();
    $data['device_name_lst'] = $this->Device_name_Model->get_data();
    $this->load->view('property_info/head',$data);
    $this->load->view('nav/inspector_nav');
    $this->load->view('property_info/inspector_main',$data);
  }
}
