
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan Stok Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan Stok Bahan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan Stok Bahan</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<div class="row">
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl" id="tgl_awal">
								</div>
							</div>
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir">
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<button style="margin-left: 5px" type="button" id="print" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-print"></i> Print</button>
								<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<br>

						<div id="load_table">
							<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Nama Bahan</th>
										<th>Stok Awal</th>
										<th>Masuk</th>
										<th>Keluar</th>
										<th>Adjust I</th>
										<th>Stok Akhir</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;
									$this->db->from('olive_master.master_bahan_baku');
									$get_bahan = $this->db->get()->result();
									foreach ($get_bahan as $value) { $no++; 
										$this->db->select_sum('olive_gudang.transaksi_stok.stok_masuk');
										$this->db->select_sum('olive_gudang.transaksi_stok.stok_keluar');
										$this->db->from('olive_gudang.transaksi_stok');
										$this->db->where('olive_gudang.transaksi_stok.kode_bahan',$value->kode_bahan_baku);
										$this->db->where('olive_gudang.transaksi_stok.jenis_transaksi !=','opname');
										$get_stok = $this->db->get()->row();
										$this->db->select_sum('olive_gudang.transaksi_stok.stok_keluar');
										$this->db->select_sum('olive_gudang.transaksi_stok.stok_masuk');
										$this->db->from('olive_gudang.transaksi_stok');
										$this->db->where('olive_gudang.transaksi_stok.kode_bahan',$value->kode_bahan_baku);
										$this->db->where('olive_gudang.transaksi_stok.jenis_transaksi','opname');
										$get_adjust = $this->db->get()->row();

										$hasil_opname 	= $get_adjust->stok_masuk + $get_adjust->stok_keluar;
										$stok_akhir  	= ($value->real_stock + $get_stok->stok_masuk) - $get_stok->stok_keluar;

										?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $value->nama_bahan_baku ?></td>
											<td><?php echo $value->real_stock ?></td>
											<td><?php echo $get_stok->stok_masuk;  ?></td>
											<td><?php echo $get_stok->stok_keluar; ?></td>
											<td><?php echo $hasil_opname ?></td>
											<td><?php echo $stok_akhir ?></td>
										</tr>
										<?php }
										?>
									</tbody>                
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>    
</div>

<script type="text/javascript">
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id').val(key);
	}
	function hapus_data() {
		var id=$('#id').val();
		$.ajax({
			url: '<?php echo base_url('master/master_breed/hapus'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				window.location.reload();
			}
		});
	}
	$("#print").click(function(){
		var tgl_awal		= $("#tgl_awal").val();
		var tgl_akhir 		= $("#tgl_akhir").val();
		window.open("<?php echo base_url().'laporan/laporan_stok_bahan/print_stok_bahan/'; ?>"+tgl_awal+"/"+tgl_akhir);
	});

	function cari_stok_day(){
		tgl_awal  = $('#tgl_awal').val();
		tgl_akhir = $('#tgl_akhir').val();
		if (tgl_awal != '' && tgl_akhir != '') {
			$.ajax({
				url: '<?php echo base_url('laporan/laporan_stok_bahan/load_data_cari'); ?>',
				type: 'post',
				data:{tgl_akhir:tgl_akhir,tgl_awal:tgl_awal},
				success: function(hasil){
					$('#load_table').html(hasil);
				}
			});
		}else{
			alert('Harap Mengisi Form.');
		}


	}

</script>