<?php 
/**
 * NY Times Feed plugin settings
 * 
 * @link              https://joeseago.com
 * @since             1.0.1
 * @package           NYTimesFeed
 */

function nytfeed_settings_init() {
    // Register a new setting for settings page
    register_setting( 'nytfeed', 'nytfeed_options' );
 
    // Register a new section in the settings page
    add_settings_section(
        'nytfeed_section_nytsection',
        __( 'Here is where you select section of New York Times articles for feed', 'nytfeed' ), 'nytfeed_section_nytsection_callback',
        'nytfeed'
    );
 
    // Register a new field
    add_settings_field(
        'nytfeed_field_section',
            __( 'Section', 'nytfeed' ),
        'nytfeed_field_section_cb',
        'nytfeed',
        'nytfeed_section_nytsection',
        array(
            'label_for'         => 'nytfeed_field_section',
            'class'             => 'nytfeed_row',
            'nytfeed_custom_data' => 'custom',
        )
    );
}
 
/**
 * Register init function
 */
add_action( 'admin_init', 'nytfeed_settings_init' );

/**
 *  TODO: 'nytfeed_section_nytsection_callback' callback function
 * @param array $args
 */
function nytfeed_section_nytsection_callback( $args ) {
}
 
/**
 * Section field callback function
 * @param array $args
 */
function nytfeed_field_section_cb( $args ) {
    // Get the value of the registered setting
    $options = get_option( 'nytfeed_options' );

    // NY Times article section options from NY Times API for reference
    // TODO: build loop for option dropdown with this array instead of hardcoded options
    $nytSections = ['home','opinion','world','national','politics',
                    'upshot','nyregion','business','technology','science',
                    'health','sports','arts','books','movies',
                    'theater','sundayreview','fashion','tmagazine','food',
                    'travel','magazine','realestate','automobiles','obituaries','insider'];
    ?>

    <select
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['nytfeed_custom_data'] ); ?>"
            name="nytfeed_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
        
        <option value="home" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'home', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'home', 'nytfeed' ); ?>
        </option>

        <option value="opinion" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'opinion', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'opinion', 'nytfeed' ); ?>
        </option>

        <option value="world" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'world', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'world', 'nytfeed' ); ?>
        </option>

        <option value="national" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'national', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'national', 'nytfeed' ); ?>
        </option>

        <option value="politics" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'politics', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'politics', 'nytfeed' ); ?>
        </option>

        <option value="upshot" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'upshot', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'upshot', 'nytfeed' ); ?>
        </option>

        <option value="nyregion" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'nyregion', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'nyregion', 'nytfeed' ); ?>
        </option>

        <option value="business" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'business', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'business', 'nytfeed' ); ?>
        </option>

        <option value="technology" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'technology', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'technology', 'nytfeed' ); ?>
        </option>

        <option value="science" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'science', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'science', 'nytfeed' ); ?>
        </option>

        <option value="health" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'health', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'health', 'nytfeed' ); ?>
        </option>
        
        <option value="sports" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'sports', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'sports', 'nytfeed' ); ?>
        </option>

        <option value="arts" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'arts', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'arts', 'nytfeed' ); ?>
        </option>

        <option value="books" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'books', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'books', 'nytfeed' ); ?>
        </option>

        <option value="movies" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'movies', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'movies', 'nytfeed' ); ?>
        </option>

        <option value="theater" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'theater', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'theater', 'nytfeed' ); ?>
        </option>

        <option value="sundayreview" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'sundayreview', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'sundayreview', 'nytfeed' ); ?>
        </option>

        <option value="fashion" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'fashion', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'fashion', 'nytfeed' ); ?>
        </option>

        <option value="tmagazine" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'tmagazine', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'tmagazine', 'nytfeed' ); ?>
        </option>

        <option value="food" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'food', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'food', 'nytfeed' ); ?>
        </option>

        <option value="travel" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'travel', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'travel', 'nytfeed' ); ?>
        </option>

        <option value="magazine" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'magazine', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'magazine', 'nytfeed' ); ?>
        </option>

        <option value="realestate" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'realestate', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'realestate', 'nytfeed' ); ?>
        </option>

        <option value="travel" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'travel', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'travel', 'nytfeed' ); ?>
        </option>

        <option value="automobiles" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'automobiles', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'automobiles', 'nytfeed' ); ?>
        </option>

        <option value="obituaries" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'obituaries', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'obituaries', 'nytfeed' ); ?>
        </option>

        <option value="insider" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'insider', false ) ) : ( '' ); ?>>
            <?php esc_html_e( 'insider', 'nytfeed' ); ?>
        </option>
    </select>
    <?php
}
 
/**
 * Top level menu page
 */
function nytfeed_options_page() {
    add_menu_page(
        'NY Times Feed Options',
        'NYT Feed',
        'manage_options',
        'nytfeed',
        'nytfeed_options_page_html'
    );
}

/**
 * Register options page
 */
add_action( 'admin_menu', 'nytfeed_options_page' );
 
/**
 * Top level menu callback function
 */
function nytfeed_options_page_html() {
    // Check user capabilities
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
 
    // Error/update messages
    // Check if the user has submitted the settings
    if ( isset( $_GET['settings-updated'] ) ) {
        // Add settings saved message with the class of "updated"
        add_settings_error( 'nytfeed_messages', 'nytfeed_message', __( 'Settings Saved', 'nytfeed' ), 'updated' );
    }
 
    // Show error/update messages
    settings_errors( 'nytfeed_messages' );
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'nytfeed' );
            do_settings_sections( 'nytfeed' );
            submit_button( 'Save Section' );
            ?>
        </form>
    </div>
    <?php
}