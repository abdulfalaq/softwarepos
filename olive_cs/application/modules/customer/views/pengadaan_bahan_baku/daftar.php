<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan Bahan Baku</a></li>
		<li></li>
	</ol>
</div>
<div class="clearfix"></div>
<div class="container">
	<h1>Pengadaan Bahan Baku</h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span class="" style="font-size: 24px">Kebutuhan Bahan Baku</span>
				</div>
				<div class="panel-body">
					<h4>DAFTAR DATA</h4>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-5">
								<div class="input-group">
									<select name="bulan" id="bulan">
										<option value="">Pilih Bulan..</option>
										<option value="1">Januari</option>	
										<option value="2">Februari</option>	
										<option value="3">Maret</option>	
										<option value="4">April</option>	
										<option value="5">Mei</option>	
										<option value="6">Juni</option>	
										<option value="7">Juli</option>	
										<option value="8">Agustus</option>	
										<option value="9">September</option>	
										<option value="10">Oktober</option>	
										<option value="11">November</option>	
										<option value="12">Desember</option>	
									</select>
									<span class="input-group-btn">
										<button onclick="cari_pengadaan()" class="btn btn-info" type="button"><i class="fa fa-search"></i> Cari </button>
									</span>
								</div>
							</div>
							<div class="col-md-1">
							</div>
						</div>
					</div>
					<div class="col-md-12" >
						<hr>
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode</th>
									<th>Bulan</th>
									<th>Tahun</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="data_pengadaan">
								<?php
								$this->db->order_by('id','DESC');
								$get_pengadaan=$this->db->get_where('pengadaan',array('tahun' =>date('Y')));
								$hasil_pengadaan=$get_pengadaan->result();
								$no=1;
								foreach ($hasil_pengadaan as $pengadaan) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @$pengadaan->kode_pengadaan;?></td>
										<td><?php echo @BulanIndo($pengadaan->bulan);?></td>
										<td><?php echo @$pengadaan->tahun;?></td>
										<td><?php echo @$pengadaan->status;?></td>
										<td>
											<?php 
											if(empty($pengadaan->status)){
												?>
												<a href="<?php echo base_url('pembelian/pengadaan_bahan_baku/edit').'/'.@$pengadaan->kode_pengadaan; ?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5">
													<li class="fa fa-pencil"></li>
												</a>
												<?php
											}elseif ($pengadaan->status=='ditolak') {
												?>
												<a href="<?php echo base_url('pembelian/pengadaan_bahan_baku/edit_ditolak').'/'.@$pengadaan->kode_pengadaan; ?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5">
													<li class="fa fa-pencil"></li>
												</a>
												<?php
											}
											else{
												?>
												<a href="<?php echo base_url().'pembelian/pengadaan_bahan_baku/detail/'.@$pengadaan->kode_pengadaan;?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
													<li class="fa fa-eye"></li>
												</a>
												<?php
											}
											?>
										</td>   
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


<!-------------------------------------------------- Modal ---------------------------------------------->
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
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->

<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
	function cari_pengadaan(){
		var bulan=$('#bulan').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/pengadaan_bahan_baku/data_pengadaan'); ?>',
			type: 'post',
			data:{bulan:bulan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#data_pengadaan').html(hasil);
			}
		});
	}
</script>