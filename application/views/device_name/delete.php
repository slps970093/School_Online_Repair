      <div class="main">
        <?php validation_errors(); ?>
        <?php echo form_open('admin/device/name/delete'); ?>
        <h1>刪除設備名稱</h1>
        <hr>
          <table class="table">
            <tr>
              <td>編號</td>
              <td><?php $id = $result['id']; ?><input type="hidden" name="id" value="<?php echo $id; ?>"><?php echo $id; ?></td>
            </tr>
            <tr>
              <td>狀態名稱</td>
              <td><?php echo $result['dn_name']; ?></td>
            </tr>
          </table>
          <input type="submit" name="submit" class="btn btn-default" value="送出">
        </form>
      </div>
  </body>
</html>
