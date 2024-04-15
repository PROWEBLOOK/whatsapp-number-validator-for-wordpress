<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
/**
 * The main plugin class
 *
 * @package plugins
 */

/**
 * Class PROW_Plugin
 */
class PROW_Plugin {

	/**
	 * Whether we run in debugging mode.
	 *
	 * @var  bool
	 */
	protected static $debug = NULL;

	/**
	 * Plugin instance.
	 *
	 * @see   get_instance()
	 * @var  object
	 */
	protected static $instance = NULL;

	/**
	 * URL to this plugin's directory.
	 *
	 * @var  string
	 */
	public $plugin_url = '';

	/**
	 * Path to this plugin's directory.
	 *
	 * @var  string
	 */
	public $plugin_path = '';

	/**
	 * The API Object.
	 *
	 * @var object
	 */
	private $api = NULL;

	/**
	 * The validator object.
	 *
	 * @var object
	 */
	private $validator = NULL;

	/**
	 * The options
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Access this plugin’s working instance
	 *
	 * @wp-hook plugins_loaded
	 * @return  object of this class
	 */
	public static function get_instance() {

		if ( NULL === self::$debug ) {
			self::$debug = ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? TRUE : FALSE;
		}

		NULL === self::$instance and self::$instance = new self;

		return self::$instance;
	}

	/**
	 * Used for regular plugin work.
	 *
	 * @wp-hook  plugins_loaded
	 * @return   void
	 */
	public function plugin_setup() {

		$this->plugin_url = plugins_url( '/', dirname( __FILE__ ) );
		$this->plugin_path = 'Proweblook-wa-validator/';
		$this->load_language( 'Proweblook-wa-validator' );

		// Load Options.
		$this->set_options( get_option( 'prowa_settings', array() ) );

		// Load the API.
		require_once( dirname( __FILE__ ) . '/API/class-prow-countries.php' );
		require_once( dirname( __FILE__ ) . '/API/class-prow-api.php' );
		require_once( dirname( __FILE__ ) . '/API/class-prow-phone-validator.php' );
		PROW_Countries::populate();
		$this->api = new PROW_API();
		$this->api->set_apikey( $this->get_option( 'prowa_api_key' ) );
		$this->api->set_country_code( $this->get_option( 'prowa_country' ) );
		$this->validator = new PROW_Phone_Validator();
		$this->validator->set_api( $this->api );

		// Load the Ajax Interface.
		require_once( dirname( __FILE__ ) . '/AJAX/class-prow-ajax-handler.php' );
		require_once( dirname( __FILE__ ) . '/AJAX/class-prow-ajax-validate-phone.php' );
		$ajax_handler = new PROW_Ajax_Handler();
		$ajax = new PROW_Ajax_Validate_Phone();
		$ajax->set_validator( $this->validator );
		$ajax->set_handler( $ajax_handler );

		/**
		 * Filters whether the ajax call is only for logged in users. Default: FALSE.
		 *
		 * @param bool
		 */
		$ajax_is_private = (bool) apply_filters( 'PROW_api_is_private', TRUE );
		$ajax->set_private( $ajax_is_private );
		$ajax->register();

		// Load WooCommerce Handler.
		if ( 1 === (int) $this->get_option( 'prowa_auto_check' ) && class_exists( 'WooCommerce' ) ) {
			require_once( dirname( __FILE__ ) . '/WC/class-prow-wc.php' );
			$wc = new PROW_WC();
			$wc->set_validator( $this->validator );
			$wc->setup();
		}

		// Load the Contact Form 7 Handler.
		if ( 1 === (int) $this->get_option( 'prowa_cf7_check' ) && defined( 'WPCF7_VERSION' ) ) {
			require_once( dirname( __FILE__ ) . '/CF7/class-prow-contactform7.php' );
			$cf7 = new PROW_ContactForm7();
			$cf7->set_validator( $this->validator );
			$cf7->setup();
		}

		// Load the Gravity Forms Handler.
		if ( 1 === (int) $this->get_option( 'prowa_gravity_check' ) ) {
			require_once( dirname( __FILE__ ) . '/Gravity/class-prow-gravity-forms.php' );
			$gf = new PROW_GravityForms();
			$gf->set_validator( $this->validator );
			$gf->setup();
		}

		// Load the WPForms Handler.
		if ( 1 === (int) $this->get_option( 'prowa_wpforms_check' ) ) {
			require_once( dirname( __FILE__ ) . '/WPForms/class-prow-wpforms.php' );
			$wpf = new PROW_WPForms();
			$wpf->set_validator( $this->validator );
			$wpf->setup();
		}

		// Load the Ninja Forms Handler.
		if ( 1 === (int) $this->get_option( 'prowa_ninja_check' ) ) {
			require_once( dirname( __FILE__ ) . '/Ninja/class-prow-ninja-forms.php' );
			$nf = new PROW_NinjaForms();
			$nf->set_validator( $this->validator );
			$nf->setup();
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'register_script' ) );

		if ( is_admin() ) {
			// Load the Admin Interface.
			require_once( dirname( __FILE__ ) . '/class-prow-admin.php' );
			$admin = PROW_Admin::get_instance();
			$admin->load();
		}
	}

	/**
	 * Register the Javascript.
	 */
	public function register_script() {

		// Minimize the script on production site.
		$min = '';
		if ( ! self::$debug ) {
			$min = '.min';
		}
		wp_register_script('prowa_frontend_script', $this->get_plugin_url() . 'assets/js/prowa_form_script' . $min . '.js', array( 'jquery', 'underscore' ), '1.0', TRUE );

		$js_vars = $this->js_localization();

		// The HTML templates.
		$js_vars['tpl']    = '<span class="prowa-error"><%- status %> <%- phone %></span>';

		wp_localize_script( 'prowa_frontend_script', 'prowa', $js_vars);
	}

	/**
	 * Enqueue Script on frontend.
	 *
	 * @see PROW_activate_third_party()
	 */
	public function enqueue_frontend() {
		wp_enqueue_script( 'prowa_frontend_script' );
	}

	/**
	 * Add footer styles on frontend
	 */
	public function footer_styles() {
		?><style>.prowa-error{color: #f00;}</style><?php
	}

	/**
	 * Is the debug mode on?
	 *
	 * @return boolean
	 */
	public function is_debug() {

		return self::$debug;
	}
	/**
	 * Get the plugin url
	 *
	 * @return string plugin url.
	 */
	public function get_plugin_url() {

		return $this->plugin_url;
	}

	/**
	 * Get the plugin url
	 *
	 * @return string plugin path.
	 */
	public function get_plugin_path() {

		return $this->plugin_path;
	}

	/**
	 * Localized Javascript Variables.
	 *
	 * @return array
	 **/
	public function js_localization() {

		return array(
			'AJAX_URL'                    => esc_js( admin_url( 'admin-ajax.php' ) ),
			'nonce'                       => esc_js( wp_create_nonce( 'validate-phone' ) ),
			'VALID_CONFIRMED'             => esc_js( __('Exist on WA ', 'Proweblook-wa-validator') ),
			'VALID_UNCONFIRMED'           => esc_js( __('Not Exists on WA ' , 'Proweblook-wa-validator') ),
			'INVALID'                     => esc_js( __('Invalid ', 'Proweblook-wa-validator') ),
			'DELAYED'                     => esc_js( __('Validation Delayed', 'Proweblook-wa-validator') ),
			'RATE_LIMIT_EXCEEDED'         => esc_js( __('Rate Limit Exceeded', 'Proweblook-wa-validator') ),
			'API_KEY_INVALID_OR_DEPLETED' => esc_js( __('API Key Invalid or Depleted', 'Proweblook-wa-validator') ),
			'UNKNOWN'                     => esc_js( __('Phone Number Missing', 'Proweblook-wa-validator') ),
			800                           => esc_js( __('Phone Number Missing', 'Proweblook-wa-validator') ),
			801                           => esc_js( __('Service Unavailable', 'Proweblook-wa-validator') ),
		);
	}

	/**
	 * Get the options.
	 *
	 * @return array
	 */
	public function get_options() {

		return $this->options;
	}

	/**
	 * Set the options.
	 *
	 * @param array $options The options.
	 *
	 * @return array
	 */
	public function set_options( $options ) {

		$defaults = array(
			'bpmvp_api_key' => '',
		);
		$this->options = wp_parse_args( (array) $options, $defaults );
		return $this->get_options();
	}

	/**
	 * Return a single option.
	 *
	 * @param string $option_key The option key.
	 *
	 * @return mixed|null
	 */
	public function get_option( $option_key ) {

		return ( ! empty( $this->options[ $option_key ] ) ) ? $this->options[ $option_key ] : NULL;
	}



	/**
	 * Empty and protected constructor.
	 */
	protected function __construct() {}

	/**
	 * Empty and private clone.
	 */
	private function __clone(){}


	/**
	 * Loads translation file.
	 *
	 * Accessible to other classes to load different language files (admin and
	 * front-end for example).
	 *
	 * @wp-hook init
	 * @param   string $domain The plugins domain.
	 * @return  void
	 */
	public function load_language( $domain ) {
		load_plugin_textdomain(
			$domain,
			false,
			$this->plugin_path . 'languages/'
		);
	}
	
}
