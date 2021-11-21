<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WP_Gutendex{

    /**
     * Gutendex Endpoint.
     */
    private $gutendex;

    /**
     * Database
     */
    private $db;

    /**
     * Admin
     */
    private $admin;

    function __construct() {
        /**
         * Gutendex
         */
        require_once( WP_GUTENDEX_DIR . '/inc/class-wp-gutendex-api.php' );
        $this->gutendex = new WP_Gutendex_API();

        /**
         * Database helper
         */
        require_once( WP_GUTENDEX_DIR . '/inc/class-wp-gutendex-db.php' );
        $this->db = new WP_Gutendex_DB();

        /**
         * Book admin 
         */
        require_once( WP_GUTENDEX_DIR . '/inc/class-wp-gutendex-admin.php' );
        $this->admin = new WP_Gutendex_Admin($this->db);
    }

    /**
     * On Activation
     */
    function activate() {
        $table = $this->db->create_table();
        $books = $this->gutendex->get_books();
        $result = $this->db->insert($books);
    }

    /**
     * On Deactivation
     */
    function deactivate() {
        $table = $this->db->drop_table();
    }
}
