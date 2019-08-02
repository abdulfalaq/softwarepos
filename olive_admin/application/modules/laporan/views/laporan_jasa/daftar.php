
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Jasa Terapis</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Jasa Terapis</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5" id="">
							<div class="input-group">
								<span class="input-group-addon">Tanggal Awal</span>
								<input type="date" class="form-control tgl" id="tgl_awal">
							</div>
						</div>
						<div class="col-md-5" id="">
							<div class="input-group">
								<span class="input-group-addon">Tanggal Akhir</span>
								<input type="date" class="form-control tgl" id="tgl_akhir">
							</div>
						</div>                        
						<div class="col-md-2 pull-left">
							<button style="margin-left: 5px" type="button" id="cetak_penjualan" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-print"></i> Print</button>
							<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
						</div>
					</div>
					<br>
					<br>
					<div id="load_table">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>Kode Terapis</th>
									<th>Nama Terapis</th>
									<th>Treatment</th>
									<th>Jumlah</th>
									<th>Nominal Insentif</th>
									<th>Total</th>
								</tr>
							</thead>              
							<tbody>
								<?php 
								$this->db->group_by('kode_terapis');
								$this->db->join('olive_master.master_karyawan','olive_master.master_karyawan.kode_karyawan = olive_kasir.opsi_transaksi_layanan.kode_terapis','left');
								$get_terapis = $this->db->get_where('olive_kasir.opsi_transaksi_layanan',array('kode_terapis !=' => ''));
								$hasil_terapis = $get_terapis->result();
								$no=1;
								foreach ($hasil_terapis as $value) {

									$this->db->group_by('olive_kasir.opsi_transaksi_layanan.kode_item');
									$this->db->select_sum('olive_kasir.opsi_transaksi_layanan.qty');
									$this->db->select_sum('olive_keuangan.insentif_terapis.total_withdraw');
									$this->db->select('olive_master.master_perawatan.nama_perawatan');
									$this->db->select('olive_master.master_perawatan.insentif_terapi');
									$this->db->where('olive_kasir.opsi_transaksi_layanan.kode_terapis',$value->kode_terapis);

									$this->db->from('olive_kasir.opsi_transaksi_layanan');
									$this->db->join('olive_master.master_perawatan', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_perawatan.kode_perawatan', 'left');
									$this->db->join('olive_keuangan.insentif_terapis', 'olive_keuangan.insentif_terapis.kode_transaksi = olive_kasir.opsi_transaksi_layanan.kode_transaksi', 'left');
									$get_treatment= $this->db->get();
									$hasil_treatment = $get_treatment->result();
									$list=1;
									$total_terapis=0;
									foreach ($hasil_treatment as  $treatment) {
										$total_terapis +=$treatment->qty * $treatment->total_withdraw;
										if($list==1){
											?>
											<tr>
												<td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $no++?></td>
												<td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $value->kode_terapis;?></td>
												<td rowspan="<?php echo count($hasil_treatment);?>"><?php echo $value->nama_karyawan;?></td>
												<td><?php echo $treatment->nama_perawatan;?></td>
												<td><?php echo $treatment->qty;?></td>
												<td class="text-right"><?php echo @format_rupiah($treatment->total_withdraw);?></td>
												<td class="text-right"><?php echo @format_rupiah($treatment->qty * $treatment->total_withdraw);?></td>
											</tr>
											<?php
										}else{
											?>
											<tr>
												<td><?php echo $treatment->nama_perawatan;?></td>
												<td><?php echo $treatment->qty;?></td>
												<td class="text-right"><?php echo @format_rupiah($treatment->total_withdraw);?></td>
												<td class="text-right"><?php echo @format_rupiah($treatment->qty * $treatment->total_withdraw);?></td>
											</tr>
											<?php
										}
										$list++;
									}
									?>
									<tr>
										<th colspan="6" class="text-right">Total</th>
										<th class="text-right"><?php echo @format_rupiah($total_terapis);?></th>
									</tr>
									<?php
								}
								?>                
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>  
</div>    
<script type="text/javascript">

	$("#cetak_penjualan").click(function(){
		tgl_awal  = $('#tgl_awal').val();
		tgl_akhir = $('#tgl_akhir').val();
		
		window.open("<?php echo base_url().'laporan/laporan_jasa/print_data'; ?>/"+tgl_awal+'/'+tgl_akhir);
	});
	function cari_stok_day(){
		tgl_awal  = $('#tgl_awal').val();
		tgl_akhir = $('#tgl_akhir').val();
		
		if (tgl_awal != '' && tgl_akhir != '') {
			$.ajax({
				url: '<?php echo base_url('laporan/laporan_jasa/load_data_cari'); ?>',
				type: 'post',
				data:{tgl_akhir:tgl_akhir,tgl_awal:tgl_awal},
				success: function(hasil){
					$('#load_table').html(hasil);
				}
			});
		}else{
			alert('Harap Mengisi Form.');
		}

	}
	</script>