<header class="mdl-layout__header">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">
      <a id="logo" href="/"><?php echo file_get_contents('../img/mcu.svg') ?></a>
    </span>
    <div class="mdl-layout-spacer"></div>
    <div <?php echo $loggedin ? 'id="status"' : ''; ?> class="mdl-cell--hide-phone">
      <?php if ($loggedin) : ?>
        <span style="font-size: 14px;color:#333132;"><?php echo $amb->getValue('fullname'); ?></span> 
        <?php 
          echo '<img src="/img/uploads/' . $amb->getValue('image') . '" alt="' . $amb->getValue('fullname')  . '" style="border-radius: 50%; height: 45px; width: 45px; cursor: pointer;">';
        ?>
      <?php else : ?>
        <span style="font-size: 14px;color:#333132;"><a href="/join/">Sign Up</a> / <a href="/login/">Log In</a></span>
      <?php endif; ?>
    </div>

    <ul id="menu" class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="status">
      <li class="mdl-menu__item mdl-menu__item--full-bleed-divider" style="text-align: center;"><a href="/profile/" style="color: black; text-decoration: none"><i class="material-icons" style="vertical-align: middle;">person</i> Profile</a></li>
      <li class="mdl-menu__item" style="text-align: center;"><a href="/logout/" style="color: red; text-decoration: none;">Sign Out</a></li>
    </ul>

  </div>
</header>
<div class="mdl-layout__drawer" style="z-index: 6;">
  <span class="mdl-layout-title">
    <?php if ($loggedin) : ?>
      <span id="status-mobile" class="mdl-cell--hide-desktop mdl-cell--hide-tablet" style="float: right; padding-right: 16px;">
      <?php 
        echo '<img src="/img/uploads/' . $amb->getValue('image') . '" alt="' . $amb->getValue('fullname')  . '" style="border-radius: 50%; height: 45px; width: 45px; cursor: pointer;">';
      ?>
    <?php else : ?>
      <span id="status-mobile-loggedout" class="mdl-cell--hide-desktop mdl-cell--hide-tablet" style="float: right; padding-right: 16px;">
        <img src="/img/person.png" alt="Sign In" style="border-radius: 50%; height: 45px; width: 45px; cursor: pointer;">
      </span>
    <?php endif; ?>
    </span>
  </span>
  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="status-mobile">
    <li class="mdl-menu__item mdl-menu__item--full-bleed-divider" style="text-align: center;"><a href="/profile/" style="color: black; text-decoration: none"><i class="material-icons" style="vertical-align: middle;">person</i> Profile</a></li>
    <li class="mdl-menu__item" style="text-align: center;"><a href="/logout/" style="color: red; text-decoration: none;">Sign Out</a></li>
  </ul>
  <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="status-mobile-loggedout">
    <li class="mdl-menu__item mdl-menu__item--full-bleed-divider" style="text-align: center;"><a href="/join/" style="color: black; text-decoration: none">Sign Up</a></li>
    <li class="mdl-menu__item" style="text-align: center;"><a href="/login/" style="color: black; text-decoration: none;">Log In</a></li>
  </ul>
  <nav class="mdl-navigation">
    <?php if ($loggedin): ?>
      <a class="mdl-navigation__link" href="/dashboard/">Dashboard</a>
      <a class="mdl-navigation__link" href="/profile/">Profile</a>
    <?php else: ?>
      <a class="mdl-navigation__link" href="/join/">Sign Up</a>
      <a class="mdl-navigation__link" href="/login/">Login</a>
    <?php endif; ?>
    <a class="mdl-navigation__link" href="/benefits/">Benefits & Levels</a>
    <a class="mdl-navigation__link" href="/faq/">FAQ</a>
    <a class="mdl-navigation__link" href="/contact/">Contact Us</a>
    <?php if ($loggedin): ?>
      <a class="mdl-navigation__link" href="/logout/">Sign Out</a>
    <?php endif; ?>
  </nav>
</div>