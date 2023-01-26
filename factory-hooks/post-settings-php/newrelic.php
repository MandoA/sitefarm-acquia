<?php

/**
 * @file
 * Adds settings files
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

if (extension_loaded('newrelic')) {

  if (!function_exists('gardens_data_get_sites_from_file')) {

    /**
     * Get the domains defined for the given site.
     *
     * @param string $name
     *   The technical ACSF site name to filter on.
     * @param bool $reset
     *   Whetever to reset APC cache or not.
     *
     * @return array|mixed|null
     *   An array of sites indexed by domain that matches the given site name.
     */
    function gardens_data_get_sites_from_file($name, $reset = FALSE) {
      static $domains = NULL;
      if (!isset($domains)) {
        $cid = 'domains-' . $name;
        if (
          !$reset
          && GARDENS_SITE_DATA_USE_APC
          && ($data = gardens_site_data_cache_get($cid)) !== FALSE
        ) {
          $domains = $data;
        }
        elseif ($map = gardens_site_data_load_file()) {
          $domains = array_filter(
            $map['sites'],
            function ($item) use ($name) {
              return $item['name'] == $name;
            }
          );
          if (GARDENS_SITE_DATA_USE_APC) {
            gardens_site_data_cache_set($cid, $domains);
          }
        }
        else {
          $domains = [];
        }
      }
      return $domains;
    }

  }

  $env = $_ENV['AH_SITE_ENVIRONMENT'] ?? 'local';

  // Get all the domains that are defined for the current site.
  $domains = gardens_data_get_sites_from_file($GLOBALS['gardens_site_settings']['conf']['acsf_db_name']);
  // Get the site's name from the first domain.
  global $_acsf_site_name;
  $_acsf_site_name = explode('.', array_keys($domains)[0])[0];
  newrelic_set_appname("ucdsitefarm.$env.$_acsf_site_name; ucdsitefarm.$env", '', 'true');
}
