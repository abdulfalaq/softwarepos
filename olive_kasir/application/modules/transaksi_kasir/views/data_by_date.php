<table style="font-size: 1.0em;" id="datatable" class="table table-bordered table-hover ">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Transaksi</th>
			<th>Tanggal</th>
			<th>Check In</th>
			<th>Check Out</th>
			<th>Petugas</th>
			<th>Saldo Awal</th>
			<th>Saldo Akhir</th>
			<th>Nominal Penjualan</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$data = $this->input->post();
		$no = 0;
		$this->db->select('*,kasir.status as status_kasir');
		$this->db->order_by('kasir.id', 'desc');
		$this->db->where('kasir.tanggal >=',$data['tgl_awal']);
		$this->db->where('kasir.tanggal <=',$data['tgl_akhir']);
		$this->db->from('olive_kasir.transaksi_kasir kasir');
		$this->db->join('olive_master.master_user user', 'kasir.petugas = user.id', 'left');
		$get_transaksi = $this->db->get()->result();
		foreach ($get_transaksi as $value) { $no++;?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $value->kode_transaksi ?></td>
			<td><?php echo tanggalIndo($value->tanggal) ?></td>
			<td><?php echo $value->check_in ?></td>
			<td><?php echo $value->check_out ?></td>
			<td><?php echo $value->nama_karyawan ?></td>
			<td><?php echo format_rupiah($value->saldo_awal) ?></td>
			<td><?php echo format_rupiah($value->saldo_akhir) ?></td>
			<td><?php echo format_rupiah($value->nominal_penjualan) ?></td>
			<td><?php echo $value->status_kasir ?></td>
			<td><?php echo $value->validasi ?></td>
			<td align="center">
				<div class="btn-group">
					<a href="<?php echo base_url('transaksi_kasir/detail/'.$value->kode_transaksi); ?>" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i> </a>
				</div>
			</td>
		</tr>
		<?php }
		?>

	</tbody>
</table>