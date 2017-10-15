<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Year_interval_Model extends CI_Model {

  public function add(){
    //如果要設定預設資料
    if($this->input->post('isEnable') == 1){
      $result = $this->db->get_where('year_interval', array('isEnable' => 1));
      $before_data = $result->result_array();
      foreach ($before_data as $row) {
        //則取消已經設定的資料
        $this->db->where('id', $row['id']);
        $this->db->update('year_interval', array('isEnable' => 0));
      }
    }
   $data = $this->security->xss_clean(array(
     'id' => NULL,
     'yi_name' => $this->input->post('name'),
     'isEnable' => $this->input->post('isEnable'),
     'start_date' => $this->input->post('start_date'),
     'end_date' => $this->input->post('end_date')
   ));
   $result = $this->db->insert('year_interval', $data);
   if($result){
     return true;
   }else{
     return false;
   }
  }
  public function getDefault(){
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    return $result->row_array();
  }
  public function setDefault(){
    //如果要設定預設資料
    if($this->input->post('isEnable') == 1){
      $result = $this->db->get_where('year_interval', array('isEnable' => 1));
      $before_data = $result->result_array();
      foreach ($before_data as $row) {
        //則取消已經設定的資料
        $this->db->where('id', $row['id']);
        $this->db->update('year_interval', array('isEnable' => 0));
      }
    }
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('year_interval', array('isEnable' => $this->input->post('isEnable')));
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function get_data($limit=NULL){
    if(is_null($limit)){
      $result = $this->db->get('year_interval');
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $result = $this->db->get('year_interval', $limit,(int)($this->input->get('page')-1));
        }else{
          $result = $this->db->get('year_interval', $limit,0);
        }
        return $result->result_array();
      }
    }
  }
  public function get_target_data($id = NULL){
    if(is_null($id)){
      return false;
    }
    $result = $this->db->get_where('year_interval', array('id' => $id));
    if($result){
      return $result->row_array();
    }else{
      return false;
    }
  }
  public function update(){
    //如果要設定預設資料
    if($this->input->post('isEnable') == 1){
      $result = $this->db->get_where('year_interval', array('isEnable' => 1));
      $before_data = $result->result_array();
      foreach ($before_data as $row) {
        //則取消已經設定的資料
        $this->db->where('id', $row['id']);
        $this->db->update('year_interval', array('isEnable' => 0));
      }
    }
    $data = $this->security->xss_clean(array(
      'yi_name' => $this->input->post('name'),
      'isEnable' => $this->input->post('isEnable'),
      'start_date' => $this->input->post('start_date'),
      'end_date' => $this->input->post('end_date')
    ));
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('year_interval', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function delete(){
    $result = $this->db->delete('year_interval', array('id' => $this->input->post('id')));
    if($result){
      return true;
    }else{
      return false;
    }
  }
}
