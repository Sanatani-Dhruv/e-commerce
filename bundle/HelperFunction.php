<?php

// print_r($_SERVER);

function out($data) {
  return htmlspecialchars($data);
}

function view($string) {
  require __DIR__ . "/../resources/views/$string";
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
