
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Keuangan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Keuangan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Keuangan</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<div class="row">
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Bulan</span>
									<select class="form-control" name="bulan" id="bulan" required="">              
										<option value="">-- Bulan --</option>
										<option value="01">Januari</option>
										<option value="02">Februari </option>
										<option value="03"> Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06"> Juni </option>
										<option value="07">Juli </option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober </option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</div>
							</div>

							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tahun</span>
									<select class="form-control" name="tahun" id="tahun" required="">              
										<option value="">
											-- Tahun --
										</option>
										<?php
										$tahun_awal=date('Y');
										$tahun_akhir=date('Y')-10;
										for ($tahun=$tahun_awal; $tahun > $tahun_akhir; $tahun--) { 
											?>
											<option value="<?php echo $tahun;?>"><?php echo $tahun;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<button style="width: 90px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
						<?php
						$bulan_tahun=date('Y-m');

						$penjualan = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.1.1','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_penjualan = $penjualan->row();

						$register_member = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.4.1','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_register_member = $register_member->row();

						$pendapatan_lain = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','kode_kategori_keuangan'=>'1.3.1','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_pendapatan_lain = $pendapatan_lain->row();

						$hpp = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'2.6.2','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_hpp = $hpp->row();

						$gaji_karyawan = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_gaji_karyawan = $gaji_karyawan->row();

						$operasional = $this->db->get_where('clouoid1_olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','kode_kategori_keuangan'=>'2.5.4','bulan'=>date('m'),'tahun'=>date('Y')));
						$hasil_operasional = $operasional->row();


						?>
						<div class="box-body">            
							<div class="sukses" ></div>
							<div id="hasil_cari">
								<div class="col-md-12">
									<center><h3>Laporan Laba Rugi Periode Bulan <?php echo BulanIndo(date('m'));?> Tahun <?php echo date('Y');?></h3></center>
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
										Periode Bulan <?php echo BulanIndo(date('m'));?> Tahun <?php echo date('Y');?> = 
										<?php  echo @format_rupiah($hasil);?>      
									</b>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>    
</div>
	<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menghapus data ini?</h2>
					<input type="hidden" id="id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#cari').click(function(){
			var bulan =$("#bulan").val();
			var tahun =$("#tahun").val();
			if (bulan=='' || tahun==''){ 
				alert('Pilih Bulan & Tahun ..!')
			}
			else{
				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url().'laporan/laporan_laba_rugi/cari_data'; ?>",  
					cache :false,

					data : {bulan:bulan,tahun:tahun},
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success : function(data) {
						$(".tunggu").hide();  
						$("#hasil_cari").html(data);
					} 
				});
			}
		});
		$("#print").click(function(){
			var bulan = $("#bulan").val();
			var tahun = $("#tahun").val();
			window.open("<?php echo base_url().'laporan/laporan_laba_rugi/print_perlengkapan'; ?>/"+bulan+'/'+tahun);
		});
	</script>