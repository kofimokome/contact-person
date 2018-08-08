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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contact-person-admin.css', array(), $this->version, 'all' );

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contact-person-admin.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Codes Added
	 *
	 * @since 1.0.0
	 */


	public function kmcp_custom_post_type() {
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
			'supports'             => array( 'title','thumbnail' ),
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
            <tr>
                <td>
                    <label for="kmcp-zip">ZIP: </label>
                </td>
                <td>
                    <input name="kmcp-zip" type="text"
                           value="<?php echo get_post_meta( $post_id, 'kmcp-zip', true ) ?>">
                </td>
            </tr>
        </table>

		<?php
	}

	public function kmcp_save_information_meta( $post_id ) {
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
			'kmcp-zip'
		);

		if ( $is_valid_nonce ) {
			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $field ] ) ) {
					update_post_meta( $post_id, $field, sanitize_text_field( $_POST[ $field ] ) );
				}
			}
		}

	}
}
