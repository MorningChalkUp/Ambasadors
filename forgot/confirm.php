<?php
  require '../inc/functions.php';

  $page_name = 'Confirm Password Reset';

  $email = $_GET['email'];

?>

<?php include '../templates/header.php'; ?>

<article class="main subscribe-page">
  <section class="hero" style="background-image: url(/img/chalkup_bg.jpg); background-position: top left; background-size: cover;">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-cell mdl-cell--6-col form">
          <div class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-cell mdl-cell--10-col">
              

              <div class="mdl-grid fields">
                
                <p>Check <?php echo isset($email) ? $email : 'your email' ?> for instructions to reset your password.</p>

                  <a href="/login/" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                    <- Return To Login
                  </a>

              </div>

            </div>
            <div class="mdl-layout-spacer"></div>
          </div>
        </div>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>
  </section>
</article>
        

<?php include '../templates/footer.php'; ?>''