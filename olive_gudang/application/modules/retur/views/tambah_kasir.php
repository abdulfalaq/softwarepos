<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="#">Tutup Kasir</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tutup Kasir</span>
					<br><br>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">  
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Kasir</label>
									<input readonly="true" value="KAS_20180209020522" type="text" class="form-control" name="kode_transaksi" />

								</div>



								<input readonly="true" value="" type="hidden" name="nominal_penjualan" class="form-control" />



								<input readonly="true" value="Rp 0,00" type="hidden" class="form-control" />

								<input type="hidden" name="saldo_sebenarnya" value="0" class="form-control" />
								<div class="form-group col-xs-5" style="display:none;">
									<label>Setoran Teh Racek</label>
									<input readonly="true" type="text" value="Rp 0,00" class="form-control"/>
									<input readonly="true" type="hidden" value="" class="form-control" name="nominal_tambahan"/>
								</div>                       
								<div class="form-group col-xs-5">
									<label>Saldo Laporan Kasir</label>
									<div class="input-group">
										<span id="dibayar">
											<input onkeyup="rupiah()" type="text" value="" class="form-control" autocomplete="off" name="saldo_akhir" id="dp" />
										</span>
										<span id="rupiah" class="input-group-addon">Rp.</span>
									</div>
								</div>
								<input readonly="true" type="hidden" value="Rp 0,00" class="form-control" name="selisih" id="dp" />
								<div class="form-group ombo" style="margin-left: 18px;">
									<input type="hidden" value="astro" class="form-control" name="petugas" />
									<input type="hidden" value="14:06:20" class="form-control" name="check_out" />
									<input type="hidden" value="close" class="form-control" name="status" />
								</div>
							</div>
							<div class="box-footer">
								<a href="<?php echo base_url('kasir/tambah_kasir'); ?>" class="btn btn-primary pull-right">Simpan</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>
