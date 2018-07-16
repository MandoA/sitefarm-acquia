<?php

/**
 * Redirects ucdsitefarm.acsitefactory.com traffic to sf.ucdavis.edu
 */
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
    preg_match("/(.*)\.(dev|test|)-?ucdsitefarm\.acsitefactory\.com$/", $_SERVER['HTTP_HOST'], $matches) &&
    php_sapi_name() != "cli") {
  $site = strip_tags($matches[1]);
  $env = strip_tags($matches[2]);
  switch ($env) {
    case '':
      $domain = $site . '.sf.ucdavis.edu';
      break;
    case 'test':
      $domain = $site . '.test.sf.ucdavis.edu';
      break;
    case 'dev':
      $domain = $site . '.dev.sf.ucdavis.edu';
      break;
  }
  header('HTTP/1.0 301 Moved Permanently');
  header('Location: https://' . $domain . $_SERVER['REQUEST_URI']);
}

/**
 * Redirects *.ucdavis.edu traffic to https://
 */
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
  ($_SERVER['HTTPS'] != 'on') &&
  preg_match("/ucdavis\.edu$/", $_SERVER['HTTP_HOST']) &&
  (php_sapi_name() != "cli")) {
    header('HTTP/1.0 301 Moved Permanently');
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}