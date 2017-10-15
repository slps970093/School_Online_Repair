      <div class="main">
        <h1>修改財產資料</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/property/information/update'); ?>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="property_number">財產編號</label>
        <input type="text" class="form-control" name="property_number" value="<?php echo $result['property_number']; ?>">
        <label for="old_serial_number">舊序號</label>
        <input type="text" class="form-control" name="old_serial_number" value="<?php echo $result['old_serial_number']; ?>">
        <label for="device_category_id">設備分類</label>
        <select name="device_category_id" class="form-control">
          <?php foreach ($device_category_lst as $row) { ?>
            <?php $id = $row['id']; ?>
            <?php if($result['device_category_id'] == $id){ ?>
            <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['dc_name']; ?></option>
            <?php }else{ ?>
            <option value="<?php echo $id; ?>"><?php echo $row['dc_name']; ?></option>
            <?php } ?>
          <?php } ?>
        </select>
        <label for="device_name_id">設備名稱</label>
        <select name="device_name_id" id="Device_name" class="form-control">
          <?php foreach ($device_name_lst as $row) { ?>
          <?php $id = $row['id']; ?>
          <?php if($result['device_name_id'] == $id){ ?>
          <option value="<?php echo $id; ?>" selected="selected"><?php echo $row['dn_name']; ?></option>
          <?php }else{ ?>
          <option value="<?php echo $id; ?>"><?php echo $row['dn_name']; ?></option>
          <?php } ?>
          <?php } ?>
        </select>
        <label for="specification">規格</label>
        <input type="text" class="form-control" name="specification" value="<?php echo $result['specification']; ?>">
        <label for="model">型號</label>
        <input type="text" class="form-control" name="model" value="<?php echo $result['model']; ?>">
        <label for="label">廠牌</label>
        <input type="text" class="form-control" name="label" value="<?php echo $result['label']; ?>">
        <label for="qty">數量</label>
        <input type="number" class="form-control" name="qty" value="<?php echo $result['qty']; ?>">
        <label for="unit">單位</label>
        <input type="text" class="form-control" name="unit" value="<?php echo $result['unit']; ?>">
        <label for="date_of_entry">入賬日期</label>
        <input type="date" class="form-control" name="date_of_entry" value="<?php echo $result['date_of_entry']; ?>">
        <label for="acceptance_date">驗收日期</label>
        <input type="date" class="form-control" name="acceptance_date" value="<?php echo $result['acceptance_date']; ?>">
        <label for="warranty_date">保固日期起</label>
        <input type="date" class="form-control" name="warranty_date" value="<?php echo $result['warranty_date']; ?>">
        <label for="warranty_date_end">保固日期迄</label>
        <input type="date" class="form-control" name="warranty_date_end" value="<?php echo $result['warranty_date_end']; ?>">
        <label for="years_of_use">使用年限</label>
        <input type="number" class="form-control" name="years_of_use" value="<?php echo $result['years_of_use']; ?>">
        <label for="source_of_funding">經費來源</label>
        <input type="text" class="form-control" name="source_of_funding" value="<?php echo $result['source_of_funding']; ?>">
        <label for="custody_unit">保管單位</label>
        <input type="text" class="form-control" name="custody_unit" value="<?php echo $result['custody_unit']; ?>">
        <label for="original_location">原始位置</label>
        <input type="text" class="form-control" name="original_location" value="<?php echo $result['original_location']; ?>">
        <label for="now_location">目前位置</label>
        <input type="text" class="form-control" name="now_location" value="<?php echo $result['now_location']; ?>">
        <label for="custodian">保管人</label>
        <input type="text" class="form-control" name="custodian" value="<?php echo $result['custodian']; ?>">
        <input type="submit" class="btn btn-default" value="送出">
      </form>
      <script type="text/javascript">
        $(document).ready(function(){
          $("#myform").validate({
            rules:{
              property_number: "required",
              old_serial_number: "required",
              device_category_id: "required",
              device_name_id: "required",
              model: "required",
              label: "required",
              qty: {
                number: true,
                required: true
              },
              unit: "required",
              date_of_entry:{
                date: true,
                required: true
              },
              acceptance_date:{
                date: true,
                required: true
              },
              warranty_date: {
                date: true,
                required: true
              },
              warranty_date_end: {
                date: true,
                required: true
              },
              years_of_use: {
                number: true,
                required: true
              },
              source_of_funding: "required",
              custody_unit: "required",
              original_location: "required",
              now_location: "required",
              custodian: "required"
            },messages:{
              property_number: "必要項目",
              old_serial_number: "必要項目",
              device_category_id: "必要項目",
              device_name_id: "必要項目",
              model: "必要項目",
              label: "必要項目",
              qty: {
                number: "請輸入數值資料",
                required: "必要資訊請務必填寫"
              },
              unit: "必要項目",
              date_of_entry: {
                date: "請輸入正確的日期",
                required: "必要資訊請務必填寫"
              },
              acceptance_date: {
                date: "請輸入正確的日期",
                required: "必要資訊請務必填寫"
              },
              warranty_date: {
                date: "請輸入正確的日期",
                required: "必要資訊請務必填寫"
              },
              warranty_date_end: {
                date: "請輸入正確的日期",
                required: "必要資訊請務必填寫"
              },
              years_of_use: "必要項目",
              source_of_funding: "必要項目",
              custody_unit: "必要項目",
              original_location: "必要項目",
              now_location: "必要項目",
              custodian: "必要項目"
            }
          });
        });
      </script>
      </div>

  </body>
</html>
