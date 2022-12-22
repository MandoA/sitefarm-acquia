<?php

/**
 * @file
 * Adds settings files
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

if (extension_loaded('newrelic')) {
  $env = 'local';

  if (isset($_ENV['AH_SITE_ENVIRONMENT'])) {
    $env = $_ENV['AH_SITE_ENVIRONMENT'];
  }

  global $_acsf_site_name;
  newrelic_set_appname("ucdsitefarm.$env.$_acsf_site_name; ucdsitefarm.$env", '', 'true');
}
