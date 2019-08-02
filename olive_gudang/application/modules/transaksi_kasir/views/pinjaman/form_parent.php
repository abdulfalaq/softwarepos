<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li>Pinjaman</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk Pinjaman</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="parents" style="margin:15px;">
		<label>Pilih Jenis Pinjaman</label>
		<select name="jenis_pinjaman" id="jenis_pinjaman" onchange="$('#modalku').modal('show')" class="form-control" style="width:350px;">
			<option value="">- Jenis Pinjaman</option>
			<option value="reguler">Pinjaman Reguler</option>
			<option value="khusus">Pinjaman Khusus</option>
		</select>
		<div id="load_form">
			<div class="text-center">
				<h2 style="margin: 80px auto;color:#eaeaea">Form Peminjaman</h2>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<div id="modalku" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalku" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3 class="modal-title" style="color:#fff;">Konfirmasi</h3>
			</div>	
			<div class="modal-body">
				<h4 class="modal-title" style="color:grey;">Yakin Memilih Jenis Pinjaman Tersebut ?</h4>
			</div>			
			<div class="modal-footer">
				<button class="btn btn-danger" onclick="location.reload()" aria-hidden="true">BATAL</button>
				<button class="btn btn-info" onclick="pilih_pinjaman()" aria-hidden="true">YA</button>
			</div>
		</div>
	</div>
</div>


<script>
	function pilih_pinjaman(){
		var opsi = $('#jenis_pinjaman').val();
		if (opsi == 'reguler') {
			$.ajax({
				url: '<?php echo base_url('setting/pinjaman/form_reguler'); ?>',
				type: 'post',
				success: function(response){
					$('#load_form').html(response);
					$('#jenis_pinjaman').attr('disabled',true);
					$('#modalku').modal('hide')
				}			
			});
		}else if (opsi == 'khusus') {
			$.ajax({
				url: '<?php echo base_url('setting/pinjaman/form_khusus'); ?>',
				type: 'post',
				success: function(response){
					$('#load_form').html(response);
					$('#jenis_pinjaman').attr('disabled',true);
					$('#modalku').modal('hide')
				}			
			});
		}else{
			$('#jenis_pinjaman').html('');
		}
	}
</script>