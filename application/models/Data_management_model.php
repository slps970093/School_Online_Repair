<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_management_model extends CI_Model {
  public function add($id = NULL){
    if(!is_null($id)){
      $data = $this->security->xss_clean(array(
        'id' => NULL,
        'user_id' => (int) $id,
        'device_category_id' => (int) $this->input->post('device_category')
      ));
      $result = $this->db->insert('data_management', $data);
      if($result){
        return true;
      }else{
        return false;
      }
    }
    return false;
  }
  public function get_num($id = NULL){
    if(!is_null($id) && is_numeric($id)){
      $result = $this->db->get_where('data_management', array('user_id' => $id));
      return $result->num_rows();
    }
    return false;
  }
  public function clean($id = NULL){
    if(!is_null($id) && is_numeric($id)){
      $result = $this->db->delete('data_management',array('user_id' => (int)$id));
      if($result){
        return true;
      }
      return false;
    }
    return false;
  }
  public function get_data($id = NULL){
    if(!is_null($id) && is_numeric($id)){
      $result = $this->db->get_where('data_management', array('user_id' => (int)$id));
      if($result){
        return $result->result_array();
      }
      return false;
    }
  }
  public function delete($id = NULL){
    if(!is_null($id) && is_numeric($id)){
      $result = $this->db->delete('data_management',array('id' => (int)$id));
      if($result){
        return true;
      }
      return false;
    }
    return false;
  }

}
