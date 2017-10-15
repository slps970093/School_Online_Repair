    <div class="main">
      <h1>修改裝置名稱</h1>
      <hr>
      <?php validation_errors(); ?>
      <?php echo form_open('admin/device/name/update'); ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>" class="form-control">
        <label for="name">名稱</label>
        <input type="text" name="name" value="<?php echo $result['dn_name'];?>" class="form-control">
        <input type="submit" name="submit" class="btn btn-default" value="送出">
      </form>
    </div>
  </body>
</html>
