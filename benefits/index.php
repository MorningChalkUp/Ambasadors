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
    border-left: 3px solid transparent;
    margin-bottom: 10px;
    cursor: pointer;
  }
  .tabs li.active {
    border-left: 3px solid #3D5BA9;
    text-decoration: none;
  }
  .tabs li:hover {
    background-color: rgba(158,158,158,.2);
  }
  .tabs a {
    color: #000000;
    font-weight: 400;
  }
  .tabs a:hover {
    text-decoration: none;
  }

  .faq p.hidden {
    display: none;
  }
  .faq p.question {
    cursor: pointer;
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
    <div class="mdl-cell--6-col right image" style="background-image: url(/img/chalkupambassadorteam2.jpg); background-position: center center; background-size: cover; background-repeat: no-repeat; min-height: 389px; min-width: 50%; float:right;height: 100%; position: absolute; right: 0; top: 0;"></div>
    <div class="mdl-grid">
      <div class="mdl-cell--6-col left" style="color: #fff; margin: 32px 0;">
        <h3 style="color: #fff;font-weight: 400; font-size: 36px; line-height: 1.4em; margin-top: 0px;">Welcome to the Morning Chalk Up Ambassador Program</h3>
        <p style="color: #fff;">
          We know you’ve already been spreading the word about the Morning Chalk Up with your CrossFit friends. Believe us when we say -- we appreciate it so much, and we never would have grown so big without your help. We built the Morning Chalk Up Ambassador program with you in mind, to reward your hard work and give you a little something extra when your friends subscribe.
        </p>
      </div>
    </div>
  </div>
  <div class="mdl-grid ">
    <div class="mdl-cell mdl-cell--3-col mdl-grid">
      <ul class="demo-list-item mdl-list tabs" style="width: 100%;">
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
        <p>We’ve worked up some really cool prizes for our most dedicated Ambassadors, but being an Ambassador isn’t just about cool stuff -- it’s being a part of a team that believes what you believe. We’re dedicated to inspiring all generations to believe in one another again and share how they’re using fitness to make a difference in everyday lives all around us. We’re asking you to help celebrate that idea with your friends.</p>
        <p>Here are some of the perks every ambassadors gets:</p>
        <ul>
          <li>Ambassadors only Facebook group to share ideas for how you’re grabbing points, share fun video or news going on in your box, connect with other CrossFitters across the globe, and help your Morning Chalk Up crew stay up-to-date.</li>
          <li>Random gifts from your Morning Chalk Up crew to our best Ambassadors. </li>
          <li>First access to ANYTHING new that we do. Pre-order, meet-and-greet events with athletes, pop-up WODs in Central Park, that sort of thing. </li>
          <li>Early access with our partnership brands.</li>
          <li>Discounts from our official partners.</li>
          <li>Ambassadors only party at the CrossFit Games.</li>
          <li>More coming soon!</li>
        </ul>

      
        <table class="mdl-data-table mdl-js-data-table" style="width: 100%; border: 0;">
          <thead>
            <tr style="background-color: #F1F2F2;">
              <th style="font-size: 20px; font-weight:bold;" class="mdl-data-table__cell--non-numeric">Point Level</th>
              <th style="font-size: 20px; font-weight:bold;" class="mdl-data-table__cell--non-numeric">Benefits</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $levels = getLevels();

              foreach ($levels as $level) {

                echo '<tr class="no-hover">';
                  echo '<td class="mdl-data-table__cell--non-numeric" style="border: 0; font-size: 16px; ">' . $level['points_min'] . '</td>';
                  echo '<td class="mdl-data-table__cell--non-numeric" style="border: 0; font-size: 16px; ">' . $level['reward'] . '</td>';
                echo '</tr>';
              }
            ?>
            <tr class="no-hover">
              <td></td>
              <td>*Prizes are subject to size, color and style availability. </td>
            </tr>
            
          </tbody>
        </table>
      </div>

    </div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>