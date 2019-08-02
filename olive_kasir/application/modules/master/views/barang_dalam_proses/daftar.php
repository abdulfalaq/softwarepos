
<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Barang Dalam Proses</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Barang Dalam Proses </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Barang Dalam Proses </span>
					<a href="<?php echo base_url('master/barang_dalam_proses/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Barang Dalam Proses</a>
					<a href="<?php echo base_url('master/barang_dalam_proses/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Barang Dalam Proses</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Unit</th>
									<th>Satuan Stok</th>
									<th>Stok Minimal</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody> 
								<?php

								$this->db2->order_by('kan_master.master_barang_dalam_proses.id','DESC');
								$this->db->from('kan_master.master_barang_dalam_proses');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_barang_dalam_proses.kode_satuan_stok = kan_master.master_satuan.kode ');
								$this->db->join('kan_master.master_gudang', 'kan_master.master_barang_dalam_proses.kode_gudang = kan_master.master_gudang.kode_gudang ');
								$get_bdp=$this->db->get();
								$hasil_bdp=$get_bdp->result();
								$no=1;
								foreach ($hasil_bdp as $bdp) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $bdp->kode_barang;?></td>
										<td><?php echo $bdp->nama_barang;?></td>
										<td><?php echo $bdp->nama_gudang;?></td>
										<td><?php echo $bdp->nama;?></td>
										<td><?php echo $bdp->stok_minimal;?></td>
										<td><?php echo get_detail_edit_delete($bdp->kode_barang);?></td>
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

<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_barang">
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
		$('#kode_barang').val(key);
	}
	function hapus_data() {
		var kode_barang=$('#kode_barang').val();
		$.ajax({
			url: '<?php echo base_url('master/barang_dalam_proses/hapus_barang'); ?>',
			type: 'post',
			data:{kode_barang:kode_barang},
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