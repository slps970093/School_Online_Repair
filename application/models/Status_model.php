<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_model extends CI_Model {
  public function add(){
    $data = array(
      'id' => NULL,
      'StatusName' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $result = $this->db->insert('repair_status', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function get_data($limit=NULL){
    if(is_null($limit)){
      $result = $this->db->get('repair_status');
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $result = $this->db->get('repair_status', $limit,(int)($this->input->get('page')-1));
        }else{
          $result = $this->db->get('repair_status', $limit,0);
        }
        return $result->result_array();
      }
    }
  }
  public function get_target_data($id){
    $result = $this->db->get_where('repair_status',array('id' => $id));
    return $result->row_array();
  }
  public function update(){
    $data = array(
      'StatusName' => $this->input->post('name')
    );
    $data = $this->security->xss_clean($data);
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('repair_status', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function delete(){
    $result = $this->db->delete('repair_status', array('id'=>$this->input->post('id')));
    if($result){
      return true;
    }else{
      return false;
    }
  }
}
