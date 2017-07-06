<?php
  require '../inc/functions.php';

  $page_name = 'Reset';
  $token = $_GET['token'];
  $e = $_GET['e'];
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
                  Reset Your Password
                </div>
              </div>

              <?php if (isset($e)): ?>
                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--12-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                    <?php 
                      if ($e == 'password') {
                        echo 'The passwords do not match.';
                      } else if ($e == 'expired') {
                        echo 'Your token has expired. You can request a new link <a href="/forgot/">here</a>.';
                      } else if ($e == 'empty') {
                        echo 'Please enter a password.';
                      }
                    ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="mdl-grid fields">
                <form style="width: 100%" action="process.php" method="post">
                  
                  <?php include '../templates/hidden-fields.php'; ?>

                  <input type="hidden" name="token" value="<?php echo $token ?>">

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="password" id="password" name="password">
                      <label class="mdl-textfield__label" for="password">Password *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="password" id="confirmpassword" name="confirmpassword">
                      <label class="mdl-textfield__label" for="confirmpassword"> Confirm Password *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                      Confirm
                    </button>
                  </div>

                </form>

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