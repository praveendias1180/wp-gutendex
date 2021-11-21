<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WP_Gutendex_DB{

    /**
     * Database Table Name
     */
    private $table_name;

    function __construct() {
        /**
         * Custom Table Name on WordPress.
         */
        $this->table_name = 'books';
    }

    /**
     * Create the book rack.
     */
    function create_table(){
        global $wpdb;

        $table_name = $wpdb->prefix . $this->table_name;
        
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT(6) NOT NULL PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            subject VARCHAR(512) NOT NULL,
            downloads INT(6) NOT NULL,
            data VARCHAR(65000) NOT NULL,
            INDEX (title)
        ) $charset_collate;";

        $result = $wpdb->query( 
            $wpdb->prepare( $sql )
        );

        return $result;
    }

    /**
     * Insert books.
     */
    function insert($books){

        global $wpdb;

        $table_name = $wpdb->prefix . $this->table_name;
        
        foreach($books as $record){
            $result = $wpdb->insert( 
                $table_name, 
                array( 
                    'id' => $record->id, 
                    'title' => $record->title, 
                    'author' => $record->authors[0]->name, 
                    'subject' => $record->subjects[0], 
                    'downloads' => $record->download_count, 
                    'data' => json_encode($record)
                ) 
            );
        }

        return $result;
    }

    /**
     * Get book records from the db.
     */
    function get_books($count){
        $count = 5;
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;
        $record = $wpdb->query(
            $wpdb->prepare(  
                "
                    SELECT * 
                    FROM $table_name
                    LIMIT %d
                ",
                $count
            )
        );

        $output_data = $wpdb->last_result;

        return $output_data;
    }

    /**
     * Drop the table on uninstallation.
     */
    function drop_table(){
        global $wpdb;

        $table_name = $wpdb->prefix . $this->table_name;
        

        $sql = "DROP TABLE $table_name";

        $result = $wpdb->query( 
            $wpdb->prepare( $sql )
        );

    }
}
