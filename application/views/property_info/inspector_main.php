    <div class="main">
      <script type="text/javascript" src="<?php echo base_url('js/jquery.tablesorter.js'); ?>"></script>
      <?php echo form_open('inspector/property/information/search',array('method' => 'GET')); ?>
      <table class="table">
        <tr>
            <td>設備分類</td>
            <td>
            <select name="device_category_id" class="form-control">
              <option value="" selected="selected"></option>
              <?php foreach ($device_category_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
              <?php } ?>
            </select>
            </td>
            <td>設備名稱</td>
            <td>
            <select name="device_name_id" id="Device_name" class="form-control">
              <option value="" selected="selected"></option>
              <?php foreach ($device_name_lst as $row) { ?>
              <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
              <?php } ?>
            </select>
            </td>
            <td>位置</td>
            <td><input type="text" class="form-control" name="location"></td>
            <td><input type="submit" class="btn btn-default" value="查詢"></td>
        </tr>
      </table>
      </form>
      <!--
      <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/property/information/qrcode/sync'); ?>'">全部同步（清除所有資料）</button>
      <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/property/information/qrcode/sync')."?section=ok"; ?>'">部分同步（僅同步新增/修改資料）</button>
      <br>
      <button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/property/information/add'); ?>'">新增資料</button>
      -->
      <table class="table" id="table-sorter">
        <thead>
        <tr>
          <td>財產編號</td>
          <td>舊序號</td>
          <td>設備分類</td>
          <td>設備名稱</td>
          <td>型號</td>
          <td>廠牌</td>
          <td>數量（單位）</td>
          <td>原始地點</td>
          <td>目前地點</td>
          <td>保管人</td>
          <td>修改目前位置</td>
          <!--
          <td>檢視</td>
          <td>修改</td>
          <td>刪除</td>
          -->
        </tr>
      </thead>
        <tbody>
          <?php foreach ($result as $row) { ?>
          <tr>
            <?php $id = $row['id']; ?>
            <td><?php echo $row['property_number']; ?></td>
            <td><?php echo $row['old_serial_number']; ?></td>
            <td><?php echo $row['dc_name']; ?></td>
            <td><?php echo $row['dn_name']; ?></td>
            <td><?php echo $row['model']; ?></td>
            <td><?php echo $row['label']; ?></td>
            <td><?php echo $row['qty']."(".$row['unit'].")"; ?></td>
            <td><?php echo $row['original_location']; ?></td>
            <td><?php echo $row['now_location']; ?></td>
            <td><?php echo $row['custodian']; ?></td>
            <td><botton type="button" class="btn btn-default" onclick="location_update(<?php echo $id; ?>);">修改財產位置</button></td>
            <!--
            <td><button type="button" class="btn btn-default" onclick="javascript:location.href='<?php echo site_url('admin/property/information/view/').$id; ?>'">檢視</button></td>
            <td><button type="button" class="btn btn-warning" onclick="javascript:location.href='<?php echo site_url('admin/property/information/update/').$id; ?>'">修改</button></td>
            <td><button type="button" class="btn btn-danger" onclick="javascript:location.href='<?php echo site_url('admin/property/information/delete/').$id; ?>'">刪除</button></td>
            -->
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <script type="text/javascript">
        $(document).ready(function(){
          $("#table-sorter").tablesorter();
        });
      </script>
      <script type="text/javascript">
        //更新資料
        var timer = 1000*5;
        function location_update(id){
          localStorage.setItem("status",0);
          window.open('<?php echo site_url('admin/property/information/nowlocation/update/'); ?>'+id, '財產目前位置更新', config='height=630,width=630');
          self.setTimeout(location_update_status,timer);
        }
        function location_update_status(){
          console.log("hello world");
          if(localStorage.getItem("status") != 0){
            console.log("status:"+localStorage.getItem("status"));
            localStorage.clear();
            //重新載入目前頁面
            window.location.reload();
          }
          self.setTimeout(location_update_status,timer);
        }
      </script>
      <?php  echo $paginator; ?>
    </div>
  </body>
</html>
