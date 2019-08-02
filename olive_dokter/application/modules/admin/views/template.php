<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
  <link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
  <meta name="author" content="SINDEVO.COM" />
  <meta name="description" content="biotic - mobile and tablet web app template" />
  <meta name="keywords" content="mobile css template, mobile html template, jquery mobile template, mobile app template, html5 mobile design, mobile design" />
  <title>RESTO - Gudang</title>
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,900' rel='stylesheet' type='text/css'>
  <script src="<?php echo base_url() . 'template/js/jquery.min.js' ?>"></script> 
  <link rel="stylesheet" href="<?php echo base_url() . 'template/css/themes/default/jquery.mobile-1.4.5.css' ?>">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'template/style.css' ?>">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'template/css/colors/yellow.css' ?>">
  <link type="text/css" rel="stylesheet" href="<?php echo base_url() . 'template/css/swipebox.css' ?>">
  <link href="<?php echo base_url() . 'component/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css '?> " rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'template/css/AdminLTE.min.css' ?>">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>




  
</head>
<body style="background-color: rgb(93, 88, 88)">
  <div class="tunggu" style="z-index:9999999999999999; background:rgba(51, 50, 50, 0.8); width:100%; height:100%; position:fixed; top:0; left:0; text-align:center; padding-top:25%; display: none;" >
    <img src="<?php echo base_url() . '/public/images/loading1.gif' ?>" style="width:72px; height: 72px;"/>
  </div>
  <<style type="text/css" media="screen">
      #homepage .ui-panel-wrapper {
        background-color:rgb(93, 88, 88) !important;
      }
  </style>
  <div data-role="page" id="homepage" data-theme="b" style="background-color:  rgb(93, 88, 88);">
   <!--  <div data-role="header" data-position="fixed" role="banner" class="ui-header ui-bar-inherit ui-header-fixed slidedown ui-panel-fixed-toolbar ui-panel-animate ui-panel-page-content-position-left ui-panel-page-content-display-reveal ui-panel-page-content-open">
      <div class="nav_left_button"><a href="#" class="nav-toggle ui-link navtoggleon"><span></span></a></div>
      <div class="nav_center_logo">Kasir</div>
     
      <div class="clear"></div>
    </div> -->
     <div role="main" class="ui-content" style="padding: 40px;margin-left: 70px;background-color:  rgb(93, 88, 88);">


      <div style="border-top: 3px solid white; background-color: #fbd921;padding: 10px;margin-right: 110px;margin-bottom: 350px;
      padding-bottom: 10px;">
      <h3 style="color: rgb(0, 0, 0)">Point Of Sale</h3>
      <p style="margin:0px;color: rgb(0, 0, 0)"><?php echo date('d-m-Y'); ?></p>
      <p style="color:rgb(0, 0, 0);background-color: rgb(0,0,0);"><div id="clock"></div></p>
      <hr style="border-color: black !important;">
      
      <!-- <?php 
      $get_sift = $this->db->get("setting_kasir");
      $hasil_sift = $get_sift->row();
      $jam = $hasil_sift->shif2;


      $get_saldo = $this->db->query("SELECT SUM(grand_total) as total from transaksi_penjualan where jam_penjualan <= '$jam' ");
      $hasil_saldo = $get_saldo->row();
      $pagi =  format_rupiah($hasil_saldo->total);

      $get_saldo_sift2 = $this->db->query("SELECT SUM(grand_total) as total from transaksi_penjualan where jam_penjualan >= '$jam' ");
      $hasil_saldo_sift2 = $get_saldo_sift2->row();
      $siang =  format_rupiah($hasil_saldo_sift2->total);
      ?>
      <h1>Shift 1</h1>
      <p>Nama Kasir :</p>
      <p style="font-weight: bold;font-size: 2em;">Omset      : <?php echo $pagi; ?></p><br> -->
      <!--  <div id="omset" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->
      <?php 
      // $hari =  date('Y-m-d'); 
      // $this->db->group_by('kode_penjualan');
      // $get_saldo = $this->db->query("SELECT SUM(grand_total) as total from transaksi_penjualan where tanggal_penjualan = '$hari'  ");
      // $hasil_saldo = $get_saldo->row();
      // $hasil =  format_rupiah($hasil_saldo->total);
      $this->db->where('tanggal_penjualan',date('Y-m-d')) ;
                 $this->db->order_by('kode_penjualan','desc');
                 $this->db->group_by('kode_penjualan');
                 $penjualan = $this->db->get('transaksi_penjualan');
                  $hasil_penjualan = $penjualan->result();
                  $keuangan = 0;
                  
                  foreach($hasil_penjualan as $total){
                    $keuangan += $total->grand_total;
                  }
      ?>

      <h1>Total Omset</h1>
      <p style="font-weight: bold;font-size: 2em;">Omset      : <?php echo format_rupiah($keuangan); ?></p><br>
      
      <!-- /.box-body -->



      <!-- <h1>Shift 2</h1>
      <p>Nama Kasir :</p>
      <p style="font-weight: bold;font-size: 2em;">Omset      : <?php echo $siang; ?> </p><br> -->
      <!-- <div id="omset2" style="min-width: 310px; height: 400px; margin: 0 auto"></div> -->




      <!-- <br><br>
      <?php 
      $hari = date('Y m d');
      $get_saldo = $this->db->query("SELECT SUM(grand_total) as total from transaksi_penjualan where tanggal_penjualan = '$hari' ");
      $hasil_saldo = $get_saldo->row();
      $hasil =  format_rupiah($hasil_saldo->total);
      ?>
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3 class="text-center"><?php echo $hasil; ?></h3>

          <p class="text-center">Total Omset</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>

      </div> -->


    </div>
  </div><!-- /content -->
  <?php
  $user = $this->session->userdata('astrosession');
  $jabatan = $user->jabatan;
  ?>
  <?php echo $user->uname; ?>
  <div data-role="panel" id="left-panel" data-display="reveal" data-position="left" style="background-color:#fbd921">

    <nav class="main-nav" >
      <ul>
       <?php
       $get_jabatan = $this->db->get_where('master_jabatan',array('kode_jabatan'=>$jabatan));
       $hasil_jabatan = $get_jabatan->row();
       $kode_jabatan = $hasil_jabatan->kode_jabatan;
       $modul = explode("|",$hasil_jabatan->modul);
       ?>
        <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
          <a style="color: white;font-weight: bold;" id="das" data-transition="slidefade">
            <img src="<?php echo base_url().'template/images/icons/white/home.png' ?>" alt="" title="" /><span>Dashboard</span></a>
          </li>
          
          <!-- <?php if (in_array("Master",$modul) OR $kode_jabatan=='1003' OR $kode_jabatan=='102'){ ?>
             <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
            <a style="color: white;font-weight: bold;" id="master" data-transition="slidefade">
              <img src="<?php echo base_url().'template/images/icons/white/settings.png' ?>" alt="" title="" /><span>Master</span></a>
            </li>
            <?php } ?> -->

            <!--<?php if (in_array("Repack",$modul) OR $kode_jabatan=='1003' OR $kode_jabatan=='102'){ ?>
            <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
            <a style="color: white;font-weight: bold;" id="repack" data-transition="slidefade">
              <img src="<?php echo base_url().'template/images/icons/white/settings.png' ?>" alt="" title="" /><span>Repack</span></a>
            </li>
            <?php } ?>-->
            
            <!-- <?php if (in_array("Pembelian",$modul) OR $kode_jabatan=='1003' OR $kode_jabatan=='102'){ ?>
            <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
            <a style="color: white;font-weight: bold;" id="pembelian" data-transition="slidefade">
              <img src="<?php echo base_url().'template/images/icons/white/settings.png' ?>" alt="" title="" /><span>Pembelian</span></a>
            </li>
            <?php } ?>
             -->
            <?php if (in_array("Stock",$modul) OR $kode_jabatan=='1003' OR $kode_jabatan=='102'){ ?>
             <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
            <a style="color: white;font-weight: bold;" id="stock" data-transition="slidefade">
              <img src="<?php echo base_url().'template/images/icons/white/settings.png' ?>" alt="" title="" /><span>Stock</span></a>
            </li>
            <?php } ?>

            <?php if (in_array("Laporan",$modul) OR $kode_jabatan=='1003' OR $kode_jabatan=='102'){ ?>
            <li style="background-color: rgb(0, 0, 0);cursor: pointer;" class="hoveren">
            <a style="color: white;font-weight: bold;" id="laporan" data-transition="slidefade">
              <img src="<?php echo base_url().'template/images/icons/white/settings.png' ?>" alt="" title="" /><span>Laporan</span></a>
            </li>
            <?php } ?>

                    <li style="background-color: rgb(0, 0, 0);cursor:pointer;" class="hoveren">
                      <a style="color: white;font-weight: bold;" style="text-decoration: none;" id="logout" data-transition="slidefade">
                        <img src="<?php echo base_url().'template/images/icons/white/lock.png' ?>" alt="" title="" /><span>Logout</span></a>
                      </li>
                      

                          </ul>
                        </nav> 

                      </div><!-- /panel -->

         <!--  <div data-role="panel" id="right-panel" data-display="reveal" data-position="right">

            <div class="user_login_info">

              <div class="user_thumb_container">
                <img src="images/profile.jpg" alt="" title="" /> 
                <div class="user_thumb">
                  <img src="images/author.jpg" alt="" title="" />     
                </div>  
              </div>

              <div class="user_details">
                <p>Sarah Williams</p>
                <ul class="user_social">
                  <li><a href="social.html"><img src="images/icons/white/twitter.png" alt="" title="" /></a></li>
                  <li><a href="social.html"><img src="images/icons/white/facebook.png" alt="" title="" /></a></li> 
                  <li><a href="social.html"><img src="images/icons/white/dribbble.png" alt="" title="" /></a></li>               
                </ul> 
              </div>  


              <nav class="user-nav">
                <ul>
                  <li><a href="features.html"><img src="images/icons/white/settings.png" alt="" title="" /><span>Settings</span></a></li>
                  <li><a href="features.html"><img src="images/icons/white/briefcase.png" alt="" title="" /><span>Account</span></a></li>
                  <li><a href="features.html"><img src="images/icons/white/message.png" alt="" title="" /><span>Messages</span><strong class="yellow">12</strong></a></li>
                  <li><a href="features.html"><img src="images/icons/white/download.png" alt="" title="" /><span>Downloads</span><strong class="yellow">5</strong></a></li>
                  <li><a href="index.html"><img src="images/icons/white/lock.png" alt="" title="" /><span>Logout</span></a></li>
                </ul>
              </nav>
            </div>
            <div class="close_loginpopup_button"><a href="#" data-rel="close"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>

  </div> --><!-- /panel

</div><!-- /page -->

<script src="<?php echo base_url() . 'template/js/jquery.mobile-1.4.5.min.js' ?>"></script>
<script src="<?php echo base_url() . 'template/js/jquery.validate.min.js' ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() . 'template/js/email.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'template/js/jquery.swipebox.js' ?>"></script>
<script src="<?php echo base_url() . 'template/js/jquery.mobile-custom.js' ?>"></script>
<style type="text/css" media="screen">
.hoveren{

}
.hoveren:hover
{
  transition: all 200ms ease-in;
  box-shadow: 2px 3px 5px #6f6f6f;
  transform: scale(1.2);
}



/* Let's get this party started */
::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
  -webkit-border-radius: 10px;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  -webkit-border-radius: 10px;
  border-radius: 10px;
  background: black; 
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
  background: black; 
}
</style>
<script>
$(function () {
  $('#omset').highcharts({
    chart: {
      backgroundColor: '#deffda'
    },
    title: {
      text: 'Grafik Omset Kasir',
            x: -20 //center
          },
          subtitle: {
            text: 'Sift 1',
            x: -20
          },  
          xAxis: {
            categories: [
            <?php 
            $omset = $this->db->query("SELECT tanggal FROM transaksi_kasir");
            $get_tanggal = $omset->result();
            foreach($get_tanggal as $tgl){
             $t = $tgl->tanggal;

             echo '"'.TanggalIndo($t).'"'.",";
           } 
           ?>


           ]
         },
         yAxis: {
          title: {
            text: 'Jumlah Omset'
          },
          plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
          }]
        },
        tooltip: {
          valueSuffix: ''
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          borderWidth: 0
        },
        series: [{
          name: 'Omset',
          data: [
          <?php 
          $omset = $this->db->query("SELECT saldo_awal FROM transaksi_kasir");
          $get_saldo = $omset->result();
          foreach($get_saldo as $jml){

            echo $jml->saldo_awal.",";
          } 
          ?>
          ]
        },]
      });

$('#omset2').highcharts({
  chart: {
    backgroundColor: '#FFFFFF'
  },
  title: {
    text: 'Grafik Omset Kasir',
            x: -20 //center
          },
          subtitle: {
            text: 'Sift 2',
            x: -20
          },
          xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

          },
          xAxis: {
            alternateGridColor: '#FFFFFF',
          },
          yAxis: {
            alternateGridColor: '#FDFFD5',
            title: {
              text: 'Jumlah Omset'
            },
            plotLines: [{
              value: 0,
              width: 1,
              color: '#FFFFFF'
            }]
          },
          tooltip: {
            valueSuffix: 'Rp'
          },
          legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
          },
          series: [{
            name: 'Omset',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
          },]
        });
});
</script>
<script>
$('#logout').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url() . 'admin/logout' ?>";
});

$('#stock').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'stock' ?>";
});

$('#das').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'admin' ?>";
});

$('#master').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'master/daftar' ?>";
});

$('#repack').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'perintah_repack/daftar_repack' ?>";
});

$('#pembelian').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'pembelian/daftar_pembelian' ?>";
});

$('#kasir').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'kasir' ?>";
});

$('#transaksi').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'kasir/dft_transaksi_kasir' ?>";
});

$('#laporan').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'laporan/menu_laporan' ?>";
});

$('#ewallet').click(function(){
  $('.tunggu').show();
  window.location = "<?php echo base_url().'ewallet/' ?>";
});

function startTime() {
  var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var date = new Date();
  var hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  var hari_ini = date.getDay();
  var day = date.getDate();
  var month = date.getMonth();
  var yy = date.getYear();
  var year = (yy < 1000) ? yy + 1900 : yy;
              //document.write(day + " " + months[month] + " " + year);
              var today=new Date(),
              curr_hour=today.getHours(),
              curr_min=today.getMinutes(),
              curr_sec=today.getSeconds();
              curr_hour=checkTime(curr_hour);
              curr_min=checkTime(curr_min);
              curr_sec=checkTime(curr_sec);
              document.getElementById('clock').innerHTML=hari[hari_ini];
            }
            function checkTime(i) {
              if (i<10) {
                i="0" + i;
              }
              return i;
            }
            setInterval(startTime, 500);
            </script>
          </body>
          </html>
