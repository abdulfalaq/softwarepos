<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
	<thead>
		<tr>
			<th width="50px;">No</th>
			<th>Kode Member</th>
			<th>Nama Member</th>
			<th>Anamnesa</th>
			<th>Dokter</th>
			<th>Tanggal Konsul</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$data = $this->input->post();
		$no = 0;
		$this->db->from('olive_kasir.data_rekam_medik');
		$this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_kasir.data_rekam_medik.kode_member','left');
		$this->db->join('olive_master.master_karyawan','olive_master.master_karyawan.kode_karyawan = olive_kasir.data_rekam_medik.kode_dokter','left');
		$this->db->where('olive_kasir.data_rekam_medik.tanggal_transaksi >=', $data['tgl_awal']);
		$this->db->where('olive_kasir.data_rekam_medik.tanggal_transaksi <=', $data['tgl_akhir']);
		$this->db->order_by('olive_kasir.data_rekam_medik.id','DESC');
		$get_rekam_medis = $this->db->get()->result();
		foreach ($get_rekam_medis as $value) { $no++; ?>
		<tr>
			<td><?php echo $no ?></td>
			<td><?php echo $value->kode_member ?></td>
			<td><?php echo $value->nama_member ?></td>
			<td><?php echo $value->anamnesa ?></td>
			<td><?php echo $value->nama_karyawan ?></td>
			<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
		</tr>

		<?php }
		?>
	</tbody>                
</table>