<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            @import url(https://fonts.googleapis.com/earlyaccess/notosanstc.css);
            body{
                font-family: 'Noto Sans TC';
            }
            header{
                text-align: center;
                background-color: aqua;
                padding: 2.5%;
            }
            footer{
                background-color: aqua;
                text-align: center;
                padding: 1.5%
            }
            .main{
                background-color: aquamarine;
                padding: 1.5%;
            }
            .readme{
                background-color: beige;
                padding: 1.5%;
                border-radius: 10px;
            }
            .add-range{
                background-color: rgba(63, 229, 222, 0.37);
                padding: 1.5%;
                border-radius:10px;
            }
        </style>
    </head>
    <body>
        <header><h1>檢修員資料政策管理</h1></header>
        <div class="main">
            <div class="readme">
                <h2>注意事項</h2><hr>
                一組帳號只能管理管理一個<b>設備分類</b><br>
                如果沒定義資料政策，將依照系統將依照預設設定不限制檢修類別
            </div>
            <h3>允許本用戶資料管理範圍</h3>

            <div class="range-data">
                <table class="table">
                    <tr>
                        <td>允許管理資料範圍</td>
                        <td>撤銷資料管理範圍</td>
                    </tr>
                    <?php foreach ($data_management as $row) { ?>
                    <tr>
                        <td><?php echo $row['device_category_id']; ?></td>
                        <td><button class="btn btn-default">撤銷</button></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="add-range">
                <?php echo form_open('admin/data/management'); ?>
                    <h3>新增資料政策</h3>
                    <hr>
                    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
                    <label for="device_category">設備分類</label>
                    <select class="form-control" name="device_category">
                      <option selected></option>
                      <?php foreach ($device_category_data as $row) { ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['dc_name']; ?></option>
                      <?php } ?>
                    </select>
                    <input type="submit" class="btn btn-default" value="設定政策">
                </form>
            </div>

        </div>
        <footer>程式設計：小周</footer>
    </body>
</html>
