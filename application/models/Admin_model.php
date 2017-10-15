<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
  public function __construct(){
      $this->load->database();
      $this->load->library('AuthHelper');
  }
  public function add()
  {
    $data = $this->security->xss_clean(array(
      'uUsername' => $this->input->post('username'),
      'uPassword' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'uName' => $this->input->post('name'),
      'competence' => $this->input->post('competence')
    ));
    $data = $this->security->xss_clean($data);
    if($this->db->insert('admin',$data)){
      return true;
    }else{
      return false;
    }
  }
  public function competence(){
    $this->db->where('uid', $this->input->post('id'));
    $result = $this->db->update('admin', $this->security->xss_clean(array('competence' => $this->input->post('competence'))));
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function isInspector($id = NULL){
    if(is_numeric($id)){
      $result = $this->db->get_where('admin', array('uid' => $id));
      $row = $result->row_array();
      if($row['competence'] != 'inspector'){
        return false;
      }
    }
    return true;
  }
  public function get_data($limit){
    if(is_numeric($this->input->get('page')) && $this->input->get('page')!= 0){
      $query = $this->db->get('admin', $limit, $limit*($this->input->get('page')-1));
    }else{
      $query = $this->db->get('admin', $limit, 0);
    }
    return $query->result_array();
  }
  public function get_target_data($id){
    $query = $this->db->get_where('admin',array('uid'=>$id));
    return $query->row_array();
  }
  public function Auth(){
    $this->db->select('uid,uUsername,uPassword,competence,uName');
    $this->db->from('admin');
    $this->db->where('uUsername',$this->input->post('username'));
    $query = $this->db->get();
    return $query->row_array();
  }
  public function delete(){
    if($this->db->delete('admin',array('uid'=>(int) $this->input->post('id')))){
      return true;
    }else{
      return false;
    }
  }
  public function update_usr(){
    $this->db->where('uid',(int) $this->input->post('id'));
    $data = $this->security->xss_clean(array(
      'uUsername' => $this->input->post('username')
    ));
    $data = $this->security->xss_clean($data);
    $result = $this->db->update('admin', $data);
    if($result){
      return TRUE;
    }else{
      return false;
    }
  }
  public function update_pwd(){
    $this->db->where('uid',(int) $this->input->post('id'));
    $data = array(
      'uPassword' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
    );
    $data = $this->security->xss_clean($data);
    $result = $this->db->update('admin', $data);
    if($result){
      return true;
    }else{
      return false;
    }
  }
  public function update_name(){
    $this->db->where('uid',(int) $this->input->post('id'));
    $data = $this->security->xss_clean(array(
      'uName' => $this->input->post('name')
    ));
    $result = $this->db->update('admin', $data);
    if($result){
      return true;
    }
    return false;
  }
  public function init(){
    $this->db->truncate('admin');
    $data = $this->security->xss_clean(array(
      'uUsername' => $this->input->post('username'),
      'uPassword' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'uName' => $this->input->post('name'),
      'competence' => 'admin'
    ));
    $result = $this->db->insert('admin', $data);
    if($result){
      return true;
    }
    return false;
  }
}
