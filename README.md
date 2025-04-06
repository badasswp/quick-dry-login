# quick-dry-login

Manually select any user profile to log into your WP development or staging website.

> <span style="color:red">**WARNING:**</span>
>
> This plugin should NEVER be used on a Production website.

## Download

You can also get the latest version from any of our [release tags](https://github.com/badasswp/quick-dry-login/releases).

## Why Quick & Dry Login

If you don't ever want to worry about entering in a `username` and `password` for your WP development or staging websites, then this plugin is exactly made for that purpose! You can select any user from the dropdown list of users and log into their session. As a caveat, __this plugin should NEVER be used on a Production website!__

https://github.com/badasswp/quick-dry-login/assets/149586343/4d37520f-7d19-4171-9823-29f22038fec1

### Hooks

#### `quick_dry_login_success`

This custom hook (action) fires immediately after the user has successfully being logged into your WP instance.

```php
add_action( 'quick_dry_login_success', [ $this, 'log_user_time' ] );

public function log_user_time( $user_id ): void {
    update_user_meta( $user_id, 'login_time', time() );
}
```

**Parameters**

- user_id _`{int}`_ The User ID for the user that was just logged in.
<br/>

#### `quick_dry_login_redirect`

This custom hook (filter) provides the ability to modify the destination URL after a user has been logged in:

```php
add_filter( 'quick_dry_login_redirect', [ $this, 'send_user_to_post' ], 10 );

public function send_user_to_post( $url ): string {
    if ( $url ) {
        return add_query_arg(
            [
              'post_type' => 'post',
            ],
            get_admin_url( 'edit.php' )
        );
    }

    return $url;
}
```

**Parameters**

- url _`{string}`_ The default WP Admin URL.

---

## Contribute

Contributions are __welcome__ and will be fully __credited__. To contribute, please fork this repo and raise a PR (Pull Request) against the `master` branch.

### Pre-requisites

You should have the following tools before proceeding to the next steps:

- Composer
- Yarn
- Docker

To enable you start development, please run:

```bash
yarn start
```

This should spin up a local WP env instance for you to work with at:

```bash
http://apbe.localhost:5417
```

You should now have a functioning local WP env to work with. To login to the `wp-admin` backend, please use `admin` for username & `password` for password.

__Awesome!__ - Thanks for being interested in contributing your time and code to this project!
