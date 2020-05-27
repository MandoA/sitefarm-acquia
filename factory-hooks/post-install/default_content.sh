#!/bin/sh
#
# Factory Hook: post-site-install
#
# The existence of one or more executable files in the
# /factory-hooks/post-site-install directory will prompt them to be run
# *after* the regular site install (drush site-install) command. So
# do not include that command as part of this script.
#
# Usage: SCRIPTNAME site env db-role domain custom-arg1 custom-arg2 ...
# Map the script inputs to convenient names.
# Acquia hosting site / environment names
site="$1"
env="$2"

# database role. (Not expected to be needed in most hook scripts.)
db_role="$3"

# The public domain name of the website.
domain="$4"


echo "site: $site"
echo "env: $env"
echo "db role: $db_role"
echo "domain: $domain"

# The websites' document root can be derived from the site/env:
docroot="/var/www/html/$site.$env/docroot"

# Acquia recommends the following two practices:
# 1. Hardcode the drush version.
# 2. When running drush, provide the application + url, rather than relying
#    on aliases. This can prevent some hard to trace problems.
DRUSH_CMD="drush9 --root=$docroot --uri=https://$domain"

$DRUSH_CMD en sitefarm_default_content -y

$DRUSH_CMD pmu hal serialization rest default_content sitefarm_default_content -y