
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Kepengurusan</a></li>
		<li>Profil Pengurus</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Profil Pengurus</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 20px;">Edit Data Pengurus</span>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus/tambah'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> Daftar Data</a>
					</div>
					<?php
					$id = $this->uri->segment(4);
					$ambil = $this->db->get_where('data_pengurus',array('id' => $id));
					$hasil_ambil = $ambil->row();
					?>
					<div class="panel-body">
					<form id="data_form" method="post">
					<input id="id" name="id" value="<?php echo $hasil_ambil->id?>" type="hidden">
						<div class="form-group">
							<label>Jabatan</label>
							<select name="kode_jabatan" id="kode_jabatan" class="form-control" required="">
								<option value="">--Pilih Jabatan</option>
								<?php 
									$ambil_jabatan = $this->db->get('master_jabatan');
									$hasil_jabatan = $ambil_jabatan->result();

									foreach ($hasil_jabatan as $item) {
								?>
								<option <?php if($hasil_ambil->kode_jabatan ==  $item->kode_jabatan){echo 'selected';}?> value="<?php echo $item->kode_jabatan.'|'.$item->nama_jabatan?>"><?php echo $item->nama_jabatan?></option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama_pengurus" id="nama_pengurus" class="form-control" required="" value="<?php echo $hasil_ambil->nama_pengurus?>">
						</div>
						<div class="form-group">
							<label>Pendidikan Terakhir</label>
							<input type="text" name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control" required="" value="<?php echo $hasil_ambil->pendidikan_terakhir?>">
						</div>
						<div class="form-group">
							<label>Lama Menjadi Anggota</label>
							<div class="input-group">
								<input type="number" name="lama_menjadi_anggota" id="lama_menjadi_anggota" class="form-control" required="" placeholder="" value="<?php echo $hasil_ambil->lama_menjadi_anggota?>">
								<span class="input-group-addon">Tahun</span>
							</div>
						</div>
						<div class="form-group">
							<label>Periode Kepengurusan</label>
							<div class="input-group">
								<select name="periode_awal" id="periode_awal" class="form-control">
									<option value="">PILIH PERIODE AWAL</option>
                                    <?php
                                    $tanggal_sekarang = date('Y')+10;
                                    $date = $tanggal_sekarang-20;
                                    for ($i=$date; $i <= $tanggal_sekarang ; $i++) { 
                                        ?>
                                        <option <?php if($hasil_ambil->periode_awal == $i ){echo 'selected';}?> value="<?php echo $i ?>">
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
								</select>
								<span class="input-group-addon">S/d</span>
								<select name="periode_akhir" id="periode_akhir" class="form-control">
									<option value="">PILIH PERIODE AKHIR</option>
									<?php
                                    $tanggal_sekarang = date('Y')+10;
                                    $date = $tanggal_sekarang-20;
                                    for ($i=$date; $i <= $tanggal_sekarang ; $i++) { 
                                        ?>
                                        <option <?php if($hasil_ambil->periode_akhir == $i ){echo 'selected';}?>  value="<?php echo $i ?>">
                                            <?php echo $i ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
								</select>
							</div>
						</div>
					</div>
					<div class="panel-footer text-right">
						<button class="btn btn-lg btn-super btn-no-radius btn-warning" type="post"><i class="fa fa-edit"></i> SIMPAN</button>
					</div>
					</form>
				</div>
			</div>
		</div> <!-- //row -->
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">

$('#data_form').submit(function(){

			$.ajax({
			url: '<?php echo base_url().'setting/kepengurusan_profil_pengurus/simpan_ubah' ?>',
			type: 'post',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(data){
				 window.location.href = '<?php echo base_url().'setting/kepengurusan_profil_pengurus'?>';
			}
		});
		return false;

		})
	$(document).ready(function(){
		$('#update_btn').hide();
	});

	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>