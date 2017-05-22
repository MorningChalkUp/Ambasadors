<?php
  $error = $_GET['e'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Morning Chalk Up Ambassador Program</title>

    <link rel="stylesheet" href="/css/material.min.css">
    <link rel="stylesheet" href="/css/getmdl-select.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <script src="https://use.typekit.net/ydo2tvd.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title"><a href="#"><span>Morning</span> Chalk Up</a></span>
          <div class="mdl-layout-spacer"></div>
        </div>
      </header>
      <main class="mdl-layout__content">
        <div class="page-content">
          <article class="main subscribe-page">
            <section class="hero" style="background-image: url(/img/about-bg.png);">
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col mdl-grid">
                  <div class="mdl-layout-spacer"></div>
                  <div class="mdl-cell mdl-cell--6-col form">
                    <div class="mdl-grid">
                      
                      <div class="mdl-layout-spacer"></div>

                      <div class="mdl-cell mdl-cell--10-col headline">
                        Ambassador Login
                      </div>

                      <div class="mdl-layout-spacer"></div>
                    </div>
                    <?php if (isset($error)): ?>
                      <div class="mdl-grid">
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell mdl-cell--10-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                          The email and password do not match our records.
                        </div>
                        <div class="mdl-layout-spacer"></div>
                      </div>
                      <?php endif; ?>
                    <form action="/inc/process/login.php" method="post">
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell mdl-cell--10-col">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="email" name="email">
                            <label class="mdl-textfield__label" for="email">Email *</label>
                          </div>
                        </div>
                        <div class="mdl-layout-spacer"></div>
                      </div>

                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell mdl-cell--10-col">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="password" id="password" name="password">
                            <label class="mdl-textfield__label" for="password">Password *</label>
                          </div>
                        </div>
                        <div class="mdl-layout-spacer"></div>
                      </div>
                      
                      <div class="mdl-grid fields">
                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-cell mdl-cell--10-col">
                          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                            <input type="checkbox" id="remember" name="remember" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">Remember Me</span>
                          </label>
                        </div>
                        <div class="mdl-layout-spacer"></div>
                      </div>
                      <div class="mdl-grid fields">
                        <div class="mdl-cell mdl-cell--1-col">&nbsp;</div>

                        <div class="hidden" style="display:none;">
                          <input type="hidden" name="URL" id="URL" value="">
                          <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="">
                          <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="">
                          <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="">
                          <input type="hidden" name="GCLID" id="GCLID" value="">
                        </div>

                        <div class="mdl-cell mdl-cell--10-col">
                          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                            Login
                          </button>
                        </div>
                        
                        <div class="mdl-cell mdl-cell--1-col">&nbsp;</div>
                        
                        
                        <div class="mdl-cell mdl-cell--1-col">&nbsp;</div>
                        <div class="mdl-cell mdl-cell--10-col">
                          <div class="center">
                            <small><a href="forgot-password.php">Forgot Password</a></small>
                          </div>
                        </div>
                        <div class="mdl-cell mdl-cell--1-col">&nbsp;</div>
                      </div>
                    </form>
                  </div>
                  <div class="mdl-layout-spacer"></div>
                </div>
              </div>
            </section>
          </article>
        </div>
        <footer class="mdl-mini-footer">
          <div class="mdl-mini-footer__right-section">
            <ul class="mdl-mini-footer__link-list">
              <li>Connect With Us: </li>
              <li><a href="#"><i class="mdi mdi-youtube-play"></i></a></li>
              <li><a href="#"><i class="mdi mdi-instagram"></i></a></li>
              <li><a href="#"><i class="mdi mdi-facebook-box"></i></a></li>
            </ul>
          </div>
        </footer>
      </main>
    </div>


    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/material.min.js"></script>
    <script defer src="js/getmdl-select.min.js"></script>
    <script src="js/init.js"></script>
  </body>
</html>