<?php
/*
Plugin Name: Conditional URLAds
Plugin URI: https://github.com/8Mi-Tech/yourls-conditional-urlads
Description: Conditionally send shortlinks through various link monetizing services
Version: 1.3
Author: 8Mi-Tech
Author URI: https://8mi.ink
*/

if ( !defined( 'YOURLS_ABSPATH' ) ) die();

yourls_add_action( 'plugins_loaded', 'conditional_urlads_load_textdomain' );
function conditional_urlads_load_textdomain() {
    yourls_load_custom_textdomain( 'conditional_urlads', dirname( __FILE__ ) . '/languages' );
}

yourls_add_action( 'plugins_loaded', 'conditional_urlads_addpage' );
function conditional_urlads_addpage() {
    if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && $_SERVER["QUERY_STRING"] === 'page=conditional-urlads' ) {
        conditional_urlads_process_request();
    } else {
        yourls_register_plugin_page( 'conditional-urlads', 'Conditional URLAds', 'conditional_urlads_loadpage' );
    }
}
function conditional_urlads_process_request() {
    if ( isset( $_POST[ 'nonce' ] ) && yourls_verify_nonce( 'conditional-urlads' ) ) {
        ob_start();  // 开始输出缓冲
        ob_end_clean();  // 清空输出缓冲
        header('Content-Type: application/json');
        #if ( isset( $_POST[ 'adfly_id' ], $_POST[ 'adfoc_id' ], $_POST[ 'ouoio_id' ], $_POST[ 'linkvertise_id' ], ) )
        if ( isset( $_POST[ 'adfly_id' ] ) ) {
            yourls_update_option( 'conditional_urlads_adfly_id', $_POST[ 'adfly_id' ] );
        }
        if ( isset( $_POST[ 'adfoc_id' ] ) ) {
            yourls_update_option( 'conditional_urlads_adfoc_id', $_POST[ 'adfoc_id' ] );
        }
        if ( isset( $_POST[ 'ouoio_id' ] ) ) {
            yourls_update_option( 'conditional_urlads_ouoio_id', $_POST[ 'ouoio_id' ] );
        }
        if ( isset( $_POST[ 'linkvertise_id' ] ) ) {
            yourls_update_option( 'conditional_urlads_linkvertise_id', $_POST[ 'linkvertise_id' ] );
        }
        yourls_update_option( 'conditional_urlads_random_adurl_bool', isset( $_POST[ 'random_adurl_bool' ] ) );
        $response = array('success' => true, 'message' => yourls__( 'Save Complete', 'conditional_urlads' ));
        echo json_encode($response);  // 输出 JSON 数据
        exit;  // 终止脚本执行，确保只返回 JSON 数据
    }

}
function conditional_urlads_loadpage() {
    #$nonce = yourls_create_nonce( 'conditional-urlads' );
    include 'settings.php';
}

define( 'ADFLY_ID', yourls_get_option( 'conditional_urlads_adfly_id' ) );// Replace this with your Adfly ID
define( 'ADFOCUS_ID', yourls_get_option( 'conditional_urlads_adfoc_id' ) );// Replace this with your Adfoc.us ID
define( 'OUO_ID', yourls_get_option( 'conditional_urlads_ouoio_id' ) );// You get the drill
define( 'LINKVERTISE_ID', yourls_get_option( 'conditional_urlads_linkvertise_id' ) );// You get the drill
define( 'RANDOM_ADURL_BOOL', yourls_get_option( 'conditional_urlads_random_adurl_bool' ) );
define( 'ADFLY_DOMAIN', 'https://adf.ly' );// If you have a custom Adfly domain, replace this with it
define( 'ADFOCUS_DOMAIN', 'https://adfoc.us' );// Same for this
define( 'OUO_DOMAIN', 'https://ouo.io' );

yourls_add_action( 'loader_failed', 'check_for_redirect' );// On url fail, check here
function check_for_redirect( $args ) {
    $regex = '!^'. implode( $TRIGGERS, '|' ) .'(.*)!';
    // Match any trigger
    if ( preg_match( $regex, $args[ 0 ], $matches ) ) {
        define( redirectService, $matches[ 0 ][ 0 ] );
        // first charachter of the redirect == service to use
        $keyword = substr( yourls_sanitize_keyword( $matches[ 1 ] ), 1 );
        // The new keyword, sub trigger
        define( doAdvert, true );
        // let our advert function know to redirect
        yourls_add_filter( 'redirect_location', 'redirect_to_advert' );
        // Add our ad-forwarding function
        include( YOURLS_ABSPATH.'/yourls-go.php' );
        // Retry forwarding
        exit;
        // We already restarted the process, stop
    }
}

define( 'TRIGGERS', array( 'a/', 'f/', 'o/', 'l/', 'r/' ) );// Add any possible trigger to use here
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
            case 'l': // linkvertise.com
            return getLinkvertise( LINKVERTISE_ID, $redirectUrl );
            case 'r': //Random AdUrl
            if ( RANDOM_ADURL_BOOL ) {
                $keywords = [ 'a', 'f', 'o', 'l' ];
                return getRedirect( $keywords[ rand( 0, 3 ) ] );
            }
        }
    }
    return $url;
    // If none of those redirect services, forward to the normal URL
}

function getRedirect( $keyword = null ) {
    $protocol = ( isset( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] === 'on' ? 'https' : 'http' ) ;
    $actual_link = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // get the current url
    $pieces = explode( '/', $actual_link );
    // split the url into an arrray seperated by /
    $last_word = array_pop( $pieces );
    //  get the keyword - this may not work if you use a plugin to allow slashes in your shortened url
    $redirect_url = $protocol . '://' . $_SERVER[ 'SERVER_NAME' ];
    if ( $keyword !== null ) {
        $redirect_url .= '/' . $keyword . '/' . $last_word;
    } else {
        $redirect_url .= '/' . $last_word;
    }
    return $redirect_url;
}

// About Linkvertise
function getLinkvertise( $userid, $link ) {
    $base_url = 'https://link-to.net/' . $userid . '/' . strval( rand()*1000 ) . '/dynamic';
    $href = $base_url . '?r=' . base64_encode( utf8_encode( $link ) );
    return $href;
}