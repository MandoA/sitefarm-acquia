This is a SiteFarm Composer-based Drupal distribution for Acquia Hosting.

# Configuring Your Localhost

## Step 1: Install Composer

[Install composer globally.](https://getcomposer.org/doc/00-intro.md) 

Recommended: Install [Prestissimo](https://github.com/hirak/prestissimo) globally:

`$ composer global require hirak/prestissimo`

## Step 2: Fire Up Local Dev Stack

Install and enable [Docksal](https://docksal.io) (recommended), [MAMP](https://www.mamp.info/), [WAMP](http://www.wampserver.com/), [LAMP](https://en.wikipedia.org/wiki/LAMP_(software_bundle)), or whatever you local development environment of choice and make sure the [Web Server System Requirements](https://www.drupal.org/docs/8/system-requirements/web-server) for Drupal 8 are being met.

## Step 3: Configure Your Local Host

### Docksal

Open your CLI of choice and navigate to the SiteFarm Acquia directory (`sitefarm-acquia`).

Run, `$ fin init`

The script will prompt you for your sudo password, and then at the end provide you with a login link.

You're done! You can skip the rest of the steps.

### Other Local Dev Stack

You will want to set up a local host on your local PHP/MySQL tool of choice. Give it a name like `sitefarm-acquia.local` and set the document root to `sitefarm-acquia/docroot`

## Step 5: Boss Composer Around (ignore if using Docksal)

Open your CLI of choice and navigate to the SiteFarm Acquia directory (`sitefarm-acquia`).

Run, `$ composer install`

Composer will download and install the SiteFarm install profile. You can then install it like you would any other Drupal site.

## Step 6: Add a Database (ignore if using Docksal)

Using a tool like [Sequel Pro](https://www.sequelpro.com/) or [phpMyAdmin](https://www.phpmyadmin.net/) create a local database.

Copy `docroot/sites/default/default.settings.local.php` and `default.services.local.yml` to `settings.local.php` and `services.local.yml` respectively.

Add your new database connection information into settings.local.php

## Step 7: Install Drupal (ignore if using Docksal)

Before installing drupal you may want to increase your `memory_limit` in your `php.ini` file. I like to bump it up to `520M`. You may also want to increase your `post_max_size` to `120M`. This will reduce the likelihood of errors on install.

Open the SiteFarm Acquia web directory(`sitefarm-acquia/docroot`) in your browser or use the local host name, my example was `sitefarm-acquia.local` and follow the instructions to install Drupal.

# Local Dev Tips

## Running Behat with Docksal

Docksal includes Docker images for running Behat with selenium and the chrome driver. No need to install anything else.

`$ fin behat` = Runs all behat tests

`$ fin behat --tags=@local` = Runs all behat tests with the `@local` tag

`$ fin bhl` = Shortcut for `$ fin behat --tags=@local`

A VNC window will open displaying the browser as it goes through the `@javascript` tests. If your OS doesn't support that, follow the connection information that is displayed in the script output.

## Updating Drupal Core

This project will attempt to keep all of your Drupal Core files up-to-date; the 
project [drupal-composer/drupal-scaffold](https://github.com/drupal-composer/drupal-scaffold) 
is used to ensure that your scaffold files are updated every time drupal/core is 
updated. If you customize any of the "scaffolding" files (commonly .htaccess), 
you may need to merge conflicts if any of your modfied files are updated in a 
new release of Drupal core.

Follow the steps below to update your core files.

1. Run `composer update drupal/core --with-dependencies` to update Drupal Core and its dependencies.
1. Run `git diff` to determine if any of the scaffolding files have changed. 
   Review the files for any changes and restore any customizations to 
  `.htaccess` or `robots.txt`.
1. Commit everything all together in a single commit, so `docroot` will remain in
   sync with the `core` when checking out branches or running `git bisect`.
1. In the event that there are non-trivial conflicts in step 2, you may wish 
   to perform these steps on a branch, and use `git merge` to combine the 
   updated core files with your customized files. This facilitates the use 
   of a [three-way merge tool such as kdiff3](http://www.gitshah.com/2010/12/how-to-setup-kdiff-as-diff-tool-for-git.html). This setup is not necessary if your changes are simple; 
   keeping all of your modifications at the beginning or end of the file is a 
   good strategy to keep merges easy.

## Maintenance
Let this handy table be your guide to updating with Compser:

| Task                                            | Composer                                          |
|-------------------------------------------------|---------------------------------------------------|
| Installing a contrib project (latest version)   | ```composer require drupal/PROJECT:8.*```         |
| Installing a contrib project (specific version) | ```composer require drupal/PROJECT:8.1.0-beta3``` |
| Updating all contrib projects and Drupal core   | ```composer update```                             |
| Updating a single contrib project               | ```composer update drupal/PROJECT```              |
| Updating Drupal core                            | ```composer update drupal/core```                 |


The magic is that Composer, unlike Drush, is a *dependency manager*. If module ```foo-8.x-1.0``` depends on ```baz-8.x-3.2```, Composer will not let you update baz to ```8.x-3.3``` (or downgrade it to ```8.x-3.1```, for that matter). Drush has no concept of dependency management. If you've ever accidentally hosed a site because of dependency issues like this, you've probably already realized how valuable Composer can be.

**you still need Drush or Drupal Console**. Tasks such as database updates (```drush updatedb```) are still firmly in Drush's province.

**Composer is only responsible for maintaining the code base**.

## Source Control
If you peek at the ```.gitignore``` we provide, you'll see that certain directories, including all directories containing contributed projects, are excluded from source control. This might be a bit disconcerting if you're newly arrived from Planet Drush, but in a Composer-based project like this one, **you SHOULD NOT commit your installed dependencies to source control**.

Composer creates a file called ```composer.lock```, which is a list of which dependencies were installed, and in which versions. **Commit ```composer.lock``` to source control!** Then, when your colleagues want to spin up their own copies of the project, all they'll have to do is run ```composer install```, which will install the correct versions of everything in ```composer.lock```.
