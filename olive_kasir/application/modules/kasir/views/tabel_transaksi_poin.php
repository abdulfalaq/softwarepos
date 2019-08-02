<?php
$id_temp=$this->uri->segment(3);

$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.id');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.qty');
$this->db->select('olive_kasir.opsi_transaksi_layanan_temp.qty_poin');
$this->db->select('olive_master.master_produk.kode_produk');
$this->db->select('olive_master.master_produk.nama_produk');
$this->db->select('olive_master.master_produk.redeem_poin');

$this->db->where('olive_kasir.opsi_transaksi_layanan_temp.id', $id_temp);
$this->db->from('olive_kasir.opsi_transaksi_layanan_temp');
$this->db->join('olive_master.master_produk', 'olive_kasir.opsi_transaksi_layanan_temp.kode_item = olive_master.master_produk.kode_produk', 'left');

$get_temp=$this->db->get()->row();
$jumlah=@$get_temp->qty - @$get_temp->qty_poin;
for ($i=0; $i < @$jumlah ; $i++) { 
	?>
	<tr>
		<td><?php echo @$get_temp->nama_produk;?></td>
		<td class="text-center">1</td>
		<td class="text-center"><?php echo @$get_temp->redeem_poin;?></td>
		<td class="text-center"><a onclick="gunakan_poin('<?php echo @$id_temp;?>',this)"  class="btn btn-success btn-md">Gunakan Poin</a></td>
	</tr>
	<?php
}
?>
