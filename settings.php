<?php
if( !defined( 'YOURLS_ABSPATH' ) ) die();
?>
<div class="wrap">
    <h2>Conditional URLAds</h2>
    <h4>Set your user ID （you can <a href="https://github.com/HeroCC/yourls-conditional-urlads">See Tutorial for details</a>）</h4>
    <form method="post">
    <input type="hidden" name="nonce" value="<?php echo yourls_create_nonce( 'conditional_urlads_settings' ); ?>" />
        <table class="form-table">
            <tr valign="center" algin="char">
                <th>Website</th>
                <th>&nbsp;&nbsp;ID</th>
            </tr>
            <tr valign="center">
                <th scope="row">Adfly</th>
                <td><input type="text" name="adfly_id" value="<?php echo yourls_get_option('conditional_urlads_adfly_id'); ?>" /></td>
            </tr>
            <tr valign="center">
                <th scope="row">Adfoc.us</th>
                <td><input type="text" name="adfoc_id" value="<?php echo yourls_get_option('conditional_urlads_adfoc_id'); ?>" /></td>
            </tr>
            <tr valign="center">
                <th scope="row">OUO.io</th>
                <td><input type="text" name="ouoio_id" value="<?php echo yourls_get_option('conditional_urlads_ouoio_id'); ?>" /></td>
            </tr>
            <tr valign="center">
                <th scope="row"><a href="https://publisher.linkvertise.com/dashboard#dynamic">Linkvertise</a></th>
                <td><input type="text" name="linkvertise_id" value="<?php echo yourls_get_option('conditional_urlads_linkvertise_id'); ?>" /></td>
            </tr>
        </table>
        <br />
        <input type="submit" value="Save" class="button" />
    </form>