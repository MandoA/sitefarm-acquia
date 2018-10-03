<?php
/**
 * @file
 * Caching settings module settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
// Set max age for Varnish cache as defined in https://docs.acquia.com/site-factory/manage/website/cache/modify/
$config['system.performance']['cache']['page']['max_age'] = 21600;
