<input type="date" id="jasa_terakhir" value="" style="display: none">
<input type="date" id="tanggal_hari_ini" value="<?php echo date('Y-m-d') ?>" style="display: none">
<div class="container">
 <?php
 $user=$this->session->userdata('astrosession');
 if($user->jabatan=='J_0006' || $user->jabatan=='J_0004'){
  ?>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'setting'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Setting</h3></div>
      </div>
    </a>
  </div>
  <!--<div class="col-sm-3">
    <a href="<?php echo base_url().'customer'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/payment-method.png"></div>
        <div class="col-xs-9"><h3>Customer</h3></div>
      </div>
    </a>
  </div>-->
  <?php
}
if($user->jabatan=='J_0006' || $user->jabatan=='J_0004' || $user->jabatan=='J_0002' || $user->jabatan=='J_0008' || $user->jabatan=='J_0007'){

  ?>
  <div class="col-sm-3">
    <a href="<?php echo base_url('registrasi_pelayanan'); ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/give-money.png"></div>
        <div class="col-xs-9"><h3>Registrasi Pelayanan</h3></div>
      </div>
    </a>
  </div>
  <!--<div class="col-sm-3">
    <a href="<?php echo base_url('pendaftaran_layanan') ?>">
     <div class="button-menu" data-mh="button-menu">
      <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/coin-return.png"></div>
      <div class="col-xs-9"><h3>Pendaftaran Layanan Paket</h3></div>
    </div>
  </a>
</div>-->
<div class="clearfix"></div>

<?php
}

?>

<script type="text/javascript">
  $(document).ready(function(){
    reloader_jasa();
    pembayaran_pajak();
    reloader_penyusutan();
    setInterval(function(){
      reloader_jasa();
      reloader_penyusutan();
      pembayaran_pajak();
    },5000);
  })

  
</script>