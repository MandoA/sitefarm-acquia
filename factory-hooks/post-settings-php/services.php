<?php

/**
 * @file
 * Adds a new services.yml files
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */

// cors.services.yml from custom theme to adjust CORS settings.
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/themes/site/cors.services.yml';


// Adding custom services.yml for all sites.
$settings['container_yamls'][] = __DIR__ . '/services.yml';
