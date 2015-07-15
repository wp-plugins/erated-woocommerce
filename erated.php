<?php

/*
Plugin Name: eRated
Version: 1.0.0
Description: eRated imports your social information and existing reputation from marketplaces like eBay and Amazon within your store to increase your sales!
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
    $erated_domain =  'https://app.erated.co';
    $erated_secret = md5(site_url());
    $site_url = urlencode(site_url());
    $iframe_url = $erated_domain.'/premium/wordpress/'.$erated_secret.'/'.$site_url.'#v/start';
    ?>
    <style type="text/css">
    .wrap{
      background-color: red;
    }
    #erated-bg{
      width: 99%;
    }
    #settings_button{
      position: absolute;
      top: 50%;
      background: transparent;
      border: none !important;
      font-size:0;
      cursor: pointer;
    }
    .button_wrapper{
      display: table;
      margin-left: 38%;
    }
    #erated_text_div{
      color:white;
      position:absolute;
      width: 100%;
      font-size: 150%;
      top: 20%;
      text-align: center;
    }
    #erated_text_div h1{
      letter-spacing: -2px;
      font-weight: 100;
      font-size: 39px;
    }
    #erated_text_div p{
      display: inline-block;
      letter-spacing: -1px;
      font-weight: 100;
      line-height: 14px;
      text-align: left;
      font-size: 20.5px;
    }
    </style>
    <script type="text/javascript">
      function hover(element) {
        element.setAttribute('src', '<?php echo plugin_dir_url(__FILE__) . 'images/btnpress.png';?>');
      }
      function unhover(element) {
        element.setAttribute('src', '<?php echo plugin_dir_url(__FILE__) . 'images/btn.png';?>');
      }
    </script>
    <img id="erated-bg" src="<?php echo plugin_dir_url(__FILE__) . 'images/bg.jpg';?>">
    <div id="erated_text_div">
      <h1>Reach the stars & own your reputation today</h1>
      <p>
          eRated imports your ratings, reviews and reputation from all your<br/><br/>
          marketplace accounts and social media platforms directly to your store.<br/><br/>
          Customize your plugin to suit your store and watch your sales increase by up to 30%.<br/><br/>
          Become a trusted seller and join eRated for free today.
      </p>
    </div>
    <div class="button_wrapper">
      <a href="<?php echo $iframe_url ?>" target="_blank"><button id="settings_button" type="submit"><img id="settings_button_image" src="<?php echo plugin_dir_url(__FILE__) . 'images/btn.png';?>" onmouseover="hover(this);" onmouseout="unhover(this);"></button></a>
    </div>
    <br/>
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