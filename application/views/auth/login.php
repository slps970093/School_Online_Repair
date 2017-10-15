    <div class="col-md-4"></div>
    <div class="col-md-4">
      <?php echo validation_errors(); ?>
      <?php echo form_open('admin/auth/login'); ?>
        <h1>線上報修管理系統─登入介面</h1>
        <hr>
        <label for="username">管理者帳號</label>
        <input type="text" name="username" class="form-control">
        <label for="password">管理者密碼</label>
        <input type="password" name="password" class="form-control">
        <input type="submit" name="submit" class="btn btn-default" value="登入"/>
      </form>
    </div>
    <div class="col-md-4"></div>
  </body>
</html>
