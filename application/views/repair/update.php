    <div class="main">
      <h1>更新設備故障資料</h1>
      <hr>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/device/repair/update'); ?>
          <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
          <label for="year_id">學年度</label>
          <select class="form-control" name="year_id">
            <?php foreach ($year_lst as $row) { ?>
              <?php $id = $row['id']; ?>
              <?php if($result['year_id'] == $id){ ?>
              <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['yi_name']; ?></option>
              <?php }else{ ?>
              <option value="<?php echo $id; ?>"><?php echo $row['yi_name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="category">設備分類</label>
          <select name="category" class="form-control">
            <?php foreach ($device_category_lst as $row) { ?>
              <?php $id =  $row['id']; ?>
              <?php if($id == $result['device_category']){ ?>
                <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['dc_name']; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $id; ?>"><?php echo $row['dc_name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="name">設備名稱</label>
          <select name="name" class="form-control" id="Device_name">
            <?php foreach ($device_name_lst as $row) { ?>
            <?php $id =  $row['id']; ?>
            <?php if($id == $result['device_name']){ ?>
              <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['dn_name']; ?></option>
            <?php }else{ ?>
              <option value="<?php echo $id; ?>"><?php echo $row['dn_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
          <label for="location">位置</label>
          <input type="text" name="location" class="form-control" value="<?php echo $result['location']; ?>">
          <label for="fault">故障分類</label>
          <select name="fault" class="form-control" id="fault_category">
            <?php foreach ($fault_category_lst as $row) { ?>
              <?php $id =  $row['id']; ?>
              <?php if($id == $result['fault_category']){ ?>
                <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['fc_name']; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $id; ?>"><?php echo $row['fc_name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="remark">備註</label>
          <textarea name="remark" rows="8" cols="80" class="form-control" ><?php echo $result['remark']; ?></textarea>
          <h3>管理者自行新增或修改</h3>
          <hr>
          <label for="status">維修狀態</label>
          <select class="form-control" name="status">
            <?php foreach ($repair_status_lst as $row) { ?>
              <?php $id = $row['id']; ?>
              <?php if($id == $result['is_status']){ ?>
                <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['StatusName']; ?></option>
              <?php }else{ ?>
                <option value="<?php echo $id; ?>"><?php echo $row['StatusName']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="description">說明</label>
          <textarea name="description" rows="8" cols="80" class="form-control"><?php echo $result['description']; ?></textarea>
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
        </form>
      </div>
  </body>
</html>
