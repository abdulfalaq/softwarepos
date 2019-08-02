
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Produk </span>
					<a href="<?php echo base_url('setting/produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Produk</label>
									<input  type="text" class="form-control" value="" readonly="" name="kode_produk" id="kode_produk" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Satuan Stok</label>
									<select   class="form-control stok select2" disabled="" name="id_satuan_stok">
										<option selected="true" value="">--Pilih satuan stok--</option>
										<option  value="S_01">kilogram</option>
										<option  value="S_02">mililiter</option>
										<option  value="S_03">liter</option>
										<option  value="S_04">pieces</option>
										<option  value="S_05">porsi</option>
										<option  value="S_06">botol</option>
										<option  value="S_07">gram</option>
										<option  value="S_08">kilogram</option>
										<option  value="S_09">Box / Kotak</option>
									</select> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Nama Produk</label>
									<input  value="" type="text" readonly="" class="form-control" name="nama_produk" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Minimal Stok</label>
									<input  type="number" readonly="" class="form-control" name="stok_minimal" id="stok_minimal" value="" />
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Harga Jual</label>
									<input  type="number" class="form-control input-group" readonly="" onkeyup="get_nominal_hpp()" name="harga_jual" id="harga_jual" value="" />
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Kategori Produk</label>
									<select class="form-control" disabled="" name="kode_kategori_produk">
										<option value="">PILIH</option>

										<option  value="MB0001">Oribu</option>

										<option  value="KP0002">Apotek</option>

										<option  value="KP0003">Resep</option>
									</select>
								</div>
								<div class="form-group  col-xs-5">

									<label class="gedhi"><b>Insentif Masker</label>
									<div class="input-group">
										<span class="input-group-addon rp_insentif">Rp 0,00</span>
										<input  type="number" readonly="" class="form-control input-group" onkeyup="get_nominal_insetif()" name="insentif_masker" id="insentif_masker" value="" />
									</div>
								</div>
								<div class="form-group  col-xs-5">

									<label class="gedhi"><b>Status</label>
									<select disabled=""  class="form-control stok select2" name="status">

										<option value="">--Pilih Status--</option>
										<option  value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>