<?php
$nomor = 1;
$total_transaksi = 0;
foreach($result as $daftar){ 

  ?> 
  <tr>
    <td><?php echo $nomor; ?></td>
    <td>
      <?php if(@$daftar->jenis_item =='Paket'){ 
        echo @$daftar->nama_paket; 
      }else{ 
        echo @$daftar->nama_perawatan; 
      } ?>
    </td>
    <td>
      <a onclick="actDelete(<?php echo $daftar->id ?>)" class="btn btn-sm btn-danger">Delete</a>
    </td>
  </tr>
  <?php 
  $nomor++; 
} 
?>
<input type="hidden" id="jumlah_data" value="<?php echo $nomor ?>">