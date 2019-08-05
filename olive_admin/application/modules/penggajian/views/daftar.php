
<!-- back button -->
<a href="<?php echo base_url('admin/dashboard'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penggajian'); ?>">Penggajian</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Penggajian</span>
					<a href="<?php echo base_url('penggajian/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('penggajian/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
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
								<button style="width: 147px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
						<div id="">
							<table class="table table-striped table-hover table-bordered" id="datatable" >
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Tanggal</th>
										<th>Nama Karyawan</th>
										<th>Total Gaji</th>
										<th width="133px;">Action</th>
									</tr>
								</thead>
								<tbody id="cari_transaksi">    
									<?php 
									$this->db->order_by('clouoid1_olive_keuangan.transaksi_penggajian.id','DESC');
									$this->db->from('clouoid1_olive_keuangan.transaksi_penggajian');
									$this->db->join('clouoid1_olive_master.master_karyawan', 'clouoid1_olive_keuangan.transaksi_penggajian.kode_karyawan = clouoid1_olive_master.master_karyawan.kode_karyawan', 'left');
									$get_gudang = $this->db->get()->result();

									$no = 0;
									foreach ($get_gudang as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= @tanggalIndo($value->tanggal_transaksi) ?></td>
											<td><?= $value->nama_karyawan ?></td>
											<td><?= @format_rupiah($value->total_gaji) ?></td>
											<td align="center">
												<div class="btn-group">
													<a href="<?php echo base_url('penggajian/detail/'.@$value->kode_transaksi); ?>" data-toggle="tooltip" style="background-color: #26a69a;color:white" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


<script src="<?php echo base_url();?>component/lib/jquery.min.js"></script>
<script src="<?php echo base_url();?>component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>component/lib/css/default.css"/>
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
				url : "<?php echo base_url()?>penggajian/cari_daftar",  
				cache :false,
				beforeSend:function(){
					$(".tunggu").show();  
				},  
				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
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
