This is a SiteFarm Composer-based Drupal distribution for Acquia Hosting.

## Get Started
You will need the following installed:

* [Composer](https://getcomposer.org), obviously

When you have that, run this command:
```
$ composer install
```
Composer will download and install the SiteFarm install profile. You can then install it like you would any other Drupal site.

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

