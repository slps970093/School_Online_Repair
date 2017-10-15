    <div class="main">
      <h1>新增故障分類</h1>
      <hr>
      <?php validation_errors(); ?>
      <?php echo form_open('admin/fault/category/add'); ?>
        <label for="extends">繼承</label>
        <select class="form-control" name="extends">
          <option value="" selected="selected">請選擇</option>
          <?php foreach ($extends_device_name as $row) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
          <?php } ?>
        </select>
        <label for="name">名稱</label>
        <input type="text" name="name" class="form-control">
        <input type="submit" name="submit" value="送出" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
