
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li>Pinjaman</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk Pinjaman</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Produk Pinjaman</span>
					<a href="<?php echo base_url('setting/pinjaman'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
					<a href="<?php echo base_url('setting/pinjaman/data_produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
				</div>
				<div class="panel-body">
					<table id="datatables" class="table table-bordered table-blue">
						<thead>
							<th width="5px">No</th>
							<th>Kode Produk</th>
							<th>Nama Produk</th>
							<th>Plafond Pinjaman / Maks. Pinjaman</th>
							<th>Tenor</th>
							<th>Jasa Perbulan</th>
							<th>Administrasi</th>
							<th>Potongan</th>
							<th>Potongan Lain-lain</th>
							<th>Potongan Dana Sosial</th>
							<!-- <th>Action</th> -->
						</thead>
						<tbody>
							<?php
							$this->db->order_by('id','DESC');
							$get_produk=$this->db->get('master_produk_pinjaman');
							$hasil_produk=$get_produk->result();
							$no=1;
							foreach ($hasil_produk as $value) {
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo @$value->kode_produk;?></td>
									<td><?php echo @$value->nama_produk;?></td>
									<td><?php echo @format_rupiah($value->plafon);?></td>
									<td><?php echo @$value->tenor;?> Bulan</td>
									<td><?php echo @$value->jasa_per_bulan;?> %</td>
									<td><?php echo @format_rupiah($value->nominal_biaya_administrasi);?></td>
									<td><?php echo @$value->penarikan_jasa_pinjaman;?></td>
									<td><?php echo @format_rupiah($value->nominal_potongan_lain);?></td>
									<td><?php echo @format_rupiah($value->nominal_potongan_dansos);?></td>
									<!-- <td align="center" width="100px">
										<a href="<?php echo @base_url('setting/pinjaman/detail_produk')."/".@$value->id; ?>" data-toggle="tooltip" title="Detail" class="btn btn-success"><i class="fa fa-eye"></i></a>
										 <a href="<?php echo @base_url('setting/produk_simpanan_pokok/edit')."/1"; ?>" data-toggle="tooltip" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
										<a href="#" data-toggle="tooltip" title="Hapus" onclick="hapus(1)" class="btn btn-danger"><i class="fa fa-trash"></i></a> 
									</td> -->
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
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



<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
</script>