<?php
/*
Plugin Name: Conditional URL Advertisements
Plugin URI: https://github.com/HeroCC/yourls-conditional-urlads
Description: Conditionally send shortlinks through various link monetizing services
Version: 1.1
Author: HeroCC
Author URI: https://herocc.com/
*/

if( !defined( 'YOURLS_ABSPATH' ) ) die();

define( 'TRIGGERS', array('a/', 'f/', 'o/') ); // Add any possible trigger to use here

define( 'ADFLY_ID', '2777408' ); // Replace this with your Adfly ID
define( 'ADFOCUS_ID', '287608' ); // Replace this with your Adfoc.us ID
define( 'OUO_ID', '0IqYvHOo' ); // You get the drill

define( 'ADFLY_DOMAIN', 'https://adf.ly' ); // If you have a custom Adfly domain, replace this with it
define( 'ADFOCUS_DOMAIN', 'https://adfoc.us' ); // Same for this
define( 'OUO_DOMAIN', 'https://ouo.io' ); 

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
    if ( redirectService == 'f' ) { // Use adfocus
      return ADFOCUS_DOMAIN . '/serve/sitelinks/?id=' . ADFOCUS_ID . '&url=' . $redirectUrl;
    } else if ( redirectService == 'a' ) { // Adfly
	  return ADFLY_DOMAIN . '/' . ADFLY_ID . '/' . $redirectUrl;
    } else if ( redirectService == 'o' ) { // OUO.io
      return OUO_DOMAIN . '/qs/' . OUO_ID . '?s=' . $redirectUrl;
    }
  }
  return $url; // If none of those redirect services, forward to the normal URL
}

function getRedirect(){
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // get the current url
	$pieces = explode('/', $actual_link); // split the url into an arrray seperated by /
	$last_word = array_pop($pieces); //  get the keyword - this may not work if you use a plugin to allow slashes in your shortened url
	return '//' . $_SERVER['SERVER_NAME'] . '/' . $last_word; // replace the '/' after $_SERVER['SERVER_NAME' if your yourls is not in your base domain, such as '/shorten/'
}
