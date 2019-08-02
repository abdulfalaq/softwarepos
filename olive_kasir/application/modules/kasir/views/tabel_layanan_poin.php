<?php
$id_temp=$this->uri->segment(3);

$this->db->select('olive_kasir.opsi_transaksi_layanan.id');
$this->db->select('olive_kasir.opsi_transaksi_layanan.qty');
$this->db->select('olive_kasir.opsi_transaksi_layanan.qty_poin');
$this->db->select('olive_kasir.opsi_transaksi_layanan.jenis_item');
$this->db->select('olive_master.master_produk.nama_produk');
$this->db->select('olive_master.master_perawatan.nama_perawatan');
$this->db->select('olive_master.master_produk.redeem_poin as redeem_poin_produk');
$this->db->select('olive_master.master_perawatan.redeem_poin as redeem_poin_perawatan');

$this->db->where('olive_kasir.opsi_transaksi_layanan.id', $id_temp);
$this->db->from('olive_kasir.opsi_transaksi_layanan');
$this->db->join('olive_master.master_produk', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_produk.kode_produk', 'left');
$this->db->join('olive_master.master_perawatan', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_perawatan.kode_perawatan', 'left');

$get_temp=$this->db->get()->row();
$jumlah=@$get_temp->qty - @$get_temp->qty_poin;
for ($i=0; $i < @$jumlah ; $i++) { 
	?>
	<tr>
		<td><?php if(@$get_temp->jenis_item=='Treatment'){echo @$get_temp->nama_perawatan;}else{echo @$get_temp->nama_produk;}?></td>
		<td class="text-center">1</td>
		<td><?php if(@$get_temp->jenis_item=='Treatment'){echo @$get_temp->redeem_poin_perawatan;}else{echo @$get_temp->redeem_poin_produk;}?></td>
		<td class="text-center"><a onclick="gunakan_poin('<?php echo @$id_temp;?>',this)"  class="btn btn-success btn-md">Gunakan Poin</a></td>
	</tr>
	<?php
}
?>
