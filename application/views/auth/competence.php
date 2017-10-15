    <div class="main">
      <h1>修改權限</h1>
      <hr>
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/auth/competence'); ?>
        <label for="id"></label>
        <input type="hidden" name="id" value="<?php echo $target_data['uid']; ?>">
        <label for="competence">權限</label>
        <select class="form-control" name="competence">
          <?php if($target_data['competence'] == "admin"){ ?>
          <option value="admin" selected="selected">管理者</option>
          <option value="inspector">檢修員</option>
          <?php }else{ ?>
          <option value="admin">管理者</option>
          <option value="inspector" selected="selected">檢修員</option>
          <?php } ?>
        </select>
        <input type="submit" name="submit" class="btn btn-default" value="送出" />
      </form>
    </div>
  </body>
</html>
