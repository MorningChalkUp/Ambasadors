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
  .faq p {
    font-size: 16px;
  }

  .faq p.hidden {
    display: none;
  }
  .faq p.question {
    cursor: pointer;
  }
  .question-section {
    font-size: 16px !important;
    margin-bottom: 14px;
  }
  .question-section .question {
    font-size: 16px !important;
    cursor: pointer;
  }
  .question-section .answer {
    font-size: 16px !important;
    color: rgba(51, 49, 50, .75);
    margin: 10px 0 10px 10px;
  }
  .question-section a, .faq a {
    color: #3D5BA9;
  }
  .question-section a:hover, .faq a:hover {
    text-decoration: underline;
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
        <h3 style="color: #fff; font-weight: 400; font-size: 36px; line-height: 1.4em; margin-top: 0px;">Welcome to the Morning Chalk Up Ambassador Program</h3>
        <p style="color: #fff;">
          We know you’ve already been spreading the word about the Morning Chalk Up with your CrossFit friends. Believe us when we say -- we appreciate it so much, and we never would have grown so big without your help. We built the Morning Chalk Up Ambassador program with you in mind, to reward your hard work and give you a little something extra when your friends subscribe.
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
    <div class="mdl-cell mdl-cell--9-col mdl-grid mdl-color--white mdl-shadow--2dp faq">
      <div class="mdl-cell mdl-cell--12-col">
        <h2>Frequently Asked Questions</h2>
        <p style="font-size: 16px;">Don't see an answer to your question? <a href="/contact/">Contact us</a> and we'll help out.</p>
      </div>
      <div class="mdl-cell mdl-cell--12-col faq" style="font-size: 16px;">
        <p><strong>General</strong></p>

        <div class="question-section">
          <div class="question" onclick="toggel('#join');"><i id="join-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How do I become an ambassador?</div>

          <div id="join" class="hidden answer">You just need to <a href="/join/" alt="Join">sign up here</a>. Once you get 5 friends to subscribe you’re officially an ambassador.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#promo');"><i id="promo-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>Do you have any promotional materials that I can use to post to social media?</div>
          
          <div id="promo" class="hidden answer">Not quite yet. We’re still working on that.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#invite');"><i id="invite-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>My friend wants to become an ambassador. How can I invite he/she join?</div>
          
          <div id="invite" class="hidden answer">Absolutely! And if you invite your friend through your dashboard you’ll get 3 points if he/she accepts.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#description');"><i id="description-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>I don't know how to describe the Morning Chalk Up to my friends. How would you describe it?</div>
          
          <div id="description" class="hidden answer">The Morning Chalk Up is a daily newsletter that tells you everything you need to know about CrossFit news in 5 minutes or less.</div>
        </div>

        <p><strong>Earning Points</strong></p>

        <div class="question-section">
          <div class="question" onclick="toggel('#sub');"><i id="sub-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How many points do I earn per subscriber?</div>

          <div id="sub" class="hidden answer">You get 1 point per subscriber.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#amb');"><i id="amb-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How many points do I earn if I recruit a new ambassador?</div>

          <div id="amb" class="hidden answer">You get 3 points per ambassador.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#other');"><i id="other-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>Are there any other ways to get points?</div>

          <div id="other" class="hidden answer">No, not at this time.</div>
        </div>

        <div class="question-section">
          <div class="question" onclick="toggel('#credit');"><i id="credit-i" class="material-icons" style="float: right;">keyboard_arrow_right</i>How long does it take before I will get credit for a sign up? </div>

          <div id="credit" class="hidden answer">Instantly! As soon as someone signs up you will see it on your dashboard.</div>
        </div>

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