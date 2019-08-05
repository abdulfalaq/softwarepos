<?php
$kode_retur=$this->uri->segment(4);
$this->db->where('kode_retur', $kode_retur);
$this->db->where('clouoid1_olive_gudang.opsi_transaksi_retur_temp.status', 'masuk');
$this->db->select('nama');
$this->db->select('nama_bahan_baku');
$this->db->select('nama_perlengkapan');
$this->db->select('nama_produk');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.id');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.jumlah');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.harga_satuan');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.subtotal');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.kategori_bahan');
$this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur_temp.expired_date');

$this->db->from('clouoid1_olive_gudang.opsi_transaksi_retur_temp');
$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_retur_temp.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_retur_temp.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_retur_temp.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_retur_temp.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
$get_temp=$this->db->get()->result();
$no=1;
$grand_total=0;
foreach($get_temp as $temp){ 
	?>

	<tr>
		<td><?php echo $no++;?></td>
		<td>
			<?php 
			if(@$temp->kategori_bahan=='bahan baku'){
				echo @$temp->nama_bahan_baku;
			}elseif (@$temp->kategori_bahan=='produk') {
				echo @$temp->nama_produk;
			}elseif (@$temp->kategori_bahan=='perlengkapan') {
				echo @$temp->nama_perlengkapan;
			}
			?>  
		</td>
		<td><?php echo @$temp->jumlah.' '.@$temp->nama; ?></td>
		<td><?php echo @format_rupiah(@$temp->harga_satuan); ?></td>
		<td><?php echo @format_rupiah(@$temp->subtotal); ?></td>
		<td><?php echo @TanggalIndo(@$temp->expired_date); ?></td>
		<td width="100px"><?php echo get_edit_delete(@$temp->id); ?></td>
	</tr>
	<?php
	$grand_total +=@$temp->subtotal;
}
?>
<tr>
	<th colspan ="4">Total</th>
	<th><?php echo @format_rupiah(@$grand_total); ?></th>
	<th></th>
	<th></th>
</tr>