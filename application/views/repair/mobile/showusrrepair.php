<!doctype html>
<html>
  <head>
      <meta charset="utf-8">
      <title>設備故障通報查詢系統</title>
      <link rel="stylesheet" href="<?php echo base_url('css/jquery.mobile-1.4.5.min.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('css/mobile/repair_view.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
      <script type="text/javascript" src="<?php echo base_url('js/jquery-1.8.3.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('js/jquery.mobile-1.4.5.min.js'); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
    <body>
        <div data-role="page">
            <div data-role="header" id="ui-header">
                <h1>設備故障維修通報系統</h1>
            </div>
            <div data-role="panel" id="myPanel" style="background-color: rgba(180, 178, 178, 0.53);color: black;">
                <h2>搜尋功能</h2>
                <hr>
                <?php echo form_open('device/repair/showlst/search',array('method' => 'GET','data-ajax' => 'false')); ?>
                    <fieldset class="ui-field-contain">
                        <label for="location">地點</label>
                        <input type="text" name="location">
                    </fieldset>
                    <fieldset class="ui-field-contain">
                        <label for="status">狀態</label>
                        <select name="status">
                          <option></option>
                          <?php foreach ($status_result as $row) { ?>
                          <?php echo "<option value='".$row['id']."'>".$row['StatusName']."</option>"; ?>
                          <?php } ?></select></td>
                        </select>
                    </fieldset>
                    <input type="submit" name="submit" value="查詢">
                </form>
            </div>
            <div data-role="content" id="ui-content">
                <div data-role="navbar">
                    <ul>
                        <li><a href="<?php echo site_url('device/repair'); ?>" data-icon="home">報修頁面</a></li>
                        <li><a href="<?php echo site_url('device/repair/showlst'); ?>" data-icon="search">查詢報修狀態</a></li>
                    </ul>
                </div>
                <a href="#myPanel" class="ui-btn ui-btn-inline ui-corner-all ui-shadow">打開搜尋功能</a>
                <table width="100%">
                    <tr>
                      <td>裝置分類</td>
                      <td>裝置名稱</td>
                      <td>故障原因</td>
                      <td>設備位置</td>
                      <td>新增時間</td>
                      <!--<td>備註</td> -->
                      <td>維修狀態</td>
                      <td>說明</td>
                    </tr>
                    <?php foreach ($result as $row) { ?>
                    <tr>
                      <td><?php echo $row['dc_name']; ?></td>
                      <td><?php echo $row['dn_name']; ?></td>
                      <td><?php echo $row['fc_name']; ?></td>
                      <td><?php echo $row['location']; ?></td>
                      <td><?php echo $row['add_datetime']; ?></td>
                      <!--<td><?php echo $row['remark']; ?></td>-->
                      <td><?php echo $row['StatusName']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <?php echo $paginator; ?>
            </div>
            <div data-role="footer" id="footer">
                <h3>程式設計:小周<br>※如需瀏覽電腦版頁面，請點選<br>CHROME瀏覽器選項中的切換為電腦版網站</h3>
            </div>
        </div>
    </body>
</html>
