<?php
/**
 * Redirects *.ucdavis.edu traffic to https://
 */
error_log("AH_SITE_ENVIRONMENT: ". $_SERVER['AH_SITE_ENVIRONMENT']);
error_log("HTTPS: ". $_SERVER['HTTPS']);
error_log("HTTP_X_SSL: ". $_SERVER['HTTP_X_SSL']);
error_log("HTTP_HOST: ". $_SERVER['HTTP_HOST']);
error_log("REQUEST_URI: ". $_SERVER['REQUEST_URI']);
error_log("php_sapi_name: ". php_sapi_name());
error_log("preg_match: ". preg_match("/ucdavis\.edu$/", $_SERVER['HTTP_HOST']));

if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
  ($_SERVER['HTTPS'] === 'OFF') &&
  preg_match("/ucdavis\.edu$/", $_SERVER['HTTP_HOST']) &&
  (php_sapi_name() != "cli")) {
  if (!isset($_SERVER['HTTP_X_SSL']) ||
    (isset($_SERVER['HTTP_X_SSL']) && $_SERVER['HTTP_X_SSL'] != 'ON')) {
    header('HTTP/1.0 301 Moved Permanently');
    header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
  }
}