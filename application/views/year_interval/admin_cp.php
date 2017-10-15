<div class="main">
  <?php if(isset($_GET['success'])){ ?>
  <div class="alert alert-success" role="alert">操作已完成</div>
  <?php } ?>
  <?php if(isset($_GET['failed'])) { ?>
  <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
  <?php } ?>
  <h1>年度資料管理</h1>
  <hr>
  <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/year/interval/add'); ?>'">新增</button>
  <table class="table">
    <tr>
      <td>編號</td>
      <td>學年分類名稱</td>
      <td>預設狀態</td>
      <td>修改預設值</td>
      <td>修改</td>
      <td>刪除</td>
    </tr>
    <?php foreach ($result as $row) { ?>
    <tr>
      <td><?php $id = $row['id']; ?><?php echo $id; ?></td>
      <td><?php echo $row['yi_name']; ?></td>
      <td>
        <?php
          if($row['isEnable'] == 0){
            echo "否";
          }else{
            echo "是";
          }
        ?>
      </td>
      <td><button type="button" class="btn btn-primary" onclick="javascript:location.href='<?php echo site_url('admin/year/interval/set/default/').$id; ?>'">修改預設值</button></td>
      <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('admin/year/interval/update/').$id; ?>'">修改</button></td>
      <td><button type="button" class="btn btn-danger" onclick="javascript:location.href='<?php echo site_url('admin/year/interval/delete/').$id; ?>'">刪除</button></td>
    </tr>
    <?php } ?>
  </table>
  <?php echo $paginator; ?>
</div>
