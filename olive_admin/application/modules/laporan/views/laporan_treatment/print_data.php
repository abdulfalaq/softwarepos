<!DOCTYPE html>
<head>
	<title>Data Laporan Treatment</title>
</head>
<body onload="window.print()">
	
	<h1 style="text-align: center">Data Laporan Treatment</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr>
				<th width="50px;">No</th>
				<th>Kode Treatment</th>
				<th>Nama Treatment</th>
				<th>Harga</th>
				<th>QTY</th>
				<th>Diskon</th>
				<th>Subtotal</th>
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
			$this->db->group_by('kode_item');
			$this->db->select('kode_item');
			$this->db->select('tanggal_transaksi');
			$this->db->where('jenis_item', 'Treatment');
			$this->db->from('olive_kasir.opsi_transaksi_layanan');
			$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
			$data_item=$this->db->get()->result();
			$no=1;
			$grand_total=0;
			foreach ($data_item as $item) {


				$this->db->select('nama_perawatan');
				$this->db->select('jenis_item');
				$this->db->select('kode_item');
				$this->db->select('olive_kasir.opsi_transaksi_layanan.harga');
				$this->db->select('olive_kasir.opsi_transaksi_layanan.jenis_diskon');
				$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_persen');
				$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
				$this->db->select('tanggal_transaksi');
				if(!empty($tgl_awal) && !empty($tgl_akhir)){
					$this->db->where('tanggal_transaksi >=', $tgl_awal);
					$this->db->where('tanggal_transaksi <=', $tgl_akhir);
				}
				$this->db->where('kode_item', $item->kode_item);
				$this->db->group_by('olive_kasir.opsi_transaksi_layanan.jenis_diskon');
				$this->db->group_by('olive_kasir.opsi_transaksi_layanan.diskon_persen');
				$this->db->group_by('olive_kasir.opsi_transaksi_layanan.diskon_rupiah');
				$this->db->where('jenis_item', 'Treatment');
				$this->db->from('olive_kasir.opsi_transaksi_layanan');
				$this->db->join('olive_master.master_perawatan', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_perawatan.kode_perawatan', 'left');
				$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
				$get_data=$this->db->get()->result();

				$subtotal=0;
				$total=0;
				foreach ($get_data as  $data) {

					if(!empty($tgl_awal) && !empty($tgl_akhir)){
						$this->db->where('tanggal_transaksi >=', $tgl_awal);
						$this->db->where('tanggal_transaksi <=', $tgl_akhir);
					}
					$this->db->where('jenis_item', $data->jenis_item);
					$this->db->where('kode_item', $data->kode_item);
					$this->db->where('olive_kasir.opsi_transaksi_layanan.jenis_diskon', $data->jenis_diskon);
					if($data->jenis_diskon=='persen'){
						$this->db->where('olive_kasir.opsi_transaksi_layanan.diskon_persen', $data->diskon_persen);
					}else if ($data->jenis_diskon=='rupiah') {
						$this->db->where('olive_kasir.opsi_transaksi_layanan.diskon_rupiah', $data->diskon_rupiah);
					}

					$this->db->select_sum('qty');
					$this->db->from('olive_kasir.opsi_transaksi_layanan');
					$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
					$data_diskon=$this->db->get()->row();
					?>
					<tr>
						<td><?php echo $no++;?></td>
						<td><?php echo $data->kode_item;?></td>
						<td><?php echo $data->nama_perawatan;?></td>                  
						<td><?php echo @format_rupiah($data->harga);?></td>  
						<td><?php echo $data_diskon->qty;?></td>
						<td>
							<?php 
							if($data->jenis_diskon=='persen'){
								echo $data->diskon_persen.'%';
								$nominal_persen=(($data_diskon->qty * $data->harga) * $data->diskon_persen)/100;
								$subtotal=(($data_diskon->qty * $data->harga) - $nominal_persen);
							}else if ($data->jenis_diskon=='rupiah') {
								echo @format_rupiah($data->diskon_rupiah);
								$subtotal=($data_diskon->qty * $data->harga) - $data->diskon_rupiah;
							}
							?>

						</td>
						<td align="right"><?php echo @format_rupiah($subtotal);?></td>  
					</tr>
					<?php
					$total +=@$subtotal;
				}
				?>
				<tr>
					<td colspan="6" align="right">
						<b> Total</b>
					</td>
					<td align="right">
						<b><?php echo @format_rupiah($total);?></b>
					</td>
				</tr>
				<?php
				$grand_total +=@$total;
			}
			?>
			<tr>
				<td colspan="6" align="right">
					<b>Grand Total</b>
				</td>
				<td align="right">
					<b><?php echo @format_rupiah($grand_total);?></b>
				</td>
			</tr>
		</tbody>     
		
	</table>
</body>
</html>