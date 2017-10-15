      <div class="main">
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
        <h1>新增財產資料</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/property/information/add',array('id' => 'myform')); ?>
        <label for="property_number">財產編號</label>
        <input type="text" class="form-control" name="property_number"><br>
        <label for="old_serial_number">舊序號</label>
        <input type="text" class="form-control" name="old_serial_number"><br>
        <label for="device_category_id">設備分類</label>
        <select name="device_category_id" class="form-control">
          <option value="" selected="selected">請選擇</option>
          <?php foreach ($device_category_lst as $row) { ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
          <?php } ?>
        </select><br>
        <label for="device_name_id">設備名稱</label>
        <select name="device_name_id" id="Device_name" class="form-control">
          <option value="" selected="selected">請選擇</option>
          <?php foreach ($device_name_lst as $row) { ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
          <?php } ?>
        </select><br>
        <label for="specification">規格</label>
        <input type="text" class="form-control" name="specification"><br>
        <label for="model">型號</label>
        <input type="text" class="form-control" name="model"><br>
        <label for="label">廠牌</label>
        <input type="text" class="form-control" name="label"><br>
        <label for="qty">數量</label>
        <input type="number" class="form-control" name="qty"><br>
        <label for="unit">單位</label>
        <input type="text" class="form-control" name="unit"><br>
        <label for="date_of_entry">入賬日期</label>
        <input type="date" class="form-control" name="date_of_entry"><br>
        <label for="acceptance_date">驗收日期</label>
        <input type="date" class="form-control" name="acceptance_date"><br>
        <label for="warranty_date">保固日期起</label>
        <input type="date" class="form-control" name="warranty_date"><br>
        <label for="warranty_date_end">保固日期迄</label>
        <input type="date" class="form-control" name="warranty_date_end"><br>
        <label for="years_of_use">使用年限</label>
        <input type="number" class="form-control" name="years_of_use"><br>
        <label for="source_of_funding">經費來源</label>
        <input type="text" class="form-control" name="source_of_funding"><br>
        <label for="custody_unit">保管單位</label>
        <input type="text" class="form-control" name="custody_unit"><br>
        <label for="original_location">原始位置</label>
        <input type="text" class="form-control" name="original_location"><br>
        <label for="now_location">目前位置</label>
        <input type="text" class="form-control" name="now_location"><br>
        <label for="custodian">保管人</label>
        <input type="text" class="form-control" name="custodian"><br>
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
