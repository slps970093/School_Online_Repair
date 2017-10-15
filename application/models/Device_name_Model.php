<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_name_Model extends CI_Model {
  public function get_data($limit = NULL){
    if(is_null($limit)){
      $result = $this->db->get('device_name');
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $result = $this->db->get('device_name', $limit,(int) ($this->input->get('page')-1));
        }else{
          $result = $this->db->get('device_name', $limit, 0);
        }
        return $result->result_array();
      }
    }
  }
  public function get_target_data($id){
    $result = $this->db->get_where('device_name',array('id' => $id));
    return $result->row_array();
  }
  public function add(){
    $data = array(
      'id' => NULL,
      'dn_name' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $result = $this->db->insert('device_name', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function update(){
    $data = array(
      'dn_name' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('device_name', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function delete(){
    $result = $this->db->delete('device_name', array('id' => $this->input->post('id')));
    if($result){
      return true;
    }
    return false;
  }
}
