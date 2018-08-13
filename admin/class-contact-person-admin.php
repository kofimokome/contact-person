<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.kofimokome.ml
 * @since      1.0.0
 *
 * @package    Contact_Person
 * @subpackage Contact_Person/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Contact_Person
 * @subpackage Contact_Person/admin
 * @author     Kofi Mokome <kofimokome10@gmail.com>
 */
class Contact_Person_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	// todo: contact-person' translate all countries to German

	private $countries = array(
		"Afghanistan",
		"Albania",
		"Algeria",
		"Andorra",
		"Angola",
		"Anguilla",
		"Antigua & Barbuda",
		"Argentina",
		"Armenia",
		"Australia",
		"Austria",
		"Azerbaijan",
		"Bahamas",
		"Bahrain",
		"Bangladesh",
		"Barbados",
		"Belarus",
		"Belgium",
		"Belize",
		"Benin",
		"Bermuda",
		"Bhutan",
		"Bolivia",
		"Bosnia & Herzegovina",
		"Botswana",
		"Brazil",
		"Brunei Darussalam",
		"Bulgaria",
		"Burkina Faso",
		"Myanmar/Burma",
		"Burundi",
		"Cambodia",
		"Cameroon",
		"Canada",
		"Cape Verde",
		"Cayman Islands",
		"Central African Republic",
		"Chad",
		"Chile",
		"China",
		"Colombia",
		"Comoros",
		"Congo",
		"Costa Rica",
		"Croatia",
		"Cuba",
		"Cyprus",
		"Czech Republic",
		"Democratic Republic of the Congo",
		"Denmark",
		"Djibouti",
		"Dominica",
		"Dominican Republic",
		"Ecuador",
		"Egypt",
		"El Salvador",
		"Equatorial Guinea",
		"Eritrea",
		"Estonia",
		"Ethiopia",
		"Fiji",
		"Finland",
		"France",
		"French Guiana",
		"Gabon",
		"Gambia",
		"Georgia",
		"Germany",
		"Ghana",
		"Great Britain",
		"Greece",
		"Grenada",
		"Guadeloupe",
		"Guatemala",
		"Guinea",
		"Guinea-Bissau",
		"Guyana",
		"Haiti",
		"Honduras",
		"Hungary",
		"Iceland",
		"India",
		"Indonesia",
		"Iran",
		"Iraq",
		"Israel and the Occupied Territories",
		"Italy",
		"Ivory Coast",
		"Jamaica",
		"Japan",
		"Jordan",
		"Kazakhstan",
		"Kenya",
		"Kosovo",
		"Kuwait",
		"Kyrgyzstan",
		"Laos",
		"Latvia",
		"Lebanon",
		"Lesotho",
		"Liberia",
		"Libya",
		"Liechtenstein",
		"Lithuania",
		"Luxembourg",
		"Republic of Macedonia",
		"Madagascar",
		"Malawi",
		"Malaysia",
		"Maldives",
		"Mali",
		"Malta",
		"Martinique",
		"Mauritania",
		"Mauritius",
		"Mayotte",
		"Mexico",
		"Moldova",
		"Monaco",
		"Mongolia",
		"Montenegro",
		"Montserrat",
		"Morocco",
		"Mozambique",
		"Namibia",
		"Nepal",
		"Netherlands",
		"New Zealand",
		"Nicaragua",
		"Niger",
		"Nigeria",
		"North Korea",
		"Norway",
		"Oman",
		"Pacific Islands",
		"Pakistan",
		"Panama",
		"Papua New Guinea",
		"Paraguay",
		"Peru",
		"Philippines",
		"Poland",
		"Portugal",
		"Puerto Rico",
		"Qatar",
		"Reunion",
		"Romania",
		"Russian Federation",
		"Rwanda",
		"Saint Kitts and Nevis",
		"Saint Lucia",
		"Saint Vincent\'s & Grenadines",
		"Samoa",
		"Sao Tome and Principe",
		"Saudi Arabia",
		"Senegal",
		"Serbia",
		"Seychelles",
		"Sierra Leone",
		"Singapore",
		"Slovakia",
		"Slovenia",
		"Solomon Islands",
		"Somalia",
		"South Africa",
		"South Korea",
		"South Sudan",
		"Spain",
		"Sri Lanka",
		"Sudan",
		"Suriname",
		"Swaziland",
		"Sweden",
		"Switzerland",
		"Syria",
		"Tajikistan",
		"Tanzania",
		"Thailand",
		"Timor Leste",
		"Togo",
		"Trinidad & Tobago",
		"Tunisia",
		"Turkey",
		"Turkmenistan",
		"Turks & Caicos Islands",
		"Uganda",
		"Ukraine",
		"United Arab Emirates",
		"United States of America",
		"Uruguay",
		"Uzbekistan",
		"Venezuela",
		"Vietnam",
		"Virgin Islands (US)",
		"Virgin Islands (UK)",
		"Yemen",
		"Zambia",
		"Zimbabwe"
	);

	private $default_post = - 1;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct(
		$plugin_name, $version
	) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		if ( get_option( "kmcp_default_post" ) == false ) {
			add_option( "kmcp_default_post", - 1, null, "no" );
		} else {
			$this->default_post = (int) get_option( "kmcp_default_post" );
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Person_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Person_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $post_type;
		if ( $post_type == "kmcp-contact-person" ) {
			wp_enqueue_style( "select2_css", plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contact-person-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Person_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Person_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $post_type, $post_id;
		if ( $post_type == "kmcp-contact-person" ) {
			wp_enqueue_script( "select2_js", plugin_dir_url( __FILE__ ) . 'js/select2.full.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contact-person-admin.js', array( 'jquery' ), $this->version, true );
			wp_localize_script( $this->plugin_name, 'my_data', array(
				'default_post_id' => $this->default_post,
				'this_post_id'    => $post_id,
				"post_type"       => $post_type
			) );
		}
	}

	/**
	 * Codes Added
	 *
	 * @since 1.0.0
	 */


	public function kmcp_custom_post_type() {
		$labels = array(
			'name'           => __( 'Contact Person', 'contact-person' ),
			'singular_name'  => __( 'Contact Person', 'contact-person' ),
			'menu_name'      => __( 'Contact Person', 'contact-person' ),
			'name_admin_bar' => __( 'Contact Person', 'contact-person' ),
			'add_new_item'   => __( "Add Contact Person", "contact-person" ),
			'edit_item'      => __( "Edit Contact Person", "contact-person" )
		);

		$args = array(
			'labels'               => $labels,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'capability_type'      => 'post',
			'hierarchical'         => false,
			'menu_position'        => 25,
			'menu_icon'            => 'dashicons-admin-site',
			'supports'             => array( 'title', 'thumbnail' ),
			'register_meta_box_cb' => array( $this, 'kmcp_meta_boxes' )
		);

		register_post_type( 'kmcp-contact-person', $args );
	}

	function kmcp_meta_boxes() {
		add_meta_box(
			'kmcp-contact-person-information',
			__( 'Contact Person Information', 'contact-person' ),
			array( $this, 'kmcp_information_metabox' ),
			'kmcp-contact-person',
			'advanced',
			'default'
		);
		add_meta_box(
			'kmcp-contact-person-default',
			__( 'Default Contact', 'contact-person' ),
			array( $this, 'kmcp_default_metabox' ),
			'kmcp-contact-person',
			'advanced',
			'default'
		);
	}

	function kmcp_information_metabox() {
		global $post_id;
		$countries        = $this->countries;
		$country_field_id = get_post_meta( $post_id, 'kmcp-country', true );
		$index            = 1;
		wp_nonce_field( basename( __FILE__ ), 'kmcp_information_nonce' );
		?>
        <table id="kmcp-information-metabox-container">

            <tr>
                <td>
                    <label for="kmcp-name"><?php _e( "Partner Name", "contact-person" ) ?>: </label>
                </td>
                <td>
                    <input name="kmcp-name" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-name', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-location"><?php _e( "Location", "contact-person" ) ?>:</label>
                </td>
                <td>
                    <input name="kmcp-location" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-location', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-address"><?php _e( "Address", "contact-person" ) ?>:</label>
                </td>
                <td>
                    <input name="kmcp-address" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-address', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-tel"><?php _e( "Telephone", "contact-person" ) ?>:</label>
                </td>
                <td>
                    <input name="kmcp-tel" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-tel', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-email"><?php _e( "Email", "contact-person" ) ?>: </label>
                </td>
                <td>
                    <input name="kmcp-email" type="email"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-email', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-postcode-from"><?php _e( "Postcode from", "contact-person" ) ?>: </label>
                </td>
                <td>
                    <input name="kmcp-postcode-from" type="number"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-postcode-from', true ) ?>" <?php echo ( $post_id == $this->default_post ) ? "readonly" : "" ?>>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-postcode-to"><?php _e( "Postcode to", "contact-person" ) ?>: </label>
                </td>
                <td>
                    <input name="kmcp-postcode-to" type="number"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-postcode-to', true ) ?>" <?php echo ( $post_id == $this->default_post ) ? "readonly" : "" ?>>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-country"><?php _e( "Country", "contact-person" ) ?>:</label>
                </td>
                <td>
                    <select name="kmcp-country" id="kmcp-country">
                        <option value="0"> <?php _e( "Select a country", "contact-person" ) ?> ...</option>
						<?php // todo: make select read only
						foreach ( $countries as $country ): ?>
							<?php if ( $country_field_id == '' ): ?>
                                <option value="<?php echo $index ?>" <?php echo ( 68 == $index ) ? "selected" : "" ?>><?php _e( $country, "contact-person" ) ?></option>
							<?php else: ?>
                                <option value="<?php echo $index ?>" <?php echo ( $country_field_id == $index ) ? "selected" : "" ?>><?php echo $country ?></option>

							<?php
							endif;
							$index ++;
							?>
						<?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

		<?php
	}

	function kmcp_default_metabox() {
		global $post_id;

		_e( "Set this contact as default", "contact-person" ); ?>?: <input name="kmcp-set-default"
                                                                           type="checkbox" <?php echo ( $this->default_post == $post_id ) ? "checked" : "" ?>>
        <br> <br>
        <b><?php _e( "Note", "contact-person" ) ?>:
            <i> <?php _e( "This will make this contact appear on all searches", "contact-person" ) ?></i></b>
		<?php
	}

	public function kmcp_save_information_meta( $post_id ) {
		$is_valid_nonce = ( isset( $_POST['kmcp_information_nonce'] ) && wp_verify_nonce( $_POST['kmcp_information_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

		// List of fields to update
		$fields = array(
			'kmcp-location',
			'kmcp-address',
			'kmcp-tel',
			'kmcp-email',
			'kmcp-set-default',
			'kmcp-postcode-from',
			'kmcp-postcode-to',
			'kmcp-name',
			'kmcp-country'
		);

		if ( $is_valid_nonce ) {
			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $field ] ) ) {
					update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
				}
			}

			if ( isset( $_POST["kmcp-set-default"] ) && $_POST["kmcp-set-default"] == "on" ) {
				update_option( "kmcp_default_post", $post_id );

			} else {
				if ( $this->default_post == $post_id ) {
					update_option( "kmcp_default_post", - 1 );
				}
			}

		}
	}
}
