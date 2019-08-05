<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
	<thead>
		<tr>
			<th>Periode</th>
			<th>Nama Promo</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tgl_awal=$this->input->post('tgl_awal');
		$tgl_akhir=$this->input->post('tgl_akhir');
		if(!empty($tgl_awal) && !empty($tgl_akhir)){
			$this->db->where('tanggal_transaksi >=', $tgl_awal);
			$this->db->where('tanggal_transaksi <=', $tgl_akhir);
		}
		$this->db->select('kode');
		$this->db->select('nama_promo');
		$this->db->group_by('kode');
		$this->db->where('clouoid1_olive_kasir.transaksi_layanan.kategori_diskon', 'promo');
		$this->db->from('clouoid1_olive_kasir.transaksi_layanan');
		$this->db->join('clouoid1_olive_master.master_promo', 'clouoid1_olive_kasir.transaksi_layanan.kode = clouoid1_olive_master.master_promo.kode_promo', 'left');
		$get_data=$this->db->get()->result();
		foreach ($get_data as $value) {
			if(!empty($tgl_awal) && !empty($tgl_akhir)){
				$this->db->where('tanggal_transaksi >=', $tgl_awal);
				$this->db->where('tanggal_transaksi <=', $tgl_akhir);
			}
			$this->db->where('kode', $value->kode);
			$this->db->select('kode');
			$jumlah_data=$this->db->get('clouoid1_olive_kasir.transaksi_layanan')->result();
			?>
			<tr>
				<td><?php echo TanggalIndo($tgl_awal).' ~ '.TanggalIndo($tgl_akhir)?></td>
				<td><?php echo $value->nama_promo;?></td>
				<td><?php echo count($jumlah_data);?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>