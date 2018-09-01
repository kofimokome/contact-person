<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.kofimokome.ml
 * @since      1.0.0
 *
 * @package    Contact_Person
 * @subpackage Contact_Person/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Contact_Person
 * @subpackage Contact_Person/public
 * @author     Kofi Mokome <kofimokome10@gmail.com>
 */
class Contact_Person_Public {

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
	 * The ID of the default contact person
	 */
	private $default_post;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->default_post = (int) get_option( "kmcp_default_post" );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contact-person-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contact-person-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajax_object', array(
			'ajax_url' => admin_url( 'admin-ajax.php' )
		) );

	}

	public function kmcp_find_zip() {
		global $wpdb;
		$zip     = $_POST['zip'];
		$results = array(
			'status'  => 'fail',
			'results' => array(),
			'tel'     => __( 'Telephone', 'contact-person' ) //dirty way of fixing translation problem
		);
		if ( $zip != '' ) {
			$zip = (int) $zip;

			/* Lets add the default contact to the beginning of the search*/
			$tel           = get_post_meta( $this->default_post, 'kmcp-tel', true );
			$email         = get_post_meta( $this->default_post, 'kmcp-email', true );
			$location      = get_post_meta( $this->default_post, 'kmcp-location', true );
			$address       = get_post_meta( $this->default_post, 'kmcp-address', true );
			$postcode_from = get_post_meta( $this->default_post, 'kmcp-postcode-from', true );
			$postcode_to   = get_post_meta( $this->default_post, 'kmcp-postcode-to', true );
			$name          = get_post_meta( $this->default_post, 'kmcp-name', true );
			$country       = get_post_meta( $this->default_post, 'kmcp-country', true );
			$temp          = array(
				'name'          => $name,
				'location'      => $location,
				'address'       => $address,
				'country'       => $country,
				'postcode_from' => $postcode_from,
				'postcode_to'   => $postcode_to,
				'tel'           => $tel,
				'email'         => $email
			);
			array_push( $results['results'], $temp );
			$results['status'] = 'success';

			/* Adding the other results if any */
			$args            = array(
				'post_type'   => 'kmcp-contact-person',
				'post_status' => 'publish',
                'posts_per_page'=> -1
			);
			$contact_persons = new WP_Query( $args );
			while ( $contact_persons->have_posts() ) {
				$contact_persons->the_post();
				$tel           = get_post_meta( get_the_ID(), 'kmcp-tel', true );
				$email         = get_post_meta( get_the_ID(), 'kmcp-email', true );
				$location      = get_post_meta( get_the_ID(), 'kmcp-location', true );
				$address       = get_post_meta( get_the_ID(), 'kmcp-address', true );
				$postcode_from = get_post_meta( get_the_ID(), 'kmcp-postcode-from', true );
				$postcode_to   = get_post_meta( get_the_ID(), 'kmcp-postcode-to', true );
				$name          = get_post_meta( get_the_ID(), 'kmcp-name', true );
				$country       = get_post_meta( get_the_ID(), 'kmcp-country', true );
				// $pic           = get_the_post_thumbnail( get_the_ID() );

				/* Just in case it happens */
				if ( (int) $postcode_from > (int) $postcode_to ) {
					$temp_val      = $postcode_to;
					$postcode_to   = $postcode_from;
					$postcode_from = $temp_val;
				}

				if ( $zip >= (int) $postcode_from && $zip <= (int) $postcode_to && ( get_the_ID() != $this->default_post ) ) { //country 68
					$temp = array(
						'name'          => $name,
						'location'      => $location,
						'address'       => $address,
						'country'       => $country,
						'postcode_from' => $postcode_from,
						'postcode_to'   => $postcode_to,
						'tel'           => $tel,
						'email'         => $email
					);
					array_push( $results['results'], $temp );
				}
			}
			echo json_encode( $results );
			wp_reset_query();
			wp_die();
			//die();

		} else {
			echo json_encode( $results );
			wp_die();
		}
	}

	public function kmcp_shortcode() {
		?>
        <div id="kmcp-search-container">
            <h1><b><?php _e( "Postcode search", "contact-person" ); ?></b></h1>
			<?php _e( "Enter your postcode here and we will look for the right contact person", "contact-person" ); ?>
            <div class="kmcp-search" style="margin-top: 10px">
                <input type="number" name="kmcp-search" id="kmcp-search"
                       placeholder="<?php _e( "Enter postcode", "contact-person" ); ?>">
                <button id="kmcp-search-button"><span
                            class="fas fa-sign-out-alt"> </span><?php _e( "Search", "contact-person" ); ?></button>
            </div>
        </div>
        <div id="kmcp-results-container">
            <!--<div class="kmcp-result-title">
                title here
            </div>
            <div class="kmcp-result-body">
                <div class="kmcp-result-information">
                    <p><b>Some titlehere</b></p>
                    <p>
                        meibner strabe 191</p>
                    <p>
                        01323 redsds
                    </p>
                    <p>
                        telefon : <a href="tel:8392839283">33u832832</a>
                    </p>
                    <p>
                        email: <a href="mailto:kofi@jdks.cds">kofi@jksj.ckd</a>
                    </p>
                </div>
                <div class="kmcp-result-pic">
                    <img src="" alt="">
                </div>
            </div>-->
        </div>
		<?php
	}
}
