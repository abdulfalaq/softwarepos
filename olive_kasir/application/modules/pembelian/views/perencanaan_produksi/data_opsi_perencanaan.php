<?php
$kode_perencanaan=$this->uri->segment(4);
$this->db->where('kan_suol.opsi_perencanaan_produksi_temp.kode_perencanaan', $kode_perencanaan);
$this->db->from('kan_master.master_produk');
$this->db->join('kan_suol.opsi_perencanaan_produksi_temp', 'kan_suol.opsi_perencanaan_produksi_temp.kode_produk = kan_master.master_produk.kode_produk ');
$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode ');
$get_opsi_perencanaan = $this->db->get();
$hasil_opsi_perencanaan=$get_opsi_perencanaan->result();
$no=1;
foreach ($hasil_opsi_perencanaan as $opsi) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<td><?php echo @$opsi->nama_produk;?></td>
		<td><?php echo @$opsi->qty.' '.@$opsi->nama;?></td>
		<td><?php echo @get_edit_delete($opsi->id_temp);?></td>   
	</tr>  
	<?php
}
?>
<input type="hidden" id="jml_opsi" value="<?php echo $no;?>">