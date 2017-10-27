<?php
  require '../inc/functions.php';

  redirectIfLoggedOut('/login/');

  $page_name = 'Profile';
?>

<?php include '../templates/header.php'; ?>

<?php
  if ($_GET['updated']) {
    echo "<script>
      r(function(){
        addSnackbar('Your profile has been updated.', 3000);
      });
      function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
    </script>";
  }
?>

<style>
  .no-hover:hover {
    background-color: #fff !important;
  }
</style>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-cell mdl-cell--8-col">
      <div class="mdl-color--white mdl-shadow--2dp">
        <div style="background-color: #3D5BA9; max-height: 80px; height: 100%;">
          <div style="width: 100px; height: 100px; margin: auto; padding-top: 30px;position:relative;">
            <a href="update.php?update=image" class="nostrike">
              <img src="/img/uploads/<?php echo $amb->getValue('image'); ?>" alt="<?php echo $amb->getValue('fullname'); ?>" style="border-radius: 50%; height: 100px; width: 100px;">
              <i class="material-icons" style="position: absolute; top: 34px;right:-10px;">mode_edit</i>
            </a>
          </div>
        </div>
        <div class="mdl-grid" style="margin-top: 30px;">
          <div class="mdl-cell mdl-cell--12-col" style="border-bottom: 1px solid #F1F2F2;">
            <h1 style="text-align: center;"><?php echo $amb->getValue('fullname'); ?></h1>
          </div>
          <div class="mdl-cell mdl-cell--12-col mdl-grid" style="border-bottom: 1px solid #F1F2F2;">
            <div class="mdl-cell mdl-cell--12-col" style="padding: 0; margin: 0;">
              <strong>Personal Information</strong>
              <div style="float: right;"><a href="update.php?update=personal"><i class="material-icons">mode_edit</i></a></div>
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--8-col">
                <table class="mdl-data-table" style="border: 0px; width: 100%;">
                  <tbody>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">person</i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">

                        <?php echo $amb->getValue('fullname'); ?>
                      
                      </td>
                    </tr>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">location_on</i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">

                        <?php echo $amb->getValue('address'); ?><br>
                        <?php echo $amb->getValue('city'); ?>, <?php echo $amb->getValue('state'); ?> <?php echo $amb->getValue('zip'); ?>
                      
                      </td>
                    </tr>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">email</i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">

                        <?php echo $amb->getValue('email'); ?>
                        
                      </td>
                    </tr>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="mdi mdi-tshirt-crew" style="font-size: 24px; vertical-align: middle;"></i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                        
                        <?php echo $amb->getValue('size'); ?> / <?php echo $amb->getValue('shirt_type'); ?>

                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mdl-layout-spacer"></div>
            </div>
          </div>
          <div class="mdl-cell mdl-cell--12-col mdl-grid">
            <div class="mdl-cell mdl-cell--12-col" style="padding: 0; margin: 0;">
              <strong>Username and Password</strong>
              <div style="float: right;"><a href="update.php?update=unpw"><i class="material-icons">mode_edit</i></a></div>
            </div>
            <div class="mdl-cell mdl-cell--12-col mdl-grid" style="padding: 0; margin: 0;">
                <div class="mdl-layout-spacer"></div>
                <div class="mdl-cell mdl-cell--8-col">
                  <table class="mdl-data-table" style="border: 0px; width: 100%;">
                  <tbody>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">person</i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                        
                        <?php echo $amb->getValue('username'); ?>
                      
                      </td>
                    </tr>
                    <tr class="no-hover">
                      <td style="border: 0px; width: 24px;" class="mdl-data-table__cell--non-numeric"><i class="material-icons" style="vertical-align: middle;">lock</i></td>
                      <td style="border: 0px;" class="mdl-data-table__cell--non-numeric">
                        
                        ************

                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>
                <div class="mdl-layout-spacer"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mdl-layout-spacer"></div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>