=== Quick & Dry Login ===
Contributors: badasswp
Tags: login, user, quick, fast.
Requires at least: 4.0
Tested up to: 6.7.2
Stable tag: 1.0.4
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Convert your WordPress JPG/PNG images to WebP formats.

== Installation ==

1. Go to 'Plugins > Add New' on your WordPress admin dashboard.
2. Search for 'Quick & Dry Login' plugin from the official WordPress plugin repository.
3. Click 'Install Now' and then 'Activate'.

== Description ==

If you don't ever want to worry about entering in a username and password for your WP development or staging websites, then this plugin is exactly made for that purpose! You can select any user from the dropdown list of users and log into their session. As a caveat, this plugin should NEVER be used on a Production website!

== Changelog ==

= 1.0.4 =
* Add WP local dev env.
* Apply lint across codebase.
* Update README docs.
* Tested up to WP 6.7.2.

= 1.0.3 =
* Enqueue styles same way as scripts.
* Update styles for user dropdown.
* Fix bugs.
* Tested up to WP 6.6

= 1.0.2 =
* Fix Asset path for Styles & Scripts.
* Safely escape asset path.
* Fix linting issues.
* Tested up to WP 6.6

= 1.0.1 =
* Set Current User ID for logged in user.
* Use \WP Error objects, to gracefully handle 400, 401 errors.
* Fix async/await syntax typos, & console errors.
* Fix linting issues.
* Tested up to WP 6.5.5.

= 1.0.0 =
* Ability to select & login using any User profile.
* Custom WP REST endpoint for authenticating selected user.
* Custom Hooks - quick_dry_login_success, quick_dry_login_redirect.
* Multiple translations for Arabic, Israeli, Chinese, Indian, German, Italian, Spanish, Russian, French & Croatian languages.
* Tested up to WP 6.5.3.

== Contribute ==

If you'd like to contribute to the development of this plugin, you can find it on [GitHub](https://github.com/badasswp/quick-dry-login).
