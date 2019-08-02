    <?php
    if($num_rows > 0){
      $i = 0;
      foreach ($result as $item) {
          $i++;
          ?>
          <tr style="font-size: 15px;">
            <td><?php echo $i; ?></td>
            <td><?php echo $item->nama_bahan; ?></td>
            <td><?php echo $item->jumlah; ?></td>
            <td><?php echo $item->harga; ?></td>
            <td><?php echo $item->jenis_diskon=="persen"?$item->diskon_item." %":"Rp. ".$item->diskon_item; ?></td>
            <td><?php echo $item->subtotal; ?></td>
            <td>
                <button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $item->id; ?>);"><i class="fa fa-times"></i></button>
                <button type="button" class="btn btn-info" onclick="actEdit(<?php echo $item->id; ?>);"><i class="fa fa-edit"></i></button>
            </td>
        </tr>
        <?php
    }
}else{ ?>
<tr>
    <td colspan="9" align="center">Tidak ada yang dibeli</td>
</tr>
<?php } ?>

