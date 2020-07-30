# Demo Framework (DF)
[![Travis build status](https://api.travis-ci.org/acquia/df.svg?branch=8.x-2.x)](https://travis-ci.org/acquia/df) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/acquia/df/badges/quality-score.png?b=8.x-3.x)](https://scrutinizer-ci.com/g/acquia/df/?branch=8.x-3.x)

Demo Framework is a distribution consisting of modules, themes and libraries. It highlights powerful features created by the Drupal community. It is intended to be used as a starterkit for promoting enterprise-ready solutions.

Demo Framework is powered by [Lightning](https://www.drupal.org/project/lightning).

## Installing Demo Framework

The preferred way to install Demo Framework is using our [Composer-based project template][template]. It's easy!

Once you have a docroot built, you can use DDev, Acquia Developer Studio or any other similar project to get started.

  ``ddev config --project-name df --project-type drupal8 && ddev start``
  
  or
  
  ``ads new webpsite``

Now use the ``site-install`` command to install Drupal with the DF installation profile.

  ``drush si df``

You may now login to your site.

  ``drush uli``
  
By default, you will be asked to select a demo scenario to install.

![Install Demo](https://user-images.githubusercontent.com/1102654/70927089-f9ff6600-1ff3-11ea-8d42-d37eb745056b.png)

Installation may take a few minutes depending on your environment. ☕️


## Deploying Demo Framework using version control

If you are using version control to deploy the Demo Framework to a server (such as Acquia Cloud), note that you must edit the file `/profiles/df/.gitignore` and remove the following lines:

```
# Contrib
modules/contrib/*
themes/contrib/*

# Libraries
libraries/*
```

If you do not do so, you will see an error in the installation referring to missing modules.

## Using the [Radix](https://www.drupal.org/project/radix) Sub Theme

To modify the CSS/JS you must use the scss files. You will find various different SCSS files in src/sass. You can override variables in src/sass/base/_variables.scss.

To compile scss you will need NPM ([How To Install NPM](http://blog.npmjs.org/post/85484771375/how-to-install-npm)) installed on your machine.

When you have NPM installed on your machine, you will need to run ``npm install`` to install the NPM packages. Once they are installed, you can run ``npm run dev`` to compile the scss files or run ``npm run production`` to compile and minify the scss files.

## Running Tests
These instructions assume you have used Composer to install Lightning. Once you
have it up and running, follow these steps to execute all of Lightning's Behat
tests:

### Behat
    $ cd MYPROJECT
    $ ./bin/drupal behat:init http://YOUR.DF.SITE --merge=../docroot/profiles/df/tests/behat.yml
    $ ./bin/drupal behat:include ../docroot/profiles/df/tests/features --with-subcontexts=../docroot/profiles/df/tests/features/bootstrap --with-subcontexts=../docroot/profiles/df/src/DFExtension/Context --with-subcontexts=../docroot/profiles/lightning/src/LightningExtension/Context
    $ ./bin/behat --config ./docroot/sites/default/files/behat.yml

If necessary, you can edit ```docroot/sites/default/files/behat.yml``` to match
your environment, but generally you will not need to do this.

## Resources

Please file issues in our [drupal.org issue queue][issue_queue].

[issue_queue]: https://www.drupal.org/project/issues/df "Demo Framework Issue Queue"
[template]: https://github.com/acquia/df-project "Composer-based project template"
[d.o_semver]: https://www.drupal.org/node/1612910
[df_composer_project]: https://github.com/acquia/df-project
