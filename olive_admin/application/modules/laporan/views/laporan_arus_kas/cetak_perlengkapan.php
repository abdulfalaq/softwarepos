<!DOCTYPE html>
<head>
	<title>Laporan Arus Kas</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Arus Kas</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<?php

									$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
									$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
									$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

									$kas_lalu = $this->db->get_where('olive_keuangan.laporan_neraca',array('nama_akun' =>'Kas','kategori_keuangan' =>'Aktiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
									$hasil_kas_lalu = $kas_lalu->row();

									$saldo_awal = $this->db->get_where('olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_saldo_awal = $saldo_awal->row();
									if(!empty($hasil_saldo_awal)){
										$kas_awal=@$hasil_saldo_awal->kas_awal;
									}else{
										$kas_awal=@$hasil_kas_lalu->nominal;
									}

									?>
									<thead>
										<tr width="100%">
											<th>No</th>
											<th>Uraian</th>
											<th>Nominal</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>1. </th>
											<th>SALDO AWAL KAS</th>
											<th class="text-right"><?php echo @format_rupiah($kas_awal);?></th>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th>2. </th>
											<th>PEMASUKAN</th>
											<th></th>
										</tr>
										<?php
										$get_pemasukan=$this->db->get_where('olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pendapatan'));
										$hasil_pemasukan=$get_pemasukan->result();
										$total_pemasukan=0;
										foreach ($hasil_pemasukan as $pemasukan) {
											$total_pemasukan+=$pemasukan->nominal;
											?>
											<tr>
												<td>&nbsp;</td>
												<td><?php echo @$pemasukan->nama_kategori_keuangan;?></td>
												<td align="right"><?php echo @format_rupiah($pemasukan->nominal);?></td>
											</tr>
											<?php
										}
										?>
										<tr>
											<th></th>
											<th>TOTAL PENDAPATAN KAS</th>
											<th class="text-right"><?php echo @format_rupiah($total_pemasukan);?></th>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th>3. </th>
											<th>PENGELUARAN</th>
											<th></th>
										</tr>
										<?php
										$get_pengeluaran=$this->db->get_where('olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pengeluaran'));
										$hasil_pengeluaran=$get_pengeluaran->result();
										$total_pengeluaran=0;
										foreach ($hasil_pengeluaran as $pengeluaran) {
											$total_pengeluaran +=$pengeluaran->nominal;
											?>
											<tr>
												<td>&nbsp;</td>
												<td><?php echo @$pengeluaran->nama_kategori_keuangan;?></td>
												<td align="right"><?php echo @format_rupiah($pengeluaran->nominal);?></td>
											</tr>
											<?php
										}
										?>
										<tr>
											<th></th>
											<th>TOTAL PENGELUARAN KAS</th>
											<th class="text-right"><?php echo @format_rupiah($total_pengeluaran);?></th>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<th></th>
											<th>SALDO AKHIR KAS</th>
											<th class="text-right"><?php echo @format_rupiah(($total_pemasukan + $kas_awal)- $total_pengeluaran);?></th>
										</tr>
									</tbody>

								</table>

	</body>
	</html>