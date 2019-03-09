<?php

/**
 * Return the HTML for email link adress
 *
 * @param array $args Arguments for the HTML building
 * @return string HTML of encoded link
 */
function get_html( $args = array() ) {

	$charset = '?_+-.@0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	$key     = str_shuffle( $charset );
	$id      = 'es-' . rand( 1, 99999999 );

	/* Check email address */
	if ( empty( $args['email'] ) ) {
		return '';
	} elseif ( ! filter_var( $args['email'], FILTER_VALIDATE_EMAIL ) ) {
		$message = __( 'Invalid email address', 'encode-shortcode' );
		return ' [ ' . $message . ' : ' . $args['email'] . ' ] ';
	}

	$encoded_email = get_encoded_text( $args['email'], $key, $charset );
	$js            = get_js( $id, $key, $encoded_email );

	$html_container = '<span id="' . $id . '">' . __( '[Encoded]', 'encode-shortcode' ) . '</span>';
	$html_script    = '<script type="text/javascript">' . $js . '</script>';

	return $html_container . $html_script;
}


/**
 * Get encoded content
 *
 * @param string $email
 * @param string $key
 * @param string $charset
 * @return string
 */
function get_encoded_text( $email, $key, $charset ) {

	$encoded_email = '';

	for ( $i = 0; $i < strlen( $email ); $i++ ) {

		$encoded_email .= $key[ strpos( $charset, $email[ $i ] ) ];
	}

	return $encoded_email;
}


/**
 * Get the JavaScript for decode data and insert the HTML link
 *
 * @param string $id ID fo the HTML container
 * @param string $key Encoding key
 * @param string $encoded_email Encoded email
 * @return string JavaScript code
 */
function get_js( $id, $key, $encoded_email ) {

	$html_link = '<a href=\\"mailto:"+d+"\\">"+d+"</a>';

	$js = <<<EOT
var a="$key";
var b=a.split("").sort().join("");
var c="$encoded_email";
var d="";
for(var e=0;e<c.length;e++)
	d+=b.charAt(a.indexOf(c.charAt(e)));
document.getElementById("$id").innerHTML="$html_link"
EOT;

	return minify_js( $js );
}


/**
 * Realy simple JavaScript minifier
 *
 * @param string $js JavaScript code
 * @return string Minified JavaScript code
 */
function minify_js( $js ) {

	$search = array(
		"/\r|\n/",
		"/\s+\n/",
		"/\n\s+/",
		'/ +/',
	);

	$replace = array(
		'',
		"\n",
		"\n ",
		' ',
	);

	return preg_replace( $search, $replace, $js );
}
