
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
					<span class="pull-left" style="font-size: 24px">Data Laporan Keuangan</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="sukses" ></div>
						<div class="row">

						</div>
						<br>
						<center><h3>Laporan Arus Kas </h3></center>

						<div class="col-md-12 row">
							<div class="sukses" ></div>
							<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
								<table  class="table table-striped table-hover table-bordered" id="tabel_daftarr"  style="font-size:1em;">
									<?php

									$tgl_sebelumnya =date('Y-m-d',strtotime('- 1 month', strtotime(date('Y-m-d'))));
									$bulan_sebelumnya=date('m',strtotime($tgl_sebelumnya));
									$tahun_sebelumnya=date('Y',strtotime($tgl_sebelumnya));

									$kas_lalu = $this->db->get_where('clouoid1_olive_keuangan.laporan_neraca',array('nama_akun' =>'Kas','kategori_keuangan' =>'Aktiva','bulan'=>$bulan_sebelumnya,'tahun'=>$tahun_sebelumnya));
									$hasil_kas_lalu = $kas_lalu->row();

									$saldo_awal = $this->db->get_where('clouoid1_olive_master.setting_saldo_awal',array('bulan'=>date('m'),'tahun'=>date('Y')));
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
										$get_pemasukan=$this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pendapatan'));
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
										$get_pengeluaran=$this->db->get_where('clouoid1_olive_keuangan.laporan_arus_kas',array('jenis_keuangan' =>'Pengeluaran'));
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
		var total_pengeluaran = $("#total_pengeluaran").val();
		window.open("<?php echo base_url().'laporan/laporan_arus_kas/print_perlengkapan'; ?>/"+total_pengeluaran);
	});
</script>