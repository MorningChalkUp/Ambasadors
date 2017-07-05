<?php
  require '../inc/functions.php';

  $page_name = 'Frequently Asked Questions';
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

  .faq p {
    font-size: 16px;
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
    <div class="mdl-cell--6-col right image" style="background-image: url(/img/chalkupambassadorteam.jpg); background-position: center center; background-size: cover; background-repeat: no-repeat; min-height: 389px; min-width: 50%; float:right;height: 100%; position: absolute; right: 0; top: 0;">
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
          <li class="mdl-list__item">
            <span class="mdl-list__item-primary-content">
              Benefits & Levels
            </span>
          </li>
        </a>
        <a href="/faq/">
          <li class="mdl-list__item active">
            <span class="mdl-list__item-primary-content">
              FAQ
            </span>
          </li>
        </a>
      </ul>
    </div>
    <div class="mdl-cell mdl-cell--9-col mdl-grid mdl-color--white mdl-shadow--2dp">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Frequently Asked Questions</h2>
      </div>
      <div class="mdl-cell mdl-cell--12-col faq">
        <p><strong>General</strong></p>
        <p class="question" onclick="toggel('#points');"><i id="points-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How many points do you earn per new subscriber?</p>

        <p id="points" class="hidden">You get 1 point per subscriber.</p>
        

        <p class="question" onclick="toggel('#credit');"><i id="credit-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How long does it take before I will get credit for a subscription?</p>
        
        <p id="credit" class="hidden">You get your points instintaniously. So as soon as someone signs up you'll see it on your dashboard.</p>


        <p class="question" onclick="toggel('#remove');"><i id="remove-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>I hate Eric mostly because his hair is blonde. Can we remove him?</p>
        
        <p id="remove" class="hidden">Competition is the spice of life right? You can try to outwork Eric if you'd like. Of course Eric is also SuperAdmin and controlls the system. So good luck with that.</p>


        <p class="question" onclick="toggel('#add');"><i id="add-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>Who do I talk to about getting a friend signed up for Ambassadors?</p>
        
        <p id="add" class="hidden">You need to email <a href="mailto:justin@morningchalkup.com?subject=[Add Ambassador]">justin@morningchalkup.com</a> with a special request in order to get your friend signed up as an ambassador.</p>


        <p class="question" onclick="toggel('#quit');"><i id="quit-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>I want to quit.</p>

        <p id="quit" class="hidden">Email <a href="mailto:justin@morningchalkup.com?subject=[Ambassador Wants To Quit]">justin@morningchalkup.com</a> so he can talk you off the ledge. But if you really do want to leave the program also email Justin and we'll get you removed.</p>

        <script>
          function toggel(id) {
            if ($(id).hasClass('hidden')) {
              $(id).removeClass('hidden');
              $(id+'-i').text('keyboard_arrow_down');
            } else {
              $(id).addClass('hidden');
              $(id+'-i').text('keyboard_arrow_right');
            }
          }
        </script>
      </div>

    </div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>