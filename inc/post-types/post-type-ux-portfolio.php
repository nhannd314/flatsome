<?php 


/* start post type */
if ( ! class_exists( 'Featured_Item_Post_Type' ) ) :

class Featured_Item_Post_Type {

	public function __construct() {
	// Run when the plugin is activated
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Add the featured_item post type and taxonomies
		add_action( 'init', array( $this, 'featured_item_init' ) );

		// Thumbnail support for featured_item posts
		add_theme_support( 'post-thumbnails', array( 'featured_item' ) );

		// Add thumbnails to column view
		add_filter( 'manage_edit-featured_item_columns', array( $this, 'add_thumbnail_column'), 10, 1 );
		add_action( 'manage_pages_custom_column', array( $this, 'display_thumbnail' ), 10, 1 );

		// Allow filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'add_taxonomy_filters' ) );

		// Show featured_item post counts in the dashboard
		add_action( 'right_now_content_table_end', array( $this, 'add_featured_item_counts' ) );
		

		// Add taxonomy terms as body classes
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
		
	}

	/**
	 * Load the plugin text domain for translation.
	 */


	/**
	 * Flushes rewrite rules on plugin activation to ensure featured_item posts don't 404.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 *
	 * @uses Featured Item_Post_Type::featured_item_init()
	 */
	public function plugin_activation() {
		$this->featured_item_init();
		flush_rewrite_rules();
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses Featured Item_Post_Type::register_post_type()
	 * @uses Featured Item_Post_Type::register_taxonomy_tag()
	 * @uses Featured Item_Post_Type::register_taxonomy_category()
	 */
	public function featured_item_init() {
		$this->register_post_type();
		$this->register_taxonomy_category();
		$this->register_taxonomy_tag();
	}

	/**
	 * Get an array of all taxonomies this plugin handles.
	 *
	 * @return array Taxonomy slugs.
	 */
	protected function get_taxonomies() {
		return array( 'featured_item_category', 'featured_item_tag' );
	}



	/**
	 * Enable the Featured Item custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Portfolio', 'flatsome-admin' ),
			'singular_name'      => __( 'Portfolio', 'flatsome-admin' ),
			'add_new'            => __( 'Add New', 'flatsome-admin' ),
			'add_new_item'       => __( 'Add New', 'flatsome-admin' ),
			'edit_item'          => __( 'Edit Portfolio', 'flatsome-admin' ),
			'new_item'           => __( 'Add New Portfolio', 'flatsome-admin' ),
			'view_item'          => __( 'View Portfolio', 'flatsome-admin' ),
			'search_items'       => __( 'Search Portfolio', 'flatsome-admin' ),
			'not_found'          => __( 'No items found', 'flatsome-admin' ),
			'not_found_in_trash' => __( 'No items found in trash', 'flatsome-admin' ),
		);
		
		$args = array(
			'menu_icon' => 'dashicons-portfolio',
			'labels'          => $labels,
			'public'          => true,
			'supports'        => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'author',
				'custom-fields',
				'revisions',
			),
			'capability_type' => 'page',
			'menu_position'   => 5,
			'hierarchical'      => true,
			'has_archive'     => true,
		);

		$args = apply_filters( 'featured_itemposttype_args', $args );
		register_post_type( 'featured_item', $args );
	}



	/**
	 * Register a taxonomy for Featured Item Tags.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_tag() {
		$labels = array(
			'name'                       => __( 'Tags', 'flatsome-admin' ),
			'singular_name'              => __( 'Tag', 'flatsome-admin' ),
			'menu_name'                  => __( 'Tags', 'flatsome-admin' ),
			'edit_item'                  => __( 'Edit Tag', 'flatsome-admin' ),
			'update_item'                => __( 'Update Tag', 'flatsome-admin' ),
			'add_new_item'               => __( 'Add New Tag', 'flatsome-admin' ),
			'new_item_name'              => __( 'New  Tag Name', 'flatsome-admin' ),
			'parent_item'                => __( 'Parent Tag', 'flatsome-admin' ),
			'parent_item_colon'          => __( 'Parent Tag:', 'flatsome-admin' ),
			'all_items'                  => __( 'All Tags', 'flatsome-admin' ),
			'search_items'               => __( 'Search  Tags', 'flatsome-admin' ),
			'popular_items'              => __( 'Popular Tags', 'flatsome-admin' ),
			'separate_items_with_commas' => __( 'Separate tags with commas', 'flatsome-admin' ),
			'add_or_remove_items'        => __( 'Add or remove tags', 'flatsome-admin' ),
			'choose_from_most_used'      => __( 'Choose from the most used tags', 'flatsome-admin' ),
			'not_found'                  => __( 'No  tags found.', 'flatsome-admin' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'query_var'         => true,

		);

		$args = apply_filters( 'featured_itemposttype_tag_args', $args );

		register_taxonomy( 'featured_item_tag', array( 'featured_item' ), $args );

	}

	/**
	 * Register a taxonomy for Featured Item Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		

		$labels = array(
			'name'                       => __( 'Categories', 'flatsome-admin' ),
			'singular_name'              => __( 'Category', 'flatsome-admin' ),
			'menu_name'                  => __( 'Categories', 'flatsome-admin' ),
			'edit_item'                  => __( 'Edit Category', 'flatsome-admin' ),
			'update_item'                => __( 'Update Category', 'flatsome-admin' ),
			'add_new_item'               => __( 'Add New Category', 'flatsome-admin' ),
			'new_item_name'              => __( 'New Category Name', 'flatsome-admin' ),
			'parent_item'                => __( 'Parent Category', 'flatsome-admin' ),
			'parent_item_colon'          => __( 'Parent Category:', 'flatsome-admin' ),
			'all_items'                  => __( 'All Categories', 'flatsome-admin' ),
			'search_items'               => __( 'Search Categories', 'flatsome-admin' ),
			'popular_items'              => __( 'Popular Categories', 'flatsome-admin' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'flatsome-admin' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'flatsome-admin' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'flatsome-admin' ),
			'not_found'                  => __( 'No categories found.', 'flatsome-admin' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'featured_itemposttype_category_args', $args );

		register_taxonomy( 'featured_item_category', array( 'featured_item' ), $args );
		
		if(flatsome_option('featured_items_page')){
			add_action( 'wp_loaded', 'add_ux_featured_item_permastructure' );
			function add_ux_featured_item_permastructure() {
				$items_link = flatsome_option('featured_items_page');
				add_permastruct( 'featured_item_category',  $items_link.'/%featured_item_category%', false );
				add_permastruct( 'featured_item', $items_link.'/%featured_item_category%/%featured_item%', false );
			}

			add_filter( 'post_type_link', 'ux_featured_items_permalinks', 10, 2 );
			function ux_featured_items_permalinks( $permalink, $post ) {
				if ( $post->post_type !== 'featured_item' )
					return $permalink;
			 
				$terms = get_the_terms( $post->ID, 'featured_item_category' );
				
				if ( ! $terms )
					return str_replace( '%featured_item_category%', '', $permalink );
			 
				$post_terms = array();
				foreach ( $terms as $term )
					$post_terms[] = $term->slug;
			 
				return str_replace( '%featured_item_category%', implode( ',', $post_terms ) , $permalink );
			}



			// Make sure that all term links include their parents in the permalinks
			add_filter( 'term_link', 'add_term_parents_to_permalinks', 10, 2 );
			 
			function add_term_parents_to_permalinks( $permalink, $term ) {
				$term_parents = get_term_parents( $term );
			 
				foreach ( $term_parents as $term_parent )
					$permlink = str_replace( $term->slug, $term_parent->slug . ',' . $term->slug, $permalink );
			 
				return $permalink;
			}
			 
			// Helper function to get all parents of a term
			function get_term_parents( $term, &$parents = array() ) {
				$parent = get_term( $term->parent, $term->taxonomy );
				
				if ( is_wp_error( $parent ) )
					return $parents;
				
				$parents[] = $parent;
			 
				if ( $parent->parent )
					get_term_parents( $parent, $parents );
			 
			    return $parents;
			}

		} // Set custom permalinks
		
		


	}

		

	/**
	 * Add taxonomy terms as body classes.
	 *
	 * If the taxonomy doesn't exist (has been unregistered), then get_the_terms() returns WP_Error, which is checked
	 * for before adding classes.
	 *
	 * @param array $classes Existing body classes.
	 *
	 * @return array Amended body classes.
	 */
	public function add_body_classes( $classes ) {
		$taxonomies = $this->get_taxonomies();

		foreach( $taxonomies as $taxonomy ) {
			$terms = get_the_terms( get_the_ID(), $taxonomy );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach( $terms as $term ) {
					$classes[] = sanitize_html_class( str_replace( '_', '-', $taxonomy ) . '-' . $term->slug );
				}
			}
		}

		return $classes;
	}

	/**
	 * Add columns to Featured Item list screen.
	 *
	 * @link http://wptheming.com/2010/07/column-edit-pages/
	 *
	 * @param array $columns Existing columns.
	 *
	 * @return array Amended columns.
	 */
	public function add_thumbnail_column( $columns ) {
		$column_thumbnail = array( 'thumbnail' => __( 'Thumbnail', 'flatsome-admin' ) );
		return array_slice( $columns, 0, 2, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	}

	/**
	 * Custom column callback
	 *
	 * @global stdClass $post Post object.
	 *
	 * @param string $column Column ID.
	 */
	public function display_thumbnail( $column ) {
		global $post;
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post->ID, array(35, 35) );
				break;
		}
	}

	/**
	 * Add taxonomy filters to the featured_item admin page.
	 *
	 * Code artfully lifted from http://pippinsplugins.com/
	 *
	 * @global string $typenow
	 */
	public function add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomies you want to display. Use the taxonomy name or slug
		$taxonomies = $this->get_taxonomies();

		// Must set this to the post type you want the filter(s) displayed on
		if ( 'featured_item' != $typenow ) {
			return;
		}

		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj          = get_taxonomy( $tax_slug );
			$tax_name         = $tax_obj->labels->name;
			$terms            = get_terms( $tax_slug );
			if ( 0 == count( $terms ) ) {
				return;
			}
			echo '<select name="' . esc_attr( $tax_slug ) . '" id="' . esc_attr( $tax_slug ) . '" class="postform">';
			echo '<option>' . esc_html( $tax_name ) .'</option>';
			foreach ( $terms as $term ) {
				printf(
					'<option value="%s"%s />%s</option>',
					esc_attr( $term->slug ),
					selected( $current_tax_slug, $term->slug ),
					esc_html( $term->name . '(' . $term->count . ')' )
				);
			}
			echo '</select>';
		}
	}

	/**
	 * Add Featured Item count to "Right Now" dashboard widget.
	 *
	 * @return null Return early if featured_item post type does not exist.
	 */
	public function add_featured_item_counts() {
		if ( ! post_type_exists( 'featured_item' ) ) {
			return;
		}

		$num_posts = wp_count_posts( 'featured_item' );

		// Published items
		$href = 'edit.php?post_type=featured_item';
		$num  = number_format_i18n( $num_posts->publish );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Featured Item Item', 'Featured Item Items', intval( $num_posts->publish ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );

		if ( 0 == $num_posts->pending ) {
			return;
		}

		// Pending items
		$href = 'edit.php?post_status=pending&amp;post_type=featured_item';
		$num  = number_format_i18n( $num_posts->pending );
		$num  = $this->link_if_can_edit_posts( $num, $href );
		$text = _n( 'Featured Item Item Pending', 'Featured Item Items Pending', intval( $num_posts->pending ) );
		$text = $this->link_if_can_edit_posts( $text, $href );
		$this->display_dashboard_count( $num, $text );
	}

	/**
	 * Wrap a dashboard number or text value in a link, if the current user can edit posts.
	 *
	 * @param  string $value Value to potentially wrap in a link.
	 * @param  string $href  Link target.
	 *
	 * @return string        Value wrapped in a link if current user can edit posts, or original value otherwise.
	 */
	protected function link_if_can_edit_posts( $value, $href ) {
		if ( current_user_can( 'edit_posts' ) ) {
			return '<a href="' . esc_url( $href ) . '">' . $value . '</a>';
		}
		return $value;
	}

	/**
	 * Display a number and text with table row and cell markup for the dashboard counters.
	 *
	 * @param  string $number Number to display. May be wrapped in a link.
	 * @param  string $label  Text to display. May be wrapped in a link.
	 */
	protected function display_dashboard_count( $number, $label ) {
		?>
		<tr>
			<td class="first b b-featured_item"><?php echo $number; ?></td>
			<td class="t featured_item"><?php echo $label; ?></td>
		</tr>
		<?php
	}

	

}

new Featured_Item_Post_Type;

endif;
