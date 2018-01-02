<?php
/**
 * @file
 * Adds a new services.yml file to update CORS settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
$settings[‘container_yamls’][] = DRUPAL_ROOT . ‘/sites/cors.services.yml’;