<?php
/*
Plugin Name: Conditional URL Advertisements
Plugin URI: https://github.com/8Mi-Tech/yourls-conditional-urlads
Description: Conditionally send shortlinks through various link monetizing services
Version: 1.2
Author: HeroCC / JackBailey / 8Mi_Yile
Author URI: https://github.com/8Mi-Tech/yourls-conditional-urlads
*/

if( !defined( 'YOURLS_ABSPATH' ) ) die();

define( 'TRIGGERS', array('a/', 'f/', 'o/') ); // Add any possible trigger to use here

include 'user-config.php';

yourls_add_action( 'loader_failed', 'check_for_redirect' ); // On url fail, check here
function check_for_redirect( $args ) {
  $regex = '!^'. implode($TRIGGERS,"|") .'(.*)!'; // Match any trigger
  if( preg_match( $regex, $args[0], $matches ) ){
    define( redirectService, $matches[0][0] ); // first charachter of the redirect == service to use
    $keyword = substr(yourls_sanitize_keyword( $matches[1] ), 1); // The new keyword, sub trigger
    define(doAdvert, true); // let our advert function know to redirect
    yourls_add_filter('redirect_location', 'redirect_to_advert'); // Add our ad-forwarding function
    include( YOURLS_ABSPATH.'/yourls-go.php' ); // Retry forwarding
    exit; // We already restarted the process, stop
  }
}

function redirect_to_advert( $url, $code ) {
  if ( doAdvert ) {
	$redirectUrl = getRedirect();
    switch ( redirectService ) { 
      case 'f': // Use adfocus
        return ADFOCUS_DOMAIN . '/serve/sitelinks/?id=' . ADFOCUS_ID . '&url=' . $redirectUrl;
      case 'a': // Adfly
	    return ADFLY_DOMAIN . '/' . ADFLY_ID . '/' . $redirectUrl;
      case 'o': // OUO.io
        return OUO_DOMAIN . '/qs/' . OUO_ID . '?s=' . $redirectUrl;
    }
  }
  return $url; // If none of those redirect services, forward to the normal URL
}

function getRedirect(){
  $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") ;
	$actual_link = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // get the current url
	$pieces = explode('/', $actual_link); // split the url into an arrray seperated by /
	$last_word = array_pop($pieces); //  get the keyword - this may not work if you use a plugin to allow slashes in your shortened url
	return $protocol . '://' . $_SERVER['SERVER_NAME'] . '/' . $last_word; // replace the '/' after $_SERVER['SERVER_NAME' if your yourls is not in your base domain, such as '/shorten/'
}
