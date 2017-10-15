<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_information_model extends CI_Model {
  public function add(){
    $data = $this->security->xss_clean(array(
      'id' => NULL,
      'property_number' => $this->input->post('property_number'),
      'old_serial_number' => $this->input->post('old_serial_number'),
      'device_category_id' =>$this->input->post('device_category_id'),
      'device_name_id' => $this->input->post('device_name_id'),
      'specification' => $this->input->post('specification'),
      'model' => $this->input->post('model'),
      'label' => $this->input->post('label'),
      'qty' => $this->input->post('qty'),
      'unit' => $this->input->post('unit'),
      'date_of_entry' => $this->input->post('date_of_entry'),
      'acceptance_date' => $this->input->post('acceptance_date'),
      'warranty_date' => $this->input->post('warranty_date'),
      'warranty_date_end' => $this->input->post('warranty_date_end'),
      'years_of_use' =>$this->input->post('years_of_use'),
      'source_of_funding' => $this->input->post('source_of_funding'),
      'custody_unit' => $this->input->post('custody_unit'),
      'original_location' => $this->input->post('original_location'),
      'now_location' => $this->input->post('now_location'),
      'custodian' => $this->input->post('custodian'),
      'isQrcode' => 0
    ));
    $result = $this->db->insert('property_information', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function get_data($perpage){
    $this->db->select('property_information.id,property_information.property_number,property_information.old_serial_number,
property_information.specification,property_information.model,property_information.label,property_information.qty,
property_information.unit,property_information.date_of_entry,property_information.acceptance_date,
property_information.warranty_date,property_information.warranty_date_end,property_information.years_of_use,
property_information.source_of_funding,property_information.custody_unit,property_information.original_location,
property_information.now_location,property_information.custodian,property_information.isQrcode,device_category.dc_name,
device_name.dn_name');
    $this->db->from('property_information');
    $this->db->join('device_name', 'property_information.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'property_information.device_category_id = device_category.id', 'inner');
    if(is_null($perpage)){
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($perpage)){
        if(is_null($this->input->get('page'))){
            $this->db->limit($perpage, 0);
        }else{
          if(is_numeric($this->input->get('page'))){
            if((int) $this->security->xss_clean($this->input->get('page')) >=2){
              $this->db->limit($perpage,$perpage*($this->input->get('page')-1));//11
            }else{
              $this->db->limit($perpage, 0);
            }
          }
        }
        $result = $this->db->get();
        return $result->result_array();
      }
    }
  }
  public function inspector_get_count($range = NULL){
    $this->db->select('*');
    $this->db->from('property_information');
    if(is_array($range)){
      foreach ($range as $row) {
        $this->db->where('device_category_id', $row['device_category_id']);
      }
    }
    return (int) $this->db->get()->num_rows();

  }
  public function inspector_get_data($perpage,$range=NULL){
    $this->db->select('property_information.id,property_information.property_number,property_information.old_serial_number,
property_information.specification,property_information.model,property_information.label,property_information.qty,
property_information.unit,property_information.date_of_entry,property_information.acceptance_date,
property_information.warranty_date,property_information.warranty_date_end,property_information.years_of_use,
property_information.source_of_funding,property_information.custody_unit,property_information.original_location,
property_information.now_location,property_information.custodian,property_information.isQrcode,device_category.dc_name,
device_name.dn_name');
    $this->db->from('property_information');
    $this->db->join('device_name', 'property_information.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'property_information.device_category_id = device_category.id', 'inner');
    if(is_null($perpage)){
      //資料範圍
      if(is_array($range)){
        foreach ($range as $row) {
          $this->db->where('property_information.device_name_id', $row['device_category_id']);
        }
      }
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($perpage)){
        //資料範圍
        if(is_array($range)){
          foreach ($range as $row) {
            $this->db->where('property_information.device_category_id', $row['device_category_id']);
          }
        }
        if(is_null($this->input->get('page'))){
            $this->db->limit($perpage, 0);
        }else{
          if(is_numeric($this->input->get('page'))){
            if((int) $this->security->xss_clean($this->input->get('page')) >=2){
              $this->db->limit($perpage,$perpage*($this->input->get('page')-1));//11
            }else{
              $this->db->limit($perpage, 0);
            }
          }
        }
        $result = $this->db->get();
        return $result->result_array();
      }
    }
  }
  public function get_where($id){
    $this->db->select('property_information.id,property_information.property_number,property_information.old_serial_number,
property_information.specification,property_information.model,property_information.label,property_information.qty,
property_information.unit,property_information.date_of_entry,property_information.acceptance_date,property_information.warranty_date,
property_information.warranty_date_end,property_information.years_of_use,property_information.source_of_funding,
property_information.custody_unit,property_information.original_location,property_information.now_location,
property_information.custodian,property_information.isQrcode,device_category.dc_name,
device_name.dn_name');
    $this->db->from('property_information');
    $this->db->join('device_name', 'property_information.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'property_information.device_category_id = device_category.id', 'inner');
    $this->db->where('property_information.id', (int) $id);
    $result = $this->db->get();
    return $result->row_array();
  }
  public function sys_qrcode_get_data(){
    if(!empty($this->input->get('section'))){
      $result = $this->db->get_where('property_information', array('isQrcode' => 0));
      return $result->result_array();
    }
    $result = $this->db->get('property_information');
    echo $this->db->last_query();
    return $result->result_array();
  }
  public function isQrcode($id){
    $this->db->where('id', (int) $id);
    $this->db->set('isQrcode', '1');
    $result = $this->db->update('property_information');
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function search($perpage = NULL,$range = NULL){
    $this->db->select('property_information.id,property_information.property_number,property_information.specification,
property_information.model,property_information.label,property_information.qty,property_information.unit,
property_information.date_of_entry,property_information.acceptance_date,property_information.warranty_date,
property_information.warranty_date_end,property_information.years_of_use,property_information.source_of_funding,
property_information.custody_unit,property_information.original_location,property_information.now_location,
property_information.custodian,property_information.isQrcode,property_information.old_serial_number,
device_category.dc_name,device_name.dn_name');
    $this->db->from('property_information');
    $this->db->join('device_name', 'property_information.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'property_information.device_category_id = device_category.id', 'inner');
    if(count($range) == 0 || is_null($range)){
      if(!empty($this->input->get('device_category_id'))){
        $this->db->where('property_information.device_category_id', $this->input->get('device_category_id'));
      }
    }
    if(!empty($this->input->get('device_name_id'))){
      $this->db->where('property_information.device_name_id', $this->input->get('device_name_id'));
    }
    if(!empty($this->input->get('location'))){
      $this->db->like('property_information.now_location',$this->input->get('location'));
    }
    if(is_array($range)){
      foreach ($range as $row) {
        $this->db->where('property_information.device_name_id', $row['device_category_id']);
      }
    }
    if(is_null($perpage)){
      $result = $this->db->get();
      //echo $this->db->last_query();
      return $result->result_array();
    }else{
      if(is_numeric($this->input->get('page'))){
        if((int) $this->security->xss_clean($this->input->get('page')) >=2){
          $this->db->limit($perpage,$perpage*($this->input->get('page')-1));//11
        }else{
          $this->db->limit($perpage, 0);
        }
      }
      $result = $this->db->get();
      return $result->result_array();
    }
    return false;
  }
  public function search_count($range = NULL){
    $this->db->select('property_information.id,property_information.property_number,property_information.old_serial_number,
property_information.specification,property_information.model,property_information.label,property_information.qty,
property_information.unit,property_information.date_of_entry,property_information.acceptance_date,
property_information.warranty_date,property_information.warranty_date_end,property_information.years_of_use,
property_information.source_of_funding,property_information.custody_unit,property_information.original_location,
property_information.now_location,property_information.custodian,property_information.isQrcode,device_category.dc_name,
device_name.dn_name');
    $this->db->from('property_information');
    $this->db->join('device_name', 'property_information.device_name_id = device_name.id', 'inner');
    $this->db->join('device_category', 'property_information.device_category_id = device_category.id', 'inner');
    if(count($range) == 0 || is_null($range)){
      if(!empty($this->input->get('device_category_id'))){
        $this->db->where('property_information.device_category_id', $this->input->get('device_category_id'));
      }
    }
    if(is_array($range)){
      foreach ($range as $row) {
        $this->db->where('property_information.device_category_id', $row['device_category_id']);
      }
    }
    if(!empty($this->input->get('device_name_id'))){
      $this->db->where('property_information.device_name_id', $this->input->get('device_name_id'));
    }
    if(!empty($this->input->get('location'))){
      $this->db->like('property_information.now_location',$this->input->get('location'));
    }
    $id = $this->db->get()->num_rows();
    return $id;
  }
  public function nowlocation_update(){
    $this->db->where('id', (int) $this->input->post('id'));
    $data = $this->security->xss_clean(array(
      'now_location' => $this->input->post('location'),
    ));
    $result = $this->db->update('property_information', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function update(){
    $this->db->where('id', (int) $this->input->post('id'));
    $data = $this->security->xss_clean(array(
      'property_number' => $this->input->post('property_number'),
      'old_serial_number' => $this->input->post('old_serial_number'),
      'device_category_id' =>$this->input->post('device_category_id'),
      'device_name_id' => $this->input->post('device_name_id'),
      'specification' => $this->input->post('specification'),
      'model' => $this->input->post('model'),
      'label' => $this->input->post('label'),
      'qty' => $this->input->post('qty'),
      'unit' => $this->input->post('unit'),
      'date_of_entry' => $this->input->post('date_of_entry'),
      'warranty_date' => $this->input->post('warranty_date'),
      'warranty_date_end' => $this->input->post('warranty_date_end'),
      'years_of_use' =>$this->input->post('years_of_use'),
      'source_of_funding' => $this->input->post('source_of_funding'),
      'custody_unit' => $this->input->post('custody_unit'),
      'original_location' => $this->input->post('original_location'),
      'now_location' => $this->input->post('now_location'),
      'custodian' => $this->input->post('custodian'),
      'isQrcode' => 0
    ));
    $result = $this->db->update('property_information', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function delete(){
    $result = $this->db->delete('property_information', array('id' => (int) $this->input->post('id')));
    if($result){
      return true;
    }
    return false;
  }
}
