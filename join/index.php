<?php
  $page_name = 'Sign Up';
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
            <div class="mdl-cell mdl-cell--8-col">
              
              <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--12-col headline">
                  Become A Morning Chalk Up Ambassador
                </div>
              </div>

              <?php if (isset($error)): ?>
                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--12-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                    <?php if ($error['email-exists']): ?>
                      <p><strong>That Email Is Already Suigned Up</strong></p>
                    <?php endif ?>
                    <?php if ($error['no-match']): ?>
                      <p><strong>Your Passwords Do Not Match</strong></p>
                    <?php endif ?>
                    <?php if ($error['username-exists']): ?>
                      <p><strong>That Username Is Taken, Plese Try Another</strong></p>
                    <?php endif ?>
                    <?php if ($error['full-name'] || $error['email'] || $error['password'] || $error['conf-password'] ||  $error['username']): ?>
                      <p><strong>The below fields are required:</strong></p>
                      <?php
                        foreach ($error as $e => $v) {
                          switch ($e) {
                            case 'full-name':
                              echo 'Full Name<br>';
                              break;
                            case 'email':
                              echo 'Email<br>';
                              break;
                            case 'password':
                              echo 'Password<br>';
                              break;
                            case 'conf-password':
                              echo 'Confirm Password<br>';
                              break;
                            case 'username':
                              echo 'Username<br>';
                              break;
                          }
                        }
                      ?>
                    <?php endif ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="mdl-grid fields">
                <form style="width: 100%" action="process.php" method="post">
                  
                  <?php include '../templates/hidden-fields.php'; ?>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="full-name" name="full-name">
                      <label class="mdl-textfield__label" for="full-name">Full Name *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                      <input class="mdl-textfield__input" type="text" id="email" name="email">
                      <label class="mdl-textfield__label" for="email">Email *</label>
                    </div>
                  </div>

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
                      <input class="mdl-textfield__input" type="password" id="conf-password" name="conf-password">
                      <label class="mdl-textfield__label" for="conf-password">Confirm Password *</label>
                    </div>
                  </div>

                  <div class="mdl-cell mdl-cell--12-col">
                    <button style="width: 100%" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit">
                      Sign Up
                    </button>
                  </div>


                </form>

                <div class="mdl-cell mdl-cell--12-col">
                  <div class="center">
                    <small>Have An Account? <a href="/login/">Login</a></small>
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