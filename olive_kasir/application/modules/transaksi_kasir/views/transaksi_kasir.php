
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Transaksi Kasir</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Transaksi Kasir </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<form id="pencarian_form" method="post" style="margin-left: 18px;" class="form-horizontal" target="_blank">

						<div class="row">
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl" id="tgl_awal" />
								</div>
							</div>
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir" />
								</div>
							</div>

							<div class=" col-md-4">
								<div class="input-group">
									<a onclick="seacrh_by_date()" class="btn btn-success"><i class="fa fa-search"></i> Cari</a>
								</div>
							</div>
						</div>
						<br>
					</form>
					<br>
					<div id="table_replace">
						<table style="font-size: 1.0em;" id="datatable" class="table table-bordered table-hover ">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Tanggal</th>
									<th>Check In</th>
									<th>Check Out</th>
									<th>Petugas</th>
									<th>Saldo Awal</th>
									<th>Saldo Akhir</th>
									<th>Nominal Penjualan</th>
									<th>Status Kasir</th>
									<th>Status Validasi</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								$this->db->select('*,kasir.status as status_kasir');
								$this->db->order_by('kasir.id', 'desc');
								$this->db->like('kasir.tanggal',date('Y-m'));
								$this->db->from('clouoid1_olive_kasir.transaksi_kasir kasir');
								$this->db->join('clouoid1_olive_master.master_user user', 'kasir.petugas = user.id', 'left');
								$get_transaksi = $this->db->get()->result();
								foreach ($get_transaksi as $value) { $no++;?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value->kode_transaksi ?></td>
									<td><?php echo tanggalIndo($value->tanggal) ?></td>
									<td><?php echo $value->check_in ?></td>
									<td><?php echo $value->check_out ?></td>
									<td><?php echo $value->nama_karyawan ?></td>
									<td><?php echo format_rupiah($value->saldo_awal) ?></td>
									<td><?php echo format_rupiah($value->saldo_akhir) ?></td>
									<td><?php echo format_rupiah($value->nominal_penjualan) ?></td>
									<td><?php echo $value->status_kasir ?></td>
									<td><?php echo $value->validasi ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="<?php echo base_url('transaksi_kasir/detail/'.$value->kode_transaksi); ?>" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i> </a>
										</div>
									</td>
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

<script type="text/javascript">
function seacrh_by_date() {
	tgl_awal = $('#tgl_awal').val();
	tgl_akhir = $('#tgl_akhir').val();

	$.ajax( {
		type:"POST", 
		url : "<?php echo base_url() ?>transaksi_kasir/search_data_by_date",  
		cache :false,  
		data :{tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
		beforeSend:function(){
			$(".tunggu").show();  
		},
		success : function(data) {
			$(".tunggu").hide();  
			$("#table_replace").html(data);  			
		},  
		error : function(data) {  
			alert('Terjadi Kesalahan System Fungsi.');  
		}  
	});
}
</script>
