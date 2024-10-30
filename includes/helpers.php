<?php
/**
 * Copyright: © 2019 Muhammad Asif, (capripio@gmail.com)
 */

if ( ! function_exists( '__cp' ) ) {
	function __cp( $text ) {
		return __( $text, CP_LOCK_WC_DOMAIN );
	}
}

if ( ! function_exists( 'dump' ) ) {
	function dump( $value ) {
		echo "<pre>";
		var_dump( $value );
		echo "</pre>";
	}
}
if ( ! function_exists( 'dd' ) ) {
	function dd( $value ) {
		dump( $value );
		die();
	}
}