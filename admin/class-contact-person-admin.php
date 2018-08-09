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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public
	function __construct(
		$plugin_name, $version
	) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public
	function enqueue_styles() {

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
			wp_enqueue_style( "tag-editor_css", plugin_dir_url( __FILE__ ) . 'css/jquery.tag-editor.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contact-person-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public
	function enqueue_scripts() {

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
			wp_enqueue_script( "select2_js", plugin_dir_url( __FILE__ ) . 'js/select2.full.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( "tag-editor_js", plugin_dir_url( __FILE__ ) . 'js/jquery.tag-editor.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( "caret.js", plugin_dir_url( __FILE__ ) . 'js/jquery.caret.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contact-person-admin.js', array( 'jquery' ), $this->version, true );
		}
	}

	/**
	 * Codes Added
	 *
	 * @since 1.0.0
	 */


	public
	function kmcp_custom_post_type() {
		$labels = array(
			'name'           => 'Contact Person',
			'singular_name'  => 'Contact Person',
			'menu_name'      => 'Contact Person',
			'name_admin_bar' => 'Contact Person',
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
			_( 'Contact Person Information' ),
			array( $this, 'kmcp_information_metabox' ),
			'kmcp-contact-person',
			'advanced',
			'default'
		);
		add_meta_box(
			'kmcp-contact-person-country',
			_( 'Contact Person Country' ),
			array( $this, 'kmcp_country_metabox' ),
			'kmcp-contact-person',
			'advanced',
			'default'
		);
	}

	function kmcp_information_metabox() {
		global $post_id;
		wp_nonce_field( basename( __FILE__ ), 'kmcp_information_nonce' );
		?>
        <table>

            <tr>
                <td>
                    <label for="kmcp-office">Office:</label>
                </td>
                <td>
                    <input name="kmcp-office" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-office', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-department">Department: </label>
                </td>
                <td>
                    <input name="kmcp-department" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-department', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-tel">Tel:</label>
                </td>
                <td>
                    <input name="kmcp-tel" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-tel', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-fax">Fax:</label>
                </td>
                <td>
                    <input name="kmcp-fax" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-fax', true ) ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kmcp-email">Email: </label>
                </td>
                <td>
                    <input name="kmcp-email" type="email"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-email', true ) ?>">
                </td>
            </tr>
        </table>

		<?php
	}

	function kmcp_country_metabox() {
		$countries = $this->countries;
		$scripts   = "<script> var countries = [];\n";
		foreach ( $countries as $country ) {
			$scripts .= "countries.push('" . $country . "');\n";
		}
		$scripts .= "console.log(countries);</script>";
		echo $scripts;

		global $post_id;
		$index            = 1;
		$country_field_id = 1;
		$kmcp_city_zip    = get_post_meta( $post_id, 'kmcp-country-zip-data', true );
		?>

        <table id="kmcp-country-container">
			<?php if ( $kmcp_city_zip == '' ): ?>
                <tr>
                    <td>
                        <label for="kmcp-country-1">Country:</label>
                    </td>
                    <td>
                        <select name="kmcp-country-1" id="kmcp-country-1">
                            <option value="0"> Select a country ...</option>
							<?php foreach ( $countries as $country ): ?>
                                <option value="<?php echo $index ?>"><?php echo $country ?></option>
								<?php $index ++; ?>
							<?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="kmcp-country-zip-1">ZIP Codes:</label>
                    </td>
                    <td>
                        <input name="kmcp-country-zip-1" id="kmcp-country-zip-1" type="text"
                               value="">
                    </td>
                </tr>
				<?php
				$country_field_id ++;
			else:
				$country_data = explode( ";", $kmcp_city_zip );
				foreach ( $country_data as $country_datum ):
					if ( $country_datum != '' ):
						$class = 'class="kmcp-country-zip-' . $country_field_id . '-container"';
						?>
                        <tr <?php echo ( $country_field_id > 1 ) ? $class : "" ?>>
                            <td>
                                <label for="kmcp-country-<?php echo $country_field_id ?>">Country:</label>
                            </td>
                            <td>
                                <select name="kmcp-country-<?php echo $country_field_id ?>"
                                        id="kmcp-country-<?php echo $country_field_id ?>">
                                    <option value="0"> Select a country ...</option>
									<?php
									$data = explode( ":", $country_datum );
									foreach ( $countries as $country ): ?>
                                        <option kofi="<?php echo $data[0]; ?>"
                                                value="<?php echo $index ?>" <?php echo ( $data[0] == $index ) ? "selected" : "" ?>><?php echo $country ?></option>
										<?php $index ++; ?>
									<?php endforeach; ?>
                                </select>
                            </td>
							<?php if ( $country_field_id > 1 ): ?>
                                <td>
                                    <button class="button button-link-delete"
                                            id="kmcp-country-delete-<?php echo $country_field_id ?>">Delete
                                    </button>
                                </td>
							<?php endif; ?>
                        </tr>
                        <tr <?php echo ( $country_field_id > 1 ) ? $class : "" ?>>
                            <td>
                                <label for="kmcp-country-zip-<?php echo $country_field_id ?>">ZIP Codes:</label>
                            </td>
                            <td>
                                <input name="kmcp-country-zip-<?php echo $country_field_id ?>"
                                       id="kmcp-country-zip-<?php echo $country_field_id ?>" type="text"
                                       value="<?php echo $data[1] ?>">
                                <br>
                            </td>

                        </tr>

						<?php
						$country_field_id ++;
						$index = 1;
					endif;
				endforeach;
			endif;
			?>
        </table>
        <br><br>
        <b id="kmcp-country-warning">Warning: Please select a country first and its zip codes</b><br>
        <button class="button-primary" id="kmcp-add-country">+ Add Country</button>
        <input name="kmcp-country-zip-data" id="kmcp-country-zip-data" type="hidden" style="width:100%;"
               value="<?php echo get_post_meta( $post_id, 'kmcp-country-zip-data', true ) ?>" readonly>

		<?php
		echo "<script>var id = " . $country_field_id . "</script>";
	}

	public
	function kmcp_save_information_meta(
		$post_id
	) {
		$is_valid_nonce = ( isset( $_POST['kmcp_information_nonce'] ) && wp_verify_nonce( $_POST['kmcp_information_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

		// List of fields to update
		$fields = array(
			'kmcp-greeting',
			'kmcp-fname',
			'kmcp-lname',
			'kmcp-office',
			'kmcp-department',
			'kmcp-tel',
			'kmcp-fax',
			'kmcp-email',
			'kmcp-country-zip-data'
		);

		if ( $is_valid_nonce ) {
			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $field ] ) ) {
					update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
				}
			}
		}

	}

	public function kmcp_shortcode() {
		?>
        <form action="">
            <label for="kmcp-search">Enter ZIP: </label>
            <input type="text" name="kmcp-search">
            <button>Search</button>
        </form>
        <?php
	}
}
