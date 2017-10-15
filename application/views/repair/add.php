    <div class="main">
      <h1>新增設備故障資料</h1>
      <hr>
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/device/repair/add'); ?>
      <label for="year_id">學年度</label>
      <select class="form-control" name="year_id">
        <?php foreach ($year_lst as $row) { ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['yi_name']; ?></option>
        <?php } ?>
      </select>
      <label for="category">設備分類</label>
      <select name="category" class="form-control">
        <option value="" selected="selected">請選擇</option>
        <?php foreach ($device_category_lst as $row) { ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
        <?php } ?>
      </select>
      <label for="name">設備名稱</label>
      <select name="name" class="form-control" id="Device_name">
        <option value="" selected="selected">請選擇</option>
        <?php foreach ($device_name_lst as $row) { ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
        <?php } ?>
      </select>
      <label for="location">位置</label>
      <input type="text" name="location" class="form-control">
      <label for="fault">故障分類</label>
      <select name="fault" class="form-control" id="fault_category">
        <option value="" selected="selected">請選擇</option>
        <?php foreach ($fault_category_lst as $row) { ?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['fc_name']; ?></option>
        <?php } ?>
      </select>
      <label for="remark">備註</label>
      <textarea name="remark" rows="8" cols="80" class="form-control"></textarea>
      <input type="submit" name="submit" class="btn btn-default" value="送出">
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
          var url = "<?php echo site_url('ajax/fault/category/get/'); ?>"+change_value;
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
  </body>
</html>
