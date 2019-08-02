<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Piutang</a></li>
		<li></li>
	</ol>
</div>
<div class="clearfix"></div>
<div class="container">
	<h1>Piutang</h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Piutang Konsinyasi</span>
					<a href="<?php echo base_url('penjualan/piutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Umum</a>
					<a href="<?php echo base_url('penjualan/piutang/daftar_konsinyasi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Konsinyasi</a>
				</div>
				<div class="panel-body">
					<h4>DAFTAR DATA</h4>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th>Kode Member</th>
									<th>Nama PIC</th>
									<th>Nama Perusahaan</th>
									<th width="5%">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$this->db_master->order_by('id','DESC');
								$this->db_master->where('kategori_member', 'Member Konsinyasi');
								$get_member=$this->db_master->get('master_member');
								$hasil_member=$get_member->result();
								$no=1;
								foreach ($hasil_member as $member) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @$member->kode_member;?></td>
										<td><?php echo @$member->nama_pic;?></td>
										<td><?php echo @$member->nama_perusahaan;?></td>
										<td>
											<a href="<?php echo base_url().'penjualan/piutang/detail_konsinyasi/'.@$member->kode_member;?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
												<li class="fa fa-eye"></li>
											</a>

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
</script>