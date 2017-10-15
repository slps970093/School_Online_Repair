    <div class="main">
      <?php echo form_open('admin/device/repair/status/update'); ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="name">狀態名</label>
        <input type="text" name="name" class="form-control" value="<?php echo $result['StatusName']?>">
        <input type="submit" name="submit" value="送出" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
