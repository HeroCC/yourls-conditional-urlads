<?php
if( !defined( 'YOURLS_ABSPATH' ) ) die();
?>
<div class="wrap">
    <h2>Conditional URLAds</h2>
    <h4><?php yourls_e( 'Set your user ID', 'conditional_urlads' ); ?> （<?php yourls_e( 'You can', 'conditional_urlads' ); ?> <a href="https://github.com/HeroCC/yourls-conditional_urlads"><?php yourls_e( 'See Tutorial for Details', 'conditional_urlads' ); ?> </a>）<br><?php yourls_e( 'Current Language', 'conditional_urlads' ); ?> <?php echo yourls_apply_filter( 'load_custom_textdomain', yourls_get_locale(), 'conditional_urlads' );; ?></h4>
    <form method="post">
    <input type="hidden" name="nonce" value="<?php echo yourls_create_nonce( 'conditional_urlads_settings' ); ?>" />
        <table class="form-table">
            <tr valign="center" algin="char">
                <th><h4><?php yourls_e( 'Website', 'conditional_urlads' ); ?></h4></th>
                <th><h4><?php yourls_e( 'User API ID', 'conditional_urlads' ); ?></h4></th>
                <th><h4><?php yourls_e( 'Trigger String', 'conditional_urlads' ); ?></h4></th>
                <th><h4><?php yourls_e( 'Example URL', 'conditional_urlads' ); ?></h4></th>
            </tr>
            <tr valign="center">
                <th scope="row">Adfly</th>
                <td><input type="text" name="adfly_id" value="<?php echo yourls_get_option('conditional_urlads_adfly_id'); ?>" /></td>
                <th>a/</th>
                <th><a href="https://8mi.ink/a/ref-adfly">https://8mi.ink/a/ref-adfly</a></th>
            </tr>
            <tr valign="center">
                <th scope="row">Adfoc.us</th>
                <td><input type="text" name="adfoc_id" value="<?php echo yourls_get_option('conditional_urlads_adfoc_id'); ?>" /></td>
                <th>f/</th>
                <th><a href="https://8mi.ink/f/ref-adfoc">https://8mi.ink/f/ref-adfoc</a></th>
            </tr>
            <tr valign="center">
                <th scope="row">OUO.io</th>
                <td><input type="text" name="ouoio_id" value="<?php echo yourls_get_option('conditional_urlads_ouoio_id'); ?>" /></td>
                <th>o/</th>
                <th><a href="https://8mi.ink/o/ref-ouoio">https://8mi.ink/o/ref-ouoio</a></th>
            </tr>
            <tr valign="center">
                <th scope="row"><a href="https://publisher.linkvertise.com/dashboard#dynamic">Linkvertise</a></th>
                <td><input type="text" name="linkvertise_id" value="<?php echo yourls_get_option('conditional_urlads_linkvertise_id'); ?>" /></td>
                <th>l/</th>
                <th><a href="https://8mi.ink/l/ref-linkvertise">https://8mi.ink/l/ref-linkvertise</a></th>
            </tr>
            <tr valign="center">
                <th scope="row"><?php yourls_e( 'Ramdom AdURL', 'conditional_urlads' ); ?></th>
                <td>
                    <input type="checkbox" id="random_adurl_bool" name="random_adurl_bool" value="true" <?php echo yourls_get_option('conditional_urlads_random_adurl_bool') ? 'checked' : ''; ?> />
                    <label for="random_adurl_bool"><?php yourls_e( 'Enable', 'conditional_urlads' ); ?></label>
                </td>
                <th>r/</th>
                <th><a href="https://8mi.ink/r/2345">https://8mi.ink/r/2345</a></th>
            </tr>
        </table>
        <br />
        <input type="submit" value="<?php yourls_e( 'Save', 'conditional_urlads' ); ?>" class="button" />
    </form>