<?php

/**
 * @file
 * Adds settings files
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

if (extension_loaded('newrelic')) {
// Get all the domains that are defined for the current site.
  $domains = gardens_data_get_sites_from_file($GLOBALS['gardens_site_settings']['conf']['acsf_db_name']);
// Get the site's name from the first domain.
  global $_acsf_site_name;
  $_acsf_site_name = explode('.', array_keys($domains)[0])[0];
  $sf_env = $_SERVER['AH_SITE_ENVIRONMENT'];
  newrelic_set_appname("$_acsf_site_name;ucdsitefarm.$sf_env", '', 'true');
}
