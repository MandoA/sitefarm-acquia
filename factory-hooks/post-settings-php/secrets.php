<?php
/**
 * @file
 * Contains super secret settings. Shhh...
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
$secrets_file = '/home/ucdsitefarm/secrets/secrets.settings.php';
if (file_exists($secrets_file)) {
  require $secrets_file;
}