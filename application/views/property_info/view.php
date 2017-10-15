      <div class="main">
        <h1>檢視資料</h1>
        <hr>
        <table class="table">
          <tr>
            <td>財產編號</td>
            <td><?php echo $result['property_number']; ?></td>
          </tr>
          <tr>
            <td>舊序號</td>
            <td><?php echo $result['old_serial_number']; ?></td>
          </tr>
          <tr>
            <td>設備分類</td>
            <td><?php echo $result['dc_name']; ?></td>
          </tr>
          <tr>
            <td>設備名稱</td>
            <td><?php echo $result['dn_name']; ?></td>
          </tr>
          <tr>
            <td>規格</td>
            <td><?php echo $result['specification']; ?></td>
          </tr>
          <tr>
            <td>型號</td>
            <td><?php echo $result['model']; ?></td>
          </tr>
          <tr>
            <td>廠牌</td>
            <td><?php echo $result['label']; ?></td>
          </tr>
          <tr>
            <td>數量</td>
            <td><?php echo $result['qty']."(".$result['unit'].")"; ?></td>
          </tr>
          <tr>
            <td>入賬日期</td>
            <td><?php echo $result['date_of_entry']; ?></td>
          </tr>
          <tr>
            <td>驗收日期</td>
            <td><?php echo $result['acceptance_date']; ?></td>
          </tr>
          <tr>
            <td>保固日期起</td>
            <td><?php echo $result['warranty_date']; ?></td>
          </tr>
          <tr>
            <td>保固日期迄</td>
            <td><?php echo $result['warranty_date_end']; ?></td>
          </tr>
          <tr>
            <td>使用年限</td>
            <td><?php echo $result['years_of_use']; ?></td>
          </tr>
          <tr>
            <td>經費來源</td>
            <td><?php echo $result['source_of_funding']; ?></td>
          </tr>
          <tr>
            <td>保管單位</td>
            <td><?php echo $result['custody_unit']; ?></td>
          </tr>
          <tr>
            <td>放置位置</td>
            <td><?php echo $result['location']; ?></td>
          </tr>
          <tr>
            <td>保管人</td>
            <td><?php echo $result['custodian']; ?></td>
          </tr>
        </table>
      </div>
  </body>
</html>
