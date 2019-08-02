<input type="date" id="jasa_terakhir" value="" style="display: none">
<input type="date" id="tanggal_hari_ini" value="<?php echo date('Y-m-d') ?>" style="display: none">
<div class="container">
   <?php
 $user=$this->session->userdata('astrosession');
 if($user->jabatan=='J_0006'){
  ?>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'setting'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Setting</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'supplier'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/payment-method.png"></div>
        <div class="col-xs-9"><h3>Supplier</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'pembelian'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Pembelian</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'retur'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/payment-method.png"></div>
        <div class="col-xs-9"><h3>Retur</h3></div>
      </div>
    </a>
  </div>
  <div class="clearfix"></div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'stok_persediaan'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Stok Persediaan</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'stok_out' ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/coin-return.png"></div>
        <div class="col-xs-9"><h3>Stok Out</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'adjust_stok'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/payment-method.png"></div>
        <div class="col-xs-9"><h3>Adjust Stok</h3></div>
      </div>
    </a>
  </div>
  <div class="col-sm-3">
    <a href="<?php echo base_url().'stok_minimal'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/give-money.png"></div>
        <div class="col-xs-9"><h3>Stok Minimal</h3></div>
      </div>
    </a>
  </div>
  <div class="clearfix"></div>


<?php
}elseif ($user->jabatan=='J_0004') {

?>
<div class="col-sm-3">
    <a href="<?php echo base_url().'stok_persediaan'; ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/gear.png"></div>
        <div class="col-xs-9"><h3>Stok Persediaan</h3></div>
      </div>
    </a>
  </div>

  <div class="col-sm-3">
    <a href="<?php echo base_url().'stok_out' ?>">
      <div class="button-menu" data-mh="button-menu">
        <div class="col-xs-3"><img class="pull-left" src="<?php echo base_url(); ?>assets/images/icon/coin-return.png"></div>
        <div class="col-xs-9"><h3>Stok Out</h3></div>
      </div>
    </a>
  </div>
  <?php } ?>

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