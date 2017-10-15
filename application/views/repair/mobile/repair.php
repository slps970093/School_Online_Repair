<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>設備故障通報系統</title>
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
                    </ul>
                </div>
                <div style="text-align: center;">
                  預設資料集：<?php echo $default_year['yi_name']; ?><br>開放報修時間：<?php echo $default_year['start_date']; ?>到<?php echo $default_year['end_date']; ?>止，超過時間系統將停止報修！
                </div>
                <?php if(isset($_GET['success'])){ ?>
                <div class="alert alert-success" role="alert">操作已完成</div>
                <?php } ?>
                <?php if(isset($_GET['failed'])) { ?>
                <div class="alert alert-warning" role="alert">操作失敗，請聯絡系統管理員</div>
                <?php } ?>
                <?php echo validation_errors(); ?>
                <?php echo form_open(site_url('device/qrcode/repair'),array('data-ajax' => 'false','id' => 'repair-form')); ?>
                    <input type="hidden" name="year_id" value="<?php echo $default_year['id']; ?>">
                    <fieldset class="ui-field-contain">
                        <label for="category">設備分類</label>
                        <select name="category">
                          <option value="" selected="selected"></option>
                          <?php foreach ($device_category_lst as $row) { ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
                          <?php } ?>
                        </select>
                    </fieldset>
                    <fieldset class="ui-field-contain">
                        <label for="name">設備名稱</label>
                        <select name="name" id="Device_name">
                          <option value="" selected="selected"></option>
                          <?php foreach ($device_name_lst as $row) { ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['dn_name']; ?></option>
                          <?php } ?>
                        </select>
                    </fieldset>
                    <fieldset class="ui-field-contain">
                        <label for="location">位置</label>
                        <input type="text" name="location">
                    </fieldset>
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
                                'category': "required",
                                'name' : "required",
                                'location': "required",
                                'fault': "required",
                            },messages:{
                                'category': "必要項目",
                                'name': "必要項目",
                                'location': "必要項目",
                                'fault':"必要項目"
                            }
                        });
                        //當 id Device_name被點擊
                        $("#Device_name").click(function(){
                          //清空
                          $("#fault_category").empty();
                        });
                        //如果 id Device_name 被更改
                        $("#Device_name").change(function(){
                          var change_value = $("#Device_name").val();
                          var url = "<?php echo $ajax_fault_category_url; ?>"+change_value;
                          //Ajax
                          $.getJSON(url,function(data){
                            $("#fault_category").append("<option selected='selected'>請選擇</option>");
                            $.each(data,function(i,item){
                              $("#fault_category").append("<option value='"+item.id+"'>"+item.name+"</option>");
                            })
                          });
                        });
                    });
                </script>
            </div>
            <div data-role="footer" id="footer">
                <h3>程式設計:小周<br>※如需瀏覽電腦版頁面，請點選<br>CHROME瀏覽器選項中的切換為電腦版網站</h3>
            </div>
        </div>
    </body>
</html>
