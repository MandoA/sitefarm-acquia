<?php

/**
 * @file
 * Adds settings files
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

if (extension_loaded('newrelic')) {
  $exploded_path = explode('/', dirname(__FILE__));
  $site_domain = array_pop($exploded_path);
  $sf_env = $_SERVER['AH_SITE_ENVIRONMENT'];
  newrelic_set_appname("$site_domain;ucdsitefarm.$sf_env", '', 'true');
}
