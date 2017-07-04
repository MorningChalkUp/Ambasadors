<?php
  require '../inc/functions.php';
?>

<?php include '../templates/header.php'; ?>

<style>
  .no-hover:hover {
    background-color: #fff !important;
  }
</style>

<article class="main dashboard">
  <div class="hero">
    <div class="left">
      Left
    </div>
    <div class="right">
      Right
    </div>
  </div>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--3-col mdl-grid">
    Tabs
    </div>
    <div class="mdl-cell mdl-cell--9-col mdl-grid mdl-color--white mdl-shadow--2dp">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Benefits & Levels</h2>
      </div>
      <div class="mdl-cell mdl-cell--12-col">
        <table class="mdl-data-table mdl-js-data-table" style="width: 100%; border: 0;">
          <thead>
            <tr style="background-color: #F1F2F2;">
              <th style="font-size: 20px; font-weight:bold;" class="mdl-data-table__cell--non-numeric">Tiers</th>
              <th style="font-size: 20px; font-weight:bold;" class="mdl-data-table__cell--non-numeric">Point Level</th>
              <th style="font-size: 20px; font-weight:bold;" class="mdl-data-table__cell--non-numeric">Benefits</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $levels = getLevels();

              foreach ($levels as $level) {

                $test = substr($level['status'], 0, 10);
                if ($test == 'Ambassador') {
                  if ($level['status'] == 'Ambassador 1') {
                    $level['status'] = 'Ambassador';
                  } else {
                    $level['status'] = '';
                  }
                }

                echo '<tr class="no-hover">';
                  echo '<td class="mdl-data-table__cell--non-numeric" style="border: 0;"><strong>' . $level['status'] . '</strong></td>';
                  echo '<td class="mdl-data-table__cell--non-numeric" style="border: 0;">' . $level['points_min'] . ' - ' . $level['points_max'] . '</td>';
                  echo '<td class="mdl-data-table__cell--non-numeric" style="border: 0;">' . $level['reward'] . '</td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>