
<!-- back button -->
<a href="<?php echo base_url('pemasukan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pemasukan'); ?>">Pemasukan</a></li>
		<li><a href="#">Detail</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>
<?php 
$id=$this->uri->segment(4);
$this->olive_keuangan->where('kode_sub_kategori_keuangan',$id);
$get_gudang = $this->olive_keuangan->get('keuangan_masuk')->row();
?>
<div class="container">

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail</span>
					<a href="<?php echo base_url('pemasukan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('pemasukan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="row">
							<input type="hidden" name="id" value="" />
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kode Pengeluaran</b></label>
								<input class="form-control" type="text" id="kode_sub_kategori_keuangan"  name="kode_sub_kategori_keuangan" value="<?php echo $get_gudang->kode_sub_kategori_keuangan?>" readonly="" />
							</div>
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kategori</b></label>
								<input class="form-control" type="text" id="nama_kategori_akun" name="nama_kategori_keuangan" value="<?php echo $get_gudang->nama_kategori_keuangan?>" readonly="" />
							</div>

						</div>
						<div class="row">
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Nama Akun</b></label>
								<input type="text" class="form-control" readonly="" id="nama_sub_kategori_akun" name="nama_sub_kategori_keuangan" value="<?php echo $get_gudang->nama_sub_kategori_keuangan?>" />

							</div>
							<div class="col-md-6">
								<label><b>Nominal</b></label>
								<input type="text"  class="form-control" value="<?php echo $get_gudang->nominal?>" name="nominal" id="nominal" readonly required=""/>
							</div>
						</div>
						<div class="row">

							<div class="col-md-6">
								<label><b>Keterangan</b></label>
								<input class="form-control" value="<?php echo $get_gudang->keterangan?>" name="keterangan" id="keterangan" required="" readonly/>
							</div>
						</div>
						<br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>
