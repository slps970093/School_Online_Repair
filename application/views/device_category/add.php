      <div class="main">
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
        <h1>新增裝置分類</h1>
        <hr>
        <?php validation_errors(); ?>
        <?php echo form_open('admin/device/category/add'); ?>
          <label for="name">名稱</label>
          <input type="text" name="name" class="form-control"><br>
          <input type="submit" name="submit" value="送出" class="btn btn-default">
        </form>
      </div>
  </body>
</html>
