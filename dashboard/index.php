<?php
  define('__ROOT__', dirname(dirname(__FILE__))); 

  require_once(__ROOT__.'/inc/vars.php');
  require_once(__ROOT__.'/inc/db/class.DBPDO.php');

  require '../inc/mcuamb_cookies.php';
  require '../inc/class.ambassador.php';
  require '../inc/functions.php';
  require '../templates/leaderboard.php';

  try {
    $con = new DBPDO();
  } catch (Exception $e) {
    echo 'There was an issue establishing a connection with the Database. Please contact <a href="mailto:eric@morningchalkup.com">eric@morningchalkup.com</a> for assistance.';
  }

  $logedin = mcuamb_loginState($con);

  if (!$logedin) {
    $location = 'Location: /login/';
    header($location);
  } else {
    $username = mcuamb_getUsername();
    $amb = new Ambassador;
    $amb->setUser($username, $con);
  }

  $page_name = 'Dashboard';

  $domain = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
?>

<?php include '../templates/header.php'; ?>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col mdl-grid">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Account Summery</h2>
      </div>
      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-cell mdl-cell--3-col">

          <div class="title"><?php echo $amb->getValue('full-name'); ?></div>
          <div class="text">Level: <strong><?php echo $amb->getValue('status'); ?></strong></div>
          <div class="text">Next Level: <strong><?php echo $amb->getValue('next-status'); ?></strong></div>
          <div class="text">Points to <?php echo $amb->getValue('next-status'); ?>: <strong><?php echo $amb->getNextPoints($con); ?></strong></div>
          <div class="text"><a href="#">Levels & Bennifets</a></div>
        </div>
        <div class="mdl-cell mdl-cell--3-col">
          Doughnut Graph - Current Signups: <?php echo $amb->getValue('points'); ?>
        </div>
        <div class="mdl-cell mdl-cell--6-col">
          Bar Graph - Signup Trend
        </div>
      </div>
    </div>

    <div class="mdl-cell mdl-cell--12-col mdl-grid">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Promotion Tools</h2>
      </div>

      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="title">Your Unique Share URL:</div>
          <div class="text"><small><a href="<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>" target="_blank"><?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?></a></small></div>
          <div class="button mdl-button mdl-js-button mdl-button--raised mdl-button--colored">COPY</div>
        </div>
      </div>

      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid mdl-cell--top">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="title">Share On Social Media</div>
          <div class="text">
            <a href="#"><i style="font-size: 32px;" class="mdi mdi-facebook-box"></i></a>
            <a href="#"><i style="font-size: 32px;" class="mdi mdi-twitter-box"></i></a>
            <a href="#"><i style="font-size: 32px;" class="mdi mdi-email"></i></a>
          </div>
        </div>
      </div>

    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-grid mdl-cell--top">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Recent Actions</h2>
      </div>

      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <table class="mdl-data-table mdl-js-data-table" style="width: 100%;">
          <tbody>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric" style="text-align: right;">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td colspan="3" align="right">
                Previous 10 >
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
    
    <div class="mdl-cell mdl-cell--4-col mdl-grid mdl-cell--top">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Leaderboard</h2>
      </div>
      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
          <?php getLeaderboard(5,$con,true,$amb); ?>
        </div>
      </div>

    </div>

  </div>
</article>

<?php include '../templates/footer.php'; ?>