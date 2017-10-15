    <div class="main">
      <h1>新增學年度資料</h1>
      <hr>
      <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/year/interval/add',array('id' => 'myform')); ?>
        <label for="name">年度資料新增</label>
        <input type="text" class="form-control" name="name">
        <label for="isEnable">設定預設</label>
        <select class="form-control" name="isEnable">
          <option value="0" selected="selected">否</option>
          <option value="1">是</option>
        </select>
        <label for="start_date">開放線上報修日期</label>
        <input type="date" class="form-control" name="start_date">
        <label for="end_date">報修截止日期</label>
        <input type="date" class="form-control" name="end_date">
        <input type="submit" class="btn btn-default" value="送出">
      </form>
    </div>
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
  </body>
</html>
