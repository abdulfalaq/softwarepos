
<div id='cssmenu'>
	<ul>
	   <li><a href='<?php echo @base_url('setting/profil_koperasi'); ?>'><i class="fa fa-university"></i> <span>Profil Koperasi</span></a></li>
	   <li class='has-sub'><a href='#'><i class="fa fa-gears"></i> <span>Kepengurusan</span></a>
	      <ul>
	         <li><a href='<?php echo @base_url('setting/kepengurusan_jabatan'); ?>'><span>Jabatan</span></a></li>
	         <li><a href='<?php echo @base_url('setting/kepengurusan_profil_pengurus'); ?>'><span>Profil Pengurus</span></a></li>
	      </ul>
	   </li>
	   <li class='has-sub'><a href='#'><i class="fa fa-group"></i> <span>Anggota</span></a>
	      <ul>
	         <li><a href='<?php echo @base_url('setting/anggota_pendaftaran'); ?>'><span>Pendaftaran</span></a></li>
	         <li><a href='<?php echo @base_url('setting/anggota_verifikasi'); ?>'><span>Verifikasi</span></a></li>
	         <li><a href='<?php echo @base_url('setting/anggota_akun'); ?>'><span>Akun</span></a></li>
	      </ul>
	   </li>
	   <li class='has-sub'><a href='#'><i class="fa fa-credit-card"></i> <span>Rekening</span></a>
	      <ul>
	         <li class="has-sub">
	         	<a href='#'><span>Harta</span></a>
	         	<ul>
	         		<li><a href="<?php echo @base_url('setting/harta_kas'); ?>">Kas</a></li>
	         		<li><a href="#">Piutang</a></li>
	         		<li><a href="#">Inventaris</a></li>
	         	</ul>
	         </li>
	         <li class="has-sub">
	         	<a href='#'><span>Kewajiban</span></a>
	         	<ul>
	         		<li><a href="#">Simpanan Sukarela</a></li>
	         		<li><a href="#">Hutang</a></li>
	         		<li><a href="#">Dana SHU</a></li>
	         	</ul>
	         </li>
	         <li class="has-sub">
	         	<a href='#'><span>Modal</span></a>
	         	<ul>
	         		<li><a href="#">Simpanan Pokok</a></li>
	         		<li><a href="#">Simpanan Wajib</a></li>
	         		<li><a href="#">Hibah</a></li>
	         		<li><a href="#">Cadangan</a></li>
	         		<li><a href="#">Cadangan</a></li>
	         		<li><a href="#">SHU Berjalan</a></li>
	         	</ul>
	         </li>
	         <li class="has-sub">
	         	<a href='#'><span>Pendapatan</span></a>
	         	<ul>
	         		<li><a href="#">Pendapatan Jasa</a></li>
	         		<li><a href="#">Administrasi</a></li>
	         	</ul>
	         </li>
	         <li class="has-sub">
	         	<a href='#'><span>Biaya</span></a>
	         	<ul>
	         		<li><a href="#">Biaya Operasional</a></li>
	         		<li><a href="#">Biaya Non-operasional</a></li>
	         	</ul>
	         </li>
	      </ul>
	   </li>
	   <li class='has-sub'><a href='#'><i class="fa fa-star"></i> <span>Produk</span></a>
	      <ul>
	         <li class="has sub">
	         	<a href='#'><span>Simpanan</span></a>
	         	<ul>
	         		<li><a href="<?php echo @base_url('setting/produk_simpanan_pokok'); ?>">Simpanan Pokok</a></li>
	         		<li><a href="<?php echo @base_url('setting/produk_simpanan_wajib'); ?>">Simpanan Wajib</a></li>
	         		<li><a href="<?php echo @base_url('setting/produk_simpanan_sukarela'); ?>">Simpanan Sukarela</a></li>
	         	</ul>
	         </li>
	         <li class="has sub">
	         	<a href='<?php echo @base_url('setting/pinjaman'); ?>'><span>Pinjaman</span></a>
	         </li>
	      </ul>
	   </li>
	</ul>
</div>