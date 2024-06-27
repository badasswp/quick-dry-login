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

**Parameters**

- user_id _`{int}`_ The User ID for the user that was just logged in.

#### `quick_dry_login_redirect`

This custom hook (filter) provides the ability to modify the destination URL after a user has been logged in:

```php
add_filter( 'quick_dry_login_redirect', [ $this, 'send_user_to_post' ], 10 );

public function send_user_to_post( $url ): string {
	if ( $url ) {
		return add_query_arg(
			[
				'post_type' => 'post'
			],
			get_admin_url( 'edit.php' )
		);
	}
	
	return $url;
}
```

**Parameters**

- url _`{string}`_ The default WP Admin URL.