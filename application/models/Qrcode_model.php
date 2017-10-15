<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qrcode_model extends CI_Model {
  public function add($repair_file,$search_file,$repair_filepath,$search_filepath){
    if(is_null($repair_file) && is_null($search_file)&& is_null($repair_filepath)&& is_null($search_filepath)){
      return false;
    }
    $data = $this->security->xss_clean(array(
      'id' => NULL,
      'location' => $this->input->post('location'),
      'device_name_id' => $this->input->post('name'),
      'device_category_id' => $this->input->post('category'),
      'title' => $this->input->post('title'),
      'repair_file' => $repair_file,
      'search_file' => $search_file,
      'repair_filepath' => $repair_filepath,
      'search_filepath' => $search_filepath,
      'content' => $this->input->post('content')
    ));
    $result = $this->db->insert('qrcode', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function sys_add($qrcode_data){
    if(!is_array($qrcode_data)){
      return false;
    }
    $data = $this->security->xss_clean(array(
      'id' => NULL,
      'location' => $qrcode_data['location'],
      'device_name_id' => $qrcode_data['device_name_id'],
      'device_category_id' => $qrcode_data['device_category_id'],
      'repair_file' => $qrcode_data['repair_qrcode'],
      'search_file' => $qrcode_data['search_qrcode'],
      'repair_filepath' => $qrcode_data['repair_qrcode_path'],
      'search_filepath' => $qrcode_data['search_qrcode_path'],
    ));
    $result = $this->db->insert('qrcode', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function update($repair_file,$search_file,$repair_filepath,$search_filepath){
    if(is_null($repair_file) && is_null($search_file)&& is_null($repair_filepath)&& is_null($search_filepath)){
      return false;
    }
    $this->db->where('id', $this->input->post('id'));
    $data = $this->security->xss_clean(array(
      'location' => $this->input->post('location'),
      'device_name_id' => $this->input->post('name'),
      'device_category_id' => $this->input->post('category'),
      'title' => $this->input->post('title'),
      'repair_file' => $repair_file,
      'search_file' => $search_file,
      'repair_filepath' => $repair_filepath,
      'search_filepath' => $search_filepath,
      'content' => $this->input->post('content')
    ));
    $result = $this->db->update('qrcode', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function get_target_data($id){
    $result = $this->db->get_where('qrcode', array('id' => $id));
    return $result->row_array();
  }
  public function create_doc($id = NULL){
    $this->db->select('qrcode.id,qrcode.location,qrcode.repair_file,
qrcode.search_file,qrcode.repair_filepath,qrcode.search_filepath,device_name.dn_name,device_category.dc_name');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    if(is_numeric($id) && !is_null($id)){
      $this->db->where('qrcode.id', $id);
      $result = $this->db->get();
      return $result->row_array();
    }
    $result = $this->db->get();
    return $result->result_array();
  }
  public function search($limit = NULL){
    $this->db->select('qrcode.id,qrcode.location,qrcode.repair_file,
qrcode.search_file,qrcode.repair_filepath,qrcode.search_filepath,device_name.dn_name,device_category.dc_name');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    $this->db->like('qrcode.location', $this->security->xss_clean($this->input->get('search')));
    if(is_null($limit)){
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $this->db->limit($perpage, $perpage*($this->input->get('page')-1));
          $result = $this->db->get();
        }else{
          $this->db->limit($perpage, 0);
          $result = $this->db->get();
        }
        return $result->result_array();
      }
    }
  }
  public function search_count(){
    $this->db->select('qrcode.id,qrcode.location,qrcode.repair_file,
qrcode.search_file,qrcode.repair_filepath,qrcode.search_filepath,device_name.dn_name,device_category.dc_name');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    $this->db->like('qrcode.location', $this->security->xss_clean($this->input->get('search')));
    $result = $this->db->get();
    return $result->num_rows();
  }
  public function get_data($perpage){
    $this->db->select('qrcode.id,qrcode.location,qrcode.repair_file,
qrcode.search_file,qrcode.repair_filepath,qrcode.search_filepath,device_name.dn_name,device_category.dc_name');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    if(is_null($perpage)){
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($perpage)){
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $this->db->limit($perpage, $perpage*($this->input->get('page')-1));
          $result = $this->db->get();
        }else{
          $this->db->limit($perpage, 0);
          $result = $this->db->get();
        }
        return $result->result_array();
      }
    }
  }
  public function ajax_get_where($id){
    $this->db->select('qrcode.id,device_category.dc_name,device_name.dn_name,qrcode.location');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    $this->db->where('qrcode.id', $id);
    $result = $this->db->get();
    return $result->row_array();
  }
  public function get_where($id = NULL){
    $this->db->select('qrcode.id,qrcode.repair_file,
qrcode.search_file,qrcode.repair_filepath,qrcode.search_filepath,device_name.dn_name,device_category.dc_name');
    $this->db->from('qrcode');
    $this->db->join('device_name', 'qrcode.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'qrcode.device_category_id = device_category.id', 'inner');
    $this->db->where('`qrcode`.`id`', (int) $id);
    $result = $this->db->get();
    return $result->row_array();
  }
  public function delete(){
    $result = $this->db->delete('qrcode', array('id' => $this->security->xss_clean($this->input->post('id'))));
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function truncate(){
    $result = $this->db->truncate('qrcode');
    if($result){
      return true;
    }
    return false;
  }
}
