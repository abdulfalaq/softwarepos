

<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Master'); ?>">Master</a></li>
		<li><a href="#">Diagnosa</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Diagnosa</span>
					<a href="<?php echo base_url('master/diagnosa/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Diagnosa</a>
					<a href="<?php echo base_url('master/diagnosa/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Diagnosa</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<?php 
						$this->db_master->from('master_diagnosa_penyakit');
						$this->db_master->select('master_diagnosa_penyakit.kode_diagnosa_penyakit');
						$this->db_master->select('master_diagnosa_penyakit.nama_diagnosa_penyakit');
						$this->db_master->select('master_diagnosa_penyakit.kode_kategori_penyakit');
						$this->db_master->select('master_diagnosa_penyakit.status');
						$this->db_master->select('master_kategori_penyakit.nama_kategori_penyakit');
						$this->db_master->join('master_kategori_penyakit','master_kategori_penyakit.kode_kategori_penyakit = master_diagnosa_penyakit.kode_kategori_penyakit', 'Left');
						$this->db_master->order_by('master_diagnosa_penyakit.id','DESC');
						$get_sapi = $this->db_master->get()->result();
						?>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>Kode Diagnosa</th>
									<th>Nama Diagnosa</th>
									<th>Kode Kategori Penyakit</th>
									<th>Nama Kategori Penyakit</th>
									<th>Status</th>
									<th width="133px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 0;
								foreach ($get_sapi as $value) { 
									$no++; ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_diagnosa_penyakit ?></td>
										<td><?= $value->nama_diagnosa_penyakit ?></td>
										<td><?= $value->kode_kategori_penyakit ?></td>
										<td><?= $value->nama_kategori_penyakit ?></td>
										<td><?php 
										if ($value->status == '1') {
											echo ('Aktif');		

										}else{
											echo ('Tidak Aktif');
										}
										?></td>
										<td><?php echo get_detail_edit_delete($value->kode_diagnosa_penyakit);?></td>
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
	<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menghapus data ini?</h2>
					<input type="hidden" id="kode_diagnosa_penyakit">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button onclick="hapus_data()" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#kode_diagnosa_penyakit').val(key);
		}
		function hapus_data() {
			var kode_diagnosa_penyakit=$('#kode_diagnosa_penyakit').val();
			$.ajax({
				url: '<?php echo base_url('master/diagnosa/hapus_diagnosa'); ?>',
				type: 'post',
				data:{kode_diagnosa_penyakit:kode_diagnosa_penyakit},
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
