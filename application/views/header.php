<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php print_r($title); ?>
  <!-- Favicons -->
<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url();?>/assets/cronaicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url();?>/assets/cronaicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url();?>/assets/cronaicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url();?>/assets/cronaicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url();?>/assets/cronaicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url();?>/assets/cronaicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url();?>/assets/cronaicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url();?>/assets/cronaicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>/assets/cronaicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url();?>/assets/cronaicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url();?>/assets/cronaicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url();?>/assets/cronaicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>/assets/cronaicons/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
  <!-- Bootstrap core CSS -->
  <link href="<?=base_url();?>/assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?=base_url();?>/assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>/assets/lib/gritter/css/jquery.gritter.css" />
  <!-- Custom styles for this template -->
  <link href="<?=base_url();?>/assets/css/style.css" rel="stylesheet">
  <link href="<?=base_url();?>/assets/css/style-responsive.css" rel="stylesheet">
  <script src="<?=base_url();?>/assets/lib/chart-master/Chart.js"></script>
</head>
<body>
  <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
  <a href="<?=base_url();?>" class="logo"><b>COVID<span>19</span> Live Tracker</b></a>
<marquee direction="left" style="color: white;">
<?php print_r($country_data->help_status);?>
</marquee>
    </header>

    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
         
          <li class="mt">
            <a class="active" href="<?=base_url();?>">
              <i class="fa fa-dashboard"></i>
              <span>Home</span>
              </a>
          </li>  
<?php
$country_list=$this->admin_model->moneselectresult('country_list','status',1);
foreach ($country_list as $cl) {
?>
        <li class="sub-menu">
            <a href="<?=base_url();?>livedata/<?=$cl->country_id;?>/<?php 
$clp='COVID-19 CONFIRMED CASES IN '.preg_replace('/[^A-Za-z0-9\-]/', '', $cl->country_name);
            print str_replace(' ', '%20', $clp);?>">
              <i class="fa fa-th"></i>
              <span><?=$cl->country_name;?></span>
              <span class="label label-theme pull-right mail-info"><?=$cl->total_case;?></span>
              </a>
          </li>
<?php } ?>

          </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>