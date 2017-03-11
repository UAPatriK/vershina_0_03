<!DOCTYPE html>
<html lang="en">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta name="google-site-verification" content="NH2MUeFmM62mb1LkHGXa__KHCnnfmf5IQdMA-fNXiQA" />
    <!-- Bootstrap core CSS -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Custom styles for this template -->
   <link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen">
<link rel="shortcut icon" href="/favicon.jpg" type="image/x-icon">
<!-- <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
 -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="<?php bloginfo('template_url'); ?>/js/ie-emulation-modes-warning.js"></script>
-->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
      <script src="<?php bloginfo('template_url'); ?>/js/jquery-cookie.js"></script>
      <script>
   $(window).load(function(){
        $('#myModal1').modal('show');
    });
</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>

  <body>
  
  <!-- <p class="bg-primary pd0">На сайте проводятся технические работы. Приносим извинения за временные неудобства</p> -->
<div class="navbar  navbar-vershina" role="navigation">

  <div class="navbar-inner">

    <div class="container-fluid">
 <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand_logo" href="/"><img src="<?php bloginfo('template_url'); ?>/images/vershina_logo.png" class="img-responsive"></a>
    </div>
 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php
        
        $args = array(
          'theme_location' => 'top-bar',
          'depth'    => 0,
          'container'  => false,
          'menu_class'   => 'nav navbar-nav navbar-right',
          'walker'   => new BootstrapNavMenuWalker()
        );
        wp_nav_menu($args);
      
      ?>
    </div>
  </div>
  </div>
</div>

 
     