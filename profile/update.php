<?php
  require '../inc/functions.php';

  redirectIfLoggedOut('/login/');

  $page_name = 'Update';

  $section = $_GET['update'];

  $personal = false;
  $unpw = false;
  $image = false;
  $error = '';

  if ($section == 'personal') {
    $personal = true;
  } else if ($section == 'unpw') {
    $unpw = true;
  } else if ($section == 'image') {
    $image = true;
  } else {
    unset($section);
  }

  if ($_GET['error']) {
    $error = $_GET['error'];
  }

?>

<?php include '../templates/header.php'; ?>

<style>
  .no-hover:hover {
    background-color: #fff !important;
  }
  .mdl-button--file input {
    cursor: pointer;
    height: 100%;
    right: 0;
    opacity: 0;
    position: absolute;
    top: 0;
    width: 300px;
    z-index: 4;
  }
  
  .mdl-textfield--file .mdl-textfield__input {
    box-sizing: border-box;
    width: calc(100% - 32px);
  }

  .mdl-textfield--file .mdl-button--file {
    right: 0;
  }

  @media screen and (max-width: 838px) {
    .mdl-textfield {
      width: 100%;
    }
  }
</style>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-cell mdl-cell--8-col">
      <div class="mdl-color--white mdl-shadow--2dp">
        <div style="background-color: #3D5BA9; max-height: 80px; height: 100%; text-align: center;">
          <div style="width: 100px; height: 100px; margin: auto; padding-top: 30px;"><img src="/img/uploads/<?php echo $amb->getValue('image'); ?>" alt="<?php echo $amb->getValue('full-name'); ?>" style="border-radius: 50%; height: 100px; width: 100px;"></div>
        </div>
        <div class="mdl-grid" style="margin-top: 30px;">
          <div class="mdl-cell mdl-cell--12-col" style="border-bottom: 1px solid #F1F2F2;">
            <h1 style="text-align: center;"><?php echo $amb->getValue('fullname'); ?></h1>
          </div>
          <form action="/profile/process.php" enctype="multipart/form-data" method="post" class="mdl-grid" style="padding: 0;">
            <?php if ($image): ?>
            <div class="mdl-cell mdl-cell--12-col mdl-grid" style="border-bottom: 1px solid #F1F2F2;">
              <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
                <strong>Update Profile Picture</strong>
                <small>Square images please. Maximum file size: 5MB. jpg, jpeg, png, or gif only.</small>
              </div>
              <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-cell mdl-cell--8-col">
                  <table class="mdl-data-table" style="border: 0px;">
                    <tbody>
                      <?php 
                        if ($error && $error == 'image') {
                          echo '<tr class="no-hover">';
                            echo '<td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"></td>';
                            echo '<td style="border: 0px;" class="mdl-data-table__cell--non-numeric">';
                              echo '<span style="color: red;"><em>File not jpg, jpeg, png, or gif. Please select a new file.</em></span>';
                            echo '</td>';
                          echo '</tr>';
                        }
                      ?>
                      <?php 
                        if ($error && $error == 'size') {
                          echo '<tr class="no-hover">';
                            echo '<td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"></td>';
                            echo '<td style="border: 0px;" class="mdl-data-table__cell--non-numeric">';
                              echo '<span style="color: red;"><em>File too big. PLease reduce the file size to below 5MB.</em></span>';
                            echo '</td>';
                          echo '</tr>';
                        }
                      ?>
                      <tr class="no-hover">
                        <td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">account_circle</i></td>
                        <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--file" style="">
                            <input class="mdl-textfield__input" placeholder="File" type="text" id="uploadFile" readonly/>
                            <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                              <i class="material-icons">attach_file</i><input type="file" id="uploadBtn" name="profile_pic">
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="mdl-layout-spacer"></div>
              </div>
            </div>
            <?php endif; ?>

            <?php if ($personal): ?>
              <div class="mdl-cell mdl-cell--12-col mdl-grid" style="border-bottom: 1px solid #F1F2F2;">
                <h5 class="center" style="width:100%"> Update Personal Information </h5><br><br>
                <div class="mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
                  
                  <?php 
                    if ($error && $error == 'email') {
                      echo '<div class="mdl-cell mdl-cell--12-col mdl-grid"><div class="mdl-layout-spacer"></div><div class="mdl-cell mdl-cell--1-col">&nbsp;</div><div class="mdl-cell mdl-cell--9-col">';
                      echo '<span style="color: red;"><em>Email taken. Please choose another.</em></span>';
                      echo '</div></div>';
                    }
                  ?>
                    
                  <div class="mdl-cell--12-col mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--1-col"><i class="material-icons" style="vertical-align: middle;">person</i></div>
                    <div class="mdl-cell mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="">
                        <input class="mdl-textfield__input" type="text" id="fullname" name="fullname" value="<?php echo $amb->getValue('fullname'); ?>">
                        <label class="mdl-textfield__label" for="fullname">Full Name</label>
                      </div>
                    </div>
                  </div>
                  <div class="mdl-cell--12-col mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--1-col"><i class="material-icons" style="vertical-align: middle;">location_on</i></div>
                    <div class="mdl-cell mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="">
                        <input class="mdl-textfield__input" type="text" id="address" name="address" value="<?php echo $amb->getValue('address'); ?>">
                        <label class="mdl-textfield__label" for="address">Address</label>
                      </div>
                      <div class="mdl-grid" style="padding: 0;">
                        <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">

                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--5-col" style="max-width: 100%; margin-left: 0;">
                            <input class="mdl-textfield__input" type="text" id="city" name="city" value="<?php echo $amb->getValue('city'); ?>">
                            <label class="mdl-textfield__label" for="city">City</label>
                          </div>

                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--2-col" style="max-width: 100%;">
                            <input class="mdl-textfield__input" type="text" id="state" name="state"  value="<?php echo $amb->getValue('state'); ?>">
                            <label class="mdl-textfield__label" for="state">State</label>
                          </div>

                          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell mdl-cell--4-col" style="max-width: 100%; margin-right: 0;">
                            <input class="mdl-textfield__input" type="text" id="zip" name="zip" value="<?php echo $amb->getValue('zip'); ?>">
                            <label class="mdl-textfield__label" for="zip">Zip Code</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mdl-cell--12-col mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--1-col"><i class="material-icons" style="vertical-align: middle;">email</i></div>
                    <div class="mdl-cell mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php echo $error == 'email' ? 'is-invalid' : ''; ?>" style="">
                        <input class="mdl-textfield__input" type="text" id="email" name="email" value="<?php echo $amb->getValue('email'); ?>">
                        <label class="mdl-textfield__label" for="email">Email</label>
                      </div>
                    </div>
                  </div>
                    
                  <div class="mdl-cell--12-col mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--1-col"><i class="mdi mdi-tshirt-crew" style="font-size: 24px; vertical-align: middle;"></i></div>
                    <div class="mdl-cell mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" id="shirt_size" name="shirt_size">
                          <option value="XS" <?php echo isSelected('XS', 'size'); ?>>XS</option>
                          <option value="S" <?php echo isSelected('S', 'size'); ?>>S</option>
                          <option value="M" <?php echo isSelected('M', 'size'); ?>>M</option>
                          <option value="L" <?php echo isSelected('L', 'size'); ?>>L</option>
                          <option value="XL" <?php echo isSelected('XL', 'size'); ?>>XL</option>
                          <option value="2XL" <?php echo isSelected('2XL', 'size'); ?>>2XL</option>
                        </select>
                        
                        <label class="mdl-textfield__label" for="shirt_size">Shirt Size</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                  </div>
                  
                  <div class="mdl-cell--12-col mdl-grid mdl-grid--no-spacing">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--1-col"><i class="mdi mdi-tshirt-crew" style="font-size: 24px; vertical-align: middle;"></i></div>
                    <div class="mdl-cell mdl-cell--9-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label select-container">
                        <select class="mdl-textfield__input" type="text" id="shirt_type" name="shirt_type">
                          <option value="T-Shirt" <?php echo isSelected('T-Shirt', 'type'); ?>>T-Shirt</option>
                          <option value="Tank / Racerback" <?php echo isSelected('Tank / Racerback', 'type'); ?>>Tank / Racerback</option>
                        </select>
                        <label class="mdl-textfield__label" for="shirt_type">Shirt Type</label>
                        <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if ($unpw): ?>
              <div class="mdl-cell mdl-cell--12-col mdl-grid" style="border-bottom: 1px solid #F1F2F2;">
                <div class="mdl-cell mdl-cell--12-col" style="padding: 0; margin: 0;">
                  <strong>Update Username and Password</strong>
                </div>
                <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-cell mdl-cell--8-col">
                      <table class="mdl-data-table" style="border: 0px;">
                      <tbody>
                        <?php 
                          if ($error && $error == 'username') {
                            echo '<tr class="no-hover">';
                              echo '<td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"></td>';
                              echo '<td style="border: 0px;" class="mdl-data-table__cell--non-numeric">';
                                echo '<span style="color: red;"><em>Username taken. Please choose another.</em></span>';
                              echo '</td>';
                            echo '</tr>';
                          }
                        ?>
                        <tr class="no-hover">
                          <td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">person</i></td>
                          <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label <?php echo $error == 'username' ? 'is-invalid' : ''; ?>" style="">
                              <input class="mdl-textfield__input" type="text" id="username" name="username" value="<?php echo $amb->getValue('username'); ?>">
                              <label class="mdl-textfield__label" for="username">Username</label>
                            </div>
                          </td>
                        </tr>
                        <tr class="no-hover">
                          <td style="border: 0px; max-width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">lock</i></td>
                          <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="">
                              <input class="mdl-textfield__input" type="password" id="password" name="password" value="<?php echo $amb->getValue('password'); ?>">
                              <label class="mdl-textfield__label" for="password">Password</label>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                    <div class="mdl-layout-spacer"></div>
                </div>
              </div>
            <?php endif; ?>
            <div class="mdl-cell mdl-cell--12-col mdl-grid">
              <div class="mdl-cell mdl-cell--12-col" style="text-align: center;">
                <?php if (isset($section)): ?>
                  <input type="hidden" name="section" value="<?php echo $section; ?>">
                  <input type="hidden" name="id" value="<?php echo $amb->getValue('id'); ?>">
                  <center>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"">
                      Update
                    </button>
                  </center>
                <?php endif; ?>
                <center>
                  <small><a href="/profile/">Cancel</a></small>
                </center>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="mdl-layout-spacer"></div>
  </div>
</article>

<script>
  document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.files[0].name;
  };
</script>

<?php include '../templates/footer.php'; ?>