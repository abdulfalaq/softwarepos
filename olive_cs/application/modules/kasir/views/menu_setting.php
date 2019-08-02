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
		<li class='has-sub'><a href='#'><i class="fa fa-money"></i> <span>Keuangan</span></a>
			<ul>
				<li class="has-sub">
					<a href='<?php echo @base_url('setting/setting_akun_keuangan'); ?>'><span>Setting Akun</span></a>
				</li>
				<li class="has-sub">
					<a href='<?php echo @base_url('setting/setting_shu'); ?>'><span>Setting SHU</span></a>
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
						<li><a href="<?php echo @base_url('setting/produk_simpanan_sukarela'); ?>">Tabungan</a></li>
					</ul>
				</li>
				<li class="has sub">
					<a href='<?php echo @base_url('setting/pinjaman'); ?>'><span>Pinjaman</span></a>
				</li>
			</ul>
		</li>
	</ul>
</div>