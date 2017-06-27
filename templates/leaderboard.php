<?php

function getLeaderboard($lim,$con,$me = false,$amb = null) {

  echo '<ul class="demo-list-two mdl-list" style="padding: 0; margin: 0; width: 100%;">';

  $leaders = getLeaders($lim,$con); 
  
  foreach ($leaders as $leader) {

    echo '<li class="mdl-list__item mdl-list__item--two-line">';
      echo '<span class="mdl-list__item-primary-content">';
      
        if ($leader['image'] == '' || $leader['image'] == null) {
          echo '<i class="material-icons mdl-list__item-avatar" style="height: 50px; width: 50px; font-size: 50px;">person</i>';
        } else {
          echo '<img src="' . $leader['image'] . '" alt="' . $leader['fname'] . ' ' . substr($leader['lname'],0,1)  . '" style="border-radius: 50%; height: 50px; width: 50px; float: left; margin-right: 16px;">';
        }
        echo '<span>';
          echo $leader['fname'] . ' ' . substr($leader['lname'],0,1) . ' - ' . $leader['points'];
        echo '</span>';
        echo '<span class="mdl-list__item-sub-title">';
          echo $leader['city'] . ', ' . $leader['state'];
        echo '</span>';
      echo '</span>';
    echo '</li>';

  }

  if ($me) {
    echo '<li class="mdl-list__item mdl-list__item--two-line" style="border-top: 1px solid rgba(0,0,0,.12); margin: 8px;" )>';
      echo '<span class="mdl-list__item-primary-content">';
      
        if ($amb->getValue('image') == '' || $amb->getValue('image') == null) {
          echo '<i class="material-icons mdl-list__item-avatar" style="height: 50px; width: 50px; font-size: 50px;">person</i>';
        } else {
          echo '<img src="' . $amb->getValue('image') . '" alt="' . $amb->getValue('full-name')  . '" style="border-radius: 50%; height: 50px; width: 50px; float: left; margin-right: 16px;">';
        }
        echo '<span>';
          echo 'Me' . ' - ' . $leader['points'];
        echo '</span>';
        echo '<span class="mdl-list__item-sub-title">';
          echo $amb->getValue('city') . ', ' . $amb->getValue('state');
        echo '</span>';
      echo '</span>';
    echo '</li>';
  }

  echo '</ul>';

}