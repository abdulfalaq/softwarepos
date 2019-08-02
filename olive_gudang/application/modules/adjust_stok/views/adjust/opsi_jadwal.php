<div> 
	<table class="table table-striped table-hover table-bordered" id="tabel_daftarr">
		<thead>
			<tr>
				<th>No</th>
				<th>Jenis Bahan</th>
				<th>Nama Bahan</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 0;
			$kode = $this->uri->segment(4);
			$this->db->where('kode_opname', $kode);
			$get_opname = $this->db->get('opsi_transaksi_opname_temp')->result();
			foreach ($get_opname as $value) { $no++;
				if ($value->jenis_bahan == 'Perlengkapan') {
					$get_perlengkapan = $this->db_master->get_where('master_perlengkapan',array('kode_perlengkapan' => $value->kode_bahan ))->row();
					$nama_bahan = $get_perlengkapan->nama_perlengkapan;
				}else if ($value->jenis_bahan == 'Bahan Baku') {
					$get_bahan_baku = $this->db_master->get_where('master_bahan_baku',array('kode_bahan_baku' => $value->kode_bahan ))->row();
					$nama_bahan = $get_bahan_baku->nama_bahan_baku;
				}else if ($value->jenis_bahan == 'Produk') {
					$get_produk = $this->db_master->get_where('master_produk',array('kode_produk' => $value->kode_bahan ))->row();
					$nama_bahan = $get_produk->nama_produk;
				} ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $value->jenis_bahan ?></td>
					<td><?php echo $nama_bahan ?></td>
					<td>
						<a onclick="actDel('<?php echo $value->id ?>')" class="btn btn-no-radius btn-danger" >Delete</a>
					</td>
				</tr>
				<?php 
			} ?>

		</tbody>
	</table>
</div>
<br><br>
<div id="cari_transaksi">
	<a onclick="input_opname_pilih()" style="padding:13px; margin-bottom:10px;background-color: #1f897f;color:white" id="simpan_jadwal" class="btn  btn-no-radius btn-app green pull-right" ><i class="fa fa-send"></i> Simpan</a>
</div>

<script>
	
</script>