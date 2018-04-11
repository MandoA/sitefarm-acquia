<?php
/**
 * @file
 * CAS module settings.
 *
 * This file will be included into settings.php for all sites on Site Factory.
 */
if (isset($_SERVER['AH_SITE_ENVIRONMENT']) && ($_SERVER['AH_SITE_ENVIRONMENT'] ==  'prod')) {
  // Prod environment should use the Prod CAS Server.
  $config['cas.settings']['server']['hostname'] = 'cas.ucdavis.edu';
}
else {
  // All other installations should use the Dev CAS Server.
  $config['cas.settings']['server']['hostname'] = 'ssodev.ucdavis.edu';
}
$config['cas.settings']['server']['version'] = '3.0';
$config['cas.settings']['server']['port'] = '443';
$config['cas.settings']['server']['path'] = '/cas';
$config['cas.settings']['server']['verify'] = '0';
$config['cas.settings']['server']['cert'] = '';
$config['cas.settings']['user_accounts']['restrict_password_management'] = TRUE;
$config['cas.settings']['logout']['logout_destination'] = 'https://cas.ucdavis.edu/cas/logout';
$config['cas.settings']['logout']['cas_logout'] = TRUE;
$config['cas.settings']['login_link_enabled'] = TRUE;
$config['cas.settings']['login_link_label'] = 'UC Davis Login';
