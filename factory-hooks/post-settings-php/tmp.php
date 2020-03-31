<?php
/**
 * @file
 * /tmp directory location settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
$config['system.file']['path']['temporary'] =
  "/mnt/gfs/{$_ENV['AH_SITE_GROUP']}.{$_ENV['AH_SITE_ENVIRONMENT']}/tmp";