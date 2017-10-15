<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use JasonGrimes\Paginator;
class Qrcode extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－QR-CODE行動報修管理";
    $totalItems = $this->db->get('qrcode')->num_rows();
    $itemsPerPage = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('admin/qrcode').'?page=(:num)';
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['result'] = $this->Qrcode_model->get_data($itemsPerPage);
    $this->load->view('qrcode/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('qrcode/admin_main');
  }
  public function add(){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('content', 'content', 'required');
    $this->form_validation->set_rules('title', 'title', 'required');
    if($this->form_validation->run()===FALSE){
      $data['device_name'] = $this->Device_name_Model->get_data();
      $data['device_category'] = $this->Device_category_Model->get_data();
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－QR-CODE行動報修管理-新增資料";
      $this->load->view('qrcode/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('qrcode/add',$data);
    }else{
      $filename = array(
        'repair_qrcode' => "repair-".$this->security->xss_clean($this->input->post('location'))."_".date('Y-m-d_H-i-s').".png",
        'repair_qrcode_path' => FCPATH."/qrcode/repair-".$this->security->xss_clean($this->input->post('location'))."_".date('Y-m-d_H-i-s').".png",
        'search_qrcode' => "search-".$this->security->xss_clean($this->input->post('location'))."_".date('Y-m-d_H-i-s').".png",
        'search_qrcode_path' => FCPATH."/qrcode/search-".$this->security->xss_clean($this->input->post('location'))."_".date('Y-m-d_H-i-s').".png"
      );
      $url = array(
        'repair' => site_url('device/qrcode/repair')."?location=".$this->security->xss_clean($this->input->post('location'))."&name=".$this->security->xss_clean($this->input->post('name'))."&category=".$this->security->xss_clean($this->input->post('category')),
        'search' => site_url('device/repair/showlst/search')."?location=".$this->security->xss_clean($this->input->post('location'))
      );
      // generate QR-CODE
      \PHPQRCode\QRcode::png($url['repair'], $filename['repair_qrcode_path'], 'L', 7, 6);
      \PHPQRCode\QRcode::png($url['search'], $filename['search_qrcode_path'], 'L', 7, 6);
      $result = $this->Qrcode_model->add($filename['repair_qrcode'],$filename['search_qrcode'],$filename['repair_qrcode_path'],$filename['search_qrcode_path']);
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/qrcode')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/qrcode')."?failed'</script>";
      }
    }
  }
  public function update($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    $this->form_validation->set_rules('category', 'category', 'required');
    $this->form_validation->set_rules('name', 'name', 'required');
    $this->form_validation->set_rules('location', 'location', 'required');
    $this->form_validation->set_rules('content', 'content', 'required');
    $this->form_validation->set_rules('title', 'title', 'required');
    if($this->form_validation->run()===FALSE){
      $data['device_name'] = $this->Device_name_Model->get_data();
      $data['target_data'] = $this->Qrcode_model->get_target_data($id);
      $data['device_category'] = $this->Device_category_Model->get_data();
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－QR-CODE行動報修管理-修改資料";
      $this->load->view('qrcode/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('qrcode/update',$data);
    }else{
      //search filepath
      $result = $this->Qrcode_model->get_target_data($this->input->post('id'));
      //delete file
      unlink($result['repair_filepath']);
      unlink($result['search_filepath']);
      $filename = array(
        'repair_qrcode' => "repair-".$this->security->xss_clean($this->input->post('now_location'))."_".date('Y-m-d_H-i-s').".png",
        'repair_qrcode_path' => FCPATH."/qrcode/repair-".$this->security->xss_clean($this->input->post('now_location'))."_".date('Y-m-d_H-i-s').".png",
        'search_qrcode' => "search-".$this->security->xss_clean($this->input->post('now_location'))."_".date('Y-m-d_H-i-s').".png",
        'search_qrcode_path' => FCPATH."/qrcode/search-".$this->security->xss_clean($this->input->post('now_location'))."_".date('Y-m-d_H-i-s').".png"
      );
      $url = array(
        'repair' => site_url('device/qrcode/repair')."?location=".$this->security->xss_clean($this->input->post('now_location'))."&name=".$this->security->xss_clean($this->input->post('name'))."&category=".$this->security->xss_clean($this->input->post('category')),
        'search' => site_url('device/repair/showlst/search')."?location=".$this->security->xss_clean($this->input->post('now_location'))
      );
      // generate QR-CODE
      \PHPQRCode\QRcode::png($url['repair'], $filename['repair_qrcode_path'], 'L', 7, 6);
      \PHPQRCode\QRcode::png($url['search'], $filename['search_qrcode_path'], 'L', 7, 6);
      $result = $this->Qrcode_model->update($filename['repair_qrcode'],$filename['search_qrcode'],$filename['repair_qrcode_path'],$filename['search_qrcode_path']);
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/qrcode')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/qrcode')."?failed'</script>";
      }
    }
  }
  public function search(){
    $this->authhelper->isAdmin();
    $data['webinfo'] = $this->Website_model->webinfo();
    $data['title'] = $data['webinfo']['website_title']."－QR-CODE行動報修管理";
    $totalItems = $this->Qrcode_model->search_count();
    $itemsPerPage = 6;
    $currentPage = ($this->input->get('page')>0 && is_numeric($this->input->get('page')))?(int) $this->input->get('page'):0;
    $urlPattern = site_url('admin/qrcode/search')."?page=(:num)&search=".$this->security->xss_clean($this->input->get('search'));
    $data['paginator'] = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
    $data['result'] = $this->Qrcode_model->search($config['per_page']);
    $this->load->view('qrcode/head',$data);
    $this->load->view('nav/admin_nav');
    $this->load->view('qrcode/admin_main',$data);

  }
  public function delete($id = NULL){
    $this->authhelper->isAdmin();
    $this->form_validation->set_rules('id', 'id', 'required');
    if($this->form_validation->run()===FALSE){
      $data['result'] = $this->Qrcode_model->get_where($id);
      $data['webinfo'] = $this->Website_model->webinfo();
      $data['title'] = $data['webinfo']['website_title']."－QR-CODE行動報修管理-刪除資料";
      $this->load->view('qrcode/head',$data);
      $this->load->view('nav/admin_nav');
      $this->load->view('qrcode/delete',$data);
    }else{
      //search filepath
      $result = $this->Qrcode_model->get_target_data($this->input->post('id'));
      //delete file
      unlink($result['repair_filepath']);
      unlink($result['search_filepath']);
      $result = $this->Qrcode_model->delete();
      if($result){
        echo "<script type='text/javascript'>alert('操作已完成！'); window.location='".site_url('admin/qrcode')."?success';</script>";
      }else{
        echo "<script type='text/javascript'>alert('操作失敗，請聯絡系統管理員！'); window.location='".site_url('admin/qrcode')."?failed'</script>";
      }
    }
  }
  public function create_doc(){
    $this->authhelper->isAdmin();
    /*
     * Libray: phpword
     * Github: https://github.com/PHPOffice/PHPWord
     * Document: https://phpword.readthedocs.io/en/latest/
     */
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();
    //Create table
    $tableStyle = array(
        'borderColor' => '006699',
        'borderSize'  => 6,
        'cellMargin'  => 50,
        'valign'=>'both'
    );
    $table = $section->addTable($tableStyle);
    $table->addRow(4000);
    if(empty($this->input->get('specify'))){
      $result = $this->Qrcode_model->create_doc();
    }
    $count = 0;
    $fontStyleName = 'bsyle';
    $phpWord->addFontStyle(
        $fontStyleName,
        array('name' => '標楷體', 'size' => 18, 'color' => '1B2232', 'bold' => true,'valign'=>'both')
    );
    $phpWord->addParagraphStyle($fontStyleName,array('valign'=>'both'));
    //Create Content
    if($this->input->get('specify') == true){
      // Specify Content (由使用者指定資料輸出)
      for($i = 0;$i<=count($_SESSION['qrcode_sel_data'])-1;$i++){
        $row = $this->Qrcode_model->create_doc((int) $_SESSION['qrcode_sel_data'][$i]['qid']);
        $cell = $table->addCell(2000);
        $str = $row['location'];
        $img_src = base_url('qrcode/').$row['repair_file'];
        $cell->addText($str,$fontStyleName);
        $cell->addTextBreak();
        $str = $row['dc_name']."(".$row['dn_name'].")"."行動報修";
        $cell->addText($str,$fontStyleName);
        $cell->addImage($img_src,array( 'width' => 300, 'height' => 300));
        $cell = $table->addCell(2000);
        $str = $row['location'];
        $img_src = base_url('qrcode/').$row['search_file'];
        $cell->addText($str,$fontStyleName);
        $cell->addTextBreak();
        $str = $row['dc_name']."(".$row['dn_name'].")"."行動報修";
        $cell->addText($str,$fontStyleName);
        //$cell->addImage($img_src);
        $cell->addImage($img_src,
			array( 'width' => 300, 'height' => 300));
        $count = 0;
        $table->addRow(4000);
      }
    }else{
      // ALl Content
      foreach($result as $row){
        if($count == 0){
          $cell = $table->addCell(2000);
          $str = $row['location'];
          $img_src = base_url('qrcode/').$row['repair_file'];
          $cell->addText($str,$fontStyleName);
          $cell->addTextBreak();
          $str = $row['dc_name']."(".$row['dn_name'].")"."行動報修";
          $cell->addText($str,$fontStyleName);
          $cell->addImage($img_src,
			array( 'width' => 300, 'height' => 300));
          $count++;
        }
        if($count == 1){
          $cell = $table->addCell(2000);
          $str = $row['location'];
          $cell->addText($str,$fontStyleName);
          $cell->addTextBreak();
          $str = $row['dc_name']."(".$row['dn_name'].")"."行動報修";
          $cell->addText($str,$fontStyleName);
          $cell->addImage($img_src,
			array( 'width' => 300, 'height' => 300));
          $count = 0;
          $table->addRow(4000);
        }
      }
    }
    // file formet
    if($this->input->get('output_formet') == 'msword'){
      // ms office
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
      $objWriter->save(FCPATH.'/doc/create_qrcode_file.docx');
      $file= FCPATH."/doc/create_qrcode_file.docx"; // 實際檔案的路徑+檔名
      $filename="create_qrcode_file.docx"; // 下載的檔名
    }else{
      // ODF Formet
      $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
      $objWriter->save(FCPATH.'/doc/create_qrcode_file.odt');
      $file= FCPATH."/doc/create_qrcode_file.odt"; // 實際檔案的路徑+檔名
      $filename="create_qrcode_file.odt"; // 下載的檔名
    }
    // Server send File Download Request
    // 範本：http://wallyjue.blogspot.tw/2008/07/php.html
    header("Content-type: application/download");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Transfer-Encoding: binary");
    readfile($file);
  }
  // Ajax function
  public function batch_selection(){
    $this->authhelper->isAdmin();
    $qrcode_id = $this->input->post('qr_id');
    if(!is_array($_SESSION['qrcode_sel_data'])){

      $tmp = 0;
      for($i=0;$i<=count($qrcode_id)-1;$i++){
        echo $tmp;
        $result = $this->Qrcode_model->ajax_get_where($qrcode_id[$i]);
        $_SESSION['qrcode_sel_data'][$tmp] = array(
          'qid' => $result['id'],
          'Name' => "設備分類－".$result['dc_name']." 設備名稱－".$result['dn_name']." 位置－".$result['location']
        );
        $tmp++;
      }

    }else{
      array_values($_SESSION['qrcode_sel_data']);
      $start_value = (int) count($_SESSION['qrcode_sel_data']);
      var_dump($qrcode_id);
      for($i=0;$i<=count($qrcode_id)-1;$i++){
        $result = $this->Qrcode_model->ajax_get_where($qrcode_id[$i]);
        $_SESSION['qrcode_sel_data'][$start_value+$tmp] = array(
          'qid' => $result['id'],
          'Name' => "設備分類－".$result['dc_name']." 設備名稱－".$result['dn_name']." 位置－".$result['location']
        );
        $tmp++;
      }
      $_SESSION['qrcode_sel_data'] = array_values($_SESSION['qrcode_sel_data']);
    }
  }


  public function get_batch_select_data(){
    $this->authhelper->isAdmin();
    if(!empty($_SESSION['qrcode_sel_data'])){
      echo "<h3>選擇批次產生WORD</h3><hr>";
      echo "<p>";
      echo "<button type='button' onclick='clean_batch_all()' class='btn btn-danger'>清除所有選取資料</button><p>";
      $_SESSION['qrcode_sel_data'] = array_values($_SESSION['qrcode_sel_data']);

      for($i = 0;$i<=count($_SESSION['qrcode_sel_data'])-1;$i++){
        echo $_SESSION['qrcode_sel_data'][$i]['Name']." ";
        echo "<button type'button' onclick='sel_delete(".$i.")' class='btn btn-default'>刪除</button>";
        echo "<br>";
      }
    }
  }

  public function delete_batch_select_data(){
    $this->authhelper->isAdmin();
    //var_dump($_SESSION['qrcode_sel_data'][$this->input->get('id')]);
    if(is_numeric($this->input->get('id')) && !is_null($this->input->get('id'))){
      unset($_SESSION['qrcode_sel_data'][$this->input->get('id')]);
      array_values($_SESSION['qrcode_sel_data']);

    }else{
      show_404();
    }
  }

  public function csrf_token(){
    $this->authhelper->isAdmin();
    $data['csrf_name'] = $this->security->get_csrf_token_name();
    $data['csrf_value'] = $this->security->get_csrf_hash();
    echo json_encode($data);
  }

  public function batch_clean(){
    unset($_SESSION['qrcode_sel_data']);
  }

}
