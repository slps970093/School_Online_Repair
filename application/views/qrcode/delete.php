      <div class="main">
        <?php echo form_open('admin/qrcode/delete'); ?>
          <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
          <table class="table">
            <tr>
              <td>設備名稱</td>
              <td><?php echo $result['dn_name']; ?></td>
            </tr>
            <tr>
              <td>設備分類</td>
              <td><?php echo $result['dc_name']; ?></td>
            </tr>
            <tr>
              <td>標題</td>
              <td><?php echo $result['title']; ?></td>
            </tr>
            <tr>
              <td>內容</td>
              <td><?php echo $result['content']; ?></td>
            </tr>
            <tr>
              <td colspan="2">
                <table width="100%">
                  <tr>
                    <td>報修QR-Code</td>
                    <td>查詢Qr-Code</td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo base_url('qrcode/').$result['repair_file']; ?>" width="100px" height="100px"></td>
                    <td><img src="<?php echo base_url('qrcode/').$result['repair_file']; ?>" width="100px" height="100px"></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <input type="submit" class="btn btn-default" value="刪除">
        </from>
      </div>
    </body>
  </html>
