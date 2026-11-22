<?php
/**
 * Document close.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

if ( ! drbotax_is_account_login() ) {
	get_template_part( 'template-parts/footer/site-footer' );
}
wp_footer();
?>
</body>
</html>
