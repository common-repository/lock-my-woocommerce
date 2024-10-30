<?php

class CP_Lock_WC_Template {
	private static $instance;

	/**
	 * CP_Lock_WC_Template constructor.
	 */
	public function __construct() {
		//add_filter( 'woocommerce_locate_template', array( $this, 'woocommerce_locate_template' ), 10, 3 );
		add_action( 'init', array( $this, 'init' ) );

	}

	function init() {
		if ( ! CP_Lock_WC_Core::is_store_unlocked() ) {
			add_filter( 'template_include', array( $this, 'template_include' ), 50 );
			add_filter( 'document_title_parts', array( $this, 'document_title_parts' ) );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'woocommerce_get_breadcrumb' ) );
			add_filter( 'sidebars_widgets', array( $this, 'sidebars_widgets' ) );
		}
	}

	function template_include( $template ) {
		if (
			is_woocommerce() ||
			is_cart() ||
			is_checkout() ||
			is_checkout_pay_page() ||
			is_account_page() ||
			is_view_order_page() ||
			is_edit_account_page() ||
			is_order_received_page() ||
			is_add_payment_method_page() ||
			is_lost_password_page()
		) {

			$template = CP_LOCK_WC_DIR . '/template/woocommerce-lock.php';
		}

		return $template;
	}

	function woocommerce_get_breadcrumb( $crumbs ) {
		$new_crumbs = array();
		if ( isset( $crumbs[0] ) ) {
			$new_crumbs[] = $crumbs[0];
			$new_crumbs[] = array(
				__cp( 'Store Login' ),
				get_permalink( wc_get_page_id( 'shop' ) ),
			);

			return $new_crumbs;
		}

		return $crumbs;
	}

	function sidebars_widgets( $sidebars ) {
		foreach ( $sidebars as $sidebar => $widgets ) {
			foreach ( $widgets as $key => $widget ) {
				if ( strpos( $widget, 'woocommerce' ) !== false ) {
					unset( $sidebars[ $sidebar ][ $key ] );
				}
			}
		}

		return $sidebars;
	}

	function document_title_parts( $title_parts ) {
		$title_parts['title'] = __cp( 'Store Login' );

		return $title_parts;
	}


	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

CP_Lock_WC_Template::getInstance();