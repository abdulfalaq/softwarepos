    <?php
    if($num_rows > 0){
      $i = 0;
      foreach ($result as $item) {
        $i++;
        ?>
        <tr style="font-size: 15px;">
          <td><?php echo $i; ?></td>
          <td><?php echo $item->nama_bahan; ?></td>
          <td>
            <button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $item->id; ?>);"><i class="fa fa-times"></i></button>
          </td>
        </tr>
        <?php
      }
    }else{ ?>
    <tr>
      <td colspan="9" align="center">Tidak ada yang dibeli</td>
    </tr>
    <?php } ?>

