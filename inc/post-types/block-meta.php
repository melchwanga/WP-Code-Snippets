<?php
/**
 * Register a meta box using a class.
 */
class FW_Block_Meta_Box {
 
    /**
     * Constructor.
     */
    public function __construct(){

        if ( is_admin() ){
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }
 
    }
 
    /**
     * Meta box initialization.
     */
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        //add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
    }
 
    /**
     * Adds the meta box.
     */
    public function add_metabox() {
        add_meta_box(
            'my-meta-box',
            __( 'Shortcode:', 'market-power' ),
            array( $this, 'render_metabox' ),
            'block',
            'side',
            'high'
        );
 
    }
 
    /**
     * Renders the meta box.
     */
    public function render_metabox( $post ) {

        // Add nonce for security and authentication.
        wp_nonce_field( 'custom_nonce_action', 'custom_nonce' );

        if($post->post_name){
            echo '<textarea style="width:100%;">[block id="'.$post->post_name.'"]</textarea>';
        }      
    }
 
    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['custom_nonce'] ) ? $_POST['custom_nonce'] : '';
        $nonce_action = 'custom_nonce_action';
 
        // Check if nonce is set.
        if ( ! isset( $nonce_name ) ) {
            return;
        }
 
        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }
 
        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
 
        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }
 
        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

    }
}
 
new FW_Block_Meta_Box();

// Add the custom columns to the post type:
add_filter( 'manage_block_posts_columns', 'set_custom_edit_block_columns' );

function set_custom_edit_block_columns($columns) {

    $offset = 2;

    $columns = array_merge(
            array_slice($columns, 0, $offset),
            array('shortcode' => __( '<strong>Shortcode</strong>', 'market-power' )),
            array_slice($columns, $offset, null)
    );

    //$columns['shortcode'] = __( 'Shortcode', 'market-power' );
    unset($columns['taxonomy-block_cat']);
    return $columns;
}

// Add the data to the custom columns for the post type:
add_action( 'manage_block_posts_custom_column' , 'custom_block_column', 10, 2 );

function custom_block_column( $column, $post_id ) {
    switch ( $column ) {
        case 'shortcode' :
            $block = get_post($post_id);
             echo '<textarea style="width:100%;">[block id="'.$block->post_name.'"]</textarea>';
            break;

    }
}