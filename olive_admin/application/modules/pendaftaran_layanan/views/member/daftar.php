<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Retur Penjualan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Retur Penjualan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Member </span>
					<a href="<?php echo base_url('penjualan/member/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Member</a>
					<a href="<?php echo base_url('penjualan/member/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Member</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="datatable">
									<thead>
										<tr>
											<th>NO</th>
											<th>Kode Member</th>
											<th>Nama Member</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Keterangan</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php 
									$this->db_master->order_by('id','DESC');
									$get_member = $this->db_master->get('master_member')->result();
									?>
									<tbody>
										<?php 
										$no = 0;
										foreach ($get_member as $value) { $no++; ?>
										<tr>
											<th><?php echo $no ?></th>
											<th><?php echo $value->kode_member ?></th>
											<th><?php echo $value->nama_pic ?> - <?php echo $value->nama_perusahaan ?></th>
											<th><?php echo $value->alamat_perusahaan ?></th>
											<th><?php echo $value->telp_pic ?></th>
											<th><?php echo $value->keterangan ?></th>
											<th><?php echo cek_status($value->status_member) ?></th>
											<td><?php echo get_edit_hapus($value->kode_member);?></td>
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



<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" >
		<div class="modal-content" style="border-radius: 0px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-no-radius btn-default pull-left" data-dismiss="modal">Batal</button>
				<a id="btnhapus_hapus" class="btn btn-danger btn-no-radius"> Hapus Data</a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#btnhapus_hapus').attr('onclick','hapus_member("'+key+'")');
	}

	function hapus_member(key){
		$.ajax({  
			type :"post",  
			url : "<?php echo base_url() . 'penjualan/member/hapus_member' ?>",  
			cache :false,  
			data :{kode_member:key},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				$(".alert_berhasil").show();   
				setTimeout(function(){window.location = '<?php echo base_url('penjualan/member/daftar'); ?>'; }, 1500);				
			}
		})
		return false;
	}
</script>