    <div class="main">
      <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
      <?php echo form_open('admin/website',array('id' => 'website')); ?>
        <h3>網站資訊設定</h3>
        <hr>
        <label for="title">網站標題</label>
        <input type="text" name="title" class="form-control" value="<?php echo $webinfo['website_title']; ?>"><br>
        <label for="content">內容簡介</label>
        <textarea class="form-control" name="content"><?php echo $webinfo['website_content']; ?></textarea><br>
        <h3>網站設定</h3>
        <hr>
        <label for="mobile">關閉手機版瀏覽</label><br>
        <select name="mobile" class="form-control">
          <?php if($webinfo['closeMobile'] == 0){ ?>
          <option value="0" selected>關閉瀏覽</option>
          <option value="1">啟用瀏覽</option>
          <?php }else{ ?>
          <option value="0">關閉瀏覽</option>
          <option value="1" selected>啟用瀏覽</option>
          <?php } ?>
        </select>
        <label for="website">關閉電腦版瀏覽</label><br>
        <select name="website" class="form-control">
          <?php if($webinfo['closeWebsite'] == 0){ ?>
          <option value="0" selected>關閉瀏覽</option>
          <option value="1">啟用瀏覽</option>
          <?php }else{ ?>
          <option value="0">關閉瀏覽</option>
          <option value="1" selected>啟用瀏覽</option>
          <?php } ?>
        </select>
        <br>
        <input type="submit" class="btn btn-default" value="修改網站設定">
      </form>
      <script type="text/javascript">
        $(document).ready(function(){
           $("#website").validate({
             title: "required",
             mobile: "required",
             website: "required"
           },messages:{
             title: "必要資訊，請務必輸入",
             mobile: "請務必設定",
             website: "請務必設定"
           });
        });
      </script>
    </div>
  </body>
</html>
