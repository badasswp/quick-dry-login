# quick-dry-login

Manually select any user profile to log into your WP development or staging website.

> <span style="color:red">**WARNING:**</span>
>
> This plugin should NEVER be used on a Production website.

## Download

You can also get the latest version from any of our [release tags](https://github.com/badasswp/quick-dry-login/releases).

#### `quick_dry_login_success`

This custom hook (action) fires immediately after the user has successfully being logged into your WP instance.

```php
add_action( 'quick_dry_login_success', [ $this, 'log_user_time' ] );

public function log_user_time( $user_id ): void {
	update_user_meta( $user_id, 'login_time', time() );
}
```