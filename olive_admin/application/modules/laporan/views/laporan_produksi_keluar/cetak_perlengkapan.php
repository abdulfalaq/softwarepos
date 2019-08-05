<!DOCTYPE html>
<head>
	<title>Laporan Produk Keluar</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Produk Keluar</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr>
				<th width="50px;">No</th>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Harga</th>
				<th>QTY</th>
				<th>Diskon</th>
				<th>Subtotal</th>
			</thead>
			<tbody>
				<?php
				$tgl_awal=$this->uri->segment(4);
				$tgl_akhir=$this->uri->segment(5);

				$this->db->group_by('kode_item');
				$this->db->select('kode_item');
				$this->db->select('jenis_item');
				$this->db->select('tanggal_transaksi');
				$this->db->where('jenis_item !=', 'Treatment');
				$this->db->where('jenis_item !=', 'kartu member');
				$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi >=',$tgl_awal);
				$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi <=',$tgl_akhir);
				$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
				$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
				$data_item=$this->db->get()->result();

				$no=1;
				$grand_total=0;
				foreach ($data_item as $item) {


					$this->db->select('nama_produk');
					$this->db->select('jenis_item');
					$this->db->select('kode_item');
					$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.harga');
					$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon');
					$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen');
					$this->db->select('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah');

					$this->db->where('kode_item', @$item->kode_item);
					$this->db->where('jenis_item', @$item->jenis_item);
					$this->db->group_by('jenis_diskon');
					$this->db->group_by('diskon_persen');
					$this->db->group_by('diskon_rupiah');
					$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
					$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_item = clouoid1_olive_master.master_produk.kode_produk', 'left');
					$get_data=$this->db->get()->result();

					$subtotal=0;
					$total=0;
					foreach ($get_data as  $data) {
						$this->db->where('jenis_item', @$data->jenis_item);
						$this->db->where('kode_item', @$data->kode_item);
						$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.jenis_diskon', $data->jenis_diskon);
						if($data->jenis_diskon=='persen'){
							$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_persen', $data->diskon_persen);
						}else if ($data->jenis_diskon=='rupiah') {
							$this->db->where('clouoid1_olive_kasir.opsi_transaksi_layanan.diskon_rupiah', $data->diskon_rupiah);
						}
						$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi >=',@$data['tgl_awal']);
						$this->db->where('clouoid1_olive_kasir.transaksi_layanan.tanggal_transaksi <=',@$data['tgl_akhir']);
						$this->db->select_sum('qty');
						$this->db->from('clouoid1_olive_kasir.opsi_transaksi_layanan');
						$this->db->join('clouoid1_olive_kasir.transaksi_layanan', 'clouoid1_olive_kasir.opsi_transaksi_layanan.kode_transaksi = clouoid1_olive_kasir.transaksi_layanan.kode_transaksi', 'left');
						$data_diskon=$this->db->get()->row();
						?>
						<tr>
							<td><?php echo $no++;?></td>
							<td><?php echo $data->kode_item;?></td>
							<td><?php echo $data->nama_produk;?></td>                  
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
			</table>
		</body>
		</html>