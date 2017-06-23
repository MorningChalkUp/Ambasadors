<?php
  require '../inc/mcuamb_cookies.php';

  $logedin = mcuamb_loginState();

  if (!$logedin) {
    $location = 'Location: /login/';
    header($location);
  }

  $page_name = 'Dashboard';
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
          <div class="title">Eric Sherred</div>
          <div class="text">Current Status: <strong>Gold</strong></div>
          <div class="text">Next Level: <strong>Platinum</strong></div>
          <div class="text">Points to Platinum: <strong>2</strong></div>
          <div class="text"><a href="#">Levels & Bennifets</a></div>
        </div>
        <div class="mdl-cell mdl-cell--3-col">
          Doughnut Graph - Current Signups
        </div>
        <div class="mdl-cell mdl-cell--6-col">
          Bar Graph - Signup Trend
        </div>
      </div>
    </div>

    <div class="mdl-cell mdl-cell--8-col mdl-grid">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Promotion Tools</h2>
      </div>

      <div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--6-col mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
          <div class="title">Your Unique Share URL:</div>
          <div class="text"><small>https://morningchalkup.com/subscribe/?reff=ericsherred</small></div>
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
              <td class="mdl-data-table__cell--non-numeric">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td class="mdl-data-table__cell--non-numeric">
                +1
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <span>eric@morningchalkup.com</span> Subscribed to the Morning Chalk Up.
              </td>
              <td class="mdl-data-table__cell--non-numeric">
                <i class="mdi mdi-clock"></i> Juse 22, 2017
              </td>
            </tr>
            <tr>
              <td colspan="3" align="right">
                Previous 5 >
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
          <ul class="demo-list-two mdl-list" style="padding: 0; margin: 0;">
            <li class="mdl-list__item mdl-list__item--two-line">
              <span class="mdl-list__item-primary-content">
                <img src="https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/justin.png" alt="Justin L." style="border-radius: 50%; height: 50px; width: 50px; float: left;     margin-right: 16px;">
                <span>Justin L. - 1,234</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
            <li class="mdl-list__item mdl-list__item--two-line">
              <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-avatar" style="height: 50px; width: 50px; font-size: 50px;">person</i>
                <span>Justin L. - 1,234</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
            <li class="mdl-list__item mdl-list__item--two-line">
              <span class="mdl-list__item-primary-content">
                <img src="https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/justin.png" alt="Justin L." style="border-radius: 50%; height: 50px; width: 50px; float: left;     margin-right: 16px;">
                <span>Justin L. - 1,234</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
            <li class="mdl-list__item mdl-list__item--two-line">
              <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-avatar" style="height: 50px; width: 50px; font-size: 50px;">person</i>
                <span>Justin L. - 1,234</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
            <li class="mdl-list__item mdl-list__item--two-line">
              <span class="mdl-list__item-primary-content">
                <img src="https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/justin.png" alt="Justin L." style="border-radius: 50%; height: 50px; width: 50px; float: left;     margin-right: 16px;">
                <span>Justin L. - 1,234</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
            <li class="mdl-list__item mdl-list__item--two-line" style="border-top: 1px solid rgba(0,0,0,.12); margin: 8px;" )>
              <span class="mdl-list__item-primary-content">
                <img src="https://morningchalkup.com/wp-content/themes/mcu-theme-version-2/img/justin.png" alt="Justin L." style="border-radius: 50%; height: 50px; width: 50px; float: left;     margin-right: 16px;">
                <span>Me - 123</span>
                <span class="mdl-list__item-sub-title">Norco, CA</span>
              </span>
            </li>
          </ul>
        </div>
      </div>

    </div>

  </div>
</article>

<?php include '../templates/footer.php'; ?>