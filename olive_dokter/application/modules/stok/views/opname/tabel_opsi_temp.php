<?php
$kode_opname=$this->uri->segment(4);
$jenis_bahan=$this->uri->segment(5);
$this->db->where('kan_suol.opsi_transaksi_opname_temp.kode_opname', @$kode_opname);
$this->db->from('kan_suol.opsi_transaksi_opname_temp');
if($jenis_bahan=='BB'){
	$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_bahan_baku.kode_bahan_baku', 'left');
}elseif ($jenis_bahan=='BDP') {
	$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang', 'left');
}elseif ($jenis_bahan=='Produk') {
	$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_opname_temp.kode_bahan=kan_master.master_produk.kode_produk', 'left');
}
$get_temp=$this->db->get();
$hasil_temp=$get_temp->result();
$no=1;
foreach ($hasil_temp as $temp) {
	?>
	<tr>
		<td><?php echo $no++;?></td>
		<?php
		if($jenis_bahan=='BB'){
			?>
			<td><?php echo @$temp->kode_bahan;?></td>
			<td><?php echo @$temp->nama_bahan_baku;?></td>
			<?php
		}elseif ($jenis_bahan=='BDP') {
			?>
			<td><?php echo @$temp->kode_bahan;?></td>
			<td><?php echo @$temp->nama_barang;?></td>
			<?php
		}elseif ($jenis_bahan=='Produk') {
			?>
			<td><?php echo @$temp->kode_bahan;?></td>
			<td><?php echo @$temp->nama_produk;?></td>
			<?php
		}
		?>
		
		<td><a class="btn btn-danger" onclick="actDelete('<?php echo @$temp->id_temp;?>')"><i class="fa fa-trash"></i></a></td>
	</tr>
	<?php
}
?>
<script type="text/javascript">
	var no='<?php echo $no;?>';
	if(no > 1){
		$('#tanggal').attr('readonly',true);
		$('#jenis_bahan').attr('disabled',true);
		$('.btn_simpan').attr('disabled',false);
	}else{
		$('#tanggal').attr('readonly',false);
		$('#jenis_bahan').attr('disabled',false);
		$('.btn_simpan').attr('disabled',true);
	}
</script>