<div class="main">
  <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/qrcode/add'); ?>'">新增QR-CODE</button>
  <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/qrcode/create/doc'); ?>'">產生ODF</button>
  <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/qrcode/create/doc')."?specify=true"; ?>'">產生已選取資料ODF</button>
  <div id="showBatch">
  </div>
  <?php echo form_open('admin/qrcode/search',array('method' => 'get')); ?>
    <table width='100%'>
      <tr>
        <td>搜尋位置：</td>
        <td><input type="text" name="search" class="form-control"></td>
        <td><input type="submit" class="btn btn-default" value="查詢"></td>
      </tr>
    </table>
  </form>
  <form id="myform">
    <table class="table">
      <tr>
        <td></td>
        <td>位置</td>
        <td>顯示QR條碼</td>
        <td>刪除</td>
      </tr>
      <?php foreach ($result as $row) { ?>
      <tr><?php $id = $row['id']; ?>
        <td><input name="qr_id[]" type="checkbox" value="<?php echo $id; ?>"  class="form-control"/></td>
        <td><?php echo $row['location']; ?></td>
        <td><img src="<?php echo base_url('qrcode/').$row['repair_file']; ?>" width="100px" height="100px">&nbsp;<img src="<?php echo base_url('qrcode/').$row['search_file']; ?>" width="100px" height="100px"></td>
        <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('admin/qrcode/delete/').$id; ?>'">刪除</button></td>
      </tr>
      <?php } ?>
    </table>

    <button type="button" class="btn btn-default" onclick="set_select()">送出批次請求</button>
    <script type="text/javascript">
      $(document).ready(function(){
        show_batch_data();
        get_csrf_token();
      });
      var csrf_token_name = '';
      var csrf_token_value = '';
      function get_csrf_token(){
        csrf_token_name = '';
        csrf_token_value = '';
        $.getJSON("<?php echo site_url('admin/qrcode/ajax/csrf'); ?>",function(result){
          $.each(result, function(key,value){
            if(key == 'csrf_name'){
              csrf_token_name = value;
            }else{
              csrf_token_value = value;
            }
          });
        });
      }
      //設定選取資料
      function set_select(){
        $.ajax({
          url: '<?php echo site_url('admin/qrcode/ajax/batch/sel/add'); ?>',
          type: 'POST',
          data: $('#myform').serialize()+"&"+csrf_token_name+"="+csrf_token_value,
          success: function(response) {
            show_batch_data();
            get_csrf_token();
          }
        });
      }
      //刪除選取資料
      function sel_delete(qr_id){
        $.ajax({
            url: '<?php echo site_url('admin/qrcode/ajax/batch/sel/delete'); ?>?id='+qr_id,
            type: 'GET',
            error: function() {
              alert('Ajax request 發生錯誤');
            },
            success: function(response) {
              show_batch_data();
              get_csrf_token();
            }
        });
      }
      //顯示選取資料
      function show_batch_data(){
        $.ajax({
          url: '<?php echo site_url('admin/qrcode/ajax/batch/sel/show'); ?>',
          type: 'GET',
          success: function(response){
            $('#showBatch').text();
            $('#showBatch').html(response);
          },
          error: function() {
            alert('Ajax request 發生錯誤');
          }
        });
      }
      function clean_batch_all(){
        $.ajax({
          url: '<?php echo site_url('admin/qrcode/ajax/batch/clean'); ?>',
          type: 'GET',
          success: function(response){
            alert("所有選取資料已經清除完畢");
            show_batch_data();
          },
          error: function() {
            alert('Ajax request 發生錯誤');
          }
        });
      }
    </script>
  </form>
  <?php //echo $this->pagination->create_links();
  echo $paginator;  ?>
</div>
