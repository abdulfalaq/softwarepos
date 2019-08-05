<?php
$bulan=$this->input->post('bulan');
$tahun=$this->input->post('tahun');
if(!empty($bulan) && !empty($tahun)){
	$bulan_tahun=$tahun.'-'.$bulan;
}


$penjualan = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.1.1','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_penjualan = $penjualan->row();

$register_member = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.4.1','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_register_member = $register_member->row();

$pendapatan_lain = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.3.1','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_pendapatan_lain = $pendapatan_lain->row();

$hpp = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'2.6.2','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_hpp = $hpp->row();

$gaji_karyawan = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_gaji_karyawan = $gaji_karyawan->row();

$operasional = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'2.5.4','bulan'=>$bulan,'tahun'=>$tahun));
$hasil_operasional = $operasional->row();


?>
<div class="col-md-12">
	<center><h3>Laporan Laba Rugi Periode Bulan <?php echo BulanIndo($bulan);?> Tahun <?php echo $tahun;?></h3></center>
	<table  class="table table-striped table-hover table-bordered" id="tabel_daftarr"  style="font-size:1.0em;">
		<thead>
			<tr width="100%">
				<th>Akun Keuangan</th>
				<th>Nominal</th>
			</tr>
		</thead>
		<tbody style="width: 700px;" id="posts">
			<tr>
				<th colspan="2">Pemasukan</th>
			</tr>
			<tr>
				<td>Penjualan</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_penjualan->nominal); ?></td>
			</tr>

			<tr>
				<td>Register Member</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_register_member->nominal); ?></td>
			</tr>

			<tr>
				<td>Pendapatan Lain-lain</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_pendapatan_lain->nominal); ?></td>
			</tr>
			<?php
			$jumlah_pemasukan=@$hasil_penjualan->nominal + @$hasil_register_member->nominal + @$hasil_pendapatan_lain->nominal;
			?>
			<tr>
				<th class="text-center">Jumlah</th>
				<th class="text-right"><?php echo @format_rupiah($jumlah_pemasukan); ?></th>
			</tr>
			<tr>
				<th colspan="2">Pengeluaran</th>
			</tr>
			<tr>
				<td>HPP</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_hpp->nominal); ?></td>
			</tr>
			<tr>
				<td>Gaji Karyawan</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_gaji_karyawan->nominal); ?></td>
			</tr>
			<tr>
				<td>Operasional</td>
				<td class="text-right"><?php echo @format_rupiah($hasil_operasional->nominal); ?></td>
			</tr>
			<?php
			$jumlah_pengeluaran=@$hasil_hpp->nominal + @$hasil_gaji_karyawan->nominal+ @$hasil_operasional->nominal;
			?>
			<tr>
				<th class="text-center">Jumlah</th>
				<th class="text-right"><?php echo @format_rupiah($jumlah_pengeluaran); ?></th>
			</tr>
		</tbody>

	</table>
	<label style="font-size: 17px;"><b>
		<?php
		if($jumlah_pemasukan >= $jumlah_pengeluaran){
			echo "Laba";
			$hasil=$jumlah_pemasukan-$jumlah_pengeluaran;
		}elseif ($jumlah_pemasukan < $jumlah_pengeluaran) {
			echo "Rugi";
			$hasil=$jumlah_pengeluaran-$jumlah_pemasukan;
		}
		?>
		Periode Bulan <?php echo BulanIndo($bulan);?> Tahun <?php echo $tahun;?> = 
		<?php  echo @format_rupiah($hasil);?>      
	</b>
</label>
</div>