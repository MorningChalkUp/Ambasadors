<?php
  require '../../inc/functions.php';

  redirectIfLoggedOut('/login/');

  $page_name = 'Update';
?>

<?php include '../../templates/header.php'; ?>

<style>
  #crop {
    border: 1px #ffffff dotted;
    width: 100px;
    height: 100px;
    position: absolute;
    background-color: rgba(225,225,225,0.5);
  }
</style>

<article class="main dashboard">
  <div class="mdl-grid">
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-cell mdl-cell--5-col">
      <div class="mdl-color--white mdl-shadow--2dp">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--12-col">
            <button style="width: 100%; margin-bottom: 20px;" id="crop-btn" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect submit">
              Crop Image
            </button>
            <div id="full-img" style="text-align: center; overflow: hidden; max-width: 100%;">
              <img style="max-width: 100%; overflow: hidden;" src="/img/uploads/raw/<?php echo $_GET['img'] ?>" data-img-file="<?php echo $_GET['img'] ?>" data-aid="<?php echo $_GET['id'] ?>">
              <div id="crop"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mdl-layout-spacer"></div>
  </div>
</article>



<?php include '../../templates/footer.php'; ?>