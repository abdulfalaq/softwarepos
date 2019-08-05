<?php 
$no = 0;
$kode = $this->uri->segment(4);
$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.id, qty');
$this->db->select('clouoid1_olive_master.master_produk.nama_produk');
$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan_temp');
$this->db->join('clouoid1_olive_master.master_produk','clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_item','right');
$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan_temp.kode_transaksi', $kode);
$produk = $this->db->get()->result();
foreach ($produk as $value) { $no++;?>
<tr>
	<td><?php echo $no ?></td>
	<td><?php echo $value->nama_produk ?></td>
	<td><?php echo $value->qty ?></td>
	<td>
		<a onclick="actDel('<?php echo $value->id ?>','produk')" class="btn btn-no-radius btn-danger"><i class="fa fa-trash"></i></a>
		<a onclick="actEdit('<?php echo $value->id ?>','produk')" class="btn btn-no-radius btn-warning"><i class="fa fa-pencil"></i></a>
	</td>
</tr>
<?php }
?>