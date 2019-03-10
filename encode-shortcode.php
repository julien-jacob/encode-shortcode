<?php

/**
 * Plugin Name: Encode Shortcode
 * Description: Protect email address in your website against spam with shortcode like this : [encode email="hello@mail.fr"]My text to encode[/encode]
 * Author: Julien MA Jacob
 * Plugin URI: https://wprock.fr
 * Version: 1.0.1
 * Author URI: https://wprock.fr/a-propos-julien-ma-jacob/
 * Text Domain: encode-shortcode
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Call php file
require plugin_dir_path( __FILE__ ) . 'includes/default-args.php';
require plugin_dir_path( __FILE__ ) . 'includes/encode.php';


/**
 * Add Shortcode [encode][/encode]
 *
 * @param array  $atts Attributes in the shortcode
 * @param string $content Text content in the link
 * @return string
 */
function encode_shortcode_add_shortcode( $atts, $content = null ) {

	$atts = shortcode_atts(
		encode_shortcode_get_default_arg(),
		$atts,
		'encode'
	);

	$atts['content'] = $content;

	return encode_shortcode_get_html( $atts );

}
add_shortcode( apply_filters( 'encode-shortcode/tag', 'encode' ), 'encode_shortcode_add_shortcode' );
