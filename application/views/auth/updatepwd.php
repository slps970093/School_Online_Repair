      <div class="main">
        <h1>修改管理者密碼</h1>
        <hr>
          <?php echo validation_errors(); ?>
          <?php echo form_open('admin/auth/pwd_update'); ?>
              <label for="id"></label>
              <input name="id" type="hidden" value="<?php echo $target_data['uid']; ?>">
              <h3>用戶：<?php echo $target_data['uUsername'];?></h3>
              <label for="password">密碼</label>
              <input type="password" name="password" class="form-control">
              <input type="submit" name="submit" class="btn btn-default" value="送出" />
          </form>
      </div>
  </body>
</html>
