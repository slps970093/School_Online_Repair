<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class fault_category_Model extends CI_Model {
  public function get_data($limit = NULL){
    if(is_null($limit)){
      $this->db->select('fault_category.id,fault_category.fc_name,device_name.dn_name');
      $this->db->from('fault_category');
      $this->db->join('device_name', 'device_name.id = fault_category.extends', 'inner');
      $result = $this->db->get();
      return $result->result_array();
    }else{
      $this->db->select('fault_category.id,fault_category.fc_name,device_name.dn_name');
      $this->db->from('fault_category');
      $this->db->join('device_name', 'device_name.id = fault_category.extends', 'inner');
      if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
        $this->db->limit($limit, (int)($this->security->xss_clean($this->input->get('page'))-1));
      }else{
        $this->db->limit($limit, 0);
      }
      $result = $this->db->get();
      return $result->result_array();
    }
  }
  public function ajax_get_target_data($id){
    $this->db->select('fault_category.id,fault_category.fc_name,device_name.dn_name');
    $this->db->from('fault_category');
    $this->db->join('device_name', 'device_name.id = fault_category.extends', 'inner');
    $this->db->where('fault_category.extends', $id);
    $result = $this->db->get();
    return $result->result_array();
  }
  public function add(){
    $data = array(
      'id' => NULL,
      'extends' => $this->input->post('extends'),
      'fc_name' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $result = $this->db->insert('fault_category', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function get_fastrepair_target_data($id){
    $result = $this->db->get_where('fault_category',array('extends' => $id));
    return $result->result_array();
  }
  public function get_target_data($id){
    $result = $this->db->get_where('fault_category',array('id' => $id));
    return $result->row_array();
  }
  public function update(){
    $data = array(
      'extends' => $this->input->post('extends'),
      'fc_name' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('fault_category', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function delete(){
    $result = $this->db->delete('fault_category', array('id' => $this->input->post('id')));
    if($result){
      return true;
    }
    return false;
  }
}
