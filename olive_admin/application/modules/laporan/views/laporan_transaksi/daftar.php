
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Transaksi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Transaksi</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Transaksi</span>
					<a id="print" target="_blank" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<div class="row">
							<div class="col-md-4" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="text" class="form-control tgl" id="tgl_awal">
								</div>
							</div>

							<div class="col-md-4" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="text" class="form-control tgl" id="tgl_akhir">
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<a onclick="cari_day()" style="width: 100%" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<div id="load_table">
							<br>
							<?php
							$this->db->select_sum('grand_total');
							$get_transaksi_tunai=$this->db->get_where('olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'tunai'));
							$hasil_transaksi_tunai=$get_transaksi_tunai->row();

							$this->db->select_sum('grand_total');
							$get_transaksi_debit=$this->db->get_where('olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'debit'));
							$hasil_transaksi_debit=$get_transaksi_debit->row();

							$this->db->select_sum('grand_total');
							$get_transaksi_cc=$this->db->get_where('olive_kasir.transaksi_layanan',array('jenis_transaksi' =>'kredit'));
							$hasil_transaksi_cc=$get_transaksi_cc->row();

							$total_transaksi=$hasil_transaksi_tunai->grand_total + $hasil_transaksi_debit->grand_total +$hasil_transaksi_cc->grand_total;

							$this->db->select_sum('subtotal');
							$get_omset_treatment=$this->db->get_where('olive_kasir.opsi_transaksi_layanan',array('jenis_item' =>'treatment'));
							$hasil_omset_treatment=$get_omset_treatment->row();

							$this->db->select_sum('subtotal');
							$this->db->where('jenis_item !=', 'Treatment');
							$this->db->where('jenis_item !=', 'kartu member');
							$get_omset_produk=$this->db->get('olive_kasir.opsi_transaksi_layanan');
							$hasil_omset_produk=$get_omset_produk->row();

							$this->db->select_sum('subtotal');
							$get_omset_member=$this->db->get_where('olive_kasir.opsi_transaksi_layanan',array('jenis_item' =>'kartu member'));
							$hasil_omset_member=$get_omset_member->row();

							$get_opsi_layanan=$this->db->get_where('olive_kasir.opsi_transaksi_layanan',array('jenis_diskon !=' =>''));
							$hasil_opsi_layanan=$get_opsi_layanan->result();
							$total_diskon=0;
							foreach ($hasil_opsi_layanan as $opsi) {
								if($opsi->jenis_diskon=='persen' || $opsi->jenis_diskon=='Persen'){
									$total_diskon +=(($opsi->qty * $opsi->harga) * $opsi->diskon_persen)/100;
								}else{
									$total_diskon +=$opsi->diskon_rupiah;
								}
							}
							?>
							<div id="cari_transaksi">
								<div id="load_laporan">
									<table class="table table-striped table-hover table-bordered" id=""  style="font-size:1.0em;">
										<thead>
											<tr>
												<th width="30%">Keterangan</th>
												<th>Nominal</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Tunai</td>
												<td align="right"><?php echo @format_rupiah($hasil_transaksi_tunai->grand_total);?></td>
											</tr>
											<tr>
												<td>Debit</td>
												<td align="right"><?php echo @format_rupiah($hasil_transaksi_debit->grand_total);?></td>
											</tr>
											<tr>
												<td>CC</td>
												<td align="right"><?php echo @format_rupiah($hasil_transaksi_cc->grand_total);?></td>
											</tr>
											<tr>
												<td><b>Total</b></td>
												<td align="right"><b><?php echo @format_rupiah($total_transaksi);?></b></td>
											</tr>
											<tr>
												<td>Omset Treatment</td>
												<td align="right"><?php echo @format_rupiah($hasil_omset_treatment->subtotal);?></td>
											</tr>
											<tr>
												<td>Omset Produk</td>
												<td align="right"><?php echo @format_rupiah($hasil_omset_produk->subtotal);?></td>
											</tr>
											<tr>
												<td>Omset Member</td>
												<td align="right"><?php echo @format_rupiah($hasil_omset_member->subtotal);?></td>
											</tr>
											<tr>
												<td><b>Total Diskon</b></td>
												<td align="right"><b><?php echo @format_rupiah($total_diskon);?></b></td>
											</tr>
										</tbody>                
									</table>
									<div class="row">

									</div>
								</div>
								<br>
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 24px">Pembatalan</span>
										<br>
										<br>
									</div>
									<div class="panel-body">
										<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
											<thead>
												<tr>
													<th>No</th>
													<th>Kode Transaksi</th>
													<th>Total Nominal</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$this->db->group_by('kode_transaksi');
												$this->db->select('kode_transaksi');
												$this->db->select_sum('subtotal');
												$get_batal=$this->db->get('olive_kasir.opsi_transaksi_batal');
												$hasil_batal=$get_batal->result();
												$no=1;
												foreach ($hasil_batal as $value) {
													?>
													<tr>
														<td><?php echo $no++?></td>
														<td><?php echo @$value->kode_transaksi;?></td>
														<td><?php echo @format_rupiah($value->subtotal);?></td>
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
					url : "<?php echo base_url().'laporan/laporan_transaksi/load_data_cari'; ?>",  
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
		$("#print").click(function(){
			var tgl_awal		= $("#tgl_awal").val();
			var tgl_akhir 		= $("#tgl_akhir").val();
			window.open("<?php echo base_url().'laporan/laporan_transaksi/print_perlengkapan/'; ?>"+tgl_awal+"/"+tgl_akhir);
		});
	</script>