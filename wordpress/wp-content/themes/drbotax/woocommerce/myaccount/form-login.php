<?php
/**
 * Login Form
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Drbotax
 * @version 9.9.0
 */

defined( 'ABSPATH' ) || exit;

$drbotax_registration = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );

do_action( 'woocommerce_before_customer_login_form' );
?>

<div class="login-shell<?php echo $drbotax_registration ? ' login-shell--with-register' : ''; ?>" id="customer_login">
	<div class="login-shell__forms">
		<?php get_template_part( 'template-parts/account/login-form' ); ?>

		<?php if ( $drbotax_registration ) : ?>
			<?php get_template_part( 'template-parts/account/register-form' ); ?>
		<?php endif; ?>
	</div>
</div>

<?php
do_action( 'woocommerce_after_customer_login_form' );
