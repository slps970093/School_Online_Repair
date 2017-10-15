<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>網站初始化設定</title>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js'); ?>"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
          .init_config{
            background-color: aqua;
            padding: 2%;
          }
        </style>
    </head>
    <body>
        <div class="init_config">
            <?php echo form_open('init',array('id' => 'config')); ?>
                <h1>網站初始化設定</h1>
                <hr>
                <div class="mag">
                    你好，因為你第一次執行這個網站，請完成以下設定，設定完成後你可以使用線上報修系統！<br>
                    設定完畢後，系統會自動鎖定初始化頁面，無法再進行設定（請到管理介面進行修改）!
                    <b>（*）為必要填寫資訊，請務必填寫完成</b>
                </div>
                <label for="title">網站名稱設定(*)</label>
                <input type="text" name="title" class="form-control"><br>
                <label for="content">網站簡介</label>
                <input type="text" name="content" class="form-control"><br>
                <label for="name">管理者名子</label>
                <input type="text" name="name" class="form-control"><br>
                <label for="username">管理者使用者名稱(*)</label>
                <input type="text" name="username" class="form-control"><br>
                <label for="password">管理者密碼(*)</label>
                <input type="password" name="password" class="form-control"><br>
                <input type="submit" class="btn btn-default" value="儲存網站資訊">
            </form>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#config").validate({
                        rules:{
                            'title': "required",
                            'username': "required",
                            'password': "required"
                        },messages:{
                            'title':"必要項目",
                            'username':"必要項目",
                            'password':"必要項目"
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>
