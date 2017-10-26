<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
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
    <script>
      $( function() {
        var full_img_top = $('#full-img').position().top;
        var full_img_left = $('#full-img').position().left;

        $('#crop').css("top", full_img_top + 50).css("left", full_img_left + 50);
        $("#crop").draggable({containment: "parent"}).resizable();
    });
    </script>

    <style>
      #crop {
        border: 1px #ffffff dotted;
        width: 100px;
        height: 100px;
        position: absolute;
        background-color: rgba(225,225,225,0.5);
      }
    </style>

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5MZWLQK');</script>
    <!-- End Google Tag Manager -->
    <script src="/js/amb_base.js"></script>
    <style>
      h2 {
        font-size: 24px !important;
        font-weight: normal !important;
        color: #333132;
        margin: 24px 0 !important;
      }
    </style>

  </head>
  <body>
    <div id="full-img" style="max-width: 600px; width: 100%; margin: auto;">
      <img style="max-width: 600px; width: 100%; height: auto;" src="/img/uploads/raw/<?php echo $_GET['img'] ?>">
      <div id="crop"></div>
    </div>
  
  </body>
</html>