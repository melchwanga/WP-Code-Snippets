<?php
/**
 * team_tek custom post type class.
 *
 * Defines the team_tek post type.
 *
 * @package    wordpress
 */
class FW_Post_Types{
    //declare atts here
    private $post_type;
    private $name_singular;
    private $name_plural;
    private $slug;
    private $_public;
    private $supports;
    private $icon;
    private $hierarchical;
    private $searchable;
    public function __Construct($args){
        extract($args);
        $this->post_type = $post_type;
        $this->name_singular = $name_singular;
        $this->name_plural = $name_plural;
        $this->slug = $slug;
        $this->supports = $supports;
        $this->icon = ($icon) ? $icon : 'dashicons-calendar-alt';
        $this->_public = ($public!=null) ? $public : true;
        $this->hierarchical = ($hierarchical)? true : false;
        $this->searchable = (isset($args['searchable'])) ? $searchable : true;
        // Add the special date post type and taxonomies. Hook on init at a lower priority
        add_action( 'init', array( $this, 'fw_post_type_init' ) ,5);
        // Allow filtering of posts by taxonomy in the admin view
        //add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );
        // Show featured_item post counts in the dashboard
        add_action( 'right_now_content_table_end', array( $this, 'add_fw_post_type_count' ) );
        /* Add Custom Meta to Category */
        
    }
    /**
     * Initiate registrations of post type and taxonomies.
     */
    public function fw_post_type_init() {

        $this->register_fw_post_type();

        flush_rewrite_rules();
    }
    
    /**
     * Register Agent Post Type
     * @since 1.0.0
     */
    public function register_fw_post_type() {

        $labels = array(
            'name'                => _x( $this->name_plural, 'Post Type General Name', 'sbs' ),
            'singular_name'       => _x( $this->name_singular, 'Post Type Singular Name', 'sbs' ),
            'menu_name'           => __( $this->name_plural, 'sbs' ),
            'name_admin_bar'      => __( $this->name_singular, 'sbs' ),
            'all_items'           => __( 'All '.$this->name_plural, 'sbs' ),
            'add_new_item'        => __( 'Add New '.$this->name_singular, 'sbs' ),
            'add_new'             => __( 'Add New', 'sbs' ),
            'new_item'            => __( 'New '.$this->name_singular, 'sbs' ),
            'edit_item'           => __( 'Edit '.$this->name_singular, 'sbs' ),
            'update_item'         => __( 'Update '.$this->name_singular, 'sbs' ),
            'view_item'           => __( 'View '.$this->name_singular, 'sbs' ),
            'search_items'        => __( 'Search '.$this->name_singular, 'sbs' ),
            'not_found'           => __( 'Not found', 'sbs' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'sbs' ),
        );
        $rewrite = ($this->slug)? array('slug'=>$this->slug) : $this->slug;

        $args = array(
            'label'               => __( $this->name_singular, 'sbs' ),
            'description'         => __( $this->name_plural, 'sbs' ),
            'labels'              => $labels,
            'supports'            => $this->supports,
            'hierarchical'        => $this->hierarchical,
            'public'              => $this->_public,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => $this->icon,
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => ($this->_public) ? false : true,
            'publicly_queryable'  => $this->_public,
            'rewrite'             => $rewrite,
            'capability_type'     => 'post',
        );
        register_post_type( $this->post_type, $args );

    }
    public function register_post_taxonomies($vars){
            extract($vars);
                $labels = array(
                    'name'                       => __( $name, 'sbs' ),
                    'singular_name'              => __( $name_singular, 'sbs' ),
                    'menu_name'                  => __( $name_plural, 'sbs' ),
                    'edit_item'                  => __( 'Edit '.$name_singular, 'sbs' ),
                    'update_item'                => __( 'Update '.$name_singular, 'sbs' ),
                    'add_new_item'               => __( 'Add New '.$name_singular, 'sbs' ),
                    'new_item_name'              => __( 'New '.$name_singular.' Name', 'sbs' ),
                    'parent_item'                => __( 'Parent '.$name_singular, 'sbs' ),
                    'parent_item_colon'          => __( 'Parent '.$name_singular, 'sbs' ),
                    'all_items'                  => __( 'All '.$name_plural, 'sbs' ),
                    'search_items'               => __( 'Search '.$name_plural, 'sbs' ),
                    'not_found'                  => __( 'No '.$name_singular.' found.', 'sbs' ),
                );
               
                $rewrite = ($slug)? array('slug'=>$slug) : false;
                $args = array(
                    'labels'            => $labels,
                    'public'            => true,
                    'show_in_nav_menus' => true,
                    'show_ui'           => true,
                    'show_tagcloud'     => true,
                    'hierarchical'      => true,
                    'show_admin_column' => true,
                    'query_var'         => true,
                    'rewrite' => $rewrite,
                );

                register_taxonomy( $cat_name, array($post_type), $args );

            flush_rewrite_rules();
    }
    /**
     * Add post count to "Right Now" dashboard widget.
     *
     * @return null Return early if featured_item post type does not exist.
     */
    public function add_post_type_count() {
            if ( ! post_type_exists( $this->post_type ) ) {
                return;
            }

            $num_posts = wp_count_posts($this->post_type);

            // Published items
            $href = 'edit.php?post_type='.$this->post_type;
            $num  = number_format_i18n( $num_posts->publish );
            $num  = $this->link_if_can_edit_posts( $num, $href );
            $text = _n( $this->post_type, $this->post_type, intval( $num_posts->publish ) );
            $text = $this->link_if_can_edit_posts( $text, $href );
            $this->display_dashboard_count( $num, $text );

            if ( 0 == $num_posts->pending ) {
                return;
            }

            // Pending items
            $href = 'edit.php?post_status=pending&amp;post_type='.$this->post_type;
            $num  = number_format_i18n( $num_posts->pending );
            $num  = $this->link_if_can_edit_posts( $num, $href );
            $text = _n( $this->name_singular.' Pending', $this->name_singular.' Pending', intval( $num_posts->pending ) );
            $text = $this->link_if_can_edit_posts( $text, $href );
            $this->display_dashboard_count( $num, $text );
    }
 }

 function fw_post_types_init(){
      //post type programme
        $args = array(
            'post_type' => 'block',
            'name_singular' => 'Block',
            'name_plural' => 'Blocks',
            'slug' => false,
            'public' => false,
            'icon' => 'dashicons-layout',
            'supports' => array(
                    'title',
                    //'editor',
                    //'excerpt',
                    //'thumbnail',
                ),
        );
        $block = new FW_Post_Types($args);

        $cat_args = array(
                         'cat_name'=>'block_cat',
                         'name' => 'Block Category',
                         'name_singular' => 'Category',
                         'name_plural' => 'Categories',
                         'post_type' => 'block',
                 );
      $block->register_post_taxonomies($cat_args);

        $args = array(
            'post_type' => 'service',
            'name_singular' => 'Service',
            'name_plural' => 'Services',
            'slug' => 'service',
            'public' => true,
            'icon' => 'dashicons-',
            'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                ),
        );
        $service = new FW_Post_Types($args);

        $cat_args = array(
                         'cat_name'=>'service_cat',
                         'name' => 'service Category',
                         'name_singular' => 'Category',
                         'name_plural' => 'Categories',
                         'post_type' => 'service',
                 );
                 
        $service->register_post_taxonomies($cat_args);

        $args = array(
            'post_type' => 'project',
            'name_singular' => 'Project',
            'name_plural' => 'Projects',
            'slug' => false,
            'public' => true,
            'icon' => 'dashicons-schedule',
            'supports' => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                ),
        );
        $project = new FW_Post_Types($args);

         $cat_args = array(
                         'cat_name'=>'project_cat',
                         'name' => 'Project Category',
                         'name_singular' => 'Category',
                         'name_plural' => 'Categories',
                         'post_type' => 'project',
                 );
       $project->register_post_taxonomies($cat_args);

        $args = array(
            'post_type' => 'gallery',
            'name_singular' => 'Gallery',
            'name_plural' => 'Gallery',
            'slug' => 'gallery',
            'public' => false,
            'icon' => 'dashicons-image-alt',
            'supports' => array(
                    'title',
                    //'editor',
                    'excerpt',
                    'thumbnail',
                ),
        );
        $gallery = new FW_Post_Types($args);

        $args = array(
            'post_type' => 'client',
            'name_singular' => 'Client',
            'name_plural' => 'Clients',
            'slug' => false,
            'public' => false,
            'icon' => 'dashicons-image-alt',
            'supports' => array(
                    'title',
                    //'editor',
                    //'excerpt',
                    'thumbnail',
                ),
        );
        $client = new FW_Post_Types($args);

 }
 add_action("init" , "fw_post_types_init" , 1);