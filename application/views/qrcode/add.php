    <div class="main">
      <?php validation_errors(); ?>
      <?php echo form_open('admin/qrcode/add'); ?>
        <label for="title">標題</label>
        <input type="text" name="title" class="form-control">
        <label for="category">設備分類</label>
        <select class="form-control" name="category">
          <option value="" selected>請選擇</option>
          <?php foreach ($device_category as $row) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
          <?php } ?>
        </select>
        <label for="name">設備名稱</label>
        <select name="name" class="form-control">
          <option value="" selected>請選擇</option>
          <?php foreach ($device_name as $row) { ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
          <?php } ?>
        </select>
        <label for="location">地點</label>
        <input type="text" class="form-control" name="location">
        <label for="content">說明</label>
        <textarea class="form-control" name="content"></textarea>
        <input type="submit" class="btn btn-default" value="送出">
      </form>
    </div>
  </body>
</html>
