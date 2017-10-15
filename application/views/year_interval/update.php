    <div class="main">
      <h1>修改學年度資料</h1>
      <hr>
      <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/year/interval/update',array('id' => 'myform')); ?>
        <label for="id"></label>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="name">年度資料標籤</label>
        <input type="text" class="form-control" name="name" value="<?php echo $result['yi_name']; ?>">
        <label for="isEnable">設定預設</label>
        <select class="form-control" name="isEnable">
          <?php
            if($result['isEnable'] == 1){
              echo "<option value='1' selected='selected'>是</option>";
              echo "<option value='0'>否</option>";
            }else{
              echo "<option value='1'>是</option>";
              echo "<option value='0' selected='selected'>否</option>";
            }
          ?>
        </select>
        <label for="start_date">開放線上報修日期</label>
        <input type="date" class="form-control" name="start_date" value="<?php echo $result['start_date']; ?>">
        <label for="end_date">報修截止日期</label>
        <input type="date" class="form-control" name="end_date" value="<?php echo $result['end_date']; ?>">
        <input type="submit" class="btn btn-default" value="送出">
      </form>
      <script type="text/javascript">
        document.ready(function(){
          $("#myform").validate({
            rules: {
              name: "required",
              isEnable: "required",
              start_date: "required",
              start_time: "required",
              end_date: "required",
              end_time: "required"
            },messages:{
              name: "必要資料",
              isEnable: "必要資料",
              start_date: "必要資料",
              start_time: "必要資料",
              end_date: "必要資料",
              end_time: "必要資料"
            }
          });
        });
      </script>
    </div>
  </body>
</html>
