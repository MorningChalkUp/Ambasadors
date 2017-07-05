<?php
  require '../inc/functions.php';

  $page_name = 'Benefits & Levels';
  
?>

<?php include '../templates/header.php'; ?>

<style>
  .no-hover:hover {
    background-color: #fff !important;
  }
  .hero:after {
    clear: right;
    content: '.';
    font-size: 1px;
    display: block;
    visibility: hidden;
    height: 0px;
  }
  .tabs li {
    height: 68px;
    border-left: 10px solid #f0f0f0;
    margin-bottom: 10px;
    cursor: pointer;
  }
  .tabs li.active, .tabs li:hover {
    border-left: 10px solid #3D5BA9;
    box-shadow:  -2px 0 4px 0 rgba(0,0,0,.5);
    text-decoration: none;
  }
  .tabs a {
    color: #000000;
    font-weight: 400;
  }
  .tabs a:hover {
    text-decoration: none;
  }
  @media (max-width: 839px) {
    .hero .right.image {
      display:none;
    }

    .hero .left {
      width: 100%;
      padding: 8px;
    }

    .tabs .mdl-cell {
      width: 100%
    }
  }
</style>

<article class="main dashboard">
  <div class="hero" style="background-color: #3D5BA9; overflow: hidden; position: relative;">
    <div class="mdl-cell--6-col right image" style="background-image: url(/img/chalkupambassadorteam.png); background-position: center center; background-size: cover; background-repeat: no-repeat; min-height: 389px; min-width: 50%; float:right;height: 100%; position: absolute; right: 0; top: 0;">
      </div>
    <div class="mdl-grid">
      <div class="mdl-cell--6-col left" style="color: #fff;">
        <h3 style="font-weight: 500; font-size: 1.8em; line-height: 1.4em">Welcome to the Morning Chalk Up Ambassador Program</h3>
        <p style="color: #fff;">
          We’ve designed the Morning Chalk Up Ambassador Program to enable you to sell, service, and innovate by leveraging our products and platforms across the Chalk Up Cloud suite. Ambassadors are a fundamental part of the Chalk Up Cloud mission, the empower millions of people to work the way they choose and build what’s next. 
        </p>
      </div>
    </div>
  </div>
  <div class="mdl-grid tabs">
    <div class="mdl-cell mdl-cell--3-col mdl-grid">
      <ul class="demo-list-item mdl-list" style="width: 100%;">
        <a href="/benefits/">
          <li class="mdl-list__item active">
            <span class="mdl-list__item-primary-content">
              Benefits & Levels
            </span>
          </li>
        </a>
        <a href="/faq/">
          <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
              FAQ
            </span>
          </li>
        </a>
      </ul>
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