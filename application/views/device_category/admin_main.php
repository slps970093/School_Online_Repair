<div class="main">
  <?php if(isset($_GET['success'])){ ?>
  <div class="alert alert-success" role="alert">操作已完成</div>
  <?php } ?>
  <?php if(isset($_GET['failed'])) { ?>
  <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
  <?php } ?>
  <h1>設備分類管理</h1>
  <hr>
  <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/device/category/add'); ?>'">新增</button>
  <table class="table">
    <tr>
      <td>編號</td>
      <td>名稱</td>
      <td>修改</td>
      <td>刪除</td>
    </tr>
    <?php foreach ($result as $row) { ?>
    <?php $id = $row['id']; ?>
    <tr>
      <td><?php echo $id ?></td>
      <td><?php echo $row['dc_name'] ?></td>
      <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('admin/device/category/update/').$id; ?>'">修改</button></td>
      <td><button type="button" class="btn btn-danger" onclick="javascript:location.href='<?php echo site_url('admin/device/category/delete/').$id; ?>'">刪除</button></td>
    </tr>
    <?php } ?>
  </table>
  <?php echo $paginator; ?>
</div>
