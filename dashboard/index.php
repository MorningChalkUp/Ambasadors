<?php
  require '../inc/functions.php';

  redirectIfLoggedOut('/login/');

  $page_name = 'Dashboard';

  if (isset($_GET['page'])) {
    $activityPage = $_GET['page'];
  } else {
    $activityPage = 1;
  }

  if (isset($_GET['count'])) {
    $activityCount = $_GET['count'];
  } else {
    $activityCount = 10;
  }

?>

<?php include '../templates/header.php'; ?>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
      <h2>Account Summary</h2>
      <div class="mdl-grid mdl-color--white mdl-shadow--2dp">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet mdl-cell--12-col-phone">
          <p style="font-size: 24px;"><?php echo $amb->getValue('fullname'); ?></p>
          <div class="text" style="font-size: 16px;">Level: <strong><?php echo $amb->getValue('status'); ?></strong></div>
          <div class="text" style="font-size: 16px;">Next Level: <strong><?php echo $amb->getNextLevel($con); ?></strong></div>
          <div class="text" style="font-size: 16px;">Points to <?php echo $amb->getNextLevel($con); ?>: <strong><?php echo $amb->getNextPoints($con); ?></strong></div>
          <div class="text" style="font-size: 16px;"><a href="/benefits/">Benefits & Levels</a></div>
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet mdl-cell--12-col-phone">
          <p>Progress to Next Level</p>
          <div style="max-width:200px">
            <canvas id="current"></canvas>
          </div>
          <script>
            var current = document.getElementById("current");
            doughnutData = {
              datasets: [{
                data: [
                  <?php echo $amb->getValue('points'); ?>, 
                  <?php echo $amb->getNextPoints($con); ?>,
                ],
                backgroundColor: ['#178552', 'rgba(0, 0, 0, 0.1)'],
              }],
              labels: [
                'Points',
                'Needed',
              ],
            };
            doughnutOptions = {
              legend: {
                display: false,
              },
              cutoutPercentage: 75,
            };
            var myDoughnutChart = new Chart(current, {
                type: 'doughnut',
                data: doughnutData,
                options: doughnutOptions,
            });
          </script>
        </div>
        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
          <p>Recent Growth</p>
          <canvas id="recent" height="130"></canvas>
          <script>
            var recent = document.getElementById("recent");
            recentData = {
              datasets: [{
                data: [
                  <?php echo $amb->getActivityCount(time()-(4 * 24 * 60 * 60),$con); ?>,
                  <?php echo $amb->getActivityCount(time()-(3 * 24 * 60 * 60),$con); ?>,
                  <?php echo $amb->getActivityCount(time()-(2 * 24 * 60 * 60),$con); ?>,
                  <?php echo $amb->getActivityCount(time()-(1 * 24 * 60 * 60),$con); ?>,
                  <?php echo $amb->getActivityCount(time()-(0 * 24 * 60 * 60),$con); ?>,
                ],
                backgroundColor: ['#3D5BA9', '#3D5BA9', '#3D5BA9', '#3D5BA9', '#3D5BA9',],
              }],
              labels: [
                '<?php echo date('m/d/y', strtotime('-4 days')) ?>',
                '<?php echo date('m/d/y', strtotime('-3 days')) ?>',
                '<?php echo date('m/d/y', strtotime('-2 days')) ?>',
                '<?php echo date('m/d/y', strtotime('-1 days')) ?>',
                '<?php echo date('m/d/y') ?>',
              ],
            };
            recentOptions = {
              legend: {
                display: false,
              },
              scales: {
                xAxes: [{
                  stacked: true
                }],
                yAxes: [{
                  stacked: true
                }]
              }
            };
            var myBarChart = new Chart(recent, {
              type: 'bar',
              data: recentData,
              options: recentOptions,
            });
          </script>
        </div>
      </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col">
      <h2>Promotion Tools</h2>
      <div class="mdl-grid mdl-grid--no-spacing">
        <div class="mdl-cell mdl-cell--6-col mdl-card mdl-color--white mdl-shadow--2dp">
          <div class="mdl-card__supporting-text">
            <p><strong>Your Unique Share URL:</strong></p>
            <p><small><a href="<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>" target="_blank"><?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?></a></small></p>
            <div class="button mdl-button mdl-js-button mdl-button--raised mdl-button--colored cpy-btn" data-clipboard-text="<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>" onclick="addSnackbar('Link Coppied')">COPY</div>
          </div>
        </div>
        <div class="mdl-cell mdl-cell--6-col mdl-card mdl-color--white mdl-shadow--2dp">
          <div class="mdl-card__supporting-text">
            <p><strong>Share On Social Media:</strong></p>
            <i style="font-size: 20px; cursor: pointer;background-color:#3b5998;" class="button mdl-button mdl-button--raised mdl-button--colored mdi mdi-facebook js-share-facebook"></i>
            <i style="font-size: 20px; cursor: pointer;background-color:#1da1f2;" class="button mdl-button mdl-button--raised mdl-button--colored mdi mdi-twitter js-share-twitter"></i>
            <i style="font-size: 20px; cursor: pointer;background-color:#333132;" class="button mdl-button mdl-button--raised mdl-button--colored mdi mdi-email js-share-email"></i>
            <script>
              $('.js-share-email').on('click', function() {
                document.location = 'mailto:?subject=Join the Morning Chalk Up&body=<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>';
              });

              $('.js-share-facebook').on('click', function() {
                FB.ui({
                  method: 'feed',
                  link: '<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>',
                  caption: 'Join me on the Morning Chalk Up',
                  picture: 'http://morningchalkup.com/wp-content/uploads/2017/01/fb_og.png',
                  name: 'Morning Chalk Up',
                  description: "Get the Fittest News in your inbox every morning.",
                }, function(response){});
              });

              $('.js-share-twitter').on('click', function() {
                window.open('https://twitter.com/intent/tweet?text=' + 'Get the Fittest News every day: <?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?> %23MorningChalkUp', '_blank');
              });

            </script>
          </div>
        </div>
      </div>
      <br>
      <h2>Recent Activity</h2>
      
      <div class="mdl-grid mdl-grid--no-spacing">
        <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col">
          <?php getActions($activityCount,$activityPage,$amb,$con); ?>
        </div>
      </div>

    </div>
    
    <div class="mdl-cell mdl-cell--4-col">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Leaderboard</h2>
        <div class="mdl-color--white mdl-shadow--2dp">
          <?php getLeaderboard(5,$con,true,$amb); ?>
        </div>
      </div>

    </div>

  </div>
</article>

<?php include '../templates/footer.php'; ?>