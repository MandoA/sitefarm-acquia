#!/bin/sh
#
# Factory Hook: db-update
#
# The existence of one or more executable files in the
# /factory-hooks/db-update directory will prompt them to be run
# *instead of* the regular database update (drush updatedb) command. So
# that update command will normally be part of the commands executed
# below.
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

# Custom argument: we will run entity updates if it is in any way
# nonempty.
update_entities="$5"

# The websites' document root can be derived from the site/env:
docroot="/var/www/html/$site.$env/docroot"

# Acquia recommends the following two practices:
# 1. Hardcode the drush version.
# 2. When running drush, provide the application + url, rather than relying
#    on aliases. This can prevent some hard to trace problems.
DRUSH_CMD="drush8 --root=$docroot --uri=https://$domain"

# Now update database.
$DRUSH_CMD updatedb -y

# Run entity updates if the updatedb command didn't fail.
if [ $? -eq 0 -a -n "$update_entities" ] ; then
    # Possibly do some preparation here...
    $DRUSH_CMD entity-updates
fi

# Purge all Acquia and Fastly caches.
$DRUSH_CMD cr -y
$DRUSH_CMD p:invalidate everything -y
