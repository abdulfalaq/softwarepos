<!DOCTYPE html>
<html>
<head>
	<title>Print Laporan Stok Perlengkapan</title>
</head>
<body onload="window.print()">
	<table width="100%">
		<tr>
			<td><h3>Laporan Stok Perlengkapan</h3></td>
			<td align="right"><h5><?php echo tanggalIndo(date("Y-m-d")); ?> <?php echo date("H:i:s"); ?></h5></td>
		</tr>
	</table>

	<hr><br>
	

	<table  width="100%" class="" border="1" style="border-collapse: collapse;">
		<thead>
			<tr>
				<th width="50px;">No</th>
				<th>Nama Perlengkapan</th>
				<th>Stok Awal</th>
				<th>Masuk</th>
				<th>Keluar</th>
				<th>Adjust I</th>
				<th>Stok Akhir</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$tgl_awal=$this->uri->segment(4);
			$tgl_akhir=$this->uri->segment(5);

			$data = $this->input->post();
			$no = 0;
			$this->db->from('olive_master.master_perlengkapan');
			$get_bahan = $this->db->get()->result();
			foreach ($get_bahan as $value) { $no++; 
				$this->db->select_sum('olive_gudang.transaksi_stok.stok_masuk');
				$this->db->select_sum('olive_gudang.transaksi_stok.stok_keluar');
				$this->db->from('olive_gudang.transaksi_stok');
				$this->db->where('olive_gudang.transaksi_stok.kode_bahan',$value->kode_perlengkapan);
				$this->db->where('olive_gudang.transaksi_stok.jenis_transaksi !=','opname');
				if (!empty($tgl_awal)) {
					$this->db->where('olive_gudang.transaksi_stok.tanggal_transaksi >=',$tgl_awal);
				}
				if (!empty($tgl_akhir)) {
					$this->db->where('olive_gudang.transaksi_stok.tanggal_transaksi <=',$tgl_akhir);
				}
				$get_stok = $this->db->get()->row();
				$this->db->select_sum('olive_gudang.transaksi_stok.stok_keluar');
				$this->db->select_sum('olive_gudang.transaksi_stok.stok_masuk');
				$this->db->from('olive_gudang.transaksi_stok');
				$this->db->where('olive_gudang.transaksi_stok.kode_bahan',$value->kode_perlengkapan);
				$this->db->where('olive_gudang.transaksi_stok.jenis_transaksi','opname');
				if (!empty($tgl_awal)) {
					$this->db->where('olive_gudang.transaksi_stok.tanggal_transaksi >=',$tgl_awal);
				}
				if (!empty($tgl_akhir)) {
					$this->db->where('olive_gudang.transaksi_stok.tanggal_transaksi <=',$tgl_akhir);
				}


				$get_adjust = $this->db->get()->row();

				$hasil_opname 	= $get_adjust->stok_masuk + $get_adjust->stok_keluar;
				$stok_akhir  	= ($value->real_stock + $get_stok->stok_masuk) - $get_stok->stok_keluar;


				?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo $value->nama_perlengkapan ?></td>
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
</body>
</html>