#!/bin/bash
#
# Factory Hook: post-install
#
# This is necessary so that blt drupal:install tasks are invoked automatically
# when a site is created on ACSF.
#
# Usage: post-install.sh sitegroup env db-role domain

# Exit immediately on error and enable verbose log output.
set -ev

drush en sitefarm_default_content -y

drush pm-uninstall default_content rest hal serialization sitefarm_default_content single_content_sync -y
