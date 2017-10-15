      <div class="main">
        <h1>刪除管理者</h1>
        <hr>
          <?php echo validation_errors(); ?>
          <?php echo form_open('admin/auth/delete'); ?>
              <label for="id"></label>
              <input name="id" type="hidden" value="<?php echo $target_data['uid']; ?>">
              如需刪除資料請按下送出
              <input type="submit" name="submit" class="btn btn-default" value="送出" />
          </form>
      </div>
  </body>
</html>
