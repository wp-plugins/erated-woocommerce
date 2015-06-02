<?php

/*
Plugin Name: eRated
*/

function add_erated_menu() {
    add_menu_page(  'eRated - Reputation Settings',
                    'Reputation', 'manage_options',
                    'erated-settings',
                    'erated_admin_page_function',
                    plugin_dir_url(__FILE__) . 'icons/erated_wp_setting_sidebar_button.png', '23.56'
                 );
}

function erated_admin_page_function() {
    $erated_domain =  'http://app.erated.co';
    $erated_secret = md5(site_url());
    $iframe_url = $erated_domain.'/premium/wordpress/'.$erated_secret.'#v/start';
    ?>
      <br/><br/><br/>
      <a href="<?php echo $iframe_url ?>" target="_blank">Go to eRated configuration screen.</a>
    <?php
}

function add_erated_widget_to_body() {
    wp_enqueue_script( 'window-erated', plugins_url( '/js/window_erated.js' , __FILE__ ), array(), '1.0.0', true );
    wp_localize_script( 'window-erated', 'erated_params', md5(site_url()) );

    wp_enqueue_script( 'window-erated-imp', '//cdn.erated.co/iframe/erated_imp.js', array(), '1.0.0', true );
}

function add_erated_widget_div_to_body() {
    echo '<div class="erated"></div>';
}

add_action('admin_menu', 'add_erated_menu');

add_action( 'wp_enqueue_scripts', 'add_erated_widget_to_body' );
add_action('wp_footer', 'add_erated_widget_div_to_body');