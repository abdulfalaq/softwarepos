<?php
$kode_retur=$this->uri->segment(4);
$this->db->where('kode_retur', $kode_retur);
$this->db->where('olive_gudang.opsi_transaksi_retur_temp.status', 'keluar');
$this->db->select('nama');
$this->db->select('nama_bahan_baku');
$this->db->select('nama_perlengkapan');
$this->db->select('nama_produk');
$this->db->select('olive_gudang.opsi_transaksi_retur_temp.id');
$this->db->select('olive_gudang.opsi_transaksi_retur_temp.jumlah');
$this->db->select('olive_gudang.opsi_transaksi_retur_temp.harga_satuan');
$this->db->select('olive_gudang.opsi_transaksi_retur_temp.subtotal');
$this->db->select('olive_gudang.opsi_transaksi_retur_temp.kategori_bahan');

$this->db->from('olive_gudang.opsi_transaksi_retur_temp');
$this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
$this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
$this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_retur_temp.kode_bahan = olive_master.master_produk.kode_produk', 'left');
$this->db->join('olive_master.master_satuan', 'olive_gudang.opsi_transaksi_retur_temp.kode_satuan = olive_master.master_satuan.kode', 'left');
$get_temp=$this->db->get()->result();
$no=1;
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
		<td width="100px"><?php echo get_edit_delete(@$temp->id); ?></td>
	</tr>
	<?php
}
?>