      <div class="main">
        <h1>更新設備故障資料</h1>
        <hr>
          <?php echo validation_errors(); ?>
          <?php echo form_open('inspector/device/repair/updata'); ?>
            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
            <table class="table">
              <tr>
                <td>學年度</td>
                <td><?php echo $row['yi_name']; ?></td>
              </tr>
              <tr>
                <td>設備類別</td>
                <td><?php echo $row['dc_name']; ?></td>
              </tr>
              <tr>
                <td>設備名稱</td>
                <td><?php echo $row['dn_name']; ?></td>
              </tr>
              <tr>
                <td>故障類別</td>
                <td><?php echo $row['fc_name']; ?></td>
              </tr>
              <tr>
                <td>位置</td>
                <td><?php echo $row['location']; ?></td>
              </tr>
              <tr>
                <td>狀態</td>
                <td><?php echo $row['StatusName']; ?></td>
              </tr>
            </table>
            <h3>管理者自行新增或修改</h3>
            <hr>
            <label for="status">維修狀態</label>
            <select class="form-control" name="status">
              <?php foreach ($repair_status_lst as $row) { ?>
                <?php $id = $row['id']; ?>
                <?php if($id == $result['is_status']){ ?>
                  <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['StatusName']; ?></option>
                <?php }else{ ?>
                  <option value="<?php echo $id; ?>"><?php echo $row['StatusName']; ?></option>
                <?php } ?>
              <?php } ?>
            </select>
            <label for="description">說明</label>
            <textarea name="description" rows="8" cols="80" class="form-control"><?php echo $result['description']; ?></textarea>
            <input type="submit" name="submit" class="btn btn-default" value="送出">
          </form>
        </div>
  </body>
</html>
