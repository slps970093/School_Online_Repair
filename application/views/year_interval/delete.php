    <div class="main">
      <h1>刪除年度</h1>
      <hr>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/year/interval/delete'); ?>
            <label for="id"></label>
            <input name="id" type="hidden" value="<?php echo $result['id']; ?>">
            如需刪除資料請按下送出
            <input type="submit" name="submit" class="btn btn-default" value="送出" />
        </form>
    </div>
  </body>
</html>
