
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Peruabahan Modal</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Peruabahan Modal</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Peruabahan Modal</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="sukses" ></div>
						<div class="row"> 

						</div>
						<center><h3>Laporan Peruabahan Modal </h3></center>

						<div class="col-md-12 row">
							<div class="sukses" ></div>
							<table  class="table table-striped table-hover table-bordered" id="tabel_daftarr"  style="font-size:1em;">
								<?php 
								$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
								$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
								$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

								$modal_awal = $this->db->get_where('olive_keuangan.laporan_neraca',array('nama_akun' =>'Modal','kategori_keuangan' =>'Pasiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
								$hasil_modal_awal = $modal_awal->row();

								if(!empty($hasil_modal_awal)){
									$nominal_modal_awal=$hasil_modal_awal->nominal;

								}else{
									$saldo_awal = $this->db->get_where('olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
									$hasil_saldo_awal = $saldo_awal->row();
									$nominal_modal_awal=@$hasil_saldo_awal->persediaan_awal +  @$hasil_saldo_awal->kas_awal;
								}

								$this->db->select_sum('nominal');
								$pemasukan = $this->db->get_where('olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pemasukan','bulan'=>date('m'),'tahun'=>date('Y')));
								$hasil_pemasukan = $pemasukan->row();

								$this->db->select_sum('nominal');
								$pengeluaran = $this->db->get_where('olive_keuangan.laporan_laba_rugi',array('jenis_keuangan' =>'Pengeluaran','bulan'=>date('m'),'tahun'=>date('Y')));
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

						</label>

					</div>
				</div>

				<!------------------------------------------------------------------------------------------------------>

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
	
	$("#print").click(function(){
		var nominal_modal_awal = $("#nominal_modal_awal").val();
		window.open("<?php echo base_url().'laporan/laporan_perubahan_modal/print_perlengkapan'; ?>/"+nominal_modal_awal);
	});
</script>
