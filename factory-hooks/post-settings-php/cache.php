<?php
/**
 * @file
 * Caching settings module settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
// Set max age for Varnish cache as defined in https://docs.acquia.com/site-factory/manage/website/cache/modify/
$config['system.performance']['cache']['page']['max_age'] = 7776000; // 90 days

// Setting "Soft Purge" for Fastly only when using Drush.
if (php_sapi_name() == 'cli') {
  $config['fastly.settings']['purge_method'] = 'soft';
}
else {
  $config['fastly.settings']['purge_method'] = 'instant';
}

// More Fastly settings
$config['fastly.settings']['site_id'] = $databases['default']['default']['database'];
$config['fastly.settings']['cache_tag_hash_length'] = 5;
