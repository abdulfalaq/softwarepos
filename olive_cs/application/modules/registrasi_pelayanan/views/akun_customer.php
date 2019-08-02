<style type="text/css">
	.bg-yellow {
		border-color: #c49f47 !important;
		background-image: none !important;
		background-color: #c49f47 !important;
		color: #FFFFFF !important;
	}
	.bg-red {
		border-color: #cb5a5e !important;
		background-image: none !important;
		background-color: #cb5a5e !important;
		color: #FFFFFF !important;
	}
	.bg-blue {
		border-color: #3598dc !important;
		background-image: none !important;
		background-color: #3598dc !important;
		color: #FFFFFF !important;
	}
	.bg-purple {
		border-color: #8e5fa2 !important;
		background-image: none !important;
		background-color: #8e5fa2 !important;
		color: #FFFFFF !important;
	}
	.purple.btn {
		color: #FFFFFF;
		background-color: #8e5fa2;
	}
	.bg-red {
		border-color: #cb5a5e !important;
		background-image: none !important;
		background-color: #cb5a5e !important;
		color: #FFFFFF !important;
	}
	.bg-green {
		border-color: #26a69a !important;
		background-image: none !important;
		background-color: #26a69a !important;
		color: #FFFFFF !important;
	}
	.yellow.btn {
		color: #FFFFFF;
		background-color: #c49f47;
	}
	.blue.btn {
		color: #FFFFFF;
		background-color: #3598dc;
	}
	.red.btn {
		color: #FFFFFF;
		background-color: #cb5a5e;
	}
	.yellow.btn {
		color: #FFFFFF;
		background-color: #c49f47;
	}
	body{
		background-color: #e4feff;
	}

	.form_shadow{
		background-color: white;
		padding: 20px;
		box-shadow: 0px 2px 8px grey;
	}

	td, th, tr{
		border:solid 1px #217377 !important;
	}

	td{
		font-size: 14px;
		padding: 7px;
	}

	.modal-body{
		height: 250px;
		overflow-y: auto;
	}
	.table-bordered{
		border:solid 1px #217377 !important;
	}
	.btn-shadow{
		box-shadow: 0px 2px 5px #7f7171;
	}
	.box-pannel{
		padding: 5px !important;
		padding-left: 15px !important;
		padding-right: 10px !important;
		box-shadow: 0px 2px 6px grey;
	}
	.box-girl{
		background-color: #ff01cc;
		box-shadow: 0px 2px 7px #cbcbcb;
		transition:all 0.4s;
	}

	.box-tosca{
		box-shadow: 0px 2px 8px #1a3f42;
	}

	.ps {
		width: 20%;
		float: left;
	}
	table.dataTable thead th, table.dataTable thead td {
		padding: 5px;
	}
	label{
		margin-top: 10px;
	}

	.dataTables_filter{
		margin-right: 20px;
	}
</style>

<a href="<?php echo base_url('registrasi_pelayanan'); ?>"><button class="button-back"></button></a>

<div class="clearfix"></div>

<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-7" style="padding: 0 10px">
				<div class="form_shadow" style="margin-top: 10px;padding: 0px">
					<div class="panel panel-default">
						<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
							<h4>AKUN CUSTOMER</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<button id="record_anggota" disabled="" class="btn btn-md btn-info btn-no-radius btn-shadow pull-right" style="width: 20%;padding: 5px;margin:5px;" onclick="rekam_medis()">REKAM MEDIS</button>
									<button id="rekam_medis" disabled="" class="btn btn-md btn-info btn-no-radius btn-shadow pull-right" style="width: 30%;padding: 5px;margin:5px;" onclick="record_transaksi()">RECORD TRANSAKSI</button>
								</div>
							</div>
							<h4 style="background-color: #62b52a;color: white;padding: 15px; box-shadow: 1px 2px 5px #5c5c5c;">PROFIL CUSTOMER</h4>
							<div class="row">
								<form>
									<div class="col-md-12">
										<label>Kode Customer</label>
										<input type="text" class="form-control" readonly="" id="kode_customer">
									</div>
									<div class="col-md-12">
										<label>Nama Customer</label>
										<input type="text" class="form-control" readonly="" id="nama_customer">
									</div>
									<div class="col-md-12">
										<label>NO. KTP / SIM</label>
										<input type="number" class="form-control" readonly="" id="no_ktp">
									</div>
									<div class="col-md-12">
										<label>Tempat Lahir</label>
										<input type="text" class="form-control" readonly="" id="tempat_lahir">
									</div>
									<div class="col-md-12">
										<label>Tanggal Lahir</label>
										<input type="text" class="form-control" readonly="" id="tanggal_lahir">
									</div>
									<div class="col-md-12">
										<label>Jenis Kelamin</label>
										<input type="text" class="form-control" readonly="" id="jenis_kelamin">
									</div>
									<div class="col-md-12">
										<label>Alamat Customer</label>
										<input type="text" class="form-control" readonly="" id="alamat_customer">
									</div>
									<div class="col-md-12">
										<label>No.Telp</label>
										<input type="text" class="form-control" readonly="" id="no_telp">
									</div>
									<div class="col-md-12">
										<label>Pekerjaan</label>
										<input type="text" class="form-control" readonly="" id="pekerjaan">
									</div>
									<div class="col-md-12">
										<label>Status Perkawinan</label>
										<input type="text" class="form-control" readonly="" id="status_perkawainan">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div  class="col-md-5" id="tabel3">
				<div class="row" style="margin-bottom: 8px">
					<div class="ps text-center">
						<a href="<?php echo base_url().'registrasi_pelayanan'; ?>">
							<img src="<?php echo base_url(''); ?>assets/images/icon/I3.png" style="width: 55px;max-height: 55px;margin-bottom:7px">
							<label style="font-size: 10px">REGISTER PELAYANAN</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/tambah_customer'; ?>">
							<img  src="<?php echo base_url(); ?>assets/images/icon/I2.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">TAMBAH CUSTOMER</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/akun_customer'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/I1.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">AKUN CUSTOMER</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/order_paket'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/I4.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">ORDER PAKET</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/layanan_paket'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/list transaksi.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">DATA PAKET</label>
						</a>
					</div><hr>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
						<h4>AKUN CUSTOMER</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div style="padding: 5px;margin-top: 0px">
								<table class="table table-striped table-bordered" id="datatable" style="font-size: 12px;padding: 0 !important">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Customer</th>
											<th>Nama Customer</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 0;
										$this->db_master->from('master_member');
										$this->db_master->where('status_member', '1');
										$get_data_member = $this->db_master->get()->result();
										foreach ($get_data_member as $value) { $no++;?>										
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo $value->kode_member ?></td>
												<td><?php echo $value->nama_member ?></td>
												<td>
													<a onclick="get_detail_to('<?php echo $value->id ?>')" class="btn btn-info btn-no-radius" style="width: 50px;font-size: 10px;padding: 10px"><i class="fa fa-search"></i></a>
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
		</div>
	</div>
	<input type="hidden" id="kode_member">
	<div id="modal-RekamMedis" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" style="color: white;width: 85%">
			<div class="modal-content" style="border-radius:0px;background-color:#217377">
				<div class="modal-body" style="height: 640px ; padding: 30px">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<center>
						<img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" style="width: 60px" alt="Olive">
						<h4 class="modal-title">OLIVE TREE</h4>
						<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc">REKAM MEDIS CUSTOMER</div><br>
					</center>
					<div class="col-md-12">
						<div class="col-md-5">
						</div>
						<div class="col-md-5">
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<div class="col-md-12" style="background-color: white;padding: 0;margin-left: 30px;width: 94%">
						<table width="100%" class="table_rekam_medis">
							<thead>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TANGGAL TRANSAKSI</div>
								</td>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">ANAMNESA</div>
								</td>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">DIAGNOSA</div>
								</td>
							</thead>
							<tbody id="data_rekam_medis" style="color: black;">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-record-transaksi" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" style="color: white;width: 85%">
			<div class="modal-content" style="border-radius:0px;background-color:#217377">
				<div class="modal-body" style="height: 640px ; padding: 30px">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<center>
						<img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" style="width: 60px" alt="Olive">
						<h4 class="modal-title">OLIVE TREE</h4>
						<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc">RECORD TRANSAKSI</div><br>
					</center>
					<div class="col-md-12">
						<div class="col-md-5">
						</div>
						<div class="col-md-5">
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<div class="col-md-12" style="background-color: white;padding: 0;margin-left: 30px;width: 94%">
						<table width="100%" class="table_rekam_medis">
							<thead>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TANGGAL TRANSAKSI</div>
								</td>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TREATMENT / PRODUK</div>
								</td>
								<td style="background-color: #217377;">
									<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">QUANTITY</div>
								</td>
							</thead>
							<tbody id="data_record_anggota" style="color: black;">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		function  get_detail_to(key) {
			$.ajax({  
				type :"post",  
				url : "<?php echo base_url() . 'registrasi_pelayanan/akun_customer/get_data_member' ?>",  
				cache :false,  
				data :{id:key},
				dataType: 'Json',
				beforeSend:function(){
					$('#record_anggota').attr('disabled',true);
					$('#rekam_medis').attr('disabled',true);
				},
				success : function(data) { 
					$('#kode_customer').val(data.kode_member);
					$('#nama_customer').val(data.nama_member);
					$('#no_ktp').val(data.no_ktp);
					$('#tempat_lahir').val(data.tempat_lahir);
					$('#tanggal_lahir').val(data.hbd);
					$('#jenis_kelamin').val(data.jenis_kelamin);
					$('#alamat_customer').val(data.alamat_member);
					$('#no_telp').val(data.telp_member);
					$('#pekerjaan').val(data.pekerjaan);
					$('#status_perkawainan').val(data.status_perkawinan);
					$('#record_anggota').attr('disabled',false);
					$('#rekam_medis').attr('disabled',false);
					$('#data_rekam_medis').load("<?php echo base_url('registrasi_pelayanan/akun_customer/table_rekam_medis'); ?>/"+data.kode_member);
					$('#data_record_anggota').load("<?php echo base_url('registrasi_pelayanan/akun_customer/table_record_transaksi'); ?>/"+data.kode_member);
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			}); 
		}

		function rekam_medis() {
			$('#modal-RekamMedis').modal('show');
		}
		function record_transaksi() {
			$('#modal-record-transaksi').modal('show');	
		}
	</script>