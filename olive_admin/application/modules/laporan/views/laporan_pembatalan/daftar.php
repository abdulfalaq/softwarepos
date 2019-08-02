
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
								<button style="margin-left: 5px" type="button" id="cetak_penjualan" class="btn btn-info pull-right"><i class="fa fa-print"></i> Print</button>
								<button style="width: 90px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
						<div id="cari_transaksi">
							<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
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
									<tr>
										<td>1</td>
										<td>acne lotion</td>
										<td>-</td>
										<td>10</td>
										<td>1</td>
										<td>0</td>
										<td>100</td>
									</tr>
								</tbody>                
							</table>

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
		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#id').val(key);
		}
		function hapus_data() {
			var id=$('#id').val();
			$.ajax({
				url: '<?php echo base_url('master/master_breed/hapus'); ?>',
				type: 'post',
				data:{id:id},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					$('#modal-hapus').modal('hide');
					window.location.reload();
				}
			});
		}
	</script>