<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 01-02-2018
 * Time: 11:48 AM
 */

final class WC_Role_Based_AddToCart_Price_Hide extends VSP_Framework {
    private static $_instance = NULL;
    public $settings_fields = NULL;

    public function __construct() {
        parent::__construct(array(
            'version'       => WC_RBAP_V,
            'plugin_file'   => WC_RBAP_FILE,
            'plugin_slug'   => WC_RBAP_SLUG,
            'db_slug'       => WC_RBAP_DB,
            'plugin_name'   => WC_RBAP_NAME,
            'hook_slug'     => WC_RBAP_DB,
            'addons'        => FALSE,
            'settings_page' => array(
                'menu_parent'      => 'woocommerce',
                'menu_title'       => WC_RBAP_NAME,
                'menu_type'        => 'submenu',
                'menu_slug'        => WC_RBAP_SLUG,
                'menu_capability'  => 'manage_woocommerce',
                'show_reset_all'   => FALSE,
                'framework_title'  => WC_RBAP_NAME,
                'option_name'      => WC_RBAP_DB,
                'style'            => 'simple',
                'ajax_save'        => FALSE,
                'is_single_page'   => FALSE,
                'is_sticky_header' => TRUE,
                'buttons'          => array(
                    'save'    => __("Save", 'wcrbap-hide'),
                    'restore' => FALSE,
                    'reset'   => FALSE,
                ),

                'status_page' => FALSE,
                'show_adds'   => FALSE,
                'show_faqs'   => FALSE,
            ),

        ));
    }

    public static function instance() {
        if( self::$_instance === NULL ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    /**
     * Admin Required Functions
     */
    public function admin_loaded() {
    }

    public function on_admin_init() {
    }

    public function admin_enqueue_assets() {
    }

    public function load_required_files() {
        if( vsp_is_request('admin') ) {
            vsp_load_file(WC_RBAP_PATH . 'includes/class-settings.php');
        }

        if( vsp_is_frontend() ) {
            vsp_load_file(WC_RBAP_PATH . 'includes/frontend.php');
        }

    }

    /**
     * Front End Required Functions
     */
    public function settings_init_before() {
        $this->settings_fields = new WC_Role_Based_AddToCart_Price_Settings($this->hook_slug());
    }

    public function on_wp_init() {
        if( vsp_is_frontend() ) {
            $this->frontend = new WC_Role_Based_AddToCart_Price_Hide_Frontend();
        }
    }

    public function init() {
    }

    public function init_hooks() {
        load_plugin_textdomain('wcrbap-hide', FALSE, WC_RBAP_PATH . '/languages');
    }

    public function addons_init() {
    }

    public function settings_init() {
    }

    public function add_assets() {
    }

    /**
     * @param string $file
     * @param string $domain
     * @return string
     */
    public function load_textdomain($file = '', $domain = '') {
        if( 'wcrbap-hide' === $domain )
            return WC_RBAP_PATH . '/languages/' . get_locale() . '.mo';
        return $file;
    }

    public function row_links($plugin_meta, $plugin_file) {
        if( $plugin_file === WC_RBAP_FILE ) {
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'http://wordpress.org/plugins/wc-role-based-addtocart-price-hide', __('F.A.Q', 'wcrbap-hide'));
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/varunsridharan/wc-role-based-addtocart-price-hide', __('View On Github', 'wcrbap-hide'));
            $plugin_meta[] = sprintf('<a href="%s">%s</a>', 'https://github.com/varunsridharan/wc-role-based-addtocart-price-hide', __('Report Issue', 'wcrbap-hide'));
            $plugin_meta[] = sprintf('&hearts; <a href="%s">%s</a>', 'http://paypal.me/varunsridharan23', __('Donate', 'wcrbap-hide'));
        }

        return $plugin_meta;
    }

    /**
     * @param $action
     * @param $file
     * @param $plugin_meta
     * @param $status
     * @return mixed
     */
    public function action_links($action, $file, $plugin_meta, $status) {
        $menu_link = admin_url('admin.php?page=wc-role-based-addtocart-price-hide');
        $actions[] = sprintf('<a href="%s">%s</a>', $menu_link, __('Settings', 'wcrbap-hide'));
        $actions[] = sprintf('<a href="%s">%s</a>', 'http://varunsridharan.in/plugin-support/', __('Contact Author', 'wcrbap-hide'));
        $action = array_merge($actions, $action);
        return $action;
    }
}