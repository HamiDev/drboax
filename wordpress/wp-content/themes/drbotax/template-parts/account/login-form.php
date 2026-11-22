<?php
/**
 * WooCommerce customer login fields.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_username = '';

if ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$drbotax_username = wp_unslash( $_POST['username'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
}

$drbotax_social = drbotax_login_social_providers();
$drbotax_text   = trim( (string) drbotax_mod( 'login_text' ) );
?>
<section class="login-panel" aria-labelledby="drbotax-login-title">
	<?php get_template_part( 'template-parts/account/login-brand' ); ?>

	<header class="login-panel__intro">
		<h1 id="drbotax-login-title" class="login-panel__title"><?php echo esc_html( drbotax_login_title() ); ?></h1>
		<?php if ( '' !== $drbotax_text ) : ?>
			<p class="login-panel__text"><?php echo esc_html( $drbotax_text ); ?></p>
		<?php endif; ?>
	</header>

	<form class="woocommerce-form woocommerce-form-login login login-panel__form" method="post" novalidate>
		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-field">
			<label class="screen-reader-text" for="username"><?php esc_html_e( 'Mobile number or email', 'drbotax' ); ?></label>
			<span class="login-field__control">
				<span class="login-field__icon icon-User" aria-hidden="true"></span>
				<input
					type="text"
					class="woocommerce-Input woocommerce-Input--text input-text"
					name="username"
					id="username"
					autocomplete="username"
					placeholder="<?php esc_attr_e( 'Mobile number or email', 'drbotax' ); ?>"
					value="<?php echo esc_attr( $drbotax_username ); ?>"
					required
					aria-required="true"
				>
			</span>
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide login-field">
			<label class="screen-reader-text" for="password"><?php esc_html_e( 'Password', 'drbotax' ); ?></label>
			<span class="login-field__control">
				<span class="login-field__icon icon-Lock" aria-hidden="true"></span>
				<input
					class="woocommerce-Input woocommerce-Input--text input-text"
					type="password"
					name="password"
					id="password"
					autocomplete="current-password"
					placeholder="<?php esc_attr_e( 'Password', 'drbotax' ); ?>"
					required
					aria-required="true"
				>
			</span>
		</p>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<div class="login-panel__meta">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme login-panel__remember">
				<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever">
				<span><?php esc_html_e( 'Remember me', 'drbotax' ); ?></span>
			</label>
			<p class="woocommerce-LostPassword lost_password login-panel__lost">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot your password?', 'drbotax' ); ?></a>
			</p>
		</div>

		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

		<button
			type="submit"
			class="woocommerce-button button login-panel__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
			name="login"
			value="<?php esc_attr_e( 'Log in to your account', 'drbotax' ); ?>"
		>
			<?php esc_html_e( 'Log in to your account', 'drbotax' ); ?>
		</button>

		<?php do_action( 'woocommerce_login_form_end' ); ?>
	</form>

	<?php if ( ! empty( $drbotax_social ) ) : ?>
		<div class="login-social">
			<p class="login-social__divider"><span><?php esc_html_e( 'Or sign in with social accounts', 'drbotax' ); ?></span></p>
			<ul class="login-social__list">
				<?php foreach ( $drbotax_social as $drbotax_provider ) : ?>
					<li>
						<?php if ( '' !== $drbotax_provider['url'] ) : ?>
							<a class="login-social__button" href="<?php echo esc_url( $drbotax_provider['url'] ); ?>">
								<?php if ( '' !== $drbotax_provider['icon'] ) : ?>
									<span class="icon-<?php echo esc_attr( $drbotax_provider['icon'] ); ?>" aria-hidden="true"></span>
								<?php endif; ?>
								<span><?php echo esc_html( $drbotax_provider['label'] ); ?></span>
							</a>
						<?php else : ?>
							<span class="login-social__button login-social__button--pending">
								<?php if ( '' !== $drbotax_provider['icon'] ) : ?>
									<span class="icon-<?php echo esc_attr( $drbotax_provider['icon'] ); ?>" aria-hidden="true"></span>
								<?php endif; ?>
								<span><?php echo esc_html( $drbotax_provider['label'] ); ?></span>
							</span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
		<p class="login-panel__register">
			<?php esc_html_e( 'Don’t have an account?', 'drbotax' ); ?>
			<a href="#customer_register"><?php esc_html_e( 'Sign up', 'drbotax' ); ?></a>
		</p>
	<?php endif; ?>
</section>
