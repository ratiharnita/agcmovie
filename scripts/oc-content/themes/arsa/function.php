<?php
/**
 * Perform function.
 *
 * @since 1.0.0
 *
 * @param object arsa.
 */
function avatar($mail, $size = 60){
	$url = "http://www.gravatar.com/avatar/";
	$url .= md5( strtolower( trim( $mail ) ) );
	// $url .= "?d=" . urlencode( $default );
	$url .= "&s=" . $size;
	return $url;
}
?>