<?php
  $error = $_GET['e'];

  $domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?>

<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" class="no-js">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="ambassadors" content="true">
    <link rel="canonical" href="https://morningchalkup.com/subscribe/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Subscribe | Morning Chalk Up" />
    <meta property="og:url" content="https://morningchalkup.com/subscribe/" />
    <meta property="og:site_name" content="Morning Chalk Up" />
    <meta property="article:publisher" content="https://www.facebook.com/MorningChalkUp/" />
    <meta property="fb:app_id" content="1635216993444923" />
    <meta property="og:image" content="http://morningchalkup.com/wp-content/uploads/2017/01/fb_og.png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Subscribe | Morning Chalk Up" />
    <meta name="twitter:image" content="http://morningchalkup.com/wp-content/uploads/2017/01/fb_og.png" />

    <link rel="shortcut icon" href="<?php echo $domain; ?>/img/favicon.png" type="image/x-icon">
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="stylesheet" href="/css/material.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="/js/immybox/immybox.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/css/getmdl-select.min.css">
    <link rel="stylesheet" href="/css/mdl-selectfield.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,500,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    
    <script src="/js/jquery-2.2.3.min.js"></script>
    <script src="/js/immybox/jquery.immybox.js"></script>
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
      .mdl-layout__content .page-content article.main.subscribe-page .hero {
        background-image: url(/img/about-bg.png);
      }
    </style>
  </head>
  <body>
    
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1635216993444923',
          xfbml      : true,
          version    : 'v2.6'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));

      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }
    </script>

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title"><a href="https://morningchalkup.com"><span>Morning</span> Chalk Up</a></span>
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" href="https://morningchalkup.com" title="Home">Home</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/tidbits/" title="Tidbits">Tidbits</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/stories/" title="Stories">Stories</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/morningchalkup/" title="the Morning Chalk Up">the Morning Chalk Up</a><a class="mdl-navigation__link" href="/events" title="Events">Events</a><a class="mdl-navigation__link" href="https://morningchalkup.com/about/" title="About">About</a>    </nav>
          <div class="mdl-layout-spacer"></div>
          <div class="right sub">
            <a href="https://morningchalkup.com/subscribe">
              <i class="mdi mdi-email"></i> <span class="mdl-layout--large-screen-only">Subscribe</span>
            </a>
          </div>
          <div class="right search">
            <a class="search-btn">
              <i class="mdi mdi-magnify"></i>
              <i class="mdi mdi-close"></i>
            </a>
          </div>
        </div>
        <div class="mdl-layout__header-row search-bar">
          <form action="https://morningchalkup.com/search/" method="get">
            <i class="mdi mdi-magnify"></i>
            <input type="text" name="keyword" placeholder="Search ...">
            <button class="mdl-btn" type="submit">Search</button>
          </form>
        </div>
      </header>
      <div class="mdl-layout__drawer mdl-layout--small-screen-only">
        <span class="mdl-layout-title"><a href="/"><span>Morning</span> Chalk Up</a></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="/" title="Home">Home</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/tidbits/" title="Tidbits">Tidbits</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/stories/" title="Stories">Stories</a><a class="mdl-navigation__link" href="https://morningchalkup.com/category/morningchalkup/" title="the Morning Chalk Up">the Morning Chalk Up</a><a class="mdl-navigation__link" href="/events" title="Events">Events</a><a class="mdl-navigation__link" href="https://morningchalkup.com/about/" title="About">About</a>  </nav>
      </div>

      <main class="mdl-layout__content">
        <div class="page-content">
          <article class="main subscribe-page">
            <section class="hero">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <div class="mdl-cell mdl-cell--10-col form thank-you mdl-color--white mdl-shadow--2dp">
                    <div class="mdl-grid">
                      <div class="mdl-layout-spacer"></div>
                      <div class="mdl-cell mdl-cell--8-col headline">
                        <h1>
                          <i class="mdi mdi-email"></i>
                          <?php 
                            if (isset($name)) {
                              echo 'Thank you ' . $name . '. You are now subscribed.';
                            } else {
                              echo 'Thank you. You are now subscribed.';
                            }
                          ?>
                        </h1>
                        <div class="like">
                          Like us on Facebook
                        </div>
                        <div class="fb-like" data-href="https://www.facebook.com/MorningChalkUp/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
                      </div>
                      <div class="mdl-layout-spacer"></div>
                    </div>
                  </div>
                  <div class="mdl-layout-spacer"></div>
                </div>
              </div>
            </section>
          </article>

        <footer class="mdl-mini-footer">
          <div class="mdl-mini-footer__left-section">
            <ul class="mdl-mini-footer__link-list">
              <li><a class="mdl-navigation__link" href="/" title="Home">Home</a></li><li><a class="mdl-navigation__link" href="https://morningchalkup.com/category/tidbits/" title="Tidbits">Tidbits</a></li><li><a class="mdl-navigation__link" href="https://morningchalkup.com/category/stories/" title="Stories">Stories</a></li><li><a class="mdl-navigation__link" href="https://morningchalkup.com/category/morningchalkup/" title="the Morning Chalk Up">the Morning Chalk Up</a></li><li><a class="mdl-navigation__link" href="/events" title="Events">Events</a></li><li><a class="mdl-navigation__link" href="https://morningchalkup.com/about/" title="About">About</a></li>
            </ul>
          </div>
          <div class="mdl-mini-footer__right-section">
            <ul class="mdl-mini-footer__link-list">
              <li>Connect With Us: </li>
              <li><a target="_blank" title="YouTube" href="https://www.youtube.com/channel/UCaVuIEkcQkaLKCUfWF2-Nqg"><i class="mdi mdi-youtube-play"></i></a></li>
              <li><a target="_blank" title="Instagram" href="https://www.instagram.com/morningchalkup/"><i class="mdi mdi-instagram"></i></a></li>
              <li><a target="_blank" title="Facebook" href="https://www.facebook.com/MorningChalkUp/"><i class="mdi mdi-facebook-box"></i></a></li>
            </ul>
          </div>
        </footer>
      </main>

    </div>
      
    <div class="overlay"></div>

    <script src="/js/material.min.js"></script>
    <script src="/js/getmdl-select.min.js"></script>
    <script src="/js/jquery.textfit.min.js"></script>
    <script src="/js/MaterialSelect.js"></script>
    <script src="/js/mdl-selectfield.min.js"></script>
    <script src="/js/init.js"></script>

  </body>
</html>