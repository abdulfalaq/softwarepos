
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting/kategori_produk'); ?>">Setting</a></li>
		<li><a href="#">Kategori Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Kategori Produk </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Kategori Produk </span>
					<a href="<?php echo base_url('setting/kategori_produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/kategori_produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Detail Kategori</b></h3></label>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label><b>Kode Kategori Produk</label>
									<input required name="kode_kategori_produk" value="MB0001" readonly="true" type="text" class="form-control" id="kode_kategori_produk"/>
								</div>
								<div class="form-group  col-xs-6">
									<label class="gedhi"><b>Nama Kategori Produk</label>
									<input required value="Oribu" type="text" class="form-control" disabled name="nama_kategori_produk" />
								</div>
								<div class="form-group  col-xs-6">
									<label class="gedhi"><b>Keterangan</label>
									<input required value="Oribu" type="text" disabled class="form-control" name="keterangan" />
								</div>
							</div>

						</div>
						<div class="box-footer clearfix">

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>