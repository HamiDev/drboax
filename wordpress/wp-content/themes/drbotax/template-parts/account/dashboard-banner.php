<?php
/**
 * Account dashboard greeting banner.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_user = wp_get_current_user();
$drbotax_name = $drbotax_user instanceof WP_User ? $drbotax_user->display_name : '';
?>
<header class="account-banner">
	<div class="account-banner__identity">
		<?php
		echo get_avatar(
			$drbotax_user instanceof WP_User ? $drbotax_user->ID : 0,
			96,
			'',
			'',
			array(
				'class' => 'account-banner__avatar',
			)
		);
		?>
		<p class="account-banner__greeting">
			<?php
			printf(
				/* translators: %s: customer display name. */
				esc_html__( 'Hello, %s', 'drbotax' ),
				esc_html( $drbotax_name )
			);
			?>
		</p>
	</div>

	<a class="account-banner__logout" href="<?php echo esc_url( wc_logout_url() ); ?>">
		<span class="icon-SignOut" aria-hidden="true"></span>
		<span><?php esc_html_e( 'Log out', 'drbotax' ); ?></span>
	</a>
</header>
