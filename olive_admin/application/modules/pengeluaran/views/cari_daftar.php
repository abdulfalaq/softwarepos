<table class="table table-striped table-hover table-bordered" id="datatable" >
	<thead>
		<tr>
			<th width="50px;">No</th>
			<th>Kode Pengeluaran</th>
			<th>Kategori</th>
			<th>Nominal</th>
			<th>Nama Akun</th>
			<th>Keterangan</th>
			<th width="133px;">Action</th>
		</tr>
	</thead>
	<tbody id="scroll_data">
		<?php 
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		if(!empty($tgl_awal) && !empty($tgl_akhir)){
			$this->db3->where('tanggal_transaksi >=', $tgl_awal);
			$this->db3->where('tanggal_transaksi <=', $tgl_akhir);
		}
		$this->db3->order_by('id','DESC');
		$get_gudang = $this->db3->get('keuangan_keluar')->result();

		$no = 0;
		foreach ($get_gudang as $value) { 
			$no++; ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $value->kode_sub_kategori_keuangan ?></td>
				<td><?= $value->nama_kategori_keuangan ?></td>
				<td><?= $value->nominal ?></td>
				<td><?= $value->nama_sub_kategori_keuangan ?></td>
				<td><?= $value->keterangan ?></td>
				<td align="center">
					<a href="<?php echo base_url ("pengeluaran/detail/".$value->kode_sub_kategori_keuangan); ?>" data-toggle="tooltip" style="background-color: #26a69a;color:white" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
				</td>
			</tr>
			<?php 
		} 
		?>
	</tbody>                
</table>