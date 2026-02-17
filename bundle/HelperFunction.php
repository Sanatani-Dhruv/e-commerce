<?php

// print_r($_SERVER);

function out($data) {
  return htmlspecialchars($data);
}

function env($data, bool $get = true, $specialChars = true) {
  $data = ($specialChars) ? htmlspecialchars($data) : $data;
  return ($get) ? getenv($data) : putenv($data);
}

function view($string, array $passArgs = []) {
  $obj = new App\Viewer\View();
  $obj->view($string, $passArgs);
}

function url(string $action) {
  $_SERVER['PATH_INFO'] = (!isset($_SERVER['PATH_INFO']) ? '/' : $_SERVER['PATH_INFO']);
  if ($action == 'get') {
    return $_SERVER['PATH_INFO'];
  }

  if ($action == 'getFull') {
    return $_SERVER['REQUEST_URI'];
  }
}

function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	

function nodetailfound() {
  echo "<div class='php-no-detail-found'>";
  echo "No Account Found with Such Details!";
  echo "</div>";
}

function detailfound() {
  echo "<div class='php-status-success-message'>";
  echo "Login Successful!";
  echo "</div>";
}
?>
