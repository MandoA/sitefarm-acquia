<?php
/**
 * @file
 * Robots.txt module settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

/**
 * Redirects *.ucdavis.edu traffic to https://
 */
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) &&
  preg_match("/(\.sf\.ucdavis\.edu)|(\.(test-)?(dev-)?ucdsitefarm\.acsitefactory\.com)$/", $_SERVER['HTTP_HOST']) &&
  (php_sapi_name() != "cli")) {
  //
  $config['robotstxt.settings']['content'] = 'User-agent: *\nDisallow: /';
}