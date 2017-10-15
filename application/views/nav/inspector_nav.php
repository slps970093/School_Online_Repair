<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('inspector'); ?>"><?php echo $webinfo['website_title']; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        -->
        <li><a href="<?php echo site_url('inspector/device/repair'); ?>">報修資料管理</a></li>
        <li><a href="<?php echo site_url('inspector/property/information'); ?>">財產資料管理</a></li>
        <!--
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">功能選單<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('admin/year/interval'); ?>">年度資料管理</a></li>
            <li><a href="<?php echo site_url('admin/device/name'); ?>">設備名稱管理</a></li>
            <li><a href="<?php echo site_url('admin/device/category'); ?>">設備分類管理</a></li>
            <li><a href="<?php echo site_url('admin/device/repair'); ?>">報修資料管理</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url('admin/fault/category'); ?>">故障分類管理</a></li>
            <li><a href="<?php echo site_url('admin/device/repair/status'); ?>">狀態資料管理</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        -->
      </ul>
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      -->
      <ul class="nav navbar-nav navbar-right">
        <!--
        <li><a href="#">Link</a></li>
        -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">檢修員(<?php $this->authhelper->show_login_name(); ?>)你好<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url(); ?>">切換回首頁</a></li>
            <li><a href="<?php echo site_url('auth/logout'); ?>">登出</a></li>
            <!--
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            -->
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<script type="text/javascript">
  $('.dropdown-toggle').dropdown()
</script>
