<?php 
  $domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

  $current_page = $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (isset($page_name)) {
    $title = $page_name . ' | Morning Chalk Up Ambassadors';
  } else {
    $title = 'Morning Chalk Up Ambassadors';
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="ambassadors" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="We know you’ve already been spreading the word about the Morning Chalk Up with your CrossFit friends. Believe us when we say -- we appreciate it so much, and we never would have grown so big without your help. We built the Morning Chalk Up Ambassador program with you in mind, to reward your hard work and give you a little something extra when your friends subscribe.">
    <meta property="og:image" content="<?php echo $domain ?>/img/chalkupambassadorteam2.jpg">
    <meta property="og:url" content="<?php echo $current_page ?>">
    <meta name="twitter:card" content="summary_large_image">
    <title><?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
    <link type="icon" href="<?php echo $domain; ?>/img/favicon.png" />
    <link rel="stylesheet" href="/css/material.min.css">
    <link rel="stylesheet" href="/css/getmdl-select.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script defer src="/js/getmdl-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="https://use.typekit.net/ydo2tvd.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5MZWLQK');</script>
    <!-- End Google Tag Manager -->
    <style>
      h2 {
        font-size: 24px !important;
        font-weight: normal !important;
        color: #333132;
        margin: 24px 0 !important;
      }
    </style>
  </head>
  <body style="background-color: rgba(241, 242, 242, .4);">
    <?php include '../inc/fb.php'; ?>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <?php include 'nav.php'; ?>
      <main class="mdl-layout__content">
        <div class="page-content">