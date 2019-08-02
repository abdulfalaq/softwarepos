<?php
$kode_po=paramDecrypt($this->uri->segment(4));
$this->db->select('kan_suol.opsi_transaksi_po_temp.id, kan_suol.opsi_transaksi_po_temp.qty');
$this->db->select('kan_master.master_bahan_baku.nama_bahan_baku, kan_master.master_satuan.nama');

$this->db->where('kan_suol.opsi_transaksi_po_temp.kode_po', $kode_po);
$this->db->from('kan_suol.opsi_transaksi_po_temp');
$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_po_temp.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
$get_opsi_po = $this->db->get();
$hasil_opsi_po=$get_opsi_po->result();
$no=1;
foreach ($hasil_opsi_po as $opsi) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @$opsi->nama_bahan_baku;?></td>
		<td><?php echo @$opsi->qty.' '.@$opsi->nama;?></td>
		<td><?php echo @get_edit_delete($opsi->id);?></td>   
	</tr>  
	<?php
}
?>
<input type="hidden" id="jml_opsi" value="<?php echo $no;?>">