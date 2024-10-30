<?php
class CP_Lock_WC_Settings {
	private static $instance;

	/**
	 * CP_Lock_WC_Settings constructor.
	 */
	public function __construct() {
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'woocommerce_settings_tabs_array' ), 21, 1 );
		add_action( 'woocommerce_settings_tabs_cp_lock_wc', array( $this, 'setting_tabs' ) );
		add_action( 'woocommerce_update_options_cp_lock_wc', array( $this, 'update_settings' ) );
		add_action( 'woocommerce_admin_field_advertisement', array( $this, 'woocommerce_admin_field_advertisement' ) );
	}

	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function woocommerce_settings_tabs_array( $setting_tabs ) {
		$setting_tabs['cp_lock_wc'] = __( 'Lock My WooCommerce', CP_LOCK_WC_DOMAIN );

		return $setting_tabs;
	}

	function setting_tabs() {
		woocommerce_admin_fields( $this->get_settings() );
		?>
		<?php
	}

	function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

	private function get_settings() {
		$settings = array(
			'section_title' => array(
				'name' => __cp( 'General Settings' ),
				'type' => 'title',
				'id'   => 'cp_lock_wc_general_section_title'
			),
			'enabled'       => array(
				'name'     => __cp( 'Enable' ),
				'type'     => 'checkbox',
				'desc_tip' => __cp( 'Enable/Disable lock on your store.' ),
				'id'       => 'cp_lock_wc_enable'
			),
			'password'      => array(
				'name'     => __cp( 'Password' ),
				'type'     => 'password',
				'desc_tip' => __cp( 'Enter password so user can access your store.' ),
				'id'       => 'cp_lock_wc_password'
			),
			'message'       => array(
				'name'     => __cp( 'Message' ),
				'type'     => 'textarea',
				'desc_tip' => __cp( 'Message to show users when store is lock.' ),
				'id'       => 'cp_lock_wc_message'
			),
			'allow_user'    => array(
				'name'     => __cp( 'Allow Users' ),
				'type'     => 'checkbox',
				'desc_tip' => __cp( 'Allow users to access store without entering password.' ),
				'id'       => 'cp_lock_wc_allow_users'
			),
			'section_end'   => array(
				'type' => 'sectionend',
				'id'   => 'cp_lock_wc_section_end'
			),
			'advertisement' => array(
				'type' => 'advertisement',
				'html' => '
<h3>Want to hire me for changes?</h3>
<div id="pph-hireme"></div>
<script type="text/javascript">
(function(d, s) {
    var useSSL = \'https:\' == document.location.protocol;
    var js, where = d.getElementsByTagName(s)[0],
    js = d.createElement(s);
    js.src = (useSSL ? \'https:\' : \'http:\') +  \'//www.peopleperhour.com/hire/462935501/581260.js?width=728&height=123&orientation=horizontal&theme=light&hourlies=456182%2C122232&rnd=\'+parseInt(Math.random()*10000, 10);
    try { where.parentNode.insertBefore(js, where); } catch (e) { if (typeof console !== \'undefined\' && console.log && e.stack) { console.log(e.stack); } }
}(document, \'script\'));
</script>'
			),
		);

		return $settings;
	}

	function woocommerce_admin_field_advertisement( $value ) {
		?>
		<?= $value['html'] ?>
		<?php
	}


}

CP_Lock_WC_Settings::getInstance();