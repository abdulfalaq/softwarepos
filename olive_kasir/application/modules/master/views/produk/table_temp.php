<?php 
$this->db2->select('*');
$this->db2->from('opsi_master_produk_temp');
$get_bdp_temp = $this->db2->get()->result();
$no = 0;
foreach ($get_bdp_temp as $value) { $no++; ?>
<tr>
	<td><?= $no ?></td>
	<?php if ($value->jenis_bahan == 'BB') {
		$get_bahan_baku = $this->db2->get_where('master_bahan_baku', array('kode_bahan_baku' => $value->kode_bahan ))->row(); ?>
		<td><?= $get_bahan_baku->nama_bahan_baku ?></td>
		<?php }else{ $get_barang = $this->db2->get_where('master_barang_dalam_proses', array('kode_barang' => $value->kode_bahan ))->row(); ?>
		<td><?= $get_barang->nama_barang ?></td>
		<?php } 
		?>
		<td><?= $value->jenis_bahan ?></td>
		<td><?= $value->qty ?></td>
		<td><?php 
		if ($value->jenis_bahan == 'BB') {
			$this->db2->from('master_bahan_baku');
			$this->db2->join('master_satuan', 'master_satuan.kode = master_bahan_baku.kode_satuan_stok', 'left');
			$this->db2->where('master_bahan_baku.kode_bahan_baku', $value->kode_bahan);
			$get_satuan = $this->db2->get()->row();

			echo @$get_satuan->nama;
		}elseif($value->jenis_bahan == 'BDP'){
			$this->db2->from('master_barang_dalam_proses');
			$this->db2->join('master_satuan', 'master_satuan.kode = master_barang_dalam_proses.kode_satuan_stok', 'left');
			$this->db2->where('master_barang_dalam_proses.kode_barang', $value->kode_bahan);
			$get_satuan = $this->db2->get()->row();

			echo @$get_satuan->nama;
		}
		?>
	</td>
	<td><a class="btn btn-danger btn-no-radius" onclick="delete_temp('<?= $value->id ?>')"><i class="fa fa-trash"></i></a></td>
</tr>
<?php }

?>

<script>
function delete_temp(key){
	if (confirm("Hapus item temporarry")) {
		$.ajax({  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'master/produk/delete_temporary_item' ?>",  
			cache 	:false,  
			data 	:{id:key},
			success : function(data) { 
				load_table_temp();
			}
		})
	} 

}
</script>