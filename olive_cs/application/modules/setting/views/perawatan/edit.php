<?php 
$kode_perawatan=$this->uri->segment(4);
$this->db->where('kode_perawatan',$kode_perawatan);
$get_gudang = $this->db->get('olive_master.master_perawatan')->row();
?>


<!-- back button -->
<a href="<?php echo base_url('setting/perawatan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->


<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Perawatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Perawatan </span>
					<a href="<?php echo base_url('setting/perawatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perawatan</a>
					<a href="<?php echo base_url('setting/perawatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perawatan</a>
				</div>
				<div class="panel-body">
					<form id="form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3>Perawatan</h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Perawatan</label>
										<input  type="text" readonly="" value="<?php echo $get_gudang->kode_perawatan ?>" class="form-control" placeholder="Kode Perawatan " name="kode_perawatan" id="kode_perawatan" required="" />
									</div>
									<div class="form-group">
										<label class="gedhi">Nama Perawatan</label>
										<input type="text" class="form-control" placeholder="Nama Perawatan" value="<?php echo $get_gudang->nama_perawatan ?>" name="nama_perawatan" id="nama_perawatan" required=""/>
									</div>


								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Harga Jual</label>
										<div class="input-group">
											<span class="input-group-addon rp_hpp">Rp 0,00</span>
											<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="harga_jual" id="harga_jual" value="<?php echo $get_gudang->harga_jual ?>" required=""/>
										</div>
									</div>
									
									<div class="form-group">
										<label class="gedhi">Insentif Terapis</label>
										<div class="input-group">
											<span class="input-group-addon rp_insentif">Rp 0,00</span>
											<input type="number" class="form-control input-group" onkeyup="get_insentif()" name="insentif_terapi" id="insentif_terapi" value="<?php echo $get_gudang->insentif_terapi ?>"  required="" />
										</div>
									</div>								
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">HPP</label>
										<input type="text" class="form-control" placeholder="HPP" value="<?php echo $get_gudang->hpp ?>" name="hpp" id="hpp"  readonly=""  / >
									</div>
								</div>
								<div class="col-md-6">								
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status" id="status" required="">
											<option selected="true" value="">Pilih Status</option>
											<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
											<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
										</select> 
									</div>
								</div>
								<div class="col-md-6">
									<label class="gedhi">Reedem Poin</label>
									<div class="form-group">
										<input type="number" class="form-control input-group" onkeyup="get_ter()" name="redeem_poin" id="redeem_poin" value="" required="" />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div> 
				<div id="bottom" style="margin-top: 30px">
					<hr style="width:100%;">
					<div class="sukses" ></div>
					<div class="box-body komposisi_perawatan" style="">

						<div class="row">
							<div class="daffa">
								<div class="col-md-12" style="margin-top: 30px">  

									<div class="col-md-2">
										<label>Jenis</label>

										<select class="form-control" id="jenis" name="jenis">
											<option value="">--Pilih Jenis--</option>
											<option value="Perlengkapan">Perlengkapan</option>
											<option value="Bahan">Bahan</option>
										</select>
									</div>

									<div class="col-md-2" id="bahan">
										<label>Bahan</label>
										<input type="text" class="form-control" placeholder="Bahan" name="nama_satuan" disabled="" id="nama_satuan" />
									</div>

									<div class="col-md-2" id="bahan_baku">
										<label>Nama Bahan</label>
										<select id="kode_bahan" name="kode_bahan" class="form-control" style="width: 100%">
											<option value="">--Pilih Bahan--</option>
											<?php  
											$get_paket = $this->db->get('olive_master.master_bahan_baku')->result();
											foreach ($get_paket as $value) {?>
												<option value="<?php echo $value->kode_bahan_baku ?>"><?php echo $value->nama_bahan_baku ?></option>
												<?php }

												?>
											</select>

										</div>

										<div class="col-md-2" id="peralatan">
											<label>Nama Perlengkapan</label>
											<select id="kode_perlengkapan" name="kode_perlengkapan" class="form-control " style="width: 100%">
												<option value="">--Pilih Perlengkapan--</option>
												<?php  
												$get_butung = $this->db->get('olive_master.master_perlengkapan')->result();
												foreach ($get_butung as $value) {?>
													<option value="<?php echo $value->kode_perlengkapan ?>"><?php echo $value->nama_perlengkapan ?></option>
													<?php }

													?>
												</select>
												<input type="hidden" name="kategori_bahan" id="kategori_bahan" value="bahan baku">
											</div>

											<input type="hidden" id="nama_bahan" name="nama_bahan" />
											<div class="col-md-2">
												<label>Jumlah</label>
												<input type="number" class="form-control" placeholder="Jumlah" name="jumlah" id="jumlah"/>
												<input type="hidden" name="id_item" id="id_item" />
											</div>

											<div class="col-md-2">
												<label>Satuan</label>
												<input type="hidden" readonly="true" class="form-control" placeholder="Satuan" name="satuan" id="satuan"/>
												<input type="text" readonly="true" class="form-control" placeholder="Satuan" name="satuan_text" id="satuan_text"/>
											</div>

											<div class="col-md-2">
												<label>HPP</label>
												<input type="text" readonly="true" class="form-control" placeholder="Hpp"  id="hpp_total"/>

											</div>

											<div class="col-md-1" style="padding:25px;">
												<div onclick="tambah_temporari()" id="add"  class="btn btn-primary" >Add</div>
												<div onclick="update_temporari()" id="update"  class="btn btn-primary" >Update</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div id="list_transaksi_pembelian">
								<div class="box-body komposisi_perawatan">
									<label style="font-weight:700;font-size:14px;">
										List Komposisi Perawatan
									</label>
									<div id="oraight">
										<table id="" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Kode</th>
													<th>Nama</th>
													<th>Jumlah</th>
													<th>HPP</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="tabel_temp_data_transaksi">

											</tbody>
											<tfoot>

											</tfoot>
										</table>
									</div>
								</div>
							</div>

							<br>

							<a onclick="update_perawatan()"  class="btn btn-success pull-right komposisi_perawatan">Simpan</a>
							<a onclick="batal_lock()"  class="btn btn-danger pull-right komposisi_perawatan" style="margin-right: 10px">Batal</a>
						</div>
						<div class="box-footer clearfix">

						</div>
					</form>
					<!--  -->
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
					<input type="hidden" id="id_opsi">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button onclick="hapus_data()" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>



	<script type="text/javascript">
		load_table();
		function batal_lock(){

			var kode_perawatan=$('#kode_perawatan').val();
			$.ajax({
				url: '<?php echo base_url('setting/perawatan/hapus_all_temporari'); ?>',
				type: 'post',
				data:{kode_perawatan:kode_perawatan},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){

					window.location="<?php echo base_url('setting/perawatan/daftar');?>";
				}
			});
		}
		function actEdit(id) {
			var id = id; 
			var kode_pembelian = $('#kode_pembelian').val();
			var kode_perawatan = $('#kode_perawatan').val();
			var url = "<?php echo base_url().'setting/perawatan/get_temp_perawatan'; ?>";
			$.ajax({
				type: 'POST',
				url: url,
				dataType: 'json',
				data: {id:id},
				success: function(pembelian){
					$("#jenis").val(pembelian.jenis);
					$("#jumlah").val(pembelian.qty);
					$("#id_item").val(pembelian.id_temp);
					$("#satuan_text").val(pembelian.alias);
					$("#satuan").val(pembelian.kode);
					$("#hpp_total").val(pembelian.hpp);

					if(pembelian.jenis == 'Bahan')
					{
						$("#bahan_baku").show();
						$("#peralatan").hide();
						$("#bahan").hide();
						$("#kode_bahan").val(pembelian.kode_bahan);
					}else if(pembelian.jenis == 'Perlengkapan')
					{
						$("#bahan_baku").hide();
						$("#peralatan").show();
						$("#bahan").hide();
						$("#bahan").val('');
						$("#kode_perlengkapan").val(pembelian.kode_perlengkapan);
					}else
					{
						$("#bahan_baku").hide();
						$("#peralatan").hide();
						$("#bahan").show();
						$("#bahan").val('');
						$("#form_expired").hide();
					}

					$("#add").hide();
					$("#update").show();
					$("#tabel_temp_data_transaksi").load("<?php echo base_url().'setting/perawatan/get_perawatan/'; ?>"+kode_perawatan);
					get_harga_promo();
				}
			});
		}
		$("#kode_bahan").on('change',function(){
			var kode_bahan = $('#kode_bahan').val();
			var keterangan = "<?php echo base_url().'setting/perawatan/cari_bahan'?>";
			$.ajax({
				type: "POST",
				url: keterangan,
				dataType: 'json',
				data: {kode_bahan:kode_bahan},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(msg)
				{
					$('#total_hpp').val('');
					$('#jumlah').val('');
					$(".tunggu").hide();
					$('#satuan').val(msg.kode);
					$('#satuan_text').val(msg.alias);

					$('#hpp').val('');
				}
			});
			return false;
		});

		$("#kode_perlengkapan").on('change',function(){
			var kode_perlengkapan = $('#kode_perlengkapan').val();
			var keterangan = "<?php echo base_url().'setting/perawatan/cari_perlengkapan'?>";
			$.ajax({
				type: "POST",
				url: keterangan,
				dataType: 'json',
				data: {kode_perlengkapan:kode_perlengkapan},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(msg)
				{
					$('#total_hpp').val('');
					$('#jumlah').val('');	
					$(".tunggu").hide();
					$('#satuan').val(msg.kode);
					$('#satuan_text').val(msg.alias);

					$('#hpp').val('');
				}
			});
			return false;
		});

		$("#harga").keyup(function(){

			var jumlah = $('#jumlah').val();
			var harga = $('#harga').val();
			var tot = jumlah*harga;
			$("#sub_total").val(tot);
		});

		$("#jumlah").keyup(function(){

			var jumlah = $('#jumlah').val();
			if(parseInt(jumlah) <= 0){
				alert("Jumlah Salah ..!");
				$('#jumlah').val('');

			}else{

				var kategori_bahan = $('#jenis').val();
				if(kategori_bahan =='Perlengkapan'){
					var kode_perlengkapan = $('#kode_perlengkapan').val();
					var keterangan = "<?php echo base_url().'setting/perawatan/cari_perlengkapan'?>";
					$.ajax({
						type: "POST",
						url: keterangan,
						dataType: 'json',
						data: {kode_perlengkapan:kode_perlengkapan},

						success: function(msg)
						{
							$(".tunggu").hide();
							$('#satuan_text').val(msg.alias);
							$('#satuan').val(msg.kode);
							$('#hpp_total').val(msg.hpp);
						}
					});
				}else{
					var kode_bahan = $('#kode_bahan').val();
					var keterangan = "<?php echo base_url().'setting/perawatan/cari_bahan'?>";
					$.ajax({
						type: "POST",
						url: keterangan,
						dataType: 'json',
						data: {kode_bahan:kode_bahan},

						success: function(msg)
						{
							$(".tunggu").hide();
							$('#satuan_text').val(msg.alias);
							$('#satuan').val(msg.kode);

							$('#hpp_total').val(msg.hpp);
						}
					});
				}
			}

		});
		function lock_perawatan(){
			var nama_perawatan = $('#nama_perawatan').val();
			var kode_perawatan = $('#kode_perawatan').val();
			var harga_jual = $('#harga_jual').val();
			var insentif_terapis = $('#insentif_terapis').val();
			var komposisi_perawatan = $('.komposisi_perawatan').val();
			var status = $('#status').val();
			if(nama_perawatan=='' || harga_jual=='' || status=="" || insentif_terapi==""){
				alert("Silahkan Lengkapi Form");
			}else{
				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url() . 'setting/perawatan/cek_kode' ?>",  
					cache :false,  
					data :{kode_perawatan:kode_perawatan},
					dataType: 'Json',
					beforeSend:function(){
						$(".tunggu").show();   
					},
					success : function(data) { 
						if (data.hasil == 'kosong') {
							$(".tunggu").hide();   
							$('.komposisi_perawatan').show();
							$('#kode_perawatan').attr('readonly',true);
							$('#harga_jual').attr('readonly',true);
							$('#nama_perawatan').attr('readonly',true);	
							$('#insentif_terapi').attr('readonly',true);
							$('#status').attr('disabled',true);

						}else{
							alert('Kode Perawatan Sudah Ada');
							setTimeout(function(){ location.reload() }, 2000);
						}
					},  
					error : function() {
						alert("Data gagal dilock.");  
					}  
				});
			}
		}

		function get_nominal_hpp(){
			var hpp = $('#harga_perawatan').val();
			if(parseInt(hpp) < 0){
				alert("Harga Jual Salah");
				$('#harga_perawatan').val('');
				$(".rp_hpp").html("Rp. 0");
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'setting/perawatan/get_hpp' ?>",
					data: {
						hpp: hpp
					},

					success: function(msg)
					{
						$(".rp_hpp").html(msg);
					}
				});
			}
		}

		function tampil_update(){
			var nama_perawatan = $('#nama_perawatan').val();
			var harga_jual = $('#harga_jual').val();
			var insentif_terapis = $('#insentif_terapis').val();
			var komposisi_perawatan = $('.komposisi_perawatan').val();
			var status = $('#status').val();
			if(nama_perawatan=='' || harga_jual=='' || status=="" || insentif_terapi==""){
				alert("Silahkan Lengkapi Form");
			}else{
				$('#update').show();
				$('#add').hide();

			}
		}

		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#id_opsi').val(key);
		}
		function hapus_data() {
			var kode_perawatan=$('#kode_perawatan').val();
			var id_opsi=$('#id_opsi').val();
			$.ajax({
				url: '<?php echo base_url('setting/perawatan/hapus_temporari'); ?>',
				type: 'post',
				data:{id:id_opsi},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					$('#modal-hapus').modal('hide');
					load_table(kode_perawatan)
				}
			});
		}

		function tambah_temporari(){
			kode_perawatan		 = $('#kode_perawatan').val();
			kode_bahan			 = $('#kode_bahan').val();
			kode_perlengkapan 	 = $('#kode_perlengkapan').val();
			jumlah 				 = $('#jumlah').val();
			satuan 				 = $('#satuan').val();
			hpp 				 = $('#hpp_total').val();
			jenis 				 = $('#jenis').val();


			if(jenis=='' || jumlah=='' || nama_bahan==''){
				alert ('Lengkapi Form');
			}else{


				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url() . 'setting/perawatan/simpan_temporari' ?>",  
					cache :false,  
					data :{kode_perawatan:kode_perawatan,kode_bahan:kode_bahan,kode_perlengkapan:kode_perlengkapan,qty:jumlah,satuan:satuan,hpp:hpp,jenis:jenis},
					dataType: 'Json',
					beforeSend:function(){
						$(".tunggu").show();   
					},
					success : function(data) { 
						if (data.response == 'sukses') {
							$(".tunggu").hide();   
							$('#jenis').val('');
							$('#jumlah').val('');
							$('#kode_bahan').val('');
							$('#satuan').val('');
							$('#hpp_total').val('');
							$('#kode_perlengkapan').val('');
							load_table(kode_perawatan)

						}else{
							alert('Gagal Menyimpan data');
							setTimeout(function(){ location.reload() }, 2000);
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});
			}
		}
		function update_perawatan(){
			kode_perawatan		 = $('#kode_perawatan').val();
			kode_bahan			 = $('#kode_bahan').val();
			kode_perlengkapan 	 = $('#kode_perlengkapan').val();
			jumlah 				 = $('#jumlah').val();
			satuan 				 = $('#satuan').val();
			hpp 				 = $('#hpp').val();
			jenis 				 = $('#jenis').val();
			status 				 = $('#status').val();
			insentif_terapi 	 = $('#insentif_terapi').val();
			harga_jual 	 		 = $('#harga_jual').val();
			nama_perawatan 		 = $('#nama_perawatan').val();
			redeem_poin 		 = $('#redeem_poin').val();

			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'setting/perawatan/update_perawatan' ?>",  
				cache :false,  
				data :{kode_perawatan:kode_perawatan,kode_bahan:kode_bahan,kode_perlengkapan:kode_perlengkapan,qty:jumlah,satuan:satuan,hpp:hpp,jenis:jenis,status:status,insentif_terapi:insentif_terapi,harga_jual,harga_jual,nama_perawatan:nama_perawatan,redeem_poin:redeem_poin},
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(data) { 
					if (data.response == 'sukses') {
						$(".tunggu").hide();   
						window.location="<?php echo base_url('setting/perawatan/daftar');?>";

					}else{
						alert('Gagal Menyimpan data');
						setTimeout(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
		}	

		function detail(){
			var nama_perawatan = $('#nama_perawatan').val();
			var harga_jual = $('#harga_jual').val();
			var insentif_terapis = $('#insentif_terapis').val();
			var komposisi_perawatan = $('.komposisi_perawatan').val();
			var status = $('#status').val();
			if(nama_perawatan=='' || harga_jual=='' || status=="" || insentif_terapi==""){
				alert("Silahkan Lengkapi Form");
			}else{
				$('#jenis').attr('disabled',true);
				$('#kode_bahan').attr('disabled',true);
				$('#kode_perlengkapan').attr('disabled',true);	
				$('#jumlah').attr('readonly',true);

			}
		}

		function update_temporari(){
			kode_perawatan		 = $('#kode_perawatan').val();
			kode_bahan			 = $('#kode_bahan').val();
			kode_perlengkapan 	 = $('#kode_perlengkapan').val();
			jumlah 				 = $('#jumlah').val();
			satuan 				 = $('#satuan').val();
			hpp 				 = $('#hpp_total').val();
			jenis 				 = $('#jenis').val();
			id_item 				 = $('#id_item').val();



			if(jenis=='' || jumlah=='' || nama_bahan==''){
				alert ('Lengkapi Form');
			}else{
				

				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url() . 'setting/perawatan/update_temporari' ?>",  
					cache :false,  
					data :{id:id_item,kode_perawatan:kode_perawatan,kode_bahan:kode_bahan,kode_perlengkapan:kode_perlengkapan,qty:jumlah,satuan:satuan,hpp:hpp,jenis:jenis},
					dataType: 'Json',
					beforeSend:function(){
						$(".tunggu").show();   
					},
					success : function(data) { 
						if (data.response == 'sukses') {
							$(".tunggu").hide();
							$("#update").hide();
							$("#add").show();   
							$('#jenis').val('');
							$('#jumlah').val('');
							$('#kode_bahan').val('');
							$('#satuan').val('');
							$('#hpp_total').val('');
							$('#kode_perlengkapan').val('');
							load_table(kode_perawatan)

						}else{
							alert('Gagal Menyimpan data');
							setTimeout(function(){ location.reload() }, 2000);
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});
			}
		}

		function load_table(obj){
			kode_perawatan		 = $('#kode_perawatan').val();
			$.ajax( {
				type : "post",
				url : "<?php echo base_url() . 'setting/perawatan/tampil' ?>",
				data :{kode_perawatan:kode_perawatan},
				success : function(data) { 
					$("#oraight").html(data);
				} 

			});
			return false;
		}

		$("#update").hide();
		$("#peralatan").hide();
		$("#bahan_baku").hide();

		$('#jenis').on('change',function(){
			var jenis1 = $("#jenis").val();
			if(jenis1 == 'Bahan')
			{
				$("#bahan_baku").show();
				$("#peralatan").hide();
				$("#bahan").hide();
				$("#form_expired").show();
				$("#nama_bahan").val('');
				$("#perlengkapan").val('');
				$("#jumlah").val('');
				$("#harga").val('');
				$("#sub_total").val('');
				$("#expired_date").val('');
			}else if(jenis1 == 'Perlengkapan')
			{ 
				$("#form_expired").hide();
				$("#bahan_baku").hide();
				$("#peralatan").show();
				$("#bahan").hide();
				$("#nama_bahan").val('');
				$("#perlengkapan").val('');
				$("#jumlah").val('');
				$("#harga").val('');
				$("#sub_total").val('');
				$("#expired_date").val('');
			}else
			{ 
				$("#form_expired").hide();
				$("#bahan_baku").hide();
				$("#peralatan").hide();
				$("#bahan").show();
				$("#nama_bahan").val('');
				$("#perlengkapan").val('');
				$("#jumlah").val('');
				$("#harga").val('');
				$("#sub_total").val('');
				$("#expired_date").val('');
			};
		});
		$("#form").submit( function() {        
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'setting/perawatan/simpan_perawatan' ?>",  
				cache :false,  
				data :$(this).serialize(),
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(data) { 
					if (data.response == 'sukses') {
						$(".tunggu").hide();   
						$(".alert_berhasil").show();   
						window.location="<?php echo base_url('setting/perawatan/daftar');?>"; 
					}else{
						alert('Gagal Menyimpan data');
						setTimeout(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
			return false;   

		});   



		function get_nominal_hpp(){
			var hpp = $('#harga_jual').val();
			if(parseInt(hpp) < 0){
				alert("Harga Jual Salah");
				$('#harga_jual').val('');
				$(".rp_hpp").html("Rp. 0");
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'setting/perawatan/get_hpp' ?>",
					data: {
						hpp: hpp
					},

					success: function(msg)
					{
						$(".rp_hpp").html(msg);
					}
				});
			}
		}

		function get_insentif(){
			var hpp = $('#insentif_terapi').val();
			if(parseInt(hpp) < 0){
				alert("Insentif terapi Salah");
				$('#insentif_terapi').val('');
				$(".rp_insentif").html("Rp. 0");
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'setting/perawatan/get_hpp' ?>",
					data: {
						hpp: hpp
					},

					success: function(msg)
					{
						$(".rp_insentif").html(msg);
					}
				});
			}
		}


		function get_ter(){
			var hpp = $('#redeem_poin').val();
			if(parseInt(hpp) < 0){
				alert("Redeem Poin Salah");
				$('#redeem_poin').val('');
				$(".rp_ii").html("Rp. 0");
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'setting/perawatan/get_hpp' ?>",
					data: {
						hpp: hpp
					},

					success: function(msg)
					{
						$(".rp_ii").html(msg);
					}
				});
			}
		}
	</script>
