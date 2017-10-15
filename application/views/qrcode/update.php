    <div class="nav">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <?php validation_errors(); ?>
        <?php echo form_open('admin/qrcode/update'); ?>
          <input type="hidden" name="id" value="<?php echo $target_data['id']; ?>">
          <label for="title">標題</label>
          <input type="text" name="title" class="form-control" value="<?php echo $target_data['title']; ?>">
          <label for="category">設備分類</label>
          <select class="form-control" name="category">
            <?php foreach ($device_category as $row) { ?>
              <?php $id = $row['id']; ?>
              <?php if($id == $target_data['device_category_id']){ ?>
              <option value="<?php echo $id; ?>" selected><?php echo $row['dc_name']; ?></option>
              <?php }else{ ?>
              <option value="<?php echo $id; ?>"><?php echo $row['dc_name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="name">設備名稱</label>
          <select name="name" class="form-control">
            <?php foreach ($device_name as $row) { ?>
              <?php $id = $row['id']; ?>
              <?php if($id == $target_data['device_name_id']){ ?>
              <option value="<?php echo $id; ?>" selected><?php echo $row['dn_name']; ?></option>
              <?php }else{ ?>
              <option value="<?php echo $id; ?>"><?php echo $row['dn_name']; ?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label for="location">地點</label>
          <input type="text" class="form-control" name="location" value="<?php echo $target_data['location']; ?>">
          <label for="content">說明</label>
          <textarea class="form-control" name="content"><?php echo $target_data['content']; ?></textarea>
          <input type="submit" class="btn btn-default" value="送出">
        </form>
      </div>
      <div class="col-md-4"></div>
    </div>
  </body>
</html>
