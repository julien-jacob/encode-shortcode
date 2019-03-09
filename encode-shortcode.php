<?php

/**
 * Plugin Name: Encode Shortcode
 * Description: Shortcode for encode and protect data (like email adress or phone number) from bot and spam. [encode]My text to encode[/encode]
 * Author: Julien MA Jacob
 * Plugin URI: https://wprock.fr
 * Version: 1.0.0
 * Author URI: https://wprock.fr/a-propos-julien-ma-jacob/
 * Text Domain: encode-shortcode
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function encode_shortcode_get_default_arg() {
	return array(
		'email' => '',
		// 'class' => '',
		// 'content' => '',
		// 'container' => 'span',
		// 'container_class' => '',
	);
}


// Call php file
require plugin_dir_path( __FILE__ ) . 'encode.php';


/**
 * Add Shortcode [encode][/encode]
 *
 * @param array  $atts
 * @param string $content
 * @return string
 */
function encode_shortcode_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts(
		encode_shortcode_get_default_arg(),
		$atts,
		'encode'
	);

	return get_html($atts );

}
add_shortcode( apply_filters( 'encode-shortcode/tag', 'encode' ), 'encode_shortcode_shortcode' );
