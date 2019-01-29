This is an abbreviated set of instructions. For full information on creating a subtheme, please visit the [SiteFarm Local Installation training page](https://sitefarm.ucdavis.edu/training/builders/setting-local-development).

# Run your SiteFarm Site Locally

You will need a LAMP style development environment setup with Apache, PHP, and MySQL. The recommended tool is [Docksal](https://docksal.io/). This free, open-source app simplifies the process immensely.

1. [Install Docksal](https://docksal.io/installation)
2. Open a Terminal window, and navigate to the root of the unpacked folder that you downloaded from Site Factory.
    - Be sure you're in the root of that directory. If you run `ls -al` you should see files with names: .docksal, acquia-pipelines.yml, composer.lock, etc.
3. Run one command: `fin themer/init`

If you want to use something different, there are many options available such as [MAMP](https://www.mamp.info), [WAMP](http://www.wampserver.com/en/),  or [Drupal VM](https://www.drupalvm.com/). Just know that you will have to perform all the configuration that Docksal would otherwise do for you automatically. So it's a lot more work.