<table class="table table-striped table-hover table-bordered datatable" id="datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Opname</th>
			<th>Tanggal Opname</th>
			<th>Kode Produk</th>
			<th>Nama Produk</th>
			<th>Jenis Bahan</th>
			<th>Stok Awal</th>
			<th>Stok Akhir</th>
			<th>Selisih</th>
			<th>Status</th>
			<th>Keterangan</th>                    
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="scroll_data">
		<?php 
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		if(!empty($tgl_awal) && !empty($tgl_akhir)){
			$this->db->where('tanggal_opname >=', $tgl_awal);
			$this->db->where('tanggal_opname <=', $tgl_akhir);
		}
		$this->db->select('nama_produk');
		$this->db->select('nama_bahan_baku');
		$this->db->select('nama_perlengkapan');
		$this->db->select('olive_gudang.opsi_transaksi_opname.id');
		$this->db->select('olive_gudang.opsi_transaksi_opname.kode_opname');
		$this->db->select('olive_gudang.opsi_transaksi_opname.tanggal_opname');
		$this->db->select('olive_gudang.opsi_transaksi_opname.kode_bahan');
		$this->db->select('olive_gudang.opsi_transaksi_opname.jenis_bahan');
		$this->db->select('olive_gudang.opsi_transaksi_opname.stok_awal');
		$this->db->select('olive_gudang.opsi_transaksi_opname.stok_akhir');
		$this->db->select('olive_gudang.opsi_transaksi_opname.selisih');
		$this->db->select('olive_gudang.opsi_transaksi_opname.status');
		$this->db->select('olive_gudang.opsi_transaksi_opname.keterangan');
		$this->db->select('olive_gudang.opsi_transaksi_opname.validasi');

		$this->db->order_by('olive_gudang.opsi_transaksi_opname.id','DESC');
		$this->db->from('olive_gudang.opsi_transaksi_opname');
		$this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
		$this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_produk.kode_produk', 'left');
		$this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
		$get_gudang = $this->db->get()->result();
		$no = 0;

		foreach ($get_gudang as $value) { 
			$no++; ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $value->kode_opname ?></td>
				<td><?= tanggalIndo ($value->tanggal_opname) ?></td>
				<td><?= $value->kode_bahan ?></td>
				<td>
					<?php 
					if(@$value->jenis_bahan=='Bahan Baku'){
						echo @$value->nama_bahan_baku;
					}elseif (@$value->jenis_bahan=='Produk') {
						echo @$value->nama_produk;
					}elseif (@$value->jenis_bahan=='Perlengkapan') {
						echo @$value->nama_perlengkapan;
					}
					?>  
				</td>
				<td><?= $value->jenis_bahan ?></td>
				<td><?= $value->stok_awal ?></td>
				<td><?= $value->stok_akhir ?></td>
				<td><?= $value->selisih ?></td>
				<td><?= $value->status ?></td>
				<td><?= $value->keterangan ?></td>
				<td align="center">
					<?php
					if($value->validasi!='confirmed'){
						?>
						<a onclick="validasi('<?php echo $value->id; ?>','<?php echo $value->status; ?>')" class="btn btn-info btn-no-radius"><i class="fa fa-check"></i> Validasi</a>
						<?php
					}
					?>

				</td>
			</tr>
			<?php 
		} 
		?>
	</tbody>
</table>
