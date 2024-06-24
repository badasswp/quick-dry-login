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

/**
 * Add HTML select to WP login form.
 * 
 * @since 1.0.0
 * 
 * @wp-hook 'login-form'
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