
<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_promo')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/promo/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Promo</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_promo=$this->uri->segment(4);
	$this->db2->where('kode_promo',$kode_promo);
	$get_gudang = $this->db2->get('master_promo')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Promo </span>
					<a href="<?php echo base_url('setting/promo/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Promo</a>
					<a href="<?php echo base_url('setting/promo/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Promo</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">
							<!-- <div class="sukses alert alert-success"></div> -->
							<div class="form-group">
								<label>Kode Promo</label>
								<input type="text" name="kode_promo" id="kode_promo" class="form-control" readonly value="<?php echo $get_gudang->kode_promo; ?>" disabled="">
							</div>
							<div class="form-group">
								<label>Nama Promo</label>
								<input type="text" name="nama_promo" id="nama_promo" class="form-control" readonly value="<?php echo $get_gudang->nama_promo; ?>" disabled="">
							</div>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" readonly value="<?php echo $get_gudang->tanggal_awal; ?>" disabled="">
							</div>
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"  readonly value="<?php echo $get_gudang->tanggal_akhir; ?>" disabled="">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" id="status" class="form-control" disabled="">
									<option value="">-- Pilih Status --</option>
									<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
									<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
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
		</div>
	</div>
</div>

