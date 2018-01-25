<?php
  $page_name = 'Sign Up';
  $error = $_GET['e'];

  $url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : null;
  $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : null;
  $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : null;

  $reff = isset($_GET['reff']) ? $_GET['reff'] : null;
?>

<?php include '../templates/header.php'; ?>

<article class="main subscribe-page">
  <section class="hero" style="background-image: url(/img/chalkup_bg.jpg); background-position: top left; background-size: cover;">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-layout-spacer"></div>
        <div class="mdl-cell mdl-cell--8-col form">
          <div class="mdl-grid">
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-cell mdl-cell--10-col">
              
              <h2 class="headline">Become an Ambassador</h2>

              <p>The Morning Chalk Up is an email newsletter for people who treat CrossFit as a lifestyle. If you love the Morning Chalk Up as much as we do, then apply to join our Ambassador program and earn cool swag for spreading the word.</p>

              <?php if (isset($error)): ?>
                <div class="mdl-grid">

                  <div class="mdl-cell mdl-cell--12-col error" style="border-radius: 5px; border: 1px solid #ebccd1; padding: 5px; background: #f2dede; color: #a94442; text-align: center;">
                    <?php if ($error['email-exists']): ?>
                      <p><strong>That Email Is Already Suigned Up</strong></p>
                    <?php endif ?>
                    <?php if ($error['no-signup']): ?>
                      <p><strong>Sorry, but we have not opened signups to you yet</strong></p>
                    <?php endif ?>
                    <?php if ($error['no-match']): ?>
                      <p><strong>Your Passwords Do Not Match</strong></p>
                    <?php endif ?>
                    <?php if ($error['username-exists']): ?>
                      <p><strong>That Username Is Taken, Plese Try Another</strong></p>
                    <?php endif ?>
                    <?php if ($error['username-format']): ?>
                      <p><strong>Only Letters, Numbers, '-', And '_' are Valid Username Charicters</strong></p>
                    <?php endif ?>
                    <?php if ($error['full-name'] || $error['email'] || $error['password'] || $error['conf-password'] ||  $error['username']): ?>
                      <p><strong>The below fields are required:</strong></p>
                      <?php
                        foreach ($error as $e => $v) {
                          switch ($e) {
                            case 'full-name':
                              echo 'Name<br>';
                              break;
                            case 'first-name':
                              echo 'First Name<br>';
                              break;
                            case 'last-name':
                              echo 'Last Name<br>';
                              break;
                            case 'address':
                              echo 'Address<br>';
                              break;
                            case 'city':
                              echo 'City<br>';
                              break;
                            case 'state':
                              echo 'State<br>';
                              break;
                            case 'zip':
                              echo 'ZIP<br>';
                              break;
                            case 'email':
                              echo 'Email<br>';
                              break;
                            case 'username':
                              echo 'Username<br>';
                              break;
                            case 'password':
                              echo 'Password<br>';
                              break;
                            case 'conf-password':
                              echo 'Confirm Password<br>';
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
                  <div class="mdl-grid">
                    <!-- <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="full-name" name="full-name">
                        <label class="mdl-textfield__label" for="full-name">Full Name *</label>
                      </div>
                    </div> -->
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="first-name" name="first-name">
                        <label class="mdl-textfield__label" for="first-name">First Name *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="last-name" name="last-name">
                        <label class="mdl-textfield__label" for="last-name">Last Name *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="address" name="address">
                        <label class="mdl-textfield__label" for="address">Address *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--5-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="city" name="city">
                        <label class="mdl-textfield__label" for="city">City *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--3-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container" style="padding-bottom: 0px;">
                        <select class="mdl-textfield__input" id="state" name="state">
                          <option value="" selected=""></option>
                          <option value="AL">AL</option>
                          <option value="AK">AK</option>
                          <option value="AZ">AZ</option>
                          <option value="AR">AR</option>
                          <option value="CA">CA</option>
                          <option value="CO">CO</option>
                          <option value="CT">CT</option>
                          <option value="DE">DE</option>
                          <option value="FL">FL</option>
                          <option value="GA">GA</option>
                          <option value="HI">HI</option>
                          <option value="ID">ID</option>
                          <option value="IL">IL</option>
                          <option value="IN">IN</option>
                          <option value="IA">IA</option>
                          <option value="KS">KS</option>
                          <option value="KY">KY</option>
                          <option value="LA">LA</option>
                          <option value="ME">ME</option>
                          <option value="MD">MD</option>
                          <option value="MA">MA</option>
                          <option value="MI">MI</option>
                          <option value="MN">MN</option>
                          <option value="MS">MS</option>
                          <option value="MO">MO</option>
                          <option value="MT">MT</option>
                          <option value="NE">NE</option>
                          <option value="NV">NV</option>
                          <option value="NH">NH</option>
                          <option value="NJ">NJ</option>
                          <option value="NM">NM</option>
                          <option value="NY">NY</option>
                          <option value="NC">NC</option>
                          <option value="ND">ND</option>
                          <option value="OH">OH</option>
                          <option value="OK">OK</option>
                          <option value="OR">OR</option>
                          <option value="PA">PA</option>
                          <option value="RI">RI</option>
                          <option value="SC">SC</option>
                          <option value="SD">SD</option>
                          <option value="TN">TN</option>
                          <option value="TX">TX</option>
                          <option value="UT">UT</option>
                          <option value="VT">VT</option>
                          <option value="VA">VA</option>
                          <option value="WA">WA</option>
                          <option value="WV">WV</option>
                          <option value="WI">WI</option>
                          <option value="WY">WY</option>
                          <option value="AS">AS</option>
                          <option value="DC">DC</option>
                          <option value="FM">FM</option>
                          <option value="GU">GU</option>
                          <option value="MH">MH</option>
                          <option value="MP">MP</option>
                          <option value="PW">PW</option>
                          <option value="PR">PR</option>
                          <option value="VI">VI</option>
                          <option value="AA">AA</option>
                          <option value="AE">AE</option>
                          <option value="AP">AP</option>
                        </select>
                        
                        <label class="mdl-textfield__label" for="state">State *</label>
                        <i class="mdl-icon-toggle__label material-icons" style="top:15px;">keyboard_arrow_down</i>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="zip" name="zip">
                        <label class="mdl-textfield__label" for="zip">ZIP *</label>
                      </div>
                    </div>
                  </div>
                  

                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="email" name="email">
                        <label class="mdl-textfield__label" for="email">Email *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="username" name="username" pattern="^[a-zA-Z0-9_-]+">
                        <label class="mdl-textfield__label" for="username">Username *</label>
                        <span class="mdl-textfield__error">Please only use letters, numbers, - or _</span>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id="password" name="password">
                        <label class="mdl-textfield__label" for="password">Password *</label>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="password" id="conf-password" name="conf-password">
                        <label class="mdl-textfield__label" for="conf-password">Confirm Password *</label>
                      </div>
                    </div>
                  </div>

                  <div class="hidden" style="display:none;">
                    <input type="hidden" name="URL" id="URL" value="">
                    <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="">
                    <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="">
                    <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="">
                    <input type="hidden" name="GCLID" id="GCLID" value="">
                    <input type="hidden" name="reff" id="reff" value="<?php echo $reff != null ? $reff : ''; ?>">
                  </div>
                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" id="shirt_size" name="shirt_size">
                          <option value="XS">XS</option>
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>
                          <option value="XL">XL</option>
                          <option value="2XL">2XL</option>
                        </select>
                        
                        <label class="mdl-textfield__label" for="shirt_size">Shirt Size</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" type="text" id="shirt_type" name="shirt_type">
                          <option>T-Shirt</option>
                          <option>Tank / Racerback</option>
                        </select>
                        <label class="mdl-textfield__label" for="shirt_type">Shirt Type</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                  </div>

                  <div class="hidden" style="display:none;">
                    <input type="hidden" name="URL" id="URL" value="<?php echo $url != null ? $url : ''; ?>">
                    <input type="hidden" name="UTM_SOURCE" id="UTM_SOURCE" value="<?php echo $utm_source != null ? $utm_source : ''; ?>">
                    <input type="hidden" name="UTM_MEDIUM" id="UTM_MEDIUM" value="<?php echo $utm_medium != null ? $utm_medium : ''; ?>">
                    <input type="hidden" name="UTM_CAMP" id="UTM_CAMP" value="<?php echo $utm_campaign != null ? $utm_campaign : ''; ?>">
                    <input type="hidden" name="reff" id="reff" value="<?php echo $reff != null ? $reff : ''; ?>">
                  </div>
                  
                  <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                      <button style="width: 100%" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit">
                        Sign Up
                      </button>
                    </div>
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