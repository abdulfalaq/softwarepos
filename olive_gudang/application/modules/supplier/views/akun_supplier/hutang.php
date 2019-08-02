

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="#">Daftar Hutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_supplier=$this->uri->segment(4);
	$this->db->where('kode_supplier',$kode_supplier);
	$get_gudang2 = $this->db->get('olive_master.master_supplier')->row();
	?>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px;margin-left: 620px"><?php echo $get_gudang2->nama_supplier?></span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="container" style="margin-left: 10px">
									<div class="row">
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
												<li role="presentation" class="" id="menu_setting" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$get_gudang2->kode_supplier); ?>">Personal Data</a>
												</li>
												<li role="presentation" class="active" id="menu_pengajuan" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/hutang/'.$get_gudang2->kode_supplier); ?>" >Hutang</a>
												</li>
												<li role="presentation" class="" id="menu_validasi" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/record/'.$get_gudang2->kode_supplier); ?>">Record Transaksi</a>
												</li>
											</ul>
										</div>
									</div>
								</div><br>
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Awal</span>
										<input type="text" class="form-control tgl"  id="tgl_awal">
									</div>
								</div>
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Akhir</span>
										<input type="text" class="form-control tgl" id="tgl_akhir">
									</div>
								</div>                        
								<div class="col-md-2 pull-left">
									<button style="width: 147px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div><br>
							<div id="">
								<?php 
								$kode_supplier=$this->uri->segment(4);
								$this->db->order_by('id','DESC');
								$this->db->where('kode_supplier',$kode_supplier);
								$get_gudang = $this->db->get('olive_gudang.transaksi_hutang')->result();
								?>
								<table id="tabel_daftar" class="table table-bordered table-striped">
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Supplier</th>
										<th>Nominal Hutang</th>
										<th>Sisa Hutang</th>
										<th>Jatuh Tempo</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="cari_transaksi">
									<?php 
									$no = 0;
									foreach ($get_gudang as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= @$value->kode_transaksi ?></td>
											<td><?= tanggalIndo(@$value->tanggal_transaksi) ?></td>
											<td><?= @$value->kode_supplier ?></td>
											<td><?= format_rupiah(@$value->nominal_hutang)  ?></td>
											<td><?= format_rupiah(@$value->sisa)  ?></td>
											<td><?= tanggalIndo(@$value->tanggal_jatuh_tempo) ?></td>
											<td>
												<?php
												if (@$value->sisa == '0' ) {
													echo ('Lunas');
												} else {
													echo ('Angsuran');
												}		
												?>
											</td>
											<td align="center">
												<a href="<?php echo base_url('supplier/akun_supplier/detail_hutang/'.@$value->kode_supplier.'/'.@$value->kode_transaksi) ?>" class="btn btn-success "><i class="fa fa-eye"></i> Detail</a>
												<?php
												if (@$value->sisa != '0' ) {
													?>
													<a href="<?php echo base_url('supplier/akun_supplier/bayar_hutang/'.@$value->kode_supplier.'/'.@$value->kode_transaksi) ?>" class="btn btn-primary "><i class="fa fa-money"></i> Bayar</a>
													<?php
												} 
												?>

											</td>
										</tr>
										<?php 
									} 
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Supplier</th>
										<th>Nominal Hutang</th>
										<th>Sisa Hutang</th>
										<th>Jatuh Tempo</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
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
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>component/lib/jquery.min.js"></script>
<script src="<?php echo base_url();?>component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>component/lib/css/default.css"/>
<script type="text/javascript">
	$('.tgl').Zebra_DatePicker({});


	$('#cari').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		var kode_supplier ='<?php echo @$kode_supplier;?>';
		if (tgl_awal=='' || tgl_akhir==''){ 
			alert('Masukan Tanggal Awal & Tanggal Akhir..!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url();?>supplier/akun_supplier/cari_hutang",  
				cache :false,
				beforeSend:function(){
					$(".tunggu").show();  
				},  
				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kode_supplier:kode_supplier},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#cari_transaksi").html(data);
				},  
				error : function(data) { 
				}  
			});
		}
	});
</script>