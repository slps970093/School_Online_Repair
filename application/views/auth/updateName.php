    <div class="main">
      <h1>修改管理者用戶名稱</h1>
      <hr>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/auth/update/name'); ?>
            <label for="id"></label>
            <input name="id" type="hidden" value="<?php echo $target_data['uid']; ?>">
            <h3>用戶：<?php echo $target_data['uUsername'];?></h3>
            <label for="name">管理者名稱</label>
            <input type="text" name="name" class="form-control">
            <input type="submit" name="submit" class="btn btn-default" value="送出" />
        </form>
    </div>
  </body>
</html>
