<?php
/**
 * Redirects *.ucdavis.edu traffic to https://
 */
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
  ($_SERVER['HTTPS'] != 'on') &&
  preg_match("/ucdavis\.edu$/", $_SERVER['HTTP_HOST']) &&
  (php_sapi_name() != "cli")) {
    header('HTTP/1.0 301 Moved Permanently');
    header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}