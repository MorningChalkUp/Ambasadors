<?php
  $page_name = 'Login';
  $error = $_GET['e'];
?>

<?php include '../templates/header.php'; ?>

<article class="main subscribe-page">
  <section class="hero" style="background-image: url(/img/about-bg.png);">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-cell mdl-cell--6-col form">
          <div class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-cell mdl-cell--8-col">
              
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col headline">
                  Ambassador Login
                </div>
              </div>

              <?php if (isset($error)): ?>
                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--12-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                    The username and password do not match our records.
                  </div>
                </div>
              <?php endif; ?>

              <div class="mdl-grid fields">
                <form style="width: 100%" action="process.php" method="post">
                  
                  <?php include '../templates/hidden-fields.php'; ?>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="username" name="username">
                      <label class="mdl-textfield__label" for="username">Username *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="password" id="password" name="password">
                      <label class="mdl-textfield__label" for="password">Password *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                        <input type="checkbox" id="remember" name="remember" class="mdl-checkbox__input">
                        <span class="mdl-checkbox__label">Remember Me</span>
                      </label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                  Login
                </button>
                  </div>


                </form>

                <div class="mdl-cell mdl-cell--12-col">
                  <div class="center">
                    <small><a href="/forgot/">Forgot Password</a> | <a href="/join/">Join the Team</a></small>
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