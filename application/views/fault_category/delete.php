      <div class="main">
        <h1>刪除故障分類</h1><hr>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/fault/category/delete'); ?>
          <table class="table">
            <tr>
              <td>編號</td>
              <td><?php $id = $result['id']; ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php echo $id; ?></td>
            </tr>
            <tr>
              <td>狀態名稱</td>
              <td><?php echo $result['fc_name']; ?></td>
            </tr>
          </table>
          <input type="submit" name="submit" class="btn btn-default" value="送出">
        </form>
      </div>
  </body>
</html>
