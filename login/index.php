<?php
  $page_name = 'Dashboard';
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

            <div class="mdl-cell mdl-cell--8-col headline">
              Ambassador Login
            </div>

            <div class="mdl-layout-spacer"></div>
          </div>
          <?php if (isset($error)): ?>
            <div class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--8-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                The username and password do not match our records.
              </div>
              <div class="mdl-layout-spacer"></div>
            </div>
            <?php endif; ?>
          <form action="process.php" method="post">
            <div class="mdl-grid fields">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--8-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="username" name="username">
                  <label class="mdl-textfield__label" for="username">Username *</label>
                </div>
              </div>
              <div class="mdl-layout-spacer"></div>
            </div>

            <div class="mdl-grid fields">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--8-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="password" id="password" name="password">
                  <label class="mdl-textfield__label" for="password">Password *</label>
                </div>
              </div>
              <div class="mdl-layout-spacer"></div>
            </div>
            
            <div class="mdl-grid fields">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--8-col">
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                  <input type="checkbox" id="remember" name="remember" class="mdl-checkbox__input">
                  <span class="mdl-checkbox__label">Remember Me</span>
                </label>
              </div>
              <div class="mdl-layout-spacer"></div>
            </div>
            <div class="mdl-grid fields">
              <div class="mdl-cell mdl-cell--2-col">&nbsp;</div>

              <div class="hidden" style="display:none;">
                <input type="hidden" name="URL" id="URL" value="">
                <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="">
                <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="">
                <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="">
                <input type="hidden" name="GCLID" id="GCLID" value="">
              </div>

              <div class="mdl-cell mdl-cell--8-col">
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit" style="width: 100%;">
                  Login
                </button>
              </div>
              
              <div class="mdl-cell mdl-cell--2-col">&nbsp;</div>
              
              
              <div class="mdl-cell mdl-cell--2-col">&nbsp;</div>
              <div class="mdl-cell mdl-cell--8-col">
                <div class="center">
                  <small><a href="forgot-password.php">Forgot Password</a></small>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--2-col">&nbsp;</div>
            </div>
          </form>
        </div>
        <div class="mdl-layout-spacer"></div>
      </div>
    </div>
  </section>
</article>
        
<?php include '../templates/footer.php'; ?>