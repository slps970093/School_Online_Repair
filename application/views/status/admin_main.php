  <div class="main">
    <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/device/repair/status/add'); ?>'">新增</button>
    <h1>狀態新增</h1>
    <hr>
    <table class="table">
      <tr>
        <td>#</td>
        <td>狀態名稱</td>
        <td>修改</td>
        <td>刪除</td>
      </tr>
      <?php foreach ($result as $row) {  ?>
      <tr>
        <?php $id = $row['id']; ?>
        <td><?php echo $id; ?></td>
        <td><?php echo $row['StatusName']; ?></td>
        <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('admin/device/repair/status/update/').$id; ?>'">修改</button></td>
        <td>
          <?php if($id!=1){ ?>
          <button type="button" class="btn btn-danger" onclick="javascript:location.href='<?php echo site_url('admin/device/repair/status/delete/').$id; ?>'">刪除</button>
          <?php } ?>
        </td>
      </tr>
      <?php } ?>
    </table>
    <?php echo $paginator; ?>
  </div>
