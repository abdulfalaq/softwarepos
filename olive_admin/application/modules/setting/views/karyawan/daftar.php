<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_karyawan')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Karyawan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Karyawan </span>
					<a href="<?php echo base_url('setting/karyawan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/karyawan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<table id="datatable" class="table table-striped table-bordered">


						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Kode Karyawan</th>
								<th>Nama Karyawan</th>
								<th>Tanggal Kontrak Kerja</th>
								<th>Tanggal Kontrak Akhir</th>
								<th>Lama Bekerja</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 0;
							foreach ($get_gudang as $value) { 
								$no++; 

								if($value->status_karyawan == '1'){ ?>
								<tr>
									<?php }else{ ?>
									<tr style="background-color: #e03b3bd1; color: white ">
										<?php
									} ?>
									<td><?= $no ?></td>
									<td><?= $value->kode_karyawan ?></td>
									<td><?= $value->nama_karyawan ?></td>
									<td><?= tanggalIndo ($value->tgl_mulai_kerja) ?></td>
									<td><?= tanggalIndo ($value->tgl_berhenti_kerja) ?></td>
									<td>
										<?php 
										$mulai_kerja = new DateTime($value->tgl_mulai_kerja);
										$today = new DateTime(date("Y-m-d"));
										$y = $today->diff($mulai_kerja)->y;
										$m = $today->diff($mulai_kerja)->m;
										$d = $today->diff($mulai_kerja)->d;
										echo $y . " tahun " . $m . " bulan " . $d . " hari";
										?>
									</td>
									<td>
										<?php
										if ($value->status_karyawan == '1') {
											echo 'Aktif';
										}else{
											echo 'Tidak Aktif';
										}
										?>
									</td>
									<td align="center">
										<div class="btn-group">
											<a href="<?php echo base_url('setting/karyawan/detail/'.$value->kode_karyawan); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
											<a href="<?php echo base_url('setting/karyawan/edit/'.$value->kode_karyawan ); ?>" key="4" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
											<a onclick="actDelete('<?php echo $value->kode_karyawan ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
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
	</div> <!-- //row -->

	<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menghapus data ini?</h2>
					<input type="hidden" id="kode_karyawan">
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
			$('#kode_karyawan').val(key);
		}
		function hapus_data() {
			var kode_karyawan=$('#kode_karyawan').val();
			$.ajax({
				url: '<?php echo base_url('setting/karyawan/hapus_gudang'); ?>',
				type: 'post',
				data:{kode_karyawan:kode_karyawan},
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