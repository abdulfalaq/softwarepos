<?php 
$layanan = $this->uri->segment(3);
$no = 0;

$this->db->select('olive_cs.transaksi_registrasi.kode_layanan,olive_cs.transaksi_registrasi.status,tanggal_transaksi,kode_transaksi');
$this->db->select('olive_master.master_member.nama_member,');
$this->db->select('olive_master.master_layanan.nama_layanan');
$this->db->from('olive_cs.transaksi_registrasi');
$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_registrasi.kode_member', 'left');
$this->db->join('olive_master.master_layanan','master_layanan.kode_layanan = olive_cs.transaksi_registrasi.kode_layanan', 'left');
$this->db->where('olive_cs.transaksi_registrasi.tanggal_transaksi',date('Y-m-d'));
$this->db->where('olive_cs.transaksi_registrasi.kode_layanan',$layanan);
$this->db->order_by('olive_cs.transaksi_registrasi.id','DESC	');
$data_periksa = $this->db->get()->result();
?>
<div class="panel panel-default">
	<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
		<h4 style="text-transform:uppercase">data layanan 
			<?php if ($layanan == '02') {
				echo 'KONSUL';
			}else if($layanan == '01'){
				echo 'TREATMENT';
			}else{
				echo 'PERIKSA';
			} ?></h4>
		</div>
		<div class="panel-body">
			<div class="row" style="width: 100%">
				<div class="col-md-5" id="">
					<div class="input-group">
						<span class="input-group-addon">Tanggal Awal</span>
						<input type="text" class="form-control tgl2" id="tgl_awal">
					</div>
				</div>
				<div class="col-md-5" id="">
					<div class="input-group">
						<span class="input-group-addon">Tanggal Akhir</span>
						<input type="text" class="form-control tgl2" id="tgl_akhir">
					</div>
				</div>                        
				<div class="col-md-2 pull-left">
					<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
				</div>
			</div>
			<br><br>
			<div id="load_table">
				<table class="table table-hovered table-bordered" id="datatable">
					<thead>
						<tr>
							<th>Kode Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Nama Customer</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 

						foreach ($data_periksa as $value) { $no++; ?>
						<tr>
							<td><?php echo $value->kode_transaksi ?></td>
							<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
							<td><?php echo $value->nama_member ?></td>
							<td>
								<div class="btn-group">
									<a href="<?php echo base_url ('registrasi_pelayanan/detail/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success  btn-no-radius btn-circle green"><i class="fa fa-search"></i> </a>
									<?php 
									if ($value->kode_layanan == '02' && $value->status == 'verifikasi') { ?>
									<a href="<?php echo base_url ('registrasi_pelayanan/verifikasi/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-info  btn-no-radius btn-circle green"><i class="fa fa-check"></i> </a>
									<?php }
									?>
									<a onclick="reprint('<?php echo $value->kode_transaksi ?>')" data-toggle="tooltip" title="Detail" class="btn btn-warning btn-circle green"><i class="fa fa-print"></i> </a>
								</div>
							</td>
						</tr>
						<?php }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$('#datatable').dataTable();
			$('#datatable-keytable').DataTable( { keys: true } );
			$('#datatable-responsive').DataTable();
			$('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
			var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
			$('.select2').select2();
			
		});
		$('.tgl2').Zebra_DatePicker({});
		function reprint(key) {
			$.ajax({
				url: '<?php echo base_url('registrasi_pelayanan/registrasi_pelayanan/reprint'); ?>',
				type: 'post',
				data:{kode_transaksi:key},
				dataType:'json',
				success: function(hasil){ 
					if(hasil.respon=='gagal'){
						alert('Gagal !');
					}
				}
			});
		}
		function cari_stok_day(){
			tgl_awal  = $('#tgl_awal').val();
			tgl_akhir = $('#tgl_akhir').val();
			layanan	  = '0'+<?php echo $layanan; ?>;
			if (tgl_awal != '' && tgl_akhir != '') {
				$.ajax({
					url: '<?php echo base_url('registrasi_pelayanan/registrasi_pelayanan/load_data_cari'); ?>',
					type: 'post',
					data:{tgl_akhir:tgl_akhir,tgl_awal:tgl_awal,layanan:layanan},
					success: function(hasil){
						$('#load_table').html(hasil); 
					}
				});
			}else{
				alert('Harap Mengisi Form.');
			}


		}
	</script>