<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_repair_Model extends CI_Model {
  //管理者搜尋資料
  public function ad_advanced_search($limit){
    if(!is_null($this->security->xss_clean($this->input->get('year_id'))) && !is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id'))) && is_numeric(!is_null($this->security->xss_clean($this->input->get('status'))))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $this->security->xss_clean($this->input->get('year_id')));
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        $this->db->order_by('device_repair.id', 'DESC');
      }
    }
  	if(!is_null($this->security->xss_clean($this->input->get('year_id'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id')))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $this->security->xss_clean($this->input->get('year_id')));
        $this->db->order_by('device_repair.id', 'DESC');
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id')))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        $this->db->order_by('device_repair.id', 'DESC');
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->order_by('device_repair.id', 'DESC');
    }
    if(!is_null($limit)){
      if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
        $this->db->limit($limit, $limit*($this->input->get('page')-1));

      }else{
        $this->db->limit($limit, 0);
      }
    }
    $result = $this->db->get();
    return $result->result_array();
  }
  //管理者搜尋資料總筆數
  public function ad_advanced_search_countall(){
    if(!is_null($this->security->xss_clean($this->input->get('year_id'))) && !is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id'))) && is_numeric(!is_null($this->security->xss_clean($this->input->get('status'))))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $this->security->xss_clean($this->input->get('year_id')));
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        $this->db->order_by('device_repair.id', 'DESC');
        return $this->db->get()->num_rows();
      }
    }
  	if(!is_null($this->security->xss_clean($this->input->get('year_id'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id')))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $this->security->xss_clean($this->input->get('year_id')));
        $this->db->order_by('device_repair.id', 'DESC');
        return $this->db->get()->num_rows();
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('year_id')))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        $this->db->order_by('device_repair.id', 'DESC');
        return $this->db->get()->num_rows();
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->order_by('device_repair.id', 'DESC');
      return $this->db->get()->num_rows();
    }
  }

  //檢修員搜尋
  public function inspector_advanced_search($limit,$range=NULL){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    //搜尋條件
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('status')))){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $year_data['id']);
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        if(is_array($range)){
          foreach ($range as $row) {
            $this->db->where('device_category', $row['device_category_id']);
          }
        }
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      if(is_array($range)){
        foreach ($range as $row) {
          $this->db->where('device_category', $row['device_category_id']);
        }
      }
    }
    if(!is_null($limit)){
      if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
        $this->db->limit($limit, $limit*($this->input->get('page')-1));

      }else{
        $this->db->limit($limit, 0);
      }
    }
    $result = $this->db->get();
    return $result->result_array();
  }
  public function inspector_get_data($limit = NULL,$range=NULL){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    if(is_null($limit)){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->where('year_id', $year_data['id']);
      $this->db->order_by('device_repair.id', 'DESC');
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->where('year_id', $year_data['id']);
        $this->db->order_by('device_repair.id', 'DESC');
        if(is_array($range)){
          foreach ($range as $row) {
            $this->db->where('device_category', $row['device_category_id']);
          }
        }
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $this->db->limit($limit, ($this->input->get('page')-1));
        }else{
          $this->db->limit($limit, 0);
        }
        $result = $this->db->get();
        return $result->result_array();
      }
    }
  }
  public function inspector_get_data_countall(){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->where('year_id', $year_data['id']);
      $this->db->order_by('device_repair.id', 'DESC');
      return $this->db->get()->num_rows();
  }
  //給予搜尋條件資料筆數
  public function inspector_advanced_search_countall($range = NULL){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
    $this->db->from('device_repair');
    $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
    $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
    $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
    $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
    $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
    //搜尋條件
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
      $this->db->order_by('device_repair.id', 'DESC');
      if(is_array($range)){
        foreach ($range as $row) {
          $this->db->where('device_category', $row['device_category_id']);
        }
      }
      return $this->db->get()->num_rows();
    }
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
      $this->db->order_by('device_repair.id', 'DESC');
      if(is_array($range)){
        foreach ($range as $row) {
          $this->db->where('device_category', $row['device_category_id']);
        }
      }
      return $this->db->get()->num_rows();
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->order_by('device_repair.id', 'DESC');
      if(is_array($range)){
        foreach ($range as $row) {
          $this->db->where('device_category', $row['device_category_id']);
        }
      }
      return $this->db->get()->num_rows();
    }
  }
  //使用者搜尋
  public function usr_advanced_search($limit){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    //搜尋條件
    $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,repair_status.StatusName,year_interval.yi_name,fault_category.fc_name');
    $this->db->from('device_repair');
    $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
    $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
    $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
    $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
    $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      if(is_numeric($this->security->xss_clean($this->input->get('status')))){
        $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
        $this->db->where('year_id', $year_data['id']);
        $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
        $this->db->limit($limit,$this->security->xss_clean($this->input->get('per_page')));
        $this->db->order_by('device_repair.id', 'DESC');
      }
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->limit($limit,$this->security->xss_clean($this->input->get('per_page')));
      $this->db->order_by('device_repair.id', 'DESC');
    }
    if(!is_null($limit)){
      if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
        $this->db->limit($limit, $limit*($this->input->get('page')-1));
      }else{
        $this->db->limit($limit, 0);
      }
    }
    $result = $this->db->get();
    return $result->result_array();
  }
  //給予搜尋條件資料筆數(User)
  public function usr_advanced_search_countall(){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    //搜尋條件
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
      $this->db->order_by('device_repair.id', 'DESC');
      return $this->db->get()->num_rows();
    }
    if(!is_null($this->security->xss_clean($this->input->get('status'))) && !is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->where('is_status', $this->security->xss_clean($this->input->get('status')));
      $this->db->order_by('device_repair.id', 'DESC');
      return $this->db->get()->num_rows();
    }
    if(!is_null($this->security->xss_clean($this->input->get('location')))){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->like('location', $this->security->xss_clean($this->input->get('location')));
      $this->db->where('year_id', $year_data['id']);
      $this->db->order_by('device_repair.id', 'DESC');
      return $this->db->get()->num_rows();
    }
  }
  public function get_data($limit = NULL){
    if(is_null($limit)){
      $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
      $this->db->from('device_repair');
      $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
      $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
      $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
      $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
      $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
      $this->db->order_by('device_repair.id', 'DESC');
      $result = $this->db->get();
      return $result->result_array();
    }else{
      if(is_numeric($limit)){
        $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
        $this->db->from('device_repair');
        $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
        $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
        $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
        $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
        $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
        $this->db->order_by('device_repair.id', 'DESC');
        if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
          $this->db->limit($limit, $limit*($this->input->get('page')-1));

        }else{
          $this->db->limit($limit, 0);
        }
        $result = $this->db->get();
        return $result->result_array();
      }
    }

  }
  public function usr_get_data($year,$limit){
    $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
    $this->db->from('device_repair');
    $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
    $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
    $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
    $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
    $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
    $this->db->where('year_id', $year);
    $this->db->order_by('device_repair.id', 'DESC');
    if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
      $this->db->limit($limit, $limit*($this->input->get('page')-1));

    }else{
      $this->db->limit($limit, 0);
    }
    $result = $this->db->get();
    return $result->result_array();
  }
  public function usr_get_data_countall(){
    //找尋預設資料
    $result = $this->db->get_where('year_interval', array('isEnable' => 1));
    $year_data = $result->row_array();
    $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
    $this->db->from('device_repair');
    $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
    $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
    $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
    $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
    $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
    $this->db->where('year_id', $year_data['id']);
    $this->db->order_by('device_repair.id', 'DESC');
    return $this->db->get()->num_rows();
  }
  public function add(){
    $data = array(
      'id' => NULL,
      'year_id' => $this->input->post('year_id'),
      'device_category' => $this->input->post('category'),
      'device_name' => $this->input->post('name'),
      'fault_category' => $this->input->post('fault'),
      'location' => $this->input->post('location'),
      'add_datetime' => date('Y-m-d H:i:s'),
      'is_status' => 1,
      'remark' => $this->input->post('remark'),
      'description' => NULL
    );
    $data = $this->security->xss_clean($data);
    $result = $this->db->insert('device_repair', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function update(){
    $data = array(
      'year_id' => $this->input->post('year_id'),
      'device_category' => $this->input->post('category'),
      'device_name' => $this->input->post('name'),
      'fault_category' => $this->input->post('fault'),
      'location' => $this->input->post('location'),
      'is_status' => $this->input->post('status'),
      'remark' => $this->input->post('remark'),
      'description' => $this->input->post('description')
    );
    $data = $this->security->xss_clean($data);
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('device_repair', $data);
    if($result){
      return true;
    }
    return false;
  }

  public function inspector_update(){
    $data = array(
      'is_status' => $this->input->post('status'),
      'description' => $this->input->post('description')
    );
    $data = $this->security->xss_clean($data);
    $this->db->where('id', $this->input->post('id'));
    $result = $this->db->update('device_repair', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function delete(){
    $result = $this->db->delete('device_repair', array('id' => $this->input->post('id')));
    if($result){
      return true;
    }
    return false;
  }
  public function get_target_join_data($id){
    $this->db->select('device_repair.id,device_repair.location,device_repair.add_datetime,device_repair.remark,device_repair.description,device_category.dc_name,device_name.dn_name,fault_category.fc_name,year_interval.`yi_name`,repair_status.StatusName');
    $this->db->from('device_repair');
    $this->db->join('fault_category', 'device_repair.fault_category = fault_category.id', 'INNER');
    $this->db->join('device_name', 'device_name.id = device_repair.device_name', 'INNER');
    $this->db->join('device_category', 'device_category.id = device_repair.device_category', 'INNER');
    $this->db->join('repair_status', 'repair_status.id = device_repair.is_status', 'INNER');
    $this->db->join('year_interval', 'year_interval.id = device_repair.year_id', 'INNER');
    $this->db->where('`device_repair`.`id`', $id);
    $result = $this->db->get();
    return $result->row_array();
  }
  public function get_target_data($id){
    $result = $this->db->get_where('device_repair',array('id' => $id));
    return $result->row_array();
  }
}
