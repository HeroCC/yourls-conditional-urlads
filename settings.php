<?php
if( !defined( 'YOURLS_ABSPATH' ) ) die();

function add_title_label($websile, $id_name, $string, $url){
    $id = yourls_get_option('conditional_urlads_' . $id_name);
    echo <<<HTML
    <tr valign="center">
        <th scope="row">{$websile}</th>
        <th><input type="text" name="{$id_name}" value='{$id}' /></th>
        <th>a/</th>
        <th><a href="{$url}">{$url}</a></th>
    </tr>
HTML;
}

function display_settings_table() {
    $lang_syuid=yourls__( 'Set your user ID', 'conditional_urlads' );
    $lang_yc=yourls__( 'You can', 'conditional_urlads' );
    $lang_stfd=yourls__( 'See Tutorial for Details', 'conditional_urlads' );
    $lang_web=yourls__( 'Website', 'conditional_urlads' );
    $lang_uid=yourls__( 'User API ID', 'conditional_urlads' );
    $lang_ts=yourls__( 'Trigger String', 'conditional_urlads' );
    $lang_eurl=yourls__( 'Example URL', 'conditional_urlads' );
    $nonce=yourls_create_nonce( 'conditional-urlads' );
    echo <<<HTML
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.inline-form').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'plugins.php?page=conditional-urlads',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                    } else {
                        // 处理失败的操作
                        alert('处理失败');
                    }
                },
                error: function() {
                    // 请求失败的操作
                    alert('请求失败');
                }
            });
        });
    });
    </script>
    <style>
    .inline-form {
        display: inline;
    }
    </style>
    <div class="wrap">
        <h2>Conditional URLAds</h2>
        <h4>
            {$lang_syuid} （{$lang_yc} <a href="https://github.com/8Mi-Tech/yourls-conditional-urlads/wiki">{$lang_stfd} </a>）<br>
        </h4>
        <form method="post" class="inline-form" >
        <input type="hidden" name="nonce" value="{$nonce}" />
            <table class="form-table">
                <tr valign="center" algin="char">
                    <th><h4>{$lang_web}</h4></th>
                    <th><h4>{$lang_uid}</h4></th>
                    <th><h4>{$lang_ts}</h4></th>
                    <th><h4>{$lang_eurl}</h4></th>
                </tr>
HTML;
}

// Add more add_title_label calls as needed

function display_settings_table_end() {
    $lang_radurl=yourls__( 'Ramdom AdURL', 'conditional_urlads' );
    $radurl_bool=yourls_get_option('conditional_urlads_random_adurl_bool') ? 'checked' : '';
    $lang_enable=yourls__( 'Enable', 'conditional_urlads' );
    $lang_save=yourls__( 'Save', 'conditional_urlads' );
    echo <<<HTML
                <tr valign="center">
                    <th scope="row">{$lang_radurl}</th>
                    <td>
                        <input type="checkbox" id="random_adurl_bool" name="random_adurl_bool" value="true" {$radurl_bool} />
                        <label for="random_adurl_bool">{$lang_enable}</label>
                    </td>
                    <th>r/</th>
                    <th><a href="https://8mi.ink/r/2345">https://8mi.ink/r/2345</a></th>
                </tr>
            </table>
            <br />
            <input type="submit" value="{$lang_save}" class="button" />
        </form>
    </div>
HTML;
}

display_settings_table();
add_title_label('Adf.ly', 'adfly_id', 'a/', 'https://8mi.ink/a/ref-adfly');
add_title_label('Adfoc.us', 'adfoc_id', 'f/', 'https://8mi.ink/f/ref-adfoc');
add_title_label('OuO.io', 'ouoio_id', 'o/', 'https://8mi.ink/o/ref-ouoio');
add_title_label('Linkvertise', 'linkvertise_id', 'l/', 'https://8mi.ink/l/ref-linkvertise');
display_settings_table_end();
?>
