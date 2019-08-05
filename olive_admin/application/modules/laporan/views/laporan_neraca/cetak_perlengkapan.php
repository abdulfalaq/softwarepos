<!DOCTYPE html>
<head>
	<title>Laporan Neraca</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Neraca</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr width="100%">
				<th>NO</th>
				<th>AKTIVA</th>
				<th>NOMINAL</th>
				<th>NO</th>
				<th>PASIVA</th>
				<th>NOMINAL</th>
			</tr>
		</thead>
		<?php
		$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
		$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
		$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

		$this->db->select_sum('nominal');
		$pemasukan_kas = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pendapatan','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pemasukan_kas = $pemasukan_kas->row();

		$this->db->select_sum('nominal');
		$pengeluaran_kas = $this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pengeluaran_kas = $pengeluaran_kas->row();


		$persediaan = $this->db->get_where('clouoid1_olive_keuangan.laporan_persediaan',array('nama_kategori_keuangan' =>'Persediaan','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_persediaan = $persediaan->row();

		$saldo_awal = $this->db->get_where('clouoid1_olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_saldo_awal = $saldo_awal->row();
		if(!empty($hasil_saldo_awal)){
			$persediaan_awal=@$hasil_saldo_awal->persediaan_awal;
			$kas_awal=@$hasil_saldo_awal->kas_awal;
		}else{
			$persediaan_awal=0;
			$kas_awal=0;
		}

		$this->db->select_sum('nominal');
		$pemasukan_modal = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pemasukan_modal = $pemasukan_modal->row();

		$this->db->select_sum('nominal');
		$pengeluaran_modal = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
		$hasil_pengeluaran_modal = $pengeluaran_modal->row();

		if($hasil_pemasukan_modal->nominal >= $hasil_pengeluaran_modal->nominal){
			$laba=$hasil_pemasukan_modal->nominal-$hasil_pengeluaran_modal->nominal;
			$rugi=0;
		}elseif ($hasil_pemasukan_modal->nominal < $hasil_pengeluaran_modal->nominal) {
			$laba=0;
			$rugi=$hasil_pengeluaran_modal->nominal-$hasil_pemasukan_modal->nominal;
		}


		$modal_awal = $this->db->get_where('clouoid1_olive_keuangan.laporan_neraca',array('nama_akun' =>'Modal','kategori_keuangan' =>'Pasiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
		$hasil_modal_awal = $modal_awal->row();

		if(!empty($hasil_modal_awal)){
			$nominal_modal_awal=$hasil_modal_awal->nominal;

		}else{

			$nominal_modal_awal=@$persediaan_awal +  @$kas_awal;
		}


		$nominal_kas=(@$hasil_pemasukan_kas->nominal + @$kas_awal) -$hasil_pengeluaran_kas->nominal;
		$nominal_modal=(@$laba + @$nominal_modal_awal)- @$rugi;
		$nominal_persediaan=@$hasil_persediaan->nominal+@$persediaan_awal;
		?>
		<tbody>
			
			<tr>
				<td>1.</td>
				<td>Kas</td>
				<td class="text-right">
					<?php echo @format_rupiah($nominal_kas);?>
					<input type="hidden" name="aktiva[]" value="<?php echo @$nominal_kas;?>|Kas">
				</td>
				<td>3.</td>
				<td>Modal</td>
				<td class="text-right">
					<?php echo @format_rupiah($nominal_modal);?>
					<input type="hidden" name="pasiva[]" value="<?php echo @$nominal_modal;?>|Modal">
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
			</tr>


			<tr>
				<td>2.</td>
				<td>Persediaan</td>
				<td class="text-right">
					<?php echo @format_rupiah($nominal_persediaan);?>
					<input type="hidden" name="aktiva[]" value="<?php echo @$nominal_persediaan;?>|Persediaan">
				</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
				<td>&nbsp;</td>
				<td></td>
				<td></td>
			</tr>
			<?php
			$aktiva=$nominal_kas+@$nominal_persediaan;
			$pasiva=$nominal_modal;
			?>
			<tr>
				<th></th>
				<th class="text-center">Jumlah</th>
				<th class="text-right"><?php echo @format_rupiah($aktiva);?></th>
				<th></th>
				<th class="text-center">Jumlah</th>
				<th class="text-right"><?php echo @format_rupiah($pasiva);?></th>
			</tr>
		</tbody>
	</table>
</body>
</html>