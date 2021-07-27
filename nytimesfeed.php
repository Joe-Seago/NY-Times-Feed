<?php
/**
 *
 * @link              https://joeseago.com
 * @since             1.0.1
 * @package           NYTimesFeed
 *
 * @wordpress-plugin
 * Plugin Name:       NY Times Feed
 * Plugin URI:        https://joeseago.com
 * Description:       Customized news feed showing selected section of New York Times articles, displayed on posts or pages via shortcode.
 * Version:           1.0.1
 * Author:            Joe Seago
 * Author URI:        https://joeseago.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nytimesfeed
 */

 // Include settings page file
include 'nytimesfeed-settings.php';

// Enqueue stylesheet
function nytimesfeed_scripts() {
    wp_enqueue_style( 'nytimesfeed__styles', plugins_url( 'nytimesfeed-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'nytimesfeed_scripts' );

// Create shortcode
add_shortcode( 'nytfeed', 'nytfeed_articles' );
function nytfeed_init(){
    function nytfeed_articles() {
        // Define API call variables
        $feedOptions = get_option('nytfeed_options');
        $newsSection = $feedOptions['nytfeed_field_section'];
        $apiKey = '9LjT0wi1nyUn9G1AVpVw0SKT0wMDyqTx'; // TODO: add this option to settings page
        $apiURL = 'https://api.nytimes.com/svc/topstories/v2/' . $newsSection . '.json?api-key=' . $apiKey . '';
        $numResults = 4; // TODO: add this option to settings page

        // Make API call
        $apiResponse = wp_remote_get( esc_url_raw( $apiURL ) );
        $parsedResponse = json_decode( wp_remote_retrieve_body( $apiResponse ), true);
        $parsedResults = $parsedResponse['results'];

        // Loop through response, build array of HTML blocks
       $fullFeed = [];
       for ( $i = 0; $i < $numResults; $i++ ) {
           // Variables captured from API response
           $articleTitle = $parsedResults[$i]['title'];
           $articleDesc = $parsedResults[$i]['abstract'];
           $articleAuthor = $parsedResults[$i]['byline'];
           $articleURL = $parsedResults[$i]['url'];
           $articleImage = $parsedResults[$i]['multimedia'][0]['url'];
           $articleAlt = $parsedResults[$i]['multimedia'][0]['caption'];

           // Build HTML block with captured variables
           $htmlBlock = "<div class='nytfeed__article'><h3 class='nytfeed__title'><a href='" . $articleURL . "' target='_blank' class='nytfeed__link'>" . $articleTitle . "</a></h3><p class='nytfeed__desc'>" . $articleDesc . "</p><p class='nytfeed__byline'>" . $articleAuthor . "</p><img src='". $articleImage . "' class='nytfeed__img' alt='" . $articleAlt . "' /></div>";
          
           // Push HTML block into new array of blocks
           array_push( $fullFeed, $htmlBlock );
       }

       // Show selected section of HTML blocks
       echo "<section class='nytfeed'>";
       foreach ( $fullFeed as $value ) {
           echo $value;
       }
       echo "</section>";
    }
}
add_action('init', 'nytfeed_init');

?>