<?php
/**
 * Plugin Name: Quick & Dry Login
 * Plugin URI:  https://github.com/badasswp/quick-dry-login
 * Description: Manually select any user profile to log into your WP development or staging website.
 * Version:     1.0.0
 * Author:      badasswp
 * Author URI:  https://github.com/badasswp
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: quick-dry-login
 * Domain Path: /languages
 *
 * @package QuickDryLogin
 */

namespace badasswp\QuickDryLogin;

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'RANDOM_NONCE', \mt_rand() );

/**
 * Add HTML select to WP login form.
 * 
 * @since 1.0.0
 * 
 * @wp-hook 'login_form'
 */
add_action( 'login_form', function() {
	?>
	<p class="quick-dry-login">
		<label>
			<?php _e( 'Quick & Dry Login', 'quick-dry-login' ) ?>
			<br />
			<select id="quick-dry-select">
				<option value="">Select User Profile</option>
				<?php foreach( get_users() as $user ) {
					printf(
						'<option value="%s">%s - %s</option>',
						esc_attr( $user->ID ),
						esc_html( ucfirst( get_userdata( $user->ID )->roles[0] ) ),
						esc_html( strtolower( $user->user_email ) ),
					);
				} ?>
			</select>
		</label>
	</p>
	<?php
} );

/**
 * Register custom API endpoint.
 * 
 * @since 1.0.0
 * 
 * @wp-hook 'rest_api_init'
 */
add_action( 'rest_api_init', function() {
	register_rest_route(
		'quick-dry-login/v1',
		'/(?P<nonce>[\d]+)/(?P<id>[\d]+)',
		[
			'methods'             => \WP_REST_Server::READABLE,
			'permission_callback' => '__return_true',
			'callback'            => function( $request ) {
				// Bail out, bad request.
				if ( ! isset( $request['id'] ) || ! get_user_by( 'id', $request['id'] ) ) {
					return rest_ensure_response( null, 400 );
				}

				// Bail out, un-authorized.
				if ( ! isset( $request['nonce'] ) || ! wp_verify_nonce( $request['nonce'], 'quick-dry-login' ) ) {
					return rest_ensure_response( null, 401 );
				}

				wp_set_auth_cookie( $request['id'], TRUE );

				/**
				 * Fire on user's login success.
				 * 
				 * @since 1.0.0
				 * 
				 * @param string $user_id User ID.
				 * @return void
				 */
				do_action( 'quick_dry_login_success', $request['id'] );

				return rest_ensure_response(
					[
						'userId' => $request['id']
					],
					200
				);
			},
		]
	);
} );

/**
 * Localise values for JS.
 * 
 * @since 1.0.0
 * 
 * @wp-hook 'login_enqueue_scripts'
 */
add_action( 'login_enqueue_scripts', function() {
	/**
	 * Filter Redirect URL.
	 * 
	 * On login, determine user's redirection.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string $redirect
	 * @return string
	 */
	$redirect_url = apply_filters( 'quick_dry_login_redirect', get_admin_url() );

	wp_enqueue_script(
		'quick-dry-scripts',
		plugins_url( 'quick-dry-login/scripts.js' ),
		[],
		'1.0.0',
		true
	);

	wp_localize_script(
		'quick-dry-scripts',
		'quickDryLogin',
		[
			'redirect' => $redirect_url,
			'nonce'    => wp_create_nonce( 'quick-dry-login' ),
			'restUrl'  => get_rest_url( null, 'quick-dry-login/v1' ),
		]
	);
} );

/**
 * Bind styles & scripts to WP hook.
 * 
 * @since 1.0.0
 * 
 * @wp-hook 'login_head'
 */
add_action( 'login_head', function() {
	printf(
		'<link
			href="%s"
			rel="stylesheet"
			type="text/css"
		/>',
		esc_attr( plugins_url( 'quick-dry-login/styles.css' ) )
	);
} );