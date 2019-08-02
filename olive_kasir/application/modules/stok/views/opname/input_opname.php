
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Opname</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Opname </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Input Opname </span>
					<br><br>
				</div>
				<form id="data_form">
					<?php
					$kode_opname=$this->uri->segment(4);
					$this->db->where('kode_opname', @$kode_opname);
					$get_opname=$this->db->get('transaksi_opname');
					$hasil_opname=$get_opname->row();

					$get_unit=$this->db->get('setting');
					$hasil_unit=$get_unit->row();
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<label>Kode Opname</label>
									<input type="text" name="kode_opname" id="kode_opname" class="form-control" readonly="" value="<?php echo @$hasil_opname->kode_opname;?>">
								</div>
								<div class="col-md-4">
									<label>Tanggal</label>
									<input type="date" name="tanggal" id="tanggal" class="form-control" readonly="" value="<?php echo @$hasil_opname->tanggal_opname;?>">
								</div>
								<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
							</div>
						</div>
						<hr>
						<div class="col-md-12" style="margin-top: 20px;">
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th style="width: 70px;">No</th>
										<th>Nama Produk</th>
										<th>QTY Stok</th>
										<th>QTY Fisik</th>
										<th>Selisih</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="data_opsi_temp">
									<?php
									$jenis_bahan=@$hasil_opname->jenis_bahan;
									$this->db->where('kan_suol.opsi_transaksi_opname.kode_opname', @$kode_opname);
									$this->db->from('kan_suol.opsi_transaksi_opname');
									$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_bahan_baku.kode_bahan_baku');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_stok=kan_master.master_satuan.kode');
									$get_temp=$this->db->get();
									$hasil_temp=$get_temp->result();
									$no=1;
									foreach ($hasil_temp as $temp) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$temp->nama_bahan_baku;?></td>
											<td><?php echo @$temp->stok_awal.' '.@$temp->nama;?></td>
											<td>
												<input type="number" name="qty_fisik_<?php echo @$temp->kode_bahan;?>" id="qty_fisik_<?php echo @$temp->kode_bahan;?>" class="form-control jumlah_opanme" onkeyup="hitung_sisa('<?php echo @$temp->kode_bahan;?>')">
											</td>
											<td><div id="text_selisih_<?php echo @$temp->kode_bahan;?>"></div><?php echo @$temp->nama;?></td>
											<td><div id="text_status_<?php echo @$temp->kode_bahan;?>"></div></td>
											<td><a class="btn btn-danger" onclick="actDelete('<?php echo @$temp->id_opsi;?>')"><i class="fa fa-trash"></i></a></td>

											<input type="hidden" name="stok_awal_<?php echo @$temp->kode_bahan;?>" id="stok_awal_<?php echo @$temp->kode_bahan;?>" value="<?php echo @$temp->stok_awal;?>">
											<input type="hidden" name="selisih_<?php echo @$temp->kode_bahan;?>" id="selisih_<?php echo @$temp->kode_bahan;?>">
											<input type="hidden" name="status_<?php echo @$temp->kode_bahan;?>" id="status_<?php echo @$temp->kode_bahan;?>">
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<a onclick="konfirm_simpan()" class="btn_simpan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- //row -->
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
				<input type="hidden" name="id_temp" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="hapus_data()"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="modal-kofirm" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-success" onclick="simpan_opname()"><i class="fa fa-send"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">

	function hitung_sisa(kode_bahan){
		var qty_fisik=$('#qty_fisik_'+kode_bahan).val();
		var stok_awal=$('#stok_awal_'+kode_bahan).val();
		if(parseInt(qty_fisik) > parseInt(stok_awal)){
			selisih=qty_fisik - stok_awal;
			$('#status_'+kode_bahan).val('lebih');
			$('#selisih_'+kode_bahan).val(selisih);
			$('#text_selisih_'+kode_bahan).text(selisih);
			$('#text_status_'+kode_bahan).text('lebih');
		}else if(parseInt(qty_fisik) < parseInt(stok_awal)){
			selisih=stok_awal - qty_fisik ;
			$('#status_'+kode_bahan).val('kurang');
			$('#selisih_'+kode_bahan).val(selisih);
			$('#text_selisih_'+kode_bahan).text(selisih);
			$('#text_status_'+kode_bahan).text('kurang');
		}else{
			$('#status_'+kode_bahan).val('');
			$('#selisih_'+kode_bahan).val('');
			$('#text_selisih_'+kode_bahan).text('');
			$('#text_status_'+kode_bahan).text('');
		}
	}
	
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id_temp').val(key);
	}
	function hapus_data(){
		var id_temp=$('#id_temp').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/hapus_item_opsi' ?>",  
			cache :false,  
			data :{id_temp:id_temp},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				window.location.reload();
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;  
	}
	function konfirm_simpan() {
		var total_kosong = 0;
		$('.jumlah_opanme').each(function() {
			var num = this.value;
			if (num=='') {
				total_kosong =total_kosong +1;
			}
		});
		if(total_kosong > 0){
			alert('Lengkapi Form ..!');
		}else{
			$('#modal-kofirm').modal('show');
		}
	}
	function simpan_opname(){
		var kode_opname=$('#kode_opname').val();
		var tanggal=$('#tanggal').val();
		var kode_unit_jabung=$('#kode_unit_jabung').val();
		var jenis_bahan=$('#jenis_bahan').val();
		
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/simpan_transaksi_opname' ?>",  
			cache :false,  
			data :$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/opname/daftar');?>";
				},1500);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		
		return false;  
	}
</script>