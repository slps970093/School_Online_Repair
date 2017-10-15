    <header>
      <h1>設備故障通報系統</h1>
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
          <?php echo validation_errors(); ?>
          <?php echo form_open(site_url('device/repair')); ?>
            <label for="year_id"></label>
            <input type="hidden" name="year_id" value="<?php echo $default_year['id']; ?>">
            <label for="category">設備分類</label>
            <select name="category" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($device_category_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
              <?php } ?>
            </select>
            <label for="name">設備名稱</label>
            <select name="name" id="Device_name" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($device_name_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
              <?php } ?>
            </select>
            <label for="location">位置</label>
            <input type="text" name="location" class="form-control">
            <label for="fault">故障分類</label>
            <select name="fault" id="fault_category" class="form-control">
              <option value="" selected="selected">請選擇</option>
              <?php foreach ($fault_category_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['fc_name']; ?></option>
              <?php } ?>
            </select>
            <label for="remark">備註</label>
            <textarea name="remark" rows="8" cols="80" class="form-control"></textarea>
            <input type="submit" name="submit" value="送出" class="btn btn-default btn-lg btn-block">
          </form>
          <script type="text/javascript">
          $(document).ready(function(){
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
