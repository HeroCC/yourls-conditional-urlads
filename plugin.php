<?php
/*
Plugin Name: Conditional URL Advertisements
Plugin URI: http://yourls.org/
Description: Conditionally send shortlinks through various link monetizing services
Version: 1.0
Author: HeroCC
Author URI: https://herocc.com/
*/

if( !defined( 'YOURLS_ABSPATH' ) ) die();

define( 'TRIGGERS', array('a/', 'f/', 'c/') ); // Add any possible trigger to use here

define( 'ADFLY_ID', '2777408' ); // Replace this with your Adfly ID
define( 'ADFOCUS_ID', '287608' ); // Replace this with your Adfoc.us ID
define( 'COINURL_ID', 'ab87bdb66600433a8bd4fd87aabd896a' ); // Replace this with your CoinURL ID

define( 'ADFLY_DOMAIN', 'http://adf.ly' ); // If you have a custom Adfly domain, replace this with it
define( 'ADFOCUS_DOMAIN', 'http://adfoc.us' ); // Same for this
define( 'COINURL_DOMAIN', 'http://cur.lv' ); // CoinUrl doesn't allow custom domains, but just incase it is configurable

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
    if ( redirectService == 'f' ) { // Use adfocus
      return ADFOCUS_DOMAIN . '/serve/sitelinks/?id=' . ADFOCUS_ID . '&url=' . $url;
    } else if ( redirectService == 'c' ) { // Use CoinURL
      return COINURL_DOMAIN . '/redirect.php?id=' . COINURL_ID . '&url=' . rawurlencode($url);
    } else { // All else, use adfly
      return ADFLY_DOMAIN . '/' . ADFLY_ID . '/' . $url;
    }
  } else {
    return $url;
  }
}
