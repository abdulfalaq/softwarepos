<table class="table table-hovered table-bordered" id="datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Transaksi</th>
			<th>Tanggal Transaksi</th>
			<th>Nama Customer</th>
			<th>Nama Layanan</th>
			<th style="width: 20%" >Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$data = $this->input->post();
		$no = 0;
		$this->db->from('olive_cs.transaksi_registrasi');
		$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_registrasi.kode_member', 'left');
		$this->db->where('olive_cs.transaksi_registrasi.tanggal_transaksi >=',$data['tgl_awal']);
		$this->db->where('olive_cs.transaksi_registrasi.tanggal_transaksi <=',$data['tgl_akhir']);
		$this->db->where('olive_cs.transaksi_registrasi.kode_layanan',$data['layanan']);
		$data_periksa = $this->db->get()->result();
		foreach ($data_periksa as $value) { $no++; ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $value->kode_transaksi ?></td>
			<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
			<td><?php echo $value->nama_member ?></td>
			<td><?php echo $value->kode_layanan ?></td>
			<td>
				<div class="btn-group">
					<a href="<?php echo base_url ('registrasi_pelayanan/registrasi_pelayanan/detail/'.$value->id) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
					<a onclick="reprint('<?php echo $value->kode_transaksi ?>')" data-toggle="tooltip" title="Detail" class="btn btn-warning btn-circle green"><i class="fa fa-print"></i> </a>
				</div>
			</td>
		</tr>
		<?php }
		?>
	</tbody>
</table>
<script>
$(document).ready(function() {
	$('#datatable').dataTable();
	$('#datatable-keytable').DataTable( { keys: true } );
	$('#datatable-responsive').DataTable();
	$('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
	var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
	$('.select2').select2();
});

</script>