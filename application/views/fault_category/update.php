
      <div class="main">
      <h1>修改故障分類</h1>
      <hr>
      <?php validation_errors(); ?>
      <?php echo form_open('admin/fault/category/update'); ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="extends">繼承</label>
        <select class="form-control" name="extends">
          <?php foreach ($extends_device_name as $row) { ?>
            <?php $id = $row['id']; ?>
            <?php if($result['extends'] == $id){?>
            <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['dn_name']; ?></option>
            <?php }else{ ?>
            <option value="<?php echo $id; ?>"><?php echo  $row['dn_name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
        <label for="name">名稱</label>
        <input type="text" name="name" value="<?php echo $result['fc_name']; ?>" class="form-control">
        <input type="submit" name="submit" value="送出" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
