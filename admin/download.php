<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require '../inc/functions.php';

redirectIfLoggedOut('/login/');
redirectIfNotAdmin('/dashboard/');

$headers = array(
  'First Name',
  'Last Name',
  'Points',
  'Address',
  'City',
  'State',
  'Zip',
  'Username',
  'Shirt Size',
  'Shirt Type',
  'Join Time',
);

$leaders = getLeaders(0,$con);

$output[] = $headers;

foreach ($leaders as $leader) {
  $laderArray = [
    $leader['fname'],
    $leader['lname'],
    $leader['points'],
    $leader['address'],
    $leader['city'],
    $leader['state'],
    $leader['zip'],
    $leader['username'],
    $leader['shirt_size'],
    $leader['shirt_type'],
    $leader['join_time'],
  ];
  $output[] = $laderArray;
}

$file = date('Y_m_d_H_i_s') . '_ambassador_export.csv';

array_to_csv_download($output, $file, ',');


function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');

    // open the "output" stream
    // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
    $f = fopen('php://output', 'w');

    foreach ($array as $line) {
        fputcsv($f, $line, $delimiter);
    }
}   