<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>修改設備地點</title>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
        <!-- 最新編譯和最佳化的 CSS -->
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <!-- 最新編譯和最佳化的 JavaScript -->
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.validate.js'); ?>" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            @import url(https://fonts.googleapis.com/earlyaccess/notosanstc.css);
            body{
                font-family: 'Noto Sans TC';
            }
        </style>
    </head>
    <body style="background-color:#fce4c5;">
        <header style="text-align: center; background-color: darkcyan;color: white; padding: 1.5%;">
            <h1>修改設備地點</h1>
        </header>
        <div class="data-view" style="background-color:#2787dd ;padding: 2.5%; margin: 1.5%; color: #ffffff;border-radius:10px;">
            <h2>請確認你要修改的資料如下:</h2><hr><br>
            <table width="100%">
                <tr>
                    <td>設備名稱：</td>
                    <td><?php echo $result['dn_name']; ?></td>
                </tr>
                <tr>
                    <td>型號：</td>
                    <td><?php echo $result['model']; ?></td>
                </tr>
                <tr>
                    <td>目前放置位置：</td>
                    <td><?php echo $result['now_location']; ?></td>
                </tr>
            </table><br>
            <font style="color:#f5ff00;font-size: 17px;">注意：更新地點完畢後，管理介面會自動更新頁面！不需手動更新！</font>
        </div>
        <div class="main" style="margin: 2.5%;line-height:45px;">
            <?php echo form_open('admin/property/information/nowlocation/update',array('id'=>'update-form')); ?>
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                <lobel for="location">目前位置（*）</lobel>
                <input type="text" name="location" class="form-control" value="<?php echo $result['now_location']; ?>">
                <br>
                <input type="submit" name="submit" class="btn btn-default" value="修改">
            </form>
            <!-- form validate code -->
            <script type="text/javascript">
                    $("#update-form").validate({
                        rules:{
                            location: {
                                required: true,
                                minlength: 3,
                                maxlength: 15
                            }
                        },
                        messages:{
                            location: {
                                required: "欄位為必填項目",
                                minlength: "欄位字串不得低於三字元",
                                maxlength: "欄位字串超過上限，不得超過15字"
                            }
                        }
                    });
            </script>
        </div>
        <footer style="text-align: center; background-color: darkcyan;color: white; padding: 1.5%;">
            介面設計/軟體設計：小周
        </footer>
    </body>
</html>
