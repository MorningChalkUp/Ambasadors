<?php
  require '../inc/functions.php';

  $ip = get_client_ip();

  $url = $domain . strtok($_SERVER['REQUEST_URI'], '?');

  $time = date("Y-m-d H:i:s");

  $reff = isset($_GET['reff']) ? $_GET['reff'] : null;
  
  track_pageview($ip,$url,$time,$reff);

  if (isset($_GET['e'])) {
    $error = $_GET['e'];
  }

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
    <link type="icon" href="<?php echo $domain; ?>/img/favicon.png"  media="screen,projection"/>
    
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
          
          <span class="mdl-layout-title">
            <a id="logo" href="/"><?php echo file_get_contents('../img/mcu.svg') ?></a>
          </span>
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            <a class="mdl-navigation__link" href="https://morningchalkup.com/category/stories/" title="Stories">Stories</a>
            <a class="mdl-navigation__link" href="https://morningchalkup.com/category/community/" title="Community">Community</a>
            <a class="mdl-navigation__link" href="https://morningchalkup.com/category/tips/" title="Tips">Tips</a>
            <a class="mdl-navigation__link" href="https://morningchalkup.com/category/morningchalkup/" title="Daily Email">Daily Email</a>
            <a class="mdl-navigation__link" href="https://morningchalkup.com/about/" title="About">About</a>
          </nav>
          <div class="mdl-layout-spacer"></div>
          <!-- <div class="right sub">
            <a href="https://morningchalkup.com/subscribe">
              <i class="mdi mdi-email"></i> <span class="mdl-layout--large-screen-only">Subscribe</span>
            </a>
          </div> -->
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
            <section class="hero" style="background-image: url(https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/about-bg.png);">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <div class="mdl-cell mdl-cell--10-col form" style="padding: 25px 0px;">
                    <div class="mdl-grid">
                      
                      <div class="mdl-layout-spacer"></div>

                      <div class="mdl-cell mdl-cell--10-col headline">
                        <img src="https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/chalkup.png" alt="Morning Chalk Up" style="max-width: 370px;width: 100%;display: block;margin: 0 auto 10px auto;">
                        The Morning Chalk Up is the daily newsletter for people who do CrossFit<sup style="font-size: small;">&reg;</sup>. Get the email that athletes, insiders and fans are reading every morning.
                      </div>

                      <div class="mdl-layout-spacer"></div>
                    </div>
                    <?php if (isset($error)): ?>
                    <div class="mdl-grid">
                      
                      <div class="mdl-layout-spacer"></div>

                      <div class="mdl-cell mdl-cell--6-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                        <p><strong>The below fields are required:</strong></p>
                        <?php
                          foreach ($error as $e => $v) {
                            switch ($e) {
                              case 'email':
                                echo 'Email<br>';
                                break;
                              case 'full-name':
                                echo 'Full Name<br>';
                                break;
                              case 'zip':
                                echo 'Zip Code Required<br>';
                                break;
                              case 'country':
                                echo 'Country<br>';
                                break;
                              case 'about':
                                echo 'Tell Us More About Youself<br>';
                                break;
                            }
                          }
                        ?>
                      </div>

                      <div class="mdl-layout-spacer"></div>
                    </div>
                    <?php endif; ?>
                    <form action="process.php" method="post">
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell mdl-cell--4-col">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="full-name" name="full-name">
                            <label class="mdl-textfield__label" for="full-name">Full Name *</label>
                          </div>
                        </div>

                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="email" name="email">
                            <label class="mdl-textfield__label" for="email">Email *</label>
                          </div>
                        </div>

                        <div class="mdl-layout-spacer"></div>
                      </div>
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="zip" name="zip">
                            <label class="mdl-textfield__label" for="zip">Zip Code *</label>
                          </div>
                        </div>

                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                            <select class="mdl-selectfield__select" id="about" name="about">
                              <option value=""></option>
                              <option value="CrossFit Fan!">CrossFit Fan!</option>
                              <option value="Elite Athlete">Elite Athlete</option>
                              <option value="Box Owner/Coach">Box Owner/Coach</option>
                              <option value="Media">Media</option>
                              <option value="Vendor">Vendor</option>
                            </select>
                            <label class="mdl-selectfield__label" for="about">Tell Us More About Youself *</label>
                          </div>
                        </div>

                        <!-- <div class="mdl-select mdl-js-select mdl-select--floating-label">
                          <select class="mdl-select__input" id="about" name="about">
                            <option value=""></option>
                            <option value="CrossFit Fan!">CrossFit Fan!</option>
                            <option value="Elite Athlete">Elite Athlete</option>
                            <option value="Box Owner/Coach">Box Owner/Coach</option>
                            <option value="Media">Media</option>
                            <option value="Vendor">Vendor</option>
                          </select>
                          <label class="mdl-select__label" for="about">Tell Us More About Youself *</label>
                        </div> -->

                        <div class="mdl-layout-spacer"></div>
                      </div>
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          Subscribe to:
                          
                          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="us">
                            <input type="checkbox" id="us" class="mdl-checkbox__input" name="us">
                            <span class="mdl-checkbox__label">Morning Chalk Up</span>
                          </label>
                          
                          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="eu">
                            <input type="checkbox" id="eu" class="mdl-checkbox__input" name="eu">
                            <span class="mdl-checkbox__label">Morning Chalk Up Europe</span>
                          </label>

                        </div>
                        
                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          &nbsp;
                        </div>
                        
                        <div class="mdl-layout-spacer"></div>
                      </div>
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>

                        <div class="hidden" style="display:none;">
                          <input type="hidden" name="URL" id="URL" value="">
                          <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="">
                          <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="">
                          <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="">
                          <input type="hidden" name="GCLID" id="GCLID" value="">
                          <input type="hidden" name="reff" id="reff" value="<?php echo $reff != null ? $reff : ''; ?>">
                        </div>

                        <div class="mdl-cell mdl-cell--4-col">
                          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit">
                            Subscribe
                          </button>
                        </div>

                        <div class="mdl-layout-spacer"></div>

                        <div class="mdl-cell mdl-cell--4-col">
                          &nbsp;
                        </div>
                        
                        <div class="mdl-layout-spacer"></div>
                      </div>
                    </form>
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
    <script src="/js/immybox/jquery.immybox.min.js"></script>
    <script src="/js/MaterialSelect.js"></script>
    <script src="/js/mdl-selectfield.min.js"></script>
    <script defer src="/js/init.js"></script>

  </body>
</html>