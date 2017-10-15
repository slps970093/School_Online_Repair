<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
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
            <div data-role="content" id="ui-content">
                <div data-role="navbar">
                    <ul>
                      <li><a href="<?php echo site_url('device/repair'); ?>" data-icon="home">報修頁面</a></li>
                      <li><a href="<?php echo site_url('device/repair/showlst'); ?>" data-icon="search">查詢報修狀態</a></li>
                      <li><a href="<?php echo site_url('device/repair/showlst/search')."?location=".strip_tags($_GET['location']); ?>" data-icon="search">快速查詢報修狀態</a></li>
                    </ul>
                </div>
                <?php echo validation_errors(); ?>
                <?php  echo form_open('device/qrcode/repair',array('data-ajax' => 'false','id' => 'repair-form')); ?>
                <form data-ajax="false" id="repair-form">
                    <input type="hidden" name="year_id" value="<?php echo $default_year['id']; ?>">
                    <input type="hidden" name="category" value="<?php echo (int)strip_tags($_GET['category']); ?>">
                    <input type="hidden" name="name" value="<?php echo (int)strip_tags($_GET['name']); ?>">
                    <input type="hidden" name="location" value="<?php echo strip_tags($_GET['location']); ?>">
                    <div class="info">
                        你目前的報修地點為：<b><?php echo strip_tags($_GET['location']); ?></b><br>
                        請填寫以下資訊完成報修動作！！！如報修地點錯誤請點選報修頁面
                    </div>
                    <fieldset class="ui-field-contain">
                        <label for="fault">故障分類</label>
                        <select name="fault" id="fault_category">
                          <option value="" selected="selected"></option>
                          <?php foreach ($fault_category_lst as $row) { ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['fc_name']; ?></option>
                          <?php } ?>
                        </select>
                    </fieldset>
                    <fieldset class="ui-field-contain">
                        <label for="remark">備註</label>
                        <textarea name="remark"></textarea>
                    </fieldset>
                    <input type="submit" value="送出報修">
                </form>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#repair-form").validate({
                            rules:{
                                'fault': "required"
                            },messages:{
                                'fault':"必要項目"
                            }
                        });
                    });
                </script>
            </div>
            <div data-role="footer" id="footer">
                <h3>程式設計:小周<br>※如需瀏覽電腦版頁面，請點選CHROME瀏覽器選項中的切換為電腦版網站</h3>
            </div>
        </div>
    </body>
</html>
