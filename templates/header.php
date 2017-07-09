<?php 
  $domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?php 
        if (isset($page_name)) {
          echo $page_name;
          echo ' | Morning Chalk Up Ambassadors';
        } else {
          echo 'Morning Chalk Up Ambassadors';
        }
      ?>
      
    </title>
    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
    <link type="icon" href="<?php echo $domain; ?>/img/favicon.png" />
    <link rel="stylesheet" href="/css/material.min.css">
    <link rel="stylesheet" href="/css/getmdl-select.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="/js/jquery-2.2.3.min.js"></script>
    <script defer src="/js/getmdl-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script src="/js/clipboard.min.js"></script>
    <script src="https://use.typekit.net/ydo2tvd.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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