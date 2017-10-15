      <div class="main">
        <script type="text/javascript" src="<?php echo base_url('js/jquery.tablesorter.js'); ?>"></script>
        <?php if(isset($_GET['success'])){ ?>
        <div class="alert alert-success" role="alert">操作已完成</div>
        <?php } ?>
        <?php if(isset($_GET['failed'])) { ?>
        <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
        <?php } ?>
        <h1>設備維修管理介面</h1>
        <hr>
        <?php echo form_open('inspector/device/repair/search',array('method' => 'GET')); ?>
          <table class="table">
            <tr>
              <td>搜尋教室：</td>
              <td><input type="text" name="location" class="form-control" value=""></td>
              <td>選擇狀態：</td>
              <td><select class="form-control" name="status">
                  <option>不限</option>
                  <?php foreach ($status_result as $row) { ?>
                  <?php echo "<option value='".$row['id']."'>".$row['StatusName']."</option>"; ?>
                  <?php } ?></select></td>
              <td><input type="submit" name="submit" class="btn btn-default" value="送出"></td>
            </tr>
          </table>
        </form>
        <!--
        <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/device/repair/add'); ?>'">新增</button>
        -->
        <table class="table table-striped" id="table-sorter">
          <thead>
            <tr>
              <!--
              <td>編號</td>
              <td>學年度</td>
              -->
              <td>設備類別</td>
              <td>設備名稱</td>
              <td>故障類別</td>
              <td>位置</td>
              <td>新增時間</td>
              <td>備註</td>
              <td>狀態</td>
              <td>敘述</td>
              <!--
              <td>檢視資料</td>
              -->
              <td>修改</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($result as $row) { ?>
            <?php $id = $row['id']; ?>
            <tr>
              <!--
              <td><?php echo $id; ?></td>
              <td><?php echo $row['yi_name']; ?></td>
              -->
              <td><?php echo $row['dc_name']; ?></td>
              <td><?php echo $row['dn_name']; ?></td>
              <td><?php echo $row['fc_name']; ?></td>
              <td><?php echo $row['location']; ?></td>
              <td><?php echo $row['add_datetime']; ?></td>
              <td><?php echo $row['remark']; ?></td>
              <td><?php echo $row['StatusName']; ?></td>
              <td><?php echo $row['description']; ?></td>
              <!--
              <td><button type="button" class="btn btn-primary" onclick="javascript:location.href='<?php echo site_url('inspector/device/repair/view/').$id; ?>'">檢視資料</button></td>
              -->
              <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('inspector/device/repair/updata/').$id; ?>'">修改</button></td>
            <?php } ?>
          </tbody>
        </table>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#table-sorter").tablesorter();
          });
        </script>
        <?php echo $paginator; ?>
      </div>
  </body>
</html>
