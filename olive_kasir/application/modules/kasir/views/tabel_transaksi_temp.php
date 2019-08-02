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

    <td><?php echo @format_rupiah($daftar->harga); ?></td>
    <td>
      <?php if(@$daftar->jenis_diskon =='persen'){ 
        echo @$daftar->diskon_persen.''."%"; 
      }else{ 
        echo format_rupiah(@$daftar->diskon_rupiah); 
      }?>
    </td>
    <td>
      <?php echo format_rupiah(@$daftar->subtotal); ?>
    </td>
    <td>
      <a onclick="actDelete(<?php echo $daftar->id ?>)" class="btn btn-sm btn-danger">Delete</a>
    </td>
  </tr>
  <?php 
  $total_transaksi += $daftar->subtotal;
  $nomor++; 
} 
?>
