
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Produk Keluar</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Produk Keluar</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Produk Keluar</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<div class="sukses" ></div>
						<div class="row">
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="text" class="form-control tgl" id="tgl_awal">
								</div>
							</div>

							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="text" class="form-control tgl" id="tgl_akhir">
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<a onclick="cari_day()" style="width: 90px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<br>

						<div class="col-md-12 row">
							<div class="sukses" ></div>
							<div id="load_table">
								<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
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
											$this->db->group_by('kode_item');
											$this->db->select('kode_item');
											$this->db->select('jenis_item');
											$this->db->select('tanggal_transaksi');
											$this->db->where('jenis_item !=', 'Treatment');
											$this->db->where('jenis_item !=', 'kartu member');
											$this->db->from('olive_kasir.opsi_transaksi_layanan');
											$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
											$data_item=$this->db->get()->result();
											$no=1;
											$grand_total=0;
											foreach ($data_item as $item) {


												$this->db->select('nama_produk');
												$this->db->select('jenis_item');
												$this->db->select('kode_item');
												$this->db->select('olive_kasir.opsi_transaksi_layanan.harga');
												$this->db->select('olive_kasir.opsi_transaksi_layanan.jenis_diskon');
												$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_persen');
												$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_rupiah');

												$this->db->where('kode_item', @$item->kode_item);
												$this->db->where('jenis_item', @$item->jenis_item);
												$this->db->group_by('jenis_diskon');
												$this->db->group_by('diskon_persen');
												$this->db->group_by('diskon_rupiah');
												$this->db->from('olive_kasir.opsi_transaksi_layanan');
												$this->db->join('olive_master.master_produk', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_produk.kode_produk', 'left');
												$get_data=$this->db->get()->result();

												$subtotal=0;
												$total=0;
												foreach ($get_data as  $data) {
													$this->db->where('jenis_item', @$data->jenis_item);
													$this->db->where('kode_item', @$data->kode_item);
													$this->db->where('olive_kasir.opsi_transaksi_layanan.jenis_diskon', $data->jenis_diskon);
													if($data->jenis_diskon=='persen'){
														$this->db->where('olive_kasir.opsi_transaksi_layanan.diskon_persen', $data->diskon_persen);
													}else if ($data->jenis_diskon=='rupiah') {
														$this->db->where('olive_kasir.opsi_transaksi_layanan.diskon_rupiah', $data->diskon_rupiah);
													}

													$this->db->select_sum('qty');
													$this->db->from('olive_kasir.opsi_transaksi_layanan');
													$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
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
									</div>
								</div>

							</div>

							<!------------------------------------------------------------------------------------------------------>

						</div>
					</div>
				</div><!-- /.col -->
			</div>
		</div>    
	</div>  
	<script src="<?php echo base_url().'component/lib/jquery.min.js'?>"></script>
	<script src="<?php echo base_url().'component/lib/zebra_datepicker.js'?>"></script>
	<link rel="stylesheet" href="<?php echo base_url().'component/lib/css/default.css'?>"/>
	<script type="text/javascript">

		$('.tgl').Zebra_DatePicker({});
		
		$("#print").click(function(){
			var tgl_awal		= $("#tgl_awal").val();
			var tgl_akhir 		= $("#tgl_akhir").val();
			window.open("<?php echo base_url().'laporan/laporan_produksi_keluar/print_produksi_keluar/'; ?>"+tgl_awal+"/"+tgl_akhir);
		});

		function cari_day(){
			tgl_awal  = $('#tgl_awal').val();
			tgl_akhir = $('#tgl_akhir').val();
			if (tgl_awal != '' && tgl_akhir != '') {
				$.ajax({
					url: '<?php echo base_url('laporan/laporan_produksi_keluar/load_data_cari'); ?>',
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
