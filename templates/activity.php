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

  echo '<table class="mdl-data-table mdl-js-data-table" style="width: 100%;border:none;table-layout:fixed;">';
    echo '<tbody>';
      if (count($activityList) > 0) {
        foreach ($activityList as $action) {
          if ($action['id_type'] == 'aid') {
            $short_desc = 'Subscribed';
          } elseif ($action['id_type'] == 'pid') {
            $short_desc = 'Joined Amassadors';
          }
          echo '<tr>';
            echo '<td class="mdl-data-table__cell--non-numeric" width="55" style="padding:15px">';
              echo '<span style="border: 1px solid green; padding: 1px 2px; color: green;">';
                echo '+' . $action['points'];
              echo '</span>';
            echo '</td>';
            echo '<td class="mdl-data-table__cell--non-numeric">';
              echo '<span style="color: green; font-weight: 700;">' . $action['email'] . '</span><span class="mdl-cell--hide-phone"> ' . $action['description'] . '</span><span class="mdl-cell--hide-desktop mdl-cell--hide-tablet"> ' . $short_desc . '</span>';
            echo '</td>';
            echo '<td class="" style="width:130px">';
              echo '<i class="mdi mdi-clock"></i> <span class="mdl-cell--hide-tablet mdl-cell--hide-phone">' . date('M j, Y', strtotime($action['su_time'])) . '</span><span class="mdl-cell--hide-desktop">' . date('m/d/y', strtotime($action['su_time'])) . '</span>';
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
                echo '<span style="float: right;"><a style="cursor:pointer;" href="?page=' . ($page+1) . '">Previous 10 ></a></span>';
              }

            echo '</td>';
          echo '</tr>';
        }
      } else {
        echo '<tr>';
          echo '<td colspan="3" class="mdl-data-table__cell--non-numeric" style="white-space: normal">';
            echo "Nothing yet. Share your link to get some signups!";
          echo '</td>';
        echo '</tr>';
      }

    echo '</tbody>';
  echo '</table>';
}