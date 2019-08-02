
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Spoil</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Spoil Produk</h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Spoil </span>
					<a href="<?php echo base_url('stok/spoil_produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Spoil</a>
					<a href="<?php echo base_url('stok/spoil_produk/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Spoil</a>
				</div>
				<div class="panel-body">
					<form id="data_form">
						<div class="col-md-12 row">
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>Jumlah</th>
										<th style="width: 10px;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$get_unit=$this->db->get('setting');
									$hasil_unit=$get_unit->row();

									$this->db->where('kan_master.master_produk.kode_unit_jabung', @$hasil_unit->kode_unit);
									$this->db->from('kan_master.master_produk');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode');
									$get_bb=$this->db->get();
									$hasil_bb=$get_bb->result();
									$no=1;
									foreach ($hasil_bb as $bahan) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$bahan->nama_produk;?></td>
											<td><?php echo @$bahan->real_stok.' '.@$bahan->nama;?></td>
											<td class="text-center">
												<input name="opsi_spoil[]" type="checkbox" id="opsi_pilihan" value="<?php echo @$bahan->kode_produk;?>">
											</td>
										</tr>
										<?php
									}
									?>
									
								</tbody>
							</table>
						</div>
						<input type="hidden" name="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
						<input type="hidden" name="kode_spoil" id="kode_spoil" value="<?php echo 'SP_'.date('ymdHis');?>">
						<div class="col-md-12">
							<a onclick="simpan_spoil()" class=" btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> Spoil</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

<script type="text/javascript">
	function simpan_spoil(){
		var kode_spoil=$('#kode_spoil').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/spoil_produk/simpan_temp' ?>",  
			cache :false,  
			data :$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				window.location="<?php echo base_url() . 'stok/spoil_produk/tambah_spoil/' ?>"+kode_spoil;
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;  
	}
</script>