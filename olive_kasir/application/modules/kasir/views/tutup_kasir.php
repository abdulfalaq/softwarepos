<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
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
				<?php
				$petugas=$this->session->userdata('astrosession');
				$kode_petugas=@$petugas->id;

				$this->db->where('kode_kasir', $kode_petugas);
				$this->db->where('tanggal',date('Y-m-d'));
				$this->db->where('status','open');
				$this->db->where('validasi','');
				$get_kasir=$this->db->get('transaksi_kasir')->row();
				?>
				<div class="panel-body">
					<form id="data_form" method="post">  
						<div class="box-body">     
							<div class="sukses"></div>       
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Kasir</label>
									<input readonly="true" value="<?php echo @$get_kasir->kode_transaksi;?>" type="text" class="form-control" name="kode_transaksi" />
									<input readonly="true" value="<?php echo @$get_kasir->saldo_awal;?>" type="hidden" class="form-control" name="saldo_awal" />

								</div>                      
								<div class="form-group col-xs-5">
									<label>Saldo Laporan Kasir</label>
									<div class="input-group">
										<span id="dibayar">
											<input onkeyup="cek_rupiah()" type="number" value="" class="form-control" autocomplete="off" name="saldo_akhir" id="saldo_akhir" required="" />
										</span>
										<span id="rupiah" class="input-group-addon">Rp.</span>
									</div>
								</div>
								
								
							</div>
							<div class="box-footer">
								<button class="btn btn-primary pull-right">Simpan</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>
<script type="text/javascript">
	function cek_rupiah() {
		var saldo_akhir=$('#saldo_akhir').val();
		if(parseInt(saldo_akhir) < 0){
			alert('Saldo Awal Salah !');
			$('#saldo_akhir').val('');
			$('#rupiah').text(toRp(saldo_akhir));
		}else{
			$('#rupiah').text(toRp(saldo_akhir));
		}
	}
	function toRp(angka){
		if(angka==''){
			return 'Rp.0,00';
		}else{
			var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
			var rev2    = '';
			for(var i = 0; i < rev.length; i++){
				rev2  += rev[i];
				if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
					rev2 += '.';
				}
			}
			return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
		}
		
	}
	$("#data_form").submit(function(){
		var url = "<?php echo base_url().'kasir/simpan_tutup_kasir'; ?>";
		$.ajax( {
			type:"POST", 
			url : url,  
			cache :false,
			data :$(this).serialize(),
			dataType:'json',
			beforeSend:function(){
				$('.tunggu').show();
			},
			success : function(data) {
				$('.tunggu').hide();
				if(data.respon=='sukses'){
					window.location="<?php echo base_url('kasir'); ?>";
				}else{
					$('.sukses').html('<div class="alert alert-warning">Gagal Tutup Kasir !</div>');
					setTimeout(function(){$('.sukses').html('');},1500); 
				}
			},  
			error : function(data) {  
				alert('Gagal');  
			}  
		});
		return false;
	})
</script>
