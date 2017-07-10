<?php
  require '../inc/functions.php';

  $page_name = 'Password Reset';
  $error = $_GET['e'];
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
              
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col headline">
                  Forgot Your Password?
                </div>
                <div class="mdl-cell mdl-cell--12-col">
                  <small>Insert your email address or username below and we'll send you instructions on how to reset your password. </small>
                </div>
              </div>

              <div class="mdl-grid fields">
                <form style="width: 100%" action="process.php" method="post">
                  
                  <?php include '../templates/hidden-fields.php'; ?>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="username" name="username">
                      <label class="mdl-textfield__label" for="username">Username/Email</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                      Reset
                    </button>
                  </div>

                </form>

                <div class="mdl-cell mdl-cell--12-col">
                  <div class="center">
                    <small><a href="/login/">Return to login screen.</a></small>
                  </div>
                </div>
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
        

<?php include '../templates/footer.php'; ?>