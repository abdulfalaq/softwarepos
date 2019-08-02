<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Laporan Piutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Piutang</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span style="font-size: 24px">Data Laporan Piutang </span>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="row">
								<div class="col-md-6">
									<h4>Pilih Bulan</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="month" id="bulan_report" class="form-control">
								</div>
								<div class="col-md-2">
									<button onclick="get_report_perbulan()" class="btn btn-info btn-no-radius">Oke</button>
								</div>
								<div class="col-md-4">
									<button onclick="print_out()" class="btn btn-primary btn-no-radius pull-right btn-print"><i class="fa fa-print"></i> PRINT OUT</button>
								</div>
							</div><br>

							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="datatable">
									<thead>
										<tr>
											<th>NO</th>
											<th>Tanggal Transaksi</th>
											<th>Tanggal Jatuh Tempo</th>
											<th>Nama Member</th>
											<th>Nominal Piutang</th>
											<th>Sisa Angsuran</th>
											<th>Petugas</th>
										</tr>
									</thead>
									<tbody id="load_data">

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

<script>
	$('.btn-print').hide();
	function get_report_perbulan () {
		bulan_report = $('#bulan_report').val();

		$.ajax({
			url: '<?php echo base_url('laporan/laporan_piutang/filtering_report'); ?>',
			type: 'post',
			data:{ bulan_report:bulan_report},
			success: function(data){
				$('#load_data').html(data);
				$('.btn-print').show();
			},
		});			
	}
	function print_out(){
		var bulan 		= $("#bulan").val();
		var tahun 		= $("#tahun").val();
		if (bulan != '' && tahun != '') {
			window.open("<?php echo base_url() . 'laporan/laporan_piutang/print_out_data/'; ?>"+bulan+"/"+tahun);
		}
	}
</script>
