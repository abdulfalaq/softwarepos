<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
	<thead>
		<tr>
			<th width="50px;">No</th>
			<th>Nama Bahan</th>
			<th>Stok Awal</th>
			<th>Masuk</th>
			<th>Keluar</th>
			<th>Adjust I</th>
			<th>Stok Akhir</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$data = $this->input->post();
		$no = 0;
		$this->db->from('clouoid1_olive_master.master_bahan_baku');
		$get_bahan = $this->db->get()->result();
		foreach ($get_bahan as $value) { $no++; 
			$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_masuk');
			$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_keluar');
			$this->db->from('clouoid1_olive_gudang.transaksi_stok');
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.kode_bahan',$value->kode_bahan_baku);
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.jenis_transaksi !=','opname');
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.tanggal_transaksi >=',$data['tgl_awal']);
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.tanggal_transaksi <=',$data['tgl_akhir']);
			$get_stok = $this->db->get()->row();
			$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_keluar');
			$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_masuk');
			$this->db->from('clouoid1_olive_gudang.transaksi_stok');
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.kode_bahan',$value->kode_bahan_baku);
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.jenis_transaksi','opname');
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.tanggal_transaksi >=',$data['tgl_awal']);
			$this->db->where('clouoid1_olive_gudang.transaksi_stok.tanggal_transaksi <=',$data['tgl_akhir']);
			$get_adjust = $this->db->get()->row();

			$hasil_opname 	= $get_adjust->stok_masuk + $get_adjust->stok_keluar;
			$stok_akhir  	= ($value->real_stock + $get_stok->stok_masuk) - $get_stok->stok_keluar;

			?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $value->nama_bahan_baku ?></td>
				<td><?php echo $value->real_stock ?></td>
				<td><?php echo $get_stok->stok_masuk;  ?></td>
				<td><?php echo $get_stok->stok_keluar; ?></td>
				<td><?php echo $hasil_opname ?></td>
				<td><?php echo $stok_akhir ?></td>
			</tr>
			<?php 
		} ?>
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