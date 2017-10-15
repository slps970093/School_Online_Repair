    <div class="main">
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/year/interval/set/default'); ?>
        <label for="id"></label>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <label for="isEnable">預設值修改</label>
        <select class="form-control" name="isEnable">
          <?php
            if($result['isEnable'] == 1){
              echo "<option value='1' selected='selected'>是</option>";
              echo "<option value='0'>否</option>";
            }else{
              echo "<option value='1'>是</option>";
              echo "<option value='0' selected='selected'>否</option>";
            }
          ?>
        </select>
        <input type="submit" name="submit" class="btn btn-default" value="送出">
      </form>
    </div>
  </body>
</html>
