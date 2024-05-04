# wpcs-JuniorTak

This is the Github repo of my codes for the submission of the rtCamp WordPress Plugin Assignment. It is based on a Github [template repo](https://help.github.com/en/github/creating-cloning-and-archiving-repositories/creating-a-template-repository).

Assignment: WordPress-Contributors Plugin

## Usage

1. Download the [plugin .zip file](https://www.dropbox.com/scl/fi/yhacgrp0wyigvbrycc5d0/hyp4rtcontributors.1.0.0.zip?rlkey=1h1xtu6k19dmnwo4gtpmfih2e&st=5ddyg8q7&dl=0)
2. In the admin-side of your WordPress site, install and activate the plugin
3. Add some WordPress users
4. Add a new post or edit an existing one
5. From the post settings in the editor side panel, scroll down to Contributors section
6. Check usernames to add post contributors
7. Click **Publish** or **Update** when you finish.
8. In the front-side of your WordPress site, visit the post to see the contributors box right below the post content.

## Demo

http://hyp4rt.infinityfreeapp.com/2024/05/04/demo-post/

## Running Tests

Before running tests, make sure to properly set up the [WordPress Testing Library](https://make.wordpress.org/core/handbook/testing/automated-testing/).

Run the following [Composer](https://getcomposer.org/) commands to install dependencies

```bash
  composer require --dev phpunit/phpunit
  composer require --dev yoast/phpunit-polyfills
  composer install
```

To run tests, run the following command

```bash
  ./vendor/bin/phpunit tests/TestHypContributors.php
```
