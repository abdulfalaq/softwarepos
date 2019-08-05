<?php 
$no=0;
$kode = $this->uri->segment(3);

$this->db->select('clouoid1_olive_cs.opsi_transaksi_registrasi_temp.id');
$this->db->select('clouoid1_olive_master.master_perawatan.nama_perawatan');
$this->db->from('clouoid1_olive_cs.opsi_transaksi_registrasi_temp');
$this->db->where('clouoid1_olive_cs.opsi_transaksi_registrasi_temp.kode_transaksi', $kode);
$this->db->join('clouoid1_olive_master.master_perawatan', 'clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_cs.opsi_transaksi_registrasi_temp.kode_item','left');
$get_data = $this->db->get()->result()
?>

<table class="table table-bordered table-hovered" style="background-color:white">
	<thead>
		<tr>
			<th>Nama Perawatan</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($get_data as $value) { $no++; ?>
		<tr>
			<td><?php echo $value->nama_perawatan  ?></td>
			<td><a onclick="delete_temp('<?php echo $value->id ?>')" class="btn btn-danger btn-no-radius"> <i class="fa fa-trash"></i></a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<input type="hidden" id="julah_temp" value="<?php echo $no ?>">
<script>
function delete_temp(key){
	$('#modal-delete').modal('show')
	$('#del_id').val(key);
}
function del_data(){
	id = $('#del_id').val();

	$.ajax({
		url: "<?php echo base_url('registrasi_pelayanan/delete_temp_perawatan'); ?>",
		type: 'post',
		data:{id:id},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$('#modal-delete').modal('hide')
			load_table_produk_temp2();
		}
	});
}

function load_table_produk_temp2(){
	var kode_transaksi = "<?php echo $kode ?>";
	$('#load_table_produk_temp').load('<?php echo base_url() ?>registrasi_pelayanan/get_table_produk_temp/'+kode_transaksi);
}
</script>