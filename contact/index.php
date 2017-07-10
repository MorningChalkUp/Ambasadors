<?php
  require '../inc/functions.php';

  $page_name = 'Contact';

  if ($_GET['e']) {
    $error = true;
  }

?>

<?php include '../templates/header.php'; ?>

<style>
  footer {
    bottom: 0;
    position: absolute;
    width: 100%;
  }
  .mdl-mini-footer__right-section {
    padding-right: 30px;
  }
</style>


<?php
  if ($_GET['ty']) {
    echo "<script>
      r(function(){
        addSnackbar('Your Message Was Sent!', 3000);
      });
      function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
    </script>";
  }
?>

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
  <div class="hero" style="background-color: #ffffff; overflow: hidden; position: relative;">
    <div class="mdl-cell--6-col right image" style="background-image: url(/img/chalkupcontact.jpg); background-position: center center; background-size: cover; background-repeat: no-repeat; min-height: 389px; min-width: 50%; float:right;height: 100%; position: absolute; right: 0; top: 0;">
      </div>
    <div class="mdl-grid">
      <div class="mdl-cell--6-col left">
        <h3 style="font-weight: 500; font-size: 1.8em; line-height: 1.4em">Get in Touch.</h3>
        <p>
          If you’re experiencing a problem, have a question or need to get in touch with us for any reason, please fill out the form and one of our staff will get back to you shortly.
        </p>
      </div>
      <form style="width: 100%" action="process.php" method="post">
        <?php if (!$loggedin): ?>
          <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="email" name="email">
              <label class="mdl-textfield__label" for="email">Email *</label>
            </div>
          </div>
        <?php else: ?>
          <input type="hidden" name="email" value="<?php echo $amb->getValue('email'); ?>">
        <?php endif; ?>
        <div class="mdl-cell mdl-cell--6-col">
            <div class="mdl-textfield mdl-js-textfield" style="width: 100%;">
              <textarea class="mdl-textfield__input" type="text" rows= "1" id="question" name="question"></textarea>
              <label class="mdl-textfield__label" for="question">How can we help?</label>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--6-col">
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit"">
            Send
          </button>
        </div>
      </form>
    </div>
  </div>
</article>

<?php include '../templates/footer.php'; ?>