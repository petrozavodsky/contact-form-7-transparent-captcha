<?php
/*
Plugin Name: Contact Form 7 transparent captcha
Version: 1.1.0
Author: petrozavodsky
*/


class contact_form7_transparent_captcha {
	public static $v = '1.0.0';

	public $field_key ='site-url';

	public function __construct() {
		add_action( "wp_enqueue_scripts", [ $this, "add_js_css" ] );
		add_filter( 'wpcf7_validate', [ $this, 'cf7_validate' ], 101, 1 );
	}

	public function cf7_validate( $result ) {
		$form       = WPCF7_Submission::get_instance();
		$spam_field = $form->get_posted_data($this->field_key );
		if ( empty( $spam_field ) || $spam_field !== home_url() ) {
			wp_die( '' );
		}

		return $result;
	}

	public function add_js_css() {

		$url = home_url();

		wp_enqueue_script(
			'contact_form7_transparent_captcha_js',
			plugin_dir_url( __FILE__ ) . "/public/js/script.min.js",
			[ 'jquery' ],
			self::$v,
			false
		);

		wp_add_inline_script(
			'contact_form7_transparent_captcha_js',
			"var contact_form7_transparent_captcha_url ='{$url}';
				   var contact_form7_transparent_captcha_name ='{$this->field_key}'",
			'before'
		);

	}

}


add_action( "plugins_loaded", function () {
	new  contact_form7_transparent_captcha();
}, 30 );