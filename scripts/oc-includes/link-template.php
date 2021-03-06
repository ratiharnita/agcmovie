<?php
function home_url( $path = '') {
        $url = get_bloginfo( 'url' ).$path;
	return $url;
}

function the_permalink() {
        echo 'http://'.$_SERVER["HTTP_HOST"].''.parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH).'';
}