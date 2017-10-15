<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_management extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function index($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('uid', 'uid', 'required');
    $this->form_validation->set_rules('device_category', 'device_category', 'required');
    if($this->form_validation->run() === FALSE){
      if(is_numeric($id)){
        $check_usr = $this->Admin_model->isInspector((int) $id);
        if($check_usr){
          $data['uid'] = (int) $id;
          $data['data_management'] = $this->Data_management_model->get_data((int) $id);
          $data['device_category_data'] = $this->Device_category_Model->get_data();
          $data['webinfo'] = $this->Website_model->webinfo();
          $data['title'] = $data['webinfo']['website_title']."－設備分類新增";
          $this->load->view('auth/data_management',$data);
        }else{
          echo validation_errors();
          echo "<script type='text/javascript'>";
          echo "var msg = '".validation_errors()."';";
          echo "if(msg != null){";
          echo "alert('System Message:'+msg);";
          echo "}";
          echo "window.close();";
          echo "</script>";
        }
      }else{
        echo validation_errors();
        echo "<script type='text/javascript'>";
        echo "var msg = '".validation_errors()."';";
        echo "if(msg !== null){";
        echo "alert('System Message:'+msg);";
        echo "}";
        echo "window.close();";
        echo "</script>";
      }
    }else{
      // 確認身份
      $check_usr = $this->Admin_model->isInspector((int) $this->input->post('uid'));
      if($check_usr){
        $num = $this->Data_management_model->get_num((int) $this->input->post('uid'));
        if(is_numeric($num)){
            //定義檢修員權限
            if($num == 1){
              $result = $this->Data_management_model->add((int) $this->input->post('uid'));
            }else{
              $this->Data_management_model->clean((int) $this->input->post('uid'));
              $result = $this->Data_management_model->add((int) $this->input->post('uid'));
            }
            if($result){
              echo "<script type='text/javascript'>";
              echo "alert('檢修員資料管理權設定完成');";
              echo "window.close();";
              echo "</script>";
            }else{
              echo "<script type='text/javascript'>";
              echo "alert('檢修員資料管理權設定失敗');";
              echo "window.close();";
              echo "</script>";
            }
        }
      }else{
        echo "<script type='text/javascript'>";
        echo "alert('非正確使用者權限，操作終止！');";
        echo "window.close();";
        echo "</script>";
      }
    }
  }

}
