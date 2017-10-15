    <div class="main">
      <h1>修改管理者名稱</h1>
      <hr>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/auth/usr_update'); ?>
            <h3>用戶名稱<?php echo $target_data['uName']; ?></h3>
            <hr>
            <label for="id"></label>
            <input name="id" type="hidden" value="<?php echo $target_data['uid']; ?>">
            <label for="name">用戶名稱</label>
            <input type="text" name="name" class="form-control"  value="<?php echo $target_data['uName'];?>">
            <input type="submit" name="submit" class="btn btn-default" value="送出" />
        </form>
    </div>
  </body>
</html>
