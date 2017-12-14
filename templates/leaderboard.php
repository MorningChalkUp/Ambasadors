<?php

function getLeaderboard($lim,$con,$me = false,$amb = null) {

  echo '<ul class="demo-list-two mdl-list" style="padding: 0; margin: 0; width: 100%;">';

  $leaders = getLeaders($lim,$con); 
  
  foreach ($leaders as $leader) {

    echo '<li class="mdl-list__item mdl-list__item--two-line">';
      echo '<span class="mdl-list__item-primary-content">';
      
        echo '<img src="/img/uploads/' . $leader['image'] . '" alt="' . $leader['fname'] . ' ' . substr($leader['lname'],0,1)  . '" style="border-radius: 50%; height: 50px; width: 50px; float: left; margin-right: 16px;">';
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
    echo '<li class="mdl-list__item mdl-list__item--two-line" style="border-top: 1px solid rgba(0,0,0,.12); margin: 8px 0px;" )>';
      echo '<span class="mdl-list__item-primary-content">';
      
        echo '<img src="/img/uploads/' . $amb->getValue('image') . '" alt="' . $amb->getValue('full-name')  . '" style="border-radius: 50%; height: 50px; width: 50px; float: left; margin-right: 16px;">';
        echo '<span>';
          echo 'Me' . ' - ' . $amb->getValue('points');
        echo '</span>';
        echo '<span class="mdl-list__item-sub-title">';
          echo $amb->getValue('city') . ', ' . $amb->getValue('state');
        echo '</span>';
      echo '</span>';
    echo '</li>';
  }

  echo '</ul>';

}

function getLeaderboardAdmin($con) {

  echo '<table class="mdl-data-table mdl-js-data-table" style="width: 100%;border:none;table-layout:fixed;">';
    echo '<thead>';
      echo '<tr>';
        echo '<th class="mdl-data-table__cell--non-numeric">Name</th>';
        echo '<th class="mdl-data-table__cell--non-numeric">Location</th>';
        echo '<th>Points</th>';
        echo '<th class="mdl-data-table__cell--non-numeric">Dashboard</th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $leaders = getLeaders(0,$con); 
    
    foreach ($leaders as $leader) {
      echo '<tr>';
        echo '<td class="mdl-data-table__cell--non-numeric">';
          echo $leader['fname'] . ' ' . $leader['lname'];
        echo '</td>';
        echo '<td class="mdl-data-table__cell--non-numeric">';
           echo $leader['city'] . ', ' . $leader['state'];
        echo '</td>';
        echo '<td>';
          echo $leader['points'];
        echo '</td>';
        echo '<td class="mdl-data-table__cell--non-numeric">';
          echo '<a href="/dashboard/?u=' . $leader['username'] . '">Dashboard</a>';
        echo '</td>';
      echo '</tr>';
    }

    echo '</tbody>';
  echo '</table>';

}