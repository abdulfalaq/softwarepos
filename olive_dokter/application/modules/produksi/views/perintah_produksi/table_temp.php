<?php
$kode_produksi = $this->input->post('kode_produksi');

$this->db->where('kan_suol.opsi_transaksi_produksi_temp.kode_produksi', $kode_produksi);
$this->db->from('kan_suol.opsi_transaksi_produksi_temp');
$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi_temp.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi_temp.kode_bahan = kan_master.master_produk.kode_produk', 'left');
$this->db->join('kan_master.master_satuan', 'kan_suol.opsi_transaksi_produksi_temp.kode_satuan = kan_master.master_satuan.kode', 'left');
$get_temp = $this->db->get()->result();
$no=1;
foreach ($get_temp as $temp) {
	?>
	<tr>
		<td>
			<?php echo $no++;?>
			<input type="hidden" id="id_temp" value="<?php echo $temp->id_temp ?>">
			<input type="hidden" id="kode_bahan" value="<?php echo $temp->kode_bahan ?>">
			<input type="hidden" id="kategori_bahan" value="<?php echo $temp->kategori_bahan ?>">
			<input type="hidden" id="qty" value="<?php echo $temp->jumlah ?>">
		</td>
		<td id="nama_bahan">
			<?php 
			if($temp->kategori_bahan == 'Produk'){
				echo $temp->nama_produk;
			} else{
				echo $temp->nama_barang;
			}
			?>
		</td>
		<td><?php echo @$temp->jumlah.' '.$temp->alias;?></td>
		<td>
			<button type="button" class="btn btn-icon btn-warning" onclick="get_edit(this)"><li class="fa fa-pencil"></li></button>
			<button type="button" class="btn btn-icon btn-danger" onclick="hapus('<?php echo $temp->id_temp ?>')"><li class="fa fa-close"></li></button>
		</td>   
	</tr>
	<?php
}
?>