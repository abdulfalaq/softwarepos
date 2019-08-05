<!DOCTYPE html>
<head>
	<title>Laporan Perubahan Modal</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Perubahan Modal</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<?php 
		$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
		$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
		$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

		$modal_awal = $this->db->get_where('clouoid1_olive_keuangan.laporan_neraca',array('nama_akun' =>'Modal','kategori_keuangan' =>'Pasiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
		$hasil_modal_awal = $modal_awal->row();

		if(!empty($hasil_modal_awal)){
			$nominal_modal_awal=$hasil_modal_awal->nominal;

		}else{
			$saldo_awal = $this->db->get_where('clouoid1_olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
			$hasil_saldo_awal = $saldo_awal->row();
			$nominal_modal_awal=@$hasil_saldo_awal->persediaan_awal +  @$hasil_saldo_awal->kas_awal;
		}

		$this->db->select_sum('nominal');
		$pemasukan = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pemasukan = $pemasukan->row();

		$this->db->select_sum('nominal');
		$pengeluaran = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pengeluaran = $pengeluaran->row();

		if($hasil_pemasukan->nominal >= $hasil_pengeluaran->nominal){
			$laba=$hasil_pemasukan->nominal-$hasil_pengeluaran->nominal;
			$rugi=0;
		}elseif ($hasil_pemasukan->nominal < $hasil_pengeluaran->nominal) {
			$laba=0;
			$rugi=$hasil_pengeluaran->nominal-$hasil_pemasukan->nominal;
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
				<th>MODAL AWAL </th>
				<th class="text-right"><?php echo @format_rupiah($nominal_modal_awal);?></th>
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
			<tr>
				<td>&nbsp;</td>
				<td>Laba</td>
				<td class="text-right"><?php echo @format_rupiah($laba);?></td>
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
			<tr>
				<td>&nbsp;</td>
				<td>Rugi</td>
				<td class="text-right"><?php echo @format_rupiah($rugi);?></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<th></th>
				<th>SALDO AKHIR </th>
				<th class="text-right"><?php echo @format_rupiah(($laba + $nominal_modal_awal)- $rugi);?></th>
			</tr>
		</tbody>

	</table>
</body>
</html>