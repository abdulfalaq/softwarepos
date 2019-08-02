<?php 
$kode = $this->uri->segment(3);
$this->db->select('olive_kasir.transaksi_kasir.kode_transaksi,tanggal,check_in,check_out,petugas,saldo_awal,saldo_akhir,saldo_sebenarnya,selisih,validasi');
$this->db->select('nama_karyawan');
$this->db->from('olive_kasir.transaksi_kasir');
$this->db->where('olive_kasir.transaksi_kasir.kode_transaksi',$kode);
$this->db->join('olive_master.master_user', 'olive_kasir.transaksi_kasir.petugas = olive_master.master_user.id', 'left');
$get_detail = $this->db->get()->row();

$this->db->select_sum('grand_total');
$get_transaksi=$this->db->get_where('transaksi_layanan', array('kode_kasir' => $kode));
$total_nominal=$get_transaksi->row();

$this->db->select_sum('grand_total');
$this->db->where('jenis_transaksi', 'tunai');
$get_transaksi=$this->db->get_where('transaksi_layanan', array('kode_kasir' => $kode));
$hasil_transaksi_tunai=$get_transaksi->row();

$this->db->select_sum('grand_total');
$this->db->where('jenis_transaksi', 'kredit');
$get_transaksi=$this->db->get_where('transaksi_layanan', array('kode_kasir' => $kode));
$hasil_transaksi_kredit=$get_transaksi->row();

$this->db->select_sum('grand_total');
$this->db->where('jenis_transaksi', 'debit');
$get_transaksi=$this->db->get_where('transaksi_layanan', array('kode_kasir' => $kode));
$hasil_transaksi_debit=$get_transaksi->row();
?>

<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Transaksi Kasir</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Transaksi Kasir </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<form id="data_form">  
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-md-5">
									<label>Kode Kasir</label>
									<input readonly="true"  id="kode_transaksi" type="text" value="<?php echo $get_detail->kode_transaksi ?>" class="form-control" name="kode_transaksi" />

								</div>
								<div class="form-group  col-md-5">
									<label>Tanggal</label>
									<input readonly="true"  type="text" class="form-control" value="<?php echo tanggalIndo($get_detail->tanggal) ?>" />

								</div>
								<div class="form-group  col-md-5">
									<label>Check In</label>
									<input readonly="true" type="text" value="<?php echo $get_detail->check_in ?>" class="form-control" />

								</div>
								<div class="form-group  col-md-5">
									<label>Check Out</label>
									<input readonly="true"  type="text" value="<?php echo $get_detail->check_out ?>" class="form-control" />

								</div>
								<div class="form-group  col-md-5">
									<label>Petugas</label>
									<input readonly="true" value="<?php echo $get_detail->nama_karyawan ?>" type="text" class="form-control" />
								</div>
							</div>

							<div class="row">   
								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Tunai</label>
									<input readonly="true"  type="text" value=" <?php  echo format_rupiah($hasil_transaksi_tunai->grand_total);  ?>" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Credit</label>
									<input readonly="true" type="text" value=" <?php  echo format_rupiah($hasil_transaksi_kredit->grand_total);?>" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Debit</label>
									<input readonly="true"  type="text" value=" <?php  echo format_rupiah($hasil_transaksi_debit->grand_total); ?>" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Total Nominal</label>
									<input readonly="true"  type="text" value="<?php echo format_rupiah($total_nominal->grand_total) ?>" class="form-control" />
									<input readonly="true"  type="hidden" name="nominal_penjualan"  class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Awal</label>
									<input readonly="true" type="text" value="<?php echo format_rupiah($get_detail->saldo_awal) ?>"   class="form-control" />

								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Laporan Kasir</label>
									<input readonly="true" value="<?php echo format_rupiah($get_detail->saldo_akhir) ?>" type="text" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Sebenarnya</label>
									<input readonly="true" value="<?php echo format_rupiah($get_detail->saldo_sebenarnya) ?>" type="text" class="form-control" />

								</div>
								<div class="form-group col-md-5">
									<label>Selisih</label>
									<input readonly="true" type="text" value="<?php echo format_rupiah($get_detail->selisih) ?>" class="form-control" name="selisih" id="dp" />
								</div>
								<div class="form-group ombo" style="margin-left: 18px;">
									<input type="hidden"  class="form-control" name="petugas" />
									<input type="hidden"  class="form-control" name="check_out" />
									<input type="hidden"  class="form-control" name="status" />
								</div>
							</div><br><br>
							<?php if($get_detail->validasi !='valid'){
								?>
								<div class="box-footer">
									<a onclick="validate_this('<?php echo $kode ?>')" class="btn btn-no-radius btn-md btn-info pull-right"><i class="fa fa-check"></i> Validasi</a>
								</div>
								<?php
							}?>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validate_this(obj) {
		$.ajax( {
			type:"POST", 
			url : "<?php echo base_url() ?>transaksi_kasir/validate_data_transaksi",  
			cache :false,  
			data :{kode_transaksi:obj},
			dataType:'Json',
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {
				$(".tunggu").hide(); 
				if (data.response == 'sukses') {
					$(".alert_berhasil").show(); 
					setTimeout(function(){ window.location="<?php echo base_url('transaksi_kasir'); ?>" },1500);
				}else{
					alert('Terjadi Kesalahan Saat Mevalidasi Data.');  
				}
			},  
			error : function(data) {  
				alert('Terjadi Kesalahan System Fungsi.');  
			}  
		});
	}
</script>
