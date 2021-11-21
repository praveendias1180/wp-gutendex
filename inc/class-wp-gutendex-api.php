<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WP_Gutendex_API{

    /**
     * Gutendex Endpoint.
     */
    private $endpoint;

    /**
     * Gutendex Books.
     */
    private $books;

    function __construct() {
        /**
         * Gutendex API URL
         */
        $this->endpoint = 'https://gutendex.com/books';
    }

    /**
     * Get Books.
     */
    function get_books(){
        $response = wp_remote_get( $this->endpoint );
        
        if ( is_array( $response ) && ! is_wp_error( $response ) ) {
            $headers = $response['headers'];
            $body    = json_decode( $response['body'] );
        }
        return $body->results;
    }
}
