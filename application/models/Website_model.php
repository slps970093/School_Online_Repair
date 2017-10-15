<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Website_model extends CI_Model {
  public function init(){
    $this->db->truncate('website');
    $data = array(
      'id' => 1,
      'website_title' => $this->security->xss_clean($this->input->post('title')),
      'website_content' => $this->security->xss_clean($this->input->post('content')),
      'closeMobile' => 1,
      'closeWebsite' => 1,
    );
    $result = $this->db->insert('website', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function countall(){
    $result = $this->db->get('website');
    return $result->num_rows();
  }
  public function webinfo(){
    $result = $this->db->get_where('website', array('id' => 1));
    return $result->row_array();
  }
  public function update(){
    $data = array(
      'website_title' => $this->security->xss_clean($this->input->post('title')),
      'website_content' => $this->security->xss_clean($this->input->post('content')),
      'closeMobile' => (boolean) $this->security->xss_clean($this->input->post('mobile')),
      'closeWebsite' => (boolean) $this->security->xss_clean($this->input->post('website')),
    );
    $this->db->where('id', 1);
    $result = $this->db->update('website', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
}
