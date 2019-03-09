<?php


function get_html( $args = array() ) {

	$charset = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
	$key     = str_shuffle( $charset );
	$id      = 'es-' . rand( 1, 99999999 );

	// Check mail
	if ( empty( $args['email'] ) ) {
		return '';
	} elseif ( ! filter_var( $args['email'], FILTER_VALIDATE_EMAIL ) ) {
		return ' [ Invalid email address : ' . $args['email'] . ' ] ';
	}

	$encoded_email = get_encoded_text( $args['email'], $key, $charset );
	$js            = get_js( $id, $key, $encoded_email );

	$html_container = '<span id="' . $id . '">[Encoded]</span>';
	$html_script    = '<script type="text/javascript">' . $js . '</script>';

	return $html_container . $html_script;
}


function get_encoded_text( $email, $key, $charset ) {

	$encoded_email = '';

	for ( $i = 0; $i < strlen( $email ); $i += 1 ) {
		$encoded_email .= $key[ strpos( $charset, $email[ $i ] ) ];
	}

	return $encoded_email;
}


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
