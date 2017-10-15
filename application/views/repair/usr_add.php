    <header>
      <h1><?php echo $webinfo['website_title']; ?></h1>
      <hr>
    </header>
    <div class="nav">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <div class="form-page">
          <?php if(isset($_GET['success'])){ ?>
          <div class="alert alert-success" role="alert">操作已完成</div>
          <?php } ?>
          <?php if(isset($_GET['failed'])) { ?>
          <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
          <?php } ?>
          <div style="text-align: center;">
            預設資料集：<?php echo $default_year['yi_name']; ?><br>開放報修時間：<?php echo $default_year['start_date']; ?>到<?php echo $default_year['end_date']; ?>止，超過時間系統將停止報修！
          </div>
          <?php echo validation_errors(); ?>
          <?php echo form_open(site_url('device/repair'),array('id' => 'repairForm')); ?>
            <label for="year_id"></label>
            <input type="hidden" name="year_id" value="<?php echo $default_year['id']; ?>">
            <label for="category">設備分類</label>
            <select name="category" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($device_category_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
              <?php } ?>
            </select><br>
            <label for="name">設備名稱</label>
            <select name="name" id="Device_name" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($device_name_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
              <?php } ?>
            </select><br>
            <label for="location">位置</label>
            <input type="text" name="location" class="form-control"><br>
            <label for="fault">故障分類</label>
            <select name="fault" id="fault_category" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($fault_category_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['fc_name']; ?></option>
              <?php } ?>
            </select><br>
            <label for="remark">備註</label>
            <textarea name="remark" rows="8" cols="80" class="form-control"></textarea>
            <input type="submit" name="submit" class="btn btn-default" value="送出">
          </form>
          <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
          <script type="text/javascript">
          $(document).ready(function(){
            $("#repairForm").validate({
              rules:{
                category: "required",
                name: "required",
                location: "required",
                fault: "required"
              },messages:{
                category: "請選擇設備分類",
                name: "請選擇設備名稱",
                location: "請輸入位置",
                fault: "請選擇故障分類"
              }
            });
            //當 id Device_name被點擊
            $("#Device_name").click(function(){
              //清空
              $("#fault_category").empty();
            });
            //如果 id Device_name 被更改
            $("#Device_name").change(function(){
              var change_value = $("#Device_name").val();
              var url = "<?php echo $ajax_fault_category_url; ?>"+change_value;
              //Ajax
              $.getJSON(url,function(data){
                $("#fault_category").append("<option selected='selected'>請選擇</option>");
                $.each(data,function(i,item){
                  $("#fault_category").append("<option value='"+item.id+"'>"+item.name+"</option>");
                })
              });
            });
          });
          </script>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
    <footer>
      <hr>
      使用Codeigniter 3 / BootStrap 3 製作
    </footer>
  </body>
</html>
