<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>OLIVE ADMIN</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/plugins/font-awesome/css/font-awesome.min.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/plugins/bootstrap/css/bootstrap.min.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/plugins/uniform/css/uniform.default.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/admin/pages/css/login.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/css/components.css '?>" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/global/css/plugins.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/admin/layout/css/layout.css '?>" rel="stylesheet" type="text/css"/>
  <link href="<?php echo base_url() . 'component/admin/assets/admin/layout/css/themes/default.css '?>" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="<?php echo base_url() . 'component/admin/assets/admin/layout/css/custom.css '?>" rel="stylesheet" type="text/css"/>
  <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login" style="background: url(component/img/background.jpg)no-repeat center center fixed !important;
-webkit-background-size: cover !important;
-moz-background-size: cover !important;
-o-background-size: cover !important;
background-size: cover !important;">
<div class="menu-toggler sidebar-toggler">
</div>
<div class="content" style="background-color:white;margin-top:8%;">
  <form class="login-form" action="<?php echo base_url($this->cname).'/login'; ?>" method="post" >
    <h3 class="form-title">
      Login
      <!-- <img src="<?php echo base_url() . 'component/img/UQ.png  '?>" alt="" style="width:150px;height:auto;"/> -->
    </h3>
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button>
      <span>
        Enter any username and password. </span>
      </div>
      <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="login-email"/>
      </div>
      <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input onkeydown = "if (event.keyCode == 13) document.getElementById('btn_login').click()" class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="login-password"/>
      </div>
      <div class="form-actions">
        <button type="submit" id="btn_login" class="btn btn-block btn-success uppercase" style="background:#FCD01C;">Login</button>
      </div>
      <div class="create-account" style="background:#66B82F;color:white">
        <p>
          <a id="register-btn" class="uppercase" style="color:white">OLIVE KASIR</a>
        </p>
      </div>
    </form>
  </div>
  <div class="copyright" style="color:#fff">
   © Cloud - Astro 2017
 </div>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/jquery.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/jquery-migrate.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/bootstrap/js/bootstrap.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/jquery.blockui.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/uniform/jquery.uniform.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/jquery.cokie.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/plugins/jquery-validation/js/jquery.validate.min.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/global/scripts/metronic.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/admin/layout/scripts/layout.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/admin/layout/scripts/demo.js '?>" type="text/javascript"></script>
 <script src="<?php echo base_url() . 'component/admin/assets/admin/pages/scripts/login.js '?>" type="text/javascript"></script>
 <script>
 jQuery(document).ready(function() {     
  Metronic.init();
  Layout.init();
  Login.init();
  Demo.init();
});
 </script>
</body>
</html>