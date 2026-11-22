<?php
/**
 * WooCommerce customer registration fields.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_reg_username = '';
$drbotax_reg_email    = '';

if ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$drbotax_reg_username = wp_unslash( $_POST['username'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
}

if ( ! empty( $_POST['email'] ) && is_string( $_POST['email'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$drbotax_reg_email = wp_unslash( $_POST['email'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
}
?>
<section class="login-panel login-panel--register" id="customer_register" aria-labelledby="drbotax-register-title">
	<header class="login-panel__intro">
		<h2 id="drbotax-register-title" class="login-panel__title"><?php esc_html_e( 'Create an account', 'drbotax' ); ?></h2>
	</header>

	<form method="post" class="woocommerce-form woocommerce-form-register register login-panel__form" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
		<?php do_action( 'woocommerce_register_form_start' ); ?>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-field">
				<label class="screen-reader-text" for="reg_username"><?php esc_html_e( 'Username', 'drbotax' ); ?></label>
				<span class="login-field__control">
					<span class="login-field__icon icon-User" aria-hidden="true"></span>
					<input
						type="text"
						class="woocommerce-Input woocommerce-Input--text input-text"
						name="username"
						id="reg_username"
						autocomplete="username"
						placeholder="<?php esc_attr_e( 'Username', 'drbotax' ); ?>"
						value="<?php echo esc_attr( $drbotax_reg_username ); ?>"
						required
						aria-required="true"
					>
				</span>
			</p>
		<?php endif; ?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-field">
			<label class="screen-reader-text" for="reg_email"><?php esc_html_e( 'Email address', 'drbotax' ); ?></label>
			<span class="login-field__control">
				<span class="login-field__icon icon-User" aria-hidden="true"></span>
				<input
					type="email"
					class="woocommerce-Input woocommerce-Input--text input-text"
					name="email"
					id="reg_email"
					autocomplete="email"
					placeholder="<?php esc_attr_e( 'Email address', 'drbotax' ); ?>"
					value="<?php echo esc_attr( $drbotax_reg_email ); ?>"
					required
					aria-required="true"
				>
			</span>
		</p>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-field">
				<label class="screen-reader-text" for="reg_password"><?php esc_html_e( 'Password', 'drbotax' ); ?></label>
				<span class="login-field__control">
					<span class="login-field__icon icon-Lock" aria-hidden="true"></span>
					<input
						type="password"
						class="woocommerce-Input woocommerce-Input--text input-text"
						name="password"
						id="reg_password"
						autocomplete="new-password"
						placeholder="<?php esc_attr_e( 'Password', 'drbotax' ); ?>"
						required
						aria-required="true"
					>
				</span>
			</p>
		<?php else : ?>
			<p class="login-panel__hint"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'drbotax' ); ?></p>
		<?php endif; ?>

		<?php do_action( 'woocommerce_register_form' ); ?>

		<p class="woocommerce-form-row form-row">
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<button
				type="submit"
				class="woocommerce-Button woocommerce-button button login-panel__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit"
				name="register"
				value="<?php esc_attr_e( 'Register', 'drbotax' ); ?>"
			>
				<?php esc_html_e( 'Register', 'drbotax' ); ?>
			</button>
		</p>

		<?php do_action( 'woocommerce_register_form_end' ); ?>
	</form>
</section>
