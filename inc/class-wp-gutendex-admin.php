<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WP_Gutendex_Admin{

    /**
     * Db will be assigned by the parent.
     */
    private $db;

    function __construct($db) {
        add_action( 'admin_menu', array( $this, 'admin_page') );
        /**
         * Use the given db.
         */
        $this->db = $db;

    }

    function admin_page(){

        /**
         * Adds a menu page.
         */
        add_menu_page(
            'The Booklist',
            'Booklist',
            'manage_options',
            'wp_gutendex',
            array($this, 'admin_page_html'),
            'dashicons-book',
            20
        );
    }

    function admin_page_html(){
        require_once( WP_GUTENDEX_DIR . '/inc/class-wp-gutendex-list-table.php' );
        //Create an instance of our package class...
        $wp_gutendex_table = new WP_Gutendex_Table($this->db);
        //Fetch, prepare, sort, and filter our data...
        $wp_gutendex_table->prepare_items();

        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
    
        // add error/update messages
    
        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if ( isset( $_GET['settings-updated'] ) ) {
            // add settings saved message with the class of "updated"
            add_settings_error( 'myshortcode_messages', 'myshortcode_message', __( 'Settings Saved', 'myshortcode' ), 'updated' );
        }
    
        // show error/update messages
        settings_errors( 'myshortcode_messages' );
        ?>
        <div class="wrap">
            <h2>WP Gutendex Booklist</h2>
            
            <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
                <p>Additional class details are available on the <a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WordPress Codex</a>.</p>
            </div>
            
            <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
            <form id="movies-filter" method="get">
                <!-- For plugins, we also need to ensure that the form posts back to our current page -->
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                <!-- Now we can render the completed list table -->
                <?php $wp_gutendex_table->display() ?>
            </form>
        </div>
        <?php
    }


}
