# Hyp Contributors

A WordPress plugin to add contributors to post/page, based on [rtCamp](https://rtcamp.com/) WordPress-Contributors Plugin assignment.

## Usage

1. Download the [plugin .zip file](https://github.com/JuniorTak/hypwpcontributors/raw/main/hypcontributors.1.0.0.zip)
2. In the admin-side of your WordPress site, install and activate the plugin
3. Go to **Users** and add some WordPress users
4. Add a new post or edit an existing one
5. From the post settings in the editor side panel, scroll down to **Contributors** section
6. Check usernames to add post contributors
7. Click **Publish** or **Update** when you finish
8. In the front-side of your WordPress site, visit the post to see the contributors box right below the post content

## Demo

http://hyp4rt.infinityfreeapp.com/2024/05/04/demo-post/

## Running Tests

Before running tests, make sure to properly set up the [WordPress Testing Suite](https://make.wordpress.org/cli/handbook/misc/plugin-unit-tests/#running-tests-locally) which requires [WP-CLI](https://make.wordpress.org/cli/handbook/guides/installing/).

Then, run the following command to install [Composer](https://getcomposer.org/) dependencies

```bash
  composer install
```

To run tests, run the following command

```bash
  ./vendor/bin/phpunit tests/TestHypContributors.php
```

If you encounter any issue while setting up PHP Unit Tests, please refer to this [guide on fixing common issues while setting up php unit tests for wordpress plugins](https://sanjeebaryal.com.np/fixing-issues-while-setting-up-php-unit-tests-for-wordpress-plugins/).
