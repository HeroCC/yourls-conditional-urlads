<?php
if( !defined( 'YOURLS_ABSPATH' ) ) die();
?>
<div class="wrap">
    <h2>Conditional URLAds</h2>
    <form method="post">
    <input type="hidden" name="nonce" value="<?php echo yourls_create_nonce( 'conditional_urlads_settings' ); ?>" />
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Adfly ID</th>
                <td><input type="text" name="adfly_id" value="<?php echo yourls_get_option('conditional_urlads_adfly_id'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Adfoc.us ID</th>
                <td><input type="text" name="adfoc_id" value="<?php echo yourls_get_option('conditional_urlads_adfoc_id'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">OUO.io ID</th>
                <td><input type="text" name="ouoio_id" value="<?php echo yourls_get_option('conditional_urlads_ouoio_id'); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Linkvertise ID</th>
                <td><input type="text" name="linkvertise_id" value="<?php echo yourls_get_option('conditional_urlads_linkvertise_id'); ?>" /></td>
            </tr>
        </table>
        <input type="submit" value="Save" class="button" />
    </form>