<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

  require '../inc/functions.php';

  redirectIfLoggedOut('/login/');
  redirectIfNotAdmin('/dashboard/');
?>

<?php include '../templates/header.php'; ?>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
      <a href="download.php" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="float:right; margin: 18px 0px;">Download</a>
      <h2>Admin Leaderboard</h2>
      <div class="mdl-cell mdl-cell--12-col">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="mdl-color--white mdl-shadow--2dp">
            <?php getLeaderboardAdmin($con); ?>
          </div>
        </div>

      </div>
    </div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>