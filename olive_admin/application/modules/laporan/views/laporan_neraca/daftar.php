
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Neraca</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Neraca</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Neraca</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="sukses" ></div>
						<div class="row"> 
						</div>
						<div class="btn btn-info" onclick="tutup_buku()"><i class="fa fa-money"></i> Tutup Buku</div>
						<center><h3>Laporan Neraca </h3></center>
						<form id="data_form">
							<div class="col-md-12 row">
								<div class="sukses" ></div>
								<table  class="table table-striped table-hover table-bordered" id="tabel_daftarr"  style="font-size:1em;">
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
									$pemasukan_kas = $this->db->get_where('olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pendapatan','bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_pemasukan_kas = $pemasukan_kas->row();

									$this->db->select_sum('nominal');
									$pengeluaran_kas = $this->db->get_where('olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_pengeluaran_kas = $pengeluaran_kas->row();


									$persediaan = $this->db->get_where('olive_keuangan.laporan_persediaan',array('nama_kategori_keuangan' =>'Persediaan','bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_persediaan = $persediaan->row();

									$saldo_awal = $this->db->get_where('olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_saldo_awal = $saldo_awal->row();
									if(!empty($hasil_saldo_awal)){
										$persediaan_awal=@$hasil_saldo_awal->persediaan_awal;
										$kas_awal=@$hasil_saldo_awal->kas_awal;
									}else{
										$persediaan_awal=0;
										$kas_awal=0;
									}

									$this->db->select_sum('nominal');
									$pemasukan_modal = $this->db->get_where('olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_pemasukan_modal = $pemasukan_modal->row();

									$this->db->select_sum('nominal');
									$pengeluaran_modal = $this->db->get_where('olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_pengeluaran_modal = $pengeluaran_modal->row();

									if($hasil_pemasukan_modal->nominal >= $hasil_pengeluaran_modal->nominal){
										$laba=$hasil_pemasukan_modal->nominal-$hasil_pengeluaran_modal->nominal;
										$rugi=0;
									}elseif ($hasil_pemasukan_modal->nominal < $hasil_pengeluaran_modal->nominal) {
										$laba=0;
										$rugi=$hasil_pengeluaran_modal->nominal-$hasil_pemasukan_modal->nominal;
									}


									$modal_awal = $this->db->get_where('olive_keuangan.laporan_neraca',array('nama_akun' =>'Modal','kategori_keuangan' =>'Pasiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
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
							</form>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.col -->
</div>
</div>    
</div>  
<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data Produk tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()"  class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#cari').click(function(){

		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		if (bulan =='' || tahun == ''){ 
			alert('Masukkan Tanggal Awal dan Akhir dengan Benar ...!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url().'laporan/laporan_neraca/cari_labarugi';?>",  
				cache :false,
				data : {bulan:bulan,tahun:tahun},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#hasil_cari").html(data);
				},  
				error : function(data) {
				}  
			});
		}
	});

	function tutup_buku(){

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url().'laporan/laporan_neraca/tutup_buku';?>",  
			cache :false,
			data : $('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {
				$(".tunggu").hide();  
				//window.location.reload();
			},  
			error : function(data) {
			}  
		});
	}

	$("#cetak_penjualan").click(function(){
		window.open("<?php echo base_url().'laporan/laporan_neraca/cetak_laporan_neraca'; ?>");
	});


	$("#print").click(function(){
		var nominal_kas = $("#nominal_kas").val();
		window.open("<?php echo base_url().'laporan/laporan_neraca/print_perlengkapan'; ?>/"+nominal_kas);
	});
</script>