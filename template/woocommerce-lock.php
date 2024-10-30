<?php
/**
 * Copyright: © 2019 Muhammad Asif, (capripio@gmail.com)
 */


defined( 'ABSPATH' ) || exit;

$message = get_option( 'cp_lock_wc_message', '' );


get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

?>
    <header class="woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
            <h1 class="woocommerce-products-header__title page-title">Store Login</h1>
		<?php endif; ?>
    </header>
    <div class="cp-lock-wc-container">
        <p class="cp-lock-wc-message"><?= $message ?></p>
        <div class="cp-lock-wc-form-container">
			<?php if ( isset( $_POST['cp_lock_wc_error'] ) ): ?>
                <p class="cp-lock-wc-incorrect-error"><b>Incorrect password, please try again.</b></p>
			<?php endif; ?>
            <form class="cp-lock-wc-form" method="POST">
				<?php wp_nonce_field( 'cp_lock_wc_unlock_form' ) ?>
                <input type="hidden" name="cp_lock_action" value="unlock_form">
                <input class="cp-lock-wc-password" name="password" type="password"
                       placeholder="<?= __cp( "Password:" ) ?>">
                <button class="cp-lock-wc-login-button" type="submit"><?= __cp( "Login" ) ?></button>
            </form>
        </div>
    </div>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
