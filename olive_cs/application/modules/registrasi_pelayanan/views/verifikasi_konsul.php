
<!-- back button -->
<a href="<?php echo base_url('registrasi_pelayanan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="clearfix"></div>
<br>
<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Verifikasi </span>
						<br><br>
					</div>
					<div class="panel-body" style="padding:30px">
						<?php 
						$kode = $this->uri->segment(3);
						$this->db->from('olive_cs.transaksi_registrasi');
						$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_registrasi.kode_member', 'left');
						$this->db->join('olive_master.master_layanan',',master_layanan.kode_layanan = olive_cs.transaksi_registrasi.kode_layanan', 'left');
						$this->db->where('olive_cs.transaksi_registrasi.kode_transaksi',$kode);
						$data_periksa = $this->db->get()->row();
						?>
						<form id="data_form" method="post">
							<div class="box-body">            
								<div class="row">
									<div class="form-group  col-xs-6">
										<label><b>Kode Transaksi</b></label>
										<input required id="kode_transaksi" value="<?php echo $kode ?>" readonly="true" type="text" class="form-control" id="kode_transaksi"/>
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Tanggal Transaksi</b></label>
										<input type="date" name="date" class="form-control" value="<?php echo $data_periksa->tanggal_transaksi ?>" style="background-color: #eee">
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Nama Customer</b></label>
										<input readonly="" required value="<?php echo $data_periksa->nama_member ?>" type="text" class="form-control" name="nama_bahan_baku" />
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Nama Layanan</b></label>
										<input  readonly="" required type="text" class="form-control" name="stok_minimal" value="<?php echo $data_periksa->nama_layanan ?>" />
									</div>
									<hr>
									<div class="col-xs-12">
										<hr>
										<div id="bottom" class="row">
											<div class="sukses" ></div>
											<div id="list_transaksi_pembelian">
												<div class="box-body col-xs-12">
													<?php 
													$this->db->select('olive_cs.opsi_transaksi_registrasi.id,qty');
													$this->db->select('olive_master.master_perawatan.nama_perawatan');
													$this->db->select('olive_master.master_produk.nama_produk');
													$this->db->from('olive_cs.opsi_transaksi_registrasi');
													$this->db->join('olive_master.master_perawatan','olive_master.master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_registrasi.kode_item','left');
													$this->db->join('olive_master.master_produk','olive_master.master_produk.kode_produk = olive_cs.opsi_transaksi_registrasi.kode_item','left');
													$this->db->where('olive_cs.opsi_transaksi_registrasi.kode_transaksi',$kode);
													$data_periksa = $this->db->get()->result();						
													?>
													<table id="tabel_daftar" class="table table-bordered table-striped">
														<thead>
															<tr>
																<th>Nama Item</th>
																<th style="width:30%">Qty</th>
																<th style="width:15%">Action</th>
															</tr>
														</thead>
														<tbody id="data_temp">
															<?php 
															$no = 0;
															foreach ($data_periksa as $value) { 
																$no++; ?>
																<tr id="row_<?php echo $value->id ?>">
																	<td><?php echo @$value->nama_perawatan; echo @$value->nama_produk; ?></td>
																	<td>
																		<input readonly type="text" class="form-control" id="qty_<?= $value->id ?>" value="<?= $value->qty ?>">
																	</td>
																	<td>
																		<a id="btn_update_<?= $value->id ?>" onclick="update('<?php echo $value->id ?>')" class="btn btn-info btn-no-radius btn-md btn_update">Update</a>
																		<a id="btn_cancel_<?= $value->id ?>" onclick="cancel('<?php echo $value->id ?>')" class="btn btn-warning btn-no-radius btn-md btn_cancel">Cancel</a>
																		<a id="btn_edit_<?= $value->id ?>" key="<?= $value->id ?>" onclick="edit_data(this)" class="btn btn-warning btn-no-radius btn-md btn_edit">Edit</a>
																		<a id="btn_hapus_<?= $value->id ?>" onclick="hapus('<?php echo $value->id ?>')" class="btn btn-danger btn-no-radius btn-md">HAPUS</a>
																	</td>
																</tr>
																<?php
															}
															?>
														</tbody>
														<tfoot>

														</tfoot>
													</table>
													<br><br>
													<a onclick="$('#modal-konfirmasi').modal('show')" class="btn btn-no-radius btn-info btn-lg pull-right"><i class="fa fa-check"></i> Verifikasi</a>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="box-footer">

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius:0px">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan data ini benar ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-no-radius pull-left" data-dismiss="modal">Batal</button>
				<a onclick="simpan_verifikasi()" type="button" class="btn btn-info btn-no-radius"><i class="fa fa-chechk"></i> Verifikasi</a>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.btn_update').hide();
	$('.btn_cancel').hide();
});

function edit_data(obj){
	id = $(obj).attr('key');
	$('#qty_'+id).attr('readonly',false);
	$('#btn_edit_'+id).hide();
	$('#btn_hapus_'+id).hide();
	$('#btn_update_'+id).show();
	$('#btn_cancel_'+id).show();
}

function cancel(key){
	$('#qty_'+key).attr('readonly',true);
	$('#btn_edit_'+key).show();
	$('#btn_hapus_'+key).show();
	$('#btn_update_'+key).hide();
	$('#btn_cancel_'+key).hide();
}

function update(key){
	
	qty = $('#qty_'+key).val();

	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'registrasi_pelayanan/update_data_opsi' ?>",  
		cache :false,  
		data :{id:key,qty:qty},
		dataType: 'Json',
		beforeSend: function(){
			$('.tunggu').show();
		},
		success : function(data) { 
			$('.tunggu').hide();
			$('.alert_berhasil').hide();

			if (data.response == 'sukses') {
				$('#qty_'+key).attr('readonly',true);
				$('#btn_edit_'+key).show();
				$('#btn_hapus_'+key).show();
				$('#btn_update_'+key).hide();
				$('#btn_cancel_'+key).hide();
			}else{
				alert('Gagal Menyimpan data');
				location.reload();
			}
		},  
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
	return false;     
}

function hapus(key){

	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'registrasi_pelayanan/hapus_data_opsi' ?>",  
		cache :false,  
		data :{id:key},
		dataType: 'Json',
		beforeSend: function(){
			$('.tunggu').show();
		},
		success : function(data) { 
			$('.tunggu').hide();
			if (data.response == 'sukses') {
				$('#row_'+key).fadeOut();
			}else{
				alert('Gagal Menghapus data');
			}
		},  
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
	return false;     
}

function simpan_verifikasi(){
	kode_transaksi = $('#kode_transaksi').val();
	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'registrasi_pelayanan/simpan_registrasi' ?>",  
		cache :false,  
		data :{kode_transaksi:kode_transaksi},
		dataType: 'Json',
		beforeSend: function(){
			$('.tunggu').show();
		},
		success : function(data) { 

			$('.tunggu').hide();
			$('.alert_berhasil').show();
			if (data.response == 'sukses') {
				//setTimeout(function(){ window.location = "<?php echo base_url() . 'registrasi_pelayanan' ?>"; }, 1000);
			}else{
				$('.modal-konfirmasi').modal('hide');
				alert('Gagal Menghapus data');
			}
		},  
		error : function() {
			$('.tunggu').hide();
			$('.modal-konfirmasi').modal('hide');
			alert("Data gagal dimasukkan.");  
		}  
	});
	return false;     
}


</script>