<?php
/*
 * Plugin Name: Brightcove Title Search
 * Description: Utilizes the Brightcove API to add search functionality to the video gallery meta box
 * Author: Andrew Taylor
 *
 */

class BrightcoveTitleSearchPlugin{

    public function __construct(){

		register_activation_hook( __FILE__, array($this, 'activation_hook') );
		register_deactivation_hook( __FILE__, array($this, 'deactivation_hook') );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );

	}

	public function activation_hook(){

    }

	public function deactivation_hook(){

    }

	public function admin_enqueue_scripts( $hook ){
		// bail if not working with films
		if( get_post_type() !== 'film' ){
			return;
		}

		// bail if not editing
		if ( $hook != 'post.php' || $_GET['action'] != 'edit' ) {
			return;
		}

		// set jquery as a dependency
		$deps = array( 'jquery' );

		global $wp_scripts;

		// go through all existing enqueued scripts
		foreach( $wp_scripts->queue as $script ){

			// add any acf scripts to our dependency array
			if( stripos( $script, 'acf' ) !== false ){
				$deps[] = $script;
			}

		}

		wp_enqueue_script(
			'brightcove_title_search_plugin',
			plugin_dir_url( __FILE__ ) . 'js/brightcove-title-search.js',
			$deps,
			false,
			true
		);

		if( !defined('IFC_FILMS_BC_READ_TOKEN') ){
			require_once( ABSPATH . '../brightcove-config.php' );
		}

		$WPvars = array(
			'IFC_FILMS_BC_READ_TOKEN' => IFC_FILMS_BC_READ_TOKEN
		);

		wp_localize_script( 'brightcove_title_search_plugin', 'WPvars', $WPvars );

		wp_enqueue_style(
			'brightcove_title_search_plugin',
			plugin_dir_url( __FILE__ ) . 'css/brightcove-title-search.css'
		);
	}

	public function add_meta_box( $post_type ) {
		add_meta_box(
			'brightcove_video_search'
			,__( 'Brightcove Video Search', 'ifcfilms' )
			,array( $this, 'render_meta_box_content' )
			,'film'
			,'advanced'
			,'high'
		);
	}

	public function render_meta_box_content( $post ) {

		?>
		<input name="bc-title" type="text" id="bc-title" placeholder="<?php _e( 'Video Title', 'ifcfilms' ); ?>" />
		<div class="row" id="bc-error"></div>
		<div class="row">
			<button class="button" id="bc-search" disabled="disabled">
				<?php _e( 'Search For Videos', 'ifcfilms' ); ?>
			</button>
			<button class="button" id="bc-reset">
				<?php _e( 'Reset Search', 'ifcfilms' ); ?>
			</button>
		</div>
		<div id="bc-results" class="row"></div>
		<?php

	}

}

$BrightcoveTitleSearchPlugin = new BrightcoveTitleSearchPlugin();