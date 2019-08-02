
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Treatment</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Treatment</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Laporan Treatment</span>
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
								<button style="margin-left: 5px" type="button" id="cetak_data" class="btn btn-info pull-right"><i class="fa fa-print" ></i> Print</button>
								<button style="width: 90px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>

						<div class="col-md-12 row">
							<div class="sukses" ></div>
							<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Kode Treatment</th>
										<th>Nama Treatment</th>
										<th>Harga</th>
										<th>QTY</th>
										<th>Diskon</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody id="cari_transaksi">
									<?php
									$this->db->group_by('kode_item');
									$this->db->select('kode_item');
									$this->db->select('tanggal_transaksi');
									$this->db->where('jenis_item', 'Treatment');
									$this->db->from('olive_kasir.opsi_transaksi_layanan');
									$this->db->join('olive_kasir.transaksi_layanan', 'olive_kasir.opsi_transaksi_layanan.kode_transaksi = olive_kasir.transaksi_layanan.kode_transaksi', 'left');
									$data_item=$this->db->get()->result();
									$no=1;
									$grand_total=0;
									foreach ($data_item as $item) {
										

										$this->db->select('nama_perawatan');
										$this->db->select('jenis_item');
										$this->db->select('kode_item');
										$this->db->select('olive_kasir.opsi_transaksi_layanan.harga');
										$this->db->select('olive_kasir.opsi_transaksi_layanan.jenis_diskon');
										$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_persen');
										$this->db->select('olive_kasir.opsi_transaksi_layanan.diskon_rupiah');

										$this->db->where('kode_item', $item->kode_item);
										$this->db->group_by('jenis_diskon');
										$this->db->group_by('diskon_persen');
										$this->db->group_by('diskon_rupiah');
										$this->db->where('jenis_item', 'Treatment');
										$this->db->from('olive_kasir.opsi_transaksi_layanan');
										$this->db->join('olive_master.master_perawatan', 'olive_kasir.opsi_transaksi_layanan.kode_item = olive_master.master_perawatan.kode_perawatan', 'left');
										$get_data=$this->db->get()->result();
										
										$subtotal=0;
										$total=0;
										foreach ($get_data as  $data) {
											$this->db->where('jenis_item', $data->jenis_item);
											$this->db->where('kode_item', $data->kode_item);
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
												<td><?php echo $data->nama_perawatan;?></td>                  
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
								</tbody>
							</table>
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
	$('#cari').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		if (tgl_awal=='' || tgl_akhir==''){ 
			alert('Masukan Tanggal Awal & Tanggal Akhir..!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url().'laporan/laporan_treatment/cari_data'; ?>",  
				cache :false,

				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#cari_transaksi").html(data);
				} 
			});
		}
	});
	$('#cetak_data').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		window.open("<?php echo base_url().'laporan/laporan_treatment/print_data'; ?>/"+tgl_awal+'/'+tgl_akhir);
	});
</script>
