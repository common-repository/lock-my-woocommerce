<?php

class CP_Lock_WC_Core {
	private static $instance;

	/**
	 * CP_Lock_WC_Core constructor.
	 */
	public function __construct() {
		if ( session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		add_action( 'init', array( $this, 'init' ) );

	}


	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function init() {
		if ( isset( $_POST['cp_lock_action'] ) && $_POST['cp_lock_action'] == 'unlock_form' ) {
			$this->do_unlock_process( $_POST['password'] );
		}
	}

	private function do_unlock_process( $password ) {
		$saved_password = get_option( 'cp_lock_wc_password' );
		if ( $saved_password != $password ) {
			$_POST['cp_lock_wc_error'] = true;

			return;
		}
		$_SESSION['cp_lock_wc_unlock'] = true;
		wp_redirect( $_SERVER['HTTP_REFERER'] );

		return;
	}

	public static function is_store_unlocked() {
		$unlocked   = false;
		$allow_user = get_option( 'cp_lock_wc_allow_users', false );
		if ( $allow_user == 'yes' ) {
			$allow_user = true;
		} else {
			$allow_user = false;
		}

		if ( is_user_logged_in() && $allow_user ) {
			$unlocked = true;
		}

		if ( isset( $_SESSION['cp_lock_wc_unlock'] ) && $_SESSION['cp_lock_wc_unlock'] == true ) {
			$unlocked = true;
		}

		return apply_filters( 'cp-lock-wc-is-locked', $unlocked );
	}
}

CP_Lock_WC_Core::getInstance();