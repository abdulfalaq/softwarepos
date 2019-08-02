<style>
.testimonial-group > .row {
	white-space: nowrap;
	overflow-x: auto;
	overflow-y: hidden;
	height: 80px;
}
.testimonial-group > .row > .sp{
	display: inline-block;
	float: none;
	height: 60px;
	font-size: 16px;
	line-height: 48px;
}
.testimonial-group > .row > .a{
	padding: 6px 20px;
	height: 60px
}
.testimonial-group > .row::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 0px rgba(0,0,0,0.5);
	background-color: #fff;

}
.testimonial-group > .row::-webkit-scrollbar
{
	background-color: #fff;
	height: 8px;
}
.testimonial-group > .row::-webkit-scrollbar-thumb
{
	background-color: #fb8302;
}
#cssmenu a{
	height: 60px;
	padding: 6px 20px;
	padding-top: 20px;
}
#cssmenu {
	padding: 0;
	margin: 0;
	border: 0;
	margin-right: 25px;
	width: auto;
}
</style>
<div class="container testimonial-group">
	<div id='cssmenu' class="row">
		<div class="sp"><a href='<?php echo @base_url('laporan/laporan_stok_bahan/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan Stok Bahan</span></a></div>
		<div class="sp"><a href='<?php echo @base_url('laporan/laporan_stok_perlengkapan/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan Stok Perlengkapan</span></a></div>
		<div class="sp"><a href='<?php echo @base_url('laporan/laporan_stok_produk/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan Stok Produk</span></a></div>
		<?php
		$user=$this->session->userdata('astrosession');
		if($user->jabatan=='J_0006'  || $user->jabatan=='J_0004' || $user->jabatan=='J_0002'){
			?>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_treatment/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Treatment</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_produksi_keluar/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Produk Keluar</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_konsul/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Konsul</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_new_member/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  New Member</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_member/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Member Retention</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_jasa/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Jasa Terapis</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_transaksi/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Transaksi</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_laba_rugi/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Laba Rugi</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_arus_kas/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Arus Kas</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_perubahan_modal/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Perubahan Modal</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_neraca/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Neraca</span></a></div>
			<div class="sp"><a href='<?php echo @base_url('laporan/laporan_analisa_market/daftar'); ?>'><i class="glyphicon glyphicon-file"></i> <span>Laporan  Analisa Market</span></a></div>
			<?php
		}

		?>
	</div>
</div>
