    <div class="main">
      <h1>確認是否刪除資料</h1><hr>
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/device/repair/delete'); ?>
      <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <table class="table">
          <tr>
            <td>裝置分類</td>
            <td><?php echo $result['dc_name']; ?></td>
          </tr>
          <tr>
            <td>裝置名稱</td>
            <td><?php echo $result['dn_name']; ?></td>
          </tr>
          <tr>
            <td>故障類別</td>
            <td><?php echo $result['fc_name']; ?></td>
          </tr>
          <tr>
            <td>位置</td>
            <td><?php echo $result['location']; ?></td>
          </tr>
          <tr>
            <td>狀態</td>
            <td><?php echo $result['StatusName']; ?></td>
          </tr>
          <tr>
            <td>新增時間</td>
            <td><?php echo $result['add_datetime']; ?></td>
          </tr>
          <tr>
            <td>備註</td>
            <td><?php echo $result['remark'] ?></td>
          </tr>
          <tr>
            <td>狀態</td>
            <td><?php echo $result['StatusName']; ?></td>
          </tr>
          <tr>
            <td>說明</td>
            <td><?php echo $result ['description']; ?></td>
          </tr>
        </table>
        <input type="submit" name="submit" value="刪除" class="btn btn-default">
      </form>
    </div>
  </body>
</html>
