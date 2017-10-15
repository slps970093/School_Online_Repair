    <div class="main">
        <h1>新增管理者</h1>
        <hr>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
          <?php echo validation_errors(); ?>
          <?php echo form_open('admin/auth/add',array('id' => 'myform')); ?>
              <label for="username">帳號</label>
              <input type="text" name="username" class="form-control"><br>
              <label for="password">密碼</label>
              <input type="password" name="password" class="form-control"><br>
              <label for="name">使用者名字</label>
              <input type="text" name="name" class="form-control"><br>
              <label for="competence">權限</label>
              <select class="form-control" name="competence">
                <option value="admin" selected="selected">管理者</option>
                <option value="inspector">檢修人員</option>
              </select><br>
              <input type="submit" name="submit" class="btn btn-default" value="送出" />
          </form>
          <script type="text/javascript">
          $(document).ready(function(){
            $("#myform").validate({
              rules:{
                username: "required",
                password: "required",
                name: "required",
                competence: "required"
              },messages:{
                username: "必要項目",
                password: "必要項目",
                name: "必要項目",
                competence: "必要項目"
              }
            });
          });
          </script>
      </div>
  </body>
</html>
