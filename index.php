<?php
  require 'inc/functions.php';

  redirectIfLoggedOut('/login/');
  redirectIfLoggedIn('/dashboard/');


  $error = $_GET['e'];
?>

<?php include 'templates/header.php'; ?>
          
<article class="main subscribe-page">
  <section class="hero" style="background-image: url(/img/about-bg.png);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-cell mdl-cell--10-col form">
          <div class="mdl-grid">
            
            <div class="mdl-layout-spacer"></div>

            <div class="mdl-cell mdl-cell--10-col headline">
              <img src="/img/chalkup.png" alt="Morning Chalk Up Europe" style="max-width: 370px;width: 100%;display: block;margin: 0 auto 10px auto;">
              Welcome to The Morning Chalk Up Ambassador Program
            </div>

            <div class="mdl-layout-spacer"></div>
          </div>
          <div class="mdl-grid">
            
            <div class="mdl-layout-spacer"></div>

            <div class="mdl-cell mdl-cell--10-col">
              <center>
                <a href="/join/">Sign Up</a>
              </center>
              <center>
                <a href="/login/">Log In</a>
              </center>
              <center>
                <a href="/dashboard/">Dashboard</a>
              </center>
            </div>

            <div class="mdl-layout-spacer"></div>
          </div>
        </div>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>
  </section>
</article>

<?php include 'templates/footer.php'; ?>