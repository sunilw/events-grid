<?php

/*
   Plugin Name: Events Grid
   Description: Isotope powered layout for Modern Tribe's Calendar Events
   Version: 0.1.0
   Plugin URI: http://sunil.con.z
   Author URI: http://sunil.co.nz
   Author: Sunil Williams
 */

/*
 * If the shortcode is present in the page, then continue. Otherwise, just return
 */

/*
 * Set up constants
 */
defined( 'ABSPATH' ) or die( 'naff off' );
define( "SWEG_PLUGINDIRURI",  plugin_dir_url(__FILE__) ) ;
define( "SWEG_PLUGINDIR",  plugin_dir_path(__FILE__) ) ;


/**
 * conditionally load Isotope
 */
function sweg_load_assets() {
    global $post;
    if  (has_shortcode( $post->post_content, 'events-grid') ) {
	// wp_enqueue_script('Isotope', '//npmcdn.com/isotope-layout@3.0.1/dist/isotope.pkgd.js', array(), null  , false );
        wp_enqueue_script('jquery-Isotope', '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.1/isotope.pkgd.min.js' , array('jquery'), null  , false );
        wp_enqueue_style('events-grid-styles',  SWEG_PLUGINDIRURI . "/css/events-grid.css"  ) ;
    }
}
add_action( 'wp_enqueue_scripts', 'sweg_load_assets');

/*
 * Inject the script into the footer
 */
function sweg_init_isotope() {
    global $post;
    if  (has_shortcode( $post->post_content, 'events-grid') ) {

?>
    <script>                    
     $ = jQuery.noConflict()
	 $('.sw-events-grid').isotope({ 
	     itemSelector : '.event-card',
	     
	 }) ;
    </script>
<?php           }
}
// add_action('wp_footer', 'sweg_init_isotope');


add_shortcode(   'events-grid',  'sw_events_grid_loop' ) ;
function sw_events_grid_loop() {
    $events_loop = include (SWEG_PLUGINDIR  . '/loop/grid_loop.php' ) ;
    echo $html  ;
    return ;
}
