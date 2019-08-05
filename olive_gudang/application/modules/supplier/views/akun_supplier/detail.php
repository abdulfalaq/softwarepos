

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="#">Detail Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->db->where('kode_supplier',$id);
	$get_gudang = $this->db->get('clouoid1_olive_master.master_supplier')->row();
	?>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px;margin-left: 620px"><?php echo $get_gudang->nama_supplier?></span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="container" style="margin-left: 10px">
									<div class="row">
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
												<li role="presentation" class="active" id="menu_setting" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$get_gudang->kode_supplier); ?>">Personal Data</a>
												</li>
												<li role="presentation" class="" id="menu_pengajuan" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/hutang/'.$get_gudang->kode_supplier); ?>" >Hutang</a>
												</li>
												<li role="presentation" class="" id="menu_validasi" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/record/'.$get_gudang->kode_supplier); ?>">Record Transaksi</a>
												</li>
											</ul>
										</div>
									</div>
								</div><br>
								<div class="form-group  col-xs-6">
									<label>Kode Supplier</label>
									<input type="hidden" name="id" value="1" />
									<input readonly type="text" class="form-control"  value="<?php echo $get_gudang->kode_supplier?>"   name="kode_supplier" id="kode_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama Supplier</label>
									<input type="text" readonly class="form-control" value="<?php echo $get_gudang->nama_supplier?>"  name="nama_supplier" id="nama_supplier" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Supplier</label>
									<input type="text" readonly class="form-control" value="<?php echo $get_gudang->telp_supplier?>"  name="telp_supplier" id="telp_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama Pic</label>
									<input type="text" readonly class="form-control" value="<?php echo $get_gudang->nama_pic?>"  name="nama_pic" id="nama_pic" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Pic</label>
									<input type="hidden" name="id" value="1" />
									<input type="text" readonly class="form-control" value="<?php echo $get_gudang->telp_pic?>"  name="telp_pic" id="telp_pic" />
								</div>
								<div class="form-group  col-xs-6">
									<label class="gedhi">Status</label>
									<select class="form-control select2" name="status_supplier" readonly disabled="" id="status_supplier" >
										<option  value="">--Pilih Status--</option>
										<option <?php if($get_gudang->status_supplier=='1'){echo "selected";}?>  value="1" >Aktif</option>
										<option <?php if($get_gudang->status_supplier=='0'){echo "selected";}?>  value="0" >Nonaktif</option>
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

<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>