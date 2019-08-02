<?php 
$no = 0;
$kode = $this->uri->segment(4);
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.id, qty');
$this->db->select('olive_master.master_perawatan.nama_perawatan');
$this->db->from('olive_kasir.opsi_transaksi_layanan_temp');
$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_kasir.opsi_transaksi_layanan_temp.kode_item','right');
$this->db->where('olive_kasir.opsi_transaksi_layanan_temp.kode_transaksi', $kode);
$perawatan = $this->db->get()->result();
foreach ($perawatan as $value) { $no++;?>
<tr>
	<td><?php echo $no ?></td>
	<td><?php echo $value->nama_perawatan ?></td>
	<td><?php echo $value->qty ?></td>
	<td>
		<a onclick="actDel('<?php echo $value->id ?>','perawatan')" class="btn btn-no-radius btn-danger"><i class="fa fa-trash"></i></a>
		<a onclick="actEdit('<?php echo $value->id ?>','perawatan')" class="btn btn-no-radius btn-warning"><i class="fa fa-pencil"></i></a>
	</td>
</tr>
<?php }
?>