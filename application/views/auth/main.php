<div class="main">
  <?php if(isset($_GET['success'])){ ?>
  <div class="alert alert-success" role="alert">操作已完成</div>
  <?php } ?>
  <?php if(isset($_GET['failed'])) { ?>
  <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
  <?php } ?>
  <h1>帳戶管理系統</h1><hr>
  <button type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('admin/auth/add'); ?>'">新增資料</button><br>
  <table class="table">
      <tr>
          <td>帳戶名稱</td>
          <td>用戶名字</td>
          <td>權限</td>
          <td>修改權限</td>
          <td>定義資料管理範圍</td>
          <td>修改用戶名子</td>
          <td>修改帳號</td>
          <td>修改密碼</td>
          <td>刪除</td>
      </tr>
      <?php foreach ($usr_data as $row) { ?>
      <tr>
          <?php $id = $row['uid']; ?>
          <td><?php echo $row['uUsername']; ?></td>
          <td><?php echo $row['uName']; ?></td>
          <td>
            <?php
              if($row['competence'] == "admin"){
                echo "系統管理員";
                $isAdmin = true;
              }else{
                echo "檢修人員";
                $isAdmin = false;
              }
             ?>
          </td>
          <td>
            <?php if($id != 1 || $isAdmin ==false){ ?>
            <button type="button" class="btn btn-warning" onclick="location.href='<?php echo site_url('admin/auth/competence/').$id;?>'">修改權限</button>
            <?php } ?>
          </td>
          <td><button type="button" class="btn btn-default" onclick="window.open('<?php echo site_url('admin/data/management/').$id;?>');">定義資料管理範圍</button></td>
          <td><button type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('admin/auth/update/name/').$id;?>'">修改管理者用戶名稱</button></td>
          <td><button type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('admin/auth/usr_update/').$id;?>'">修改管理者名稱</button></td>
          <td><button type="button" class="btn btn-default" onclick="location.href='<?php echo site_url('admin/auth/pwd_update/').$id;?>'">修改管理者密碼</button></td>
          <td>
            <?php if($id != 1){ ?>
            <button type="button" class="btn btn-warning" onclick="location.href='<?php echo site_url('admin/auth/delete/').$id;?>'">刪除</button>
            <?php } ?>
          </td>
      </tr>
      <?php } ?>
  </table>
  <?php echo $paginator; ?>
</div>
