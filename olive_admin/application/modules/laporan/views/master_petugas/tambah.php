
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan asset</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pembelian</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Asset</span>
					<a href="<?php echo base_url('pembelian/master_petugas/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('pembelian/master_petugas/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form method="post" id="data_form">

						<div class="col-md-12">
							<div class="form-group">
								<label>Kode barang</label>
								<input type="text" class="form-control" name="kode_pos_penampungan_susu" placeholder="" value="" required/>


							</div>                                                             
							<div class="form-group">
								<label>Nama barang</label>
								<input type="text" class="form-control" name="nama_pos_penampungan_susu" placeholder="Nama PPS" value="" required/>
							</div>

							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status">              
									<option selected value="1">Aktif</option>
									<option value="0">Tidak Aktif </option>
								</select>
							</div>
						</div>

						<input type="hidden" name="id" value="">
						<div class="box-footer clearfix">

							<div class="form-group" style="margin:15px">
								<button type="submit" class="pull-right btn btn-default btn-primary" id="data_form">Save<i class="fa fa-arrow-circle-right"></i></button>
							</div>

						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>