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

  global $con;

?>

<?php include '../templates/header.php'; ?>

<?php
  if ($_GET['sent']) {
    echo "<script>
      r(function(){
        addSnackbar('Invites Sent!', 3000);
      });
      function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
    </script>";
  }
  if ($_GET['error']) {
    echo "<script>
      r(function(){
        addSnackbar('Please enter an email.', 3000);
      });
      function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
    </script>";
  }
?>
<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
      <h2>Account Summary</h2>
      <div class="mdl-grid mdl-color--white mdl-shadow--2dp">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet mdl-cell--12-col-phone">
          <p style="font-size: 24px;"><?php echo $amb->getValue('fullname'); ?></p>
          <p style="font-size: 16px;">
            Your Points: <strong><?php echo $amb->getValue('points'); ?></strong></p>
          <p style="font-size: 16px;">
            <strong><?php echo $amb->getNextPoints($con); ?></strong> Points to Next Reward:<br/>
            <strong><?php echo $amb->getNextReward($con); ?></strong><br/>
          </p>
          <small><a href="/benefits/">Benefits & Levels</a></small>
        </div>
        <div class="mdl-cell mdl-cell--3-col mdl-cell--6-col-tablet mdl-cell--12-col-phone">
          <p>Progress to Next Level</p>
          <div style="width: 200px; height: 200px;" id="levelPoints">
          </div>
          <script>
            Morris.Donut({
              element: 'levelPoints',
              data: [
                {label: "Points", value: <?php echo $amb->getValue('points'); ?>},
                {label: "Needed", value: <?php echo $amb->getNextPoints($con); ?>},
              ],
              colors: ['#3D5BA9', 'rgba(0, 0, 0, 0.1)'],
              resize: true,
            });

           /* var current = document.getElementById("current");
            doughnutData = {
              datasets: [{
                data: [
                  <?php //echo $amb->getValue('points'); ?>, 
                  <?php //echo $amb->getNextPoints($con); ?>,
                ],
                backgroundColor: ['#3D5BA9', 'rgba(0, 0, 0, 0.1)'],
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
            });*/
          </script>
        </div>
        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
          <p>Recent Growth</p>
          <div id="recent" style="max-width: 553px; max-height: 200px;"></div>
          <script>
            Morris.Bar({
              element: 'recent',
              data: [
                { date: '<?php echo date('m/d/y', time()-(4 * 24 * 60 * 60)); ?>',
                  points: <?php echo $amb->getActivityCount(time()-(4 * 24 * 60 * 60),$con); ?> 
                },
                { date: '<?php echo date('m/d/y', time()-(3 * 24 * 60 * 60)); ?>',
                  points: <?php echo $amb->getActivityCount(time()-(3 * 24 * 60 * 60),$con); ?> 
                },
                { date: '<?php echo date('m/d/y', time()-(2 * 24 * 60 * 60)); ?>',
                  points: <?php echo $amb->getActivityCount(time()-(2 * 24 * 60 * 60),$con); ?> 
                },
                { date: '<?php echo date('m/d/y', time()-(1 * 24 * 60 * 60)); ?>',
                  points: <?php echo $amb->getActivityCount(time()-(1 * 24 * 60 * 60),$con); ?> 
                },
                { date: '<?php echo date('m/d/y', time()-(0 * 24 * 60 * 60)); ?>',
                  points: <?php echo $amb->getActivityCount(time()-(0 * 24 * 60 * 60),$con); ?> 
                },
              ],
              xkey: 'date',
              ykeys: ['points'],
              labels: 'Points',
              hideHover: 'auto',
              resize: true,
              barColors: ['#3D5BA9'],
            });

            /*var recent = document.getElementById("recent");
            recentData = {
              datasets: [{
                data: [
                  <?php //echo $amb->getActivityCount(time()-(4 * 24 * 60 * 60),$con); ?>,
                  <?php //echo $amb->getActivityCount(time()-(3 * 24 * 60 * 60),$con); ?>,
                  <?php //echo $amb->getActivityCount(time()-(2 * 24 * 60 * 60),$con); ?>,
                  <?php //echo $amb->getActivityCount(time()-(1 * 24 * 60 * 60),$con); ?>,
                  <?php //echo $amb->getActivityCount(time()-(0 * 24 * 60 * 60),$con); ?>,
                ],
                backgroundColor: ['#3D5BA9', '#3D5BA9', '#3D5BA9', '#3D5BA9', '#3D5BA9',],
              }],
              labels: [
                '<?php //echo date('m/d/y', strtotime('-4 days')) ?>',
                '<?php //echo date('m/d/y', strtotime('-3 days')) ?>',
                '<?php //echo date('m/d/y', strtotime('-2 days')) ?>',
                '<?php //echo date('m/d/y', strtotime('-1 days')) ?>',
                '<?php //echo date('m/d/y') ?>',
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
            });*/
          </script>
        </div>
      </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col">
      <h2>Promotion Tools</h2>
      <div class="mdl-grid  mdl-color--white mdl-shadow--2dp">
        <div class="mdl-cell mdl-cell--12-col ">
          <div class="mdl-card__supporting-text">
            <strong>Share Your Unique URL:</strong>
            <small><a href="<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>" target="_blank"><?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?></a></small></p>
            <div class="button mdl-button mdl-js-button mdl-button--raised mdl-button--colored cpy-btn" data-clipboard-text="<?php echo $domain; ?>/subscribe/?reff=<?php echo $amb->getValue('username'); ?>" onclick="addSnackbar('Link Coppied')">COPY</div>
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
          <hr class="thin">
          <div class="mdl-card__supporting-text">
            <strong>Invite a friend to the Morning Chalk Up</strong>
            <form action="invite.php" method="post">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%;">
                <input class="mdl-textfield__input" type="text" name="sub_invite" value="" id="sub_invite" style="color: #484546;">
                <label class="mdl-textfield__label" for="sub_invite">Separate multiple emails by comma.</label>
              </div>
              <button class="button mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Send</button>
            </form>
          </div>
          <hr class="thin">
          <div class="mdl-card__supporting-text">
            <strong>Invite a friend to become an Ambassador</strong>
            <form action="invite.php" method="post">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width:100%;">
                <input class="mdl-textfield__input" type="text" name="amb_invite" value="" id="amb_invite" style="color: #484546;">
                <label class="mdl-textfield__label" for="amb_invite">Separate multiple emails by comma.</label>
              </div>
              <button class="button mdl-button mdl-js-button mdl-button--raised mdl-button--colored">Send</button>
            </form>
          </div>
        </div>
      </div>
      <br>
      <h2>Recent Activity</h2>
      
      <div class="mdl-grid mdl-grid--no-spacing activity">
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