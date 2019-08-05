
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Stok Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Stok Produk</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Stok Produk</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
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
								<button style="margin-left: 5px" type="button" id="print" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-print"></i> Print</button>
								<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<br>

						<div id="load_table">
							<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Nama Produk</th>
										<th>Stok Awal</th>
										<th>Masuk</th>
										<th>Keluar</th>
										<th>Adjust I</th>
										<th>Stok Akhir</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									$this->db->from('clouoid1_olive_master.master_produk');
									$get_bahan = $this->db->get()->result();
									foreach ($get_bahan as $value) { $no++; 
										$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_masuk');
										$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_keluar');
										$this->db->from('clouoid1_olive_gudang.transaksi_stok');
										$this->db->where('clouoid1_olive_gudang.transaksi_stok.kode_bahan',$value->kode_produk);
										$this->db->where('clouoid1_olive_gudang.transaksi_stok.jenis_transaksi !=','opname');
										$get_stok = $this->db->get()->row();
										$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_keluar');
										$this->db->select_sum('clouoid1_olive_gudang.transaksi_stok.stok_masuk');
										$this->db->from('clouoid1_olive_gudang.transaksi_stok');
										$this->db->where('clouoid1_olive_gudang.transaksi_stok.kode_bahan',$value->kode_produk);
										$this->db->where('clouoid1_olive_gudang.transaksi_stok.jenis_transaksi','opname');
										$get_adjust = $this->db->get()->row();

										$hasil_opname 	= $get_adjust->stok_masuk + $get_adjust->stok_keluar;
										$stok_akhir  	= ($value->real_stock + $get_stok->stok_masuk) - $get_stok->stok_keluar;

										?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $value->nama_produk ?></td>
											<td><?php echo $value->real_stock ?></td>
											<td><?php echo $get_stok->stok_masuk;  ?></td>
											<td><?php echo $get_stok->stok_keluar; ?></td>
											<td><?php echo $hasil_opname ?></td>
											<td><?php echo $stok_akhir ?></td>
										</tr>
										<?php }
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

		$("#print").click(function(){
			var tgl_awal		= $("#tgl_awal").val();
			var tgl_akhir 		= $("#tgl_akhir").val();
			window.open("<?php echo base_url().'laporan/laporan_stok_produk/print_stok_produk/'; ?>"+tgl_awal+"/"+tgl_akhir);
		});

		function cari_stok_day(){
			tgl_awal  = $('#tgl_awal').val();
			tgl_akhir = $('#tgl_akhir').val();

			if (tgl_awal != '' && tgl_akhir != '') {
				$.ajax({
					url: '<?php echo base_url('laporan/laporan_stok_produk/load_data_cari'); ?>',
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