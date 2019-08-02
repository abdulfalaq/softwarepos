<?php 
$no = 0;
$kode = $this->uri->segment(4);
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.id, qty');
$this->db->select('olive_master.master_produk.nama_produk');
$this->db->from('olive_kasir.opsi_transaksi_layanan_temp');
$this->db->join('olive_master.master_produk','olive_master.master_produk.kode_produk = olive_kasir.opsi_transaksi_layanan_temp.kode_item','right');
$this->db->where('olive_kasir.opsi_transaksi_layanan_temp.kode_transaksi', $kode);
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