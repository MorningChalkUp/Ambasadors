<?php

function getActions($count, $page, $amb, $con) {
  $activity = $amb->getActivityList($con);

  $activityList = array_slice($activity, ($page-1)*$count, $count);

  $showPrev = false;
  $showNext = false;

  if (count($activity) >= ($page * $count)) {
    $showPrev = true;
  }

  if ($page > 1) {
    $showNext = true;
  }

  echo '<table class="mdl-data-table mdl-js-data-table" style="width: 100%;">';
    echo '<tbody>';
      foreach ($activityList as $action) {
        echo '<tr>';
          echo '<td class="mdl-data-table__cell--non-numeric">';
            echo '<span style="border: 1px solid green; padding: 1px 2px; color: green;">';
              echo '+' . $action['points'];
            echo '</span>';
          echo '</td>';
          echo '<td class="mdl-data-table__cell--non-numeric" style="white-space: normal"';
            echo '<span>' . $action['email'] . '</span> Subscribed to the Morning Chalk Up.echo ';
          echo '</td>';
          echo '<td class="mdl-data-table__cell--non-numeric" style="text-align: right;">';
            echo '<i class="mdi mdi-clock"></i> ' . date('M j, Y', strtotime($action['su_time']));
          echo '</td>';
        echo '</tr>';
      }

      if ($showPrev || $showNext) {
        echo '<tr>';
          echo '<td colspan="3">';
            if ($showNext) {
              echo '<span style="float: left;"><a style="cursor:pointer;" href="?page=' . ($page-1) . '">< Next 10</a></span>';
            }
            if ($showPrev) {
              echo '<span style="float: right;"><a style="cursor:pointer;" href="?page=' . $page+1 . '">Previous 10 ></a></span>';
            }

          echo '</td>';
        echo '</tr>';
      }

    echo '</tbody>';
  echo '</table>';
}