<?php
/*
Plugin Name: Last Modified Footer
Plugin URI: http://thecuriousfrog.com/projects/last-modified-footer/
Description: This plugin generates messages stating the last modification date and time for the whole site and the individual content (if appropriate). The message templates, time and date formatting and the placement of the messages are customisable.
Version: 1.1.0
Author: Hugh Johnson
Author URI: http://thecuriousfrog.com
*/
/*
	Copyright (C) 2009 Hugh Johnson  (email : hugh.johnson@thecuriousfrog.com)

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
/*
	This plugin is based on WPCMS Content Last Updated Footer (http://wp-cms.com/our-wordpress-plugins/content-last-updated-footer-plugin/)
	by WPCMS and Last Modified (http://mtdewvirus.com/code/wordpress-plugins/) by Nick Momrik.
*/

//Check plugin class has not already been defined
if ( !class_exists( "lmf_plugin" ) ) {
	class lmf_plugin {
		//Declare the variable containing the plugin options name
		var $plugin_options_name = 'last_modified_footer_plugin_options';

		//Declare the variable containing the plugin text domain name
		var $plugin_text_domain_name = 'last-modified-footer';

		//This function is the constructor for the plugin class
		function lmf_plugin() {
			//Nothing to see here...
		}

		//This function returns an array of the plugin options
		function get_plugin_options() {
			//Declare an array containing the plugin options and default values
			$new_plugin_options = array(
				'singular_template' => 'Site last updated %site_last_modified%; This content last updated %content_last_modified%',
				'generic_template' => 'Site last updated %site_last_modified%',
				'date_format' => get_option( 'date_format' ) . ' @ ' . get_option( 'time_format' ),
				'css' => '<style type="text/css" media="screen">p.lmf_generated_text { color: #A0A0A0; }</style>',
				'use_wp_footer_hook' => 'true'
			);

			//Attempt to retrieve the existing array of options from the database
			$existing_plugin_options = get_option( $this->plugin_options_name );

			//Overwrite the default options values with any retrieved from database
			if ( !empty( $existing_plugin_options ) ) {
				foreach( $existing_plugin_options as $key => $value ) {
					$new_plugin_options[$key] = $value;
				}
			}

			//Return the array of options
			return $new_plugin_options;
		}

		//This function generates plugin output. Output is wrapped in '<p class="lmf_generated_text">' tags if $output_styling is set to 'use_css'
		function generate_output( $output_styling = 'no_styling' ) {
			//Get the options from database
			$existing_options = $this->get_plugin_options();

			global $wpdb;
			global $id;

			//Output opening paragraph tag if required
			if ( $output_styling == "use_css" ) {
				//Open the <p> tag using the 'lmf_generated_text' class inserted in the header
				echo '<p class="lmf_generated_text">';
			}

			//Generate and print the message from the appropriate template (singular or generic)
			if ( is_singular() ) {
				//Get the post modification date of the most recently modified post / page
				$last_site_update = $wpdb->get_var( "SELECT post_modified FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_modified DESC LIMIT 1" );

				//Get the post modification date of the current post / page
				$last_content_update = $wpdb->get_var( "SELECT post_modified FROM $wpdb->posts WHERE id = $id" );

				//Build the arrays containing the macros (keywords) and the values that should replace them
				$macros = array( '%site_last_modified%', '%content_last_modified%' );
				$values = array( mysql2date( $existing_options['date_format'], $last_site_update ), mysql2date( $existing_options['date_format'], $last_content_update ) );

				//Replace occurences of macros in the message template with the associated values
				$temp_output_string = str_replace( $macros, $values, $existing_options['singular_template'] );

				//Print the processed message template
				echo $temp_output_string;
			} else {
				//Get the post modification date of the most recently modified post / page
				$last_site_update = $wpdb->get_var( "SELECT post_modified FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_modified DESC LIMIT 1" );

				//Build the arrays containing the macros (keywords) and the values that should replace them
				$macros = array( '%site_last_modified%' );
				$values = array( mysql2date( $existing_options['date_format'], $last_site_update ) );

				//Replace occurences of macros in the message template with the associated values
				$temp_output_string = str_replace( $macros, $values, $existing_options['generic_template'] );

				//Print the processed message template
				echo $temp_output_string;
			}

			//Output closing paragraph tag if required
			if ( $output_styling == "use_css" ) {
				//Close the <p> tag
				echo '</p>';
			}
		}

		//This function is called when the 'wp_footer' hook fires. It checks if the message should be placed in the footer and outputs the appropriate content
		function generate_footer() {
			//Get the options from database
			$existing_options = $this->get_plugin_options();

			//Generate the appropriate message to be placed in the footer. Depends on if the automatic placement in footer option is enabled
			if( $existing_options['use_wp_footer_hook'] == "true" )
			{
				//Output the message
				$this->generate_output( 'use_css' );
			} else {
				//Just output an HTML comment as a placemarker
				echo '<!--Last Modified Footer: ' . __( 'Message placement in footer deactivated. To reactivate, see plugin options menu.' , 'last-modified-footer' ) . '-->';
			}
		}

		//This function inserts CSS into the site header to style the generated text
		function insert_css() {
			//Get the options from database
			$existing_options = $this->get_plugin_options();

			//Insert the CSS for the 'p.lmf_generated_text' class
			?>
			<!-- Last Modified Footer -->
				<?php echo $existing_options['css']; ?>
			<!-- /Last Modified Footer -->
			<?php
		}

		//This function returns text to be inserted into the WP contextual help menu for the plugin options page
		function output_help_menu() {
			$help_text = '<a href="http://thecuriousfrog.com/projects/last-modified-footer/" target="_blank">' . __( 'Plugin Homepage' , 'last-modified-footer' ) . '</a>';
			$help_text .= '<br /><a href="http://wordpress.org/extend/plugins/last-modified-footer/faq/" target="_blank">' . __( 'Plugin FAQs' , 'last-modified-footer' ) . '</a>';
			$help_text .= '<br /><a href="http://wordpress.org/tags/last-modified-footer#postform" target="_blank">' . __( 'Plugin Support Forum' , 'last-modified-footer' ) . '</a>';
			return $help_text;
		}

		//This function generates the plugin options menu
		function output_admin_menu() {
			//Insert the CSS to style the output preview
			$this->insert_css();
			?>

			<div class="wrap">

			<h2>Last Modified Footer</h2>

			<h3><?php _e( 'Plugin Options' , 'last-modified-footer' ) ?></h3>

			<p><em><?php _e( 'Click on the option names to display inline help' , 'last-modified-footer' ) ?></em></p>

			<script type="text/javascript">
			<!--
				function toggleVisibility(id) {
				   var e = document.getElementById(id);
				   if(e.style.display == 'block' )
					  e.style.display = 'none';
				   else
					  e.style.display = 'block';
				}
			//-->
			</script>

			<form method="post" action="options.php">

			<?php settings_fields( 'last_modified_footer_option_group' ); ?>

			<?php $existing_options = $this->get_plugin_options(); ?>

			<table class="form-table">

			<tr valign="top">
			<th scope="row" style="text-align:right; vertical-align:top;">
			<a style="cursor:pointer;" title="<?php _e( 'Click for Help!' , 'last-modified-footer')?>" onclick="toggleVisibility('singular_template_tip');"><?php _e( 'Single Post / Page Template:' , 'last-modified-footer' ) ?></a>
			</th>
			<td>
			<textarea name="last_modified_footer_plugin_options[singular_template]" rows="6" cols="88"><?php echo $existing_options['singular_template']; ?></textarea>
			<div style="text-align:left; display:none" id="singular_template_tip">
			<?php
			_e( 'The following macros are supported:' , 'last-modified-footer' );
			echo( '<ul>' );
			echo( '<li>' ); _e( '%content_last_modified% - The formatted representation of the date and time the single post / page was last modified' , 'last-modified-footer' ); echo( '</li>' );
			echo( '<li>' ); _e( '%site_last_modified% - The formatted representation of the date and time the site was last modified' , 'last-modified-footer' ); echo( '</li>' );
			echo( '</ul>' );
			 ?>
			</div>
			</td>
			</tr>

			<tr valign="top">
			<th scope="row" style="text-align:right; vertical-align:top;">
			<a style="cursor:pointer;" title="<?php _e( 'Click for Help!' , 'last-modified-footer' )?>" onclick="toggleVisibility('generic_template_tip');"><?php _e( 'Generic Template:' , 'last-modified-footer' ) ?></a>
			</th>
			<td>
			<textarea name="last_modified_footer_plugin_options[generic_template]" rows="6" cols="88"><?php echo $existing_options['generic_template']; ?></textarea>
			<div style="text-align:left; display:none" id="generic_template_tip">
			<?php
			_e( 'The following macros are supported:' , 'last-modified-footer' );
			echo( '<ul>' );
			echo( '<li>' ); _e( '%site_last_modified% - The formatted representation of the date and time the site was last modified' , 'last-modified-footer' ); echo( '</li>' );
			echo( '</ul>' );
			 ?>
			</div>
			</td>
			</tr>

			<tr valign="top">
			<th scope="row" style="text-align:right; vertical-align:top;">
			<a style="cursor:pointer;" title="<?php _e( 'Click for Help!' , 'last-modified-footer' )?>" onclick="toggleVisibility('lmf_date_time_tip');"><?php _e( 'Time / Date Format:' , 'last-modified-footer' ) ?></a>
			</th>
			<td>
			<input type="text" name="last_modified_footer_plugin_options[date_format]" value="<?php echo $existing_options['date_format']; ?>" />
			<div style="text-align:left; display:none" id="lmf_date_time_tip">
			<?php printf( __( 'The date / time format that should be used in the generated text (%s)' , 'last-modified-footer' ), '<a href="http://codex.wordpress.org/Formatting_Date_and_Time">' . __( 'Wordpress date and time documentation' , 'last-modified-footer' ) . '</a>' ) ?>
			</div>
			</td>
			</tr>

			<tr valign="top">
			<th scope="row" style="text-align:right; vertical-align:top;">
			<a style="cursor:pointer;" title="<?php _e( 'Click for Help!' , 'last-modified-footer' )?>" onclick="toggleVisibility('css_tip');"><?php _e( 'Text Formatting:' , 'last-modified-footer' ) ?></a>
			</th>
			<td>
			<textarea name="last_modified_footer_plugin_options[css]" rows="6" cols="88"><?php echo $existing_options['css']; ?></textarea>
			<div style="text-align:left; display:none" id="css_tip">
			<?php printf( __( 'This CSS is applied to text generated using the %s function. Make sure the "p.lmf_generated_text" class is defined here' , 'last-modified-footer' ), '"lmf_generate_formatted_output()"' ) ?>
			</div>
			</td>
			</tr>

			<tr valign="top">
			<th scope="row" style="text-align:right; vertical-align:top;">
			<a style="cursor:pointer;" title="<?php _e( 'Click for Help!' , 'last-modified-footer' )?>" onclick="toggleVisibility('lmf_wp_footer_tip');"><?php _e( 'Use "wp_footer" Hook:' , 'last-modified-footer' ) ?></a>
			</th>
			<td>
			<label for="use_wp_footer_hook_yes"><input type="radio" id="use_wp_footer_hook_yes" name="last_modified_footer_plugin_options[use_wp_footer_hook]" value="true" <?php if ( $existing_options['use_wp_footer_hook'] == "true" ) { echo( 'checked="checked"' ); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="use_wp_footer_hook_no"><input type="radio" id="use_wp_footer_hook_no" name="last_modified_footer_plugin_options[use_wp_footer_hook]" value="false" <?php if ( $existing_options['use_wp_footer_hook'] == "false" ) { echo( 'checked="checked"' ); }?>/> No</label>
			<div style="text-align:left; display:none" id="lmf_wp_footer_tip">
			<?php printf( __( 'If this option is activated then the formatted version of the generated text will be automatically placed in the page footer at the point where the template calls the %s function' , 'last-modified-footer' ), '"wp_footer"' ) ?>
			</div>
			</td>
			</tr>

			</table>

			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e( 'Save Changes' , 'last-modified-footer' ) ?>" />
			</p>

			</form>

			<br />

			<h3><?php _e( 'Output Preview' , 'last-modified-footer' ) ?></h3>
			<?php

			global $wpdb;

			//Get the post modification date of the most recently modified post / page
			$last_site_update = $wpdb->get_var( "SELECT post_modified FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_modified DESC LIMIT 1" );

			//Build the arrays containing the macros (keywords) and the values that should replace them
			$macros = array( '%site_last_modified%', '%content_last_modified%' );
			$values = array( mysql2date( $existing_options['date_format'], $last_site_update ), mysql2date( $existing_options['date_format'], date( 'Y-m-d H:i:s' ) ) );

			//Replace occurences of macros in the single post / page message template with the associated values
			$singular_output_string = str_replace( $macros, $values, $existing_options['singular_template'] );

			//Replace occurences of macros in the generic message template with the associated values
			$generic_output_string = str_replace( $macros, $values, $existing_options['generic_template'] );

			//Print the message previews
			echo ( '<h4>' ); _e( 'Formatted Output:' , 'last-modified-footer' ); echo( '</h4>' );
			echo ( '<p><em>' ); printf( __( 'This text is displayed wherever %s is called. Output is wrapped in paragraph tags using the "p.lmf_generated_text" CSS class' , 'last-modified-footer' ), '"lmf_generate_formatted_output()"' ); echo( '</em></p>' );
			echo ( '<p><b>' ); _e( 'Single posts, pages and attachments:' , 'last-modified-footer' ); echo( '</b></p><p class="lmf_generated_text">' ); echo $singular_output_string; echo( '</p>' );
			echo ( '<p><b>' ); _e( 'All other pages:' , 'last-modified-footer' ); echo( '</b></p><p class="lmf_generated_text">' ); echo $generic_output_string; echo( '</p>' );

			echo ( '<h4>' ); _e( 'Unformatted Output:' , 'last-modified-footer' ); echo( '</h4>' );
			echo ( '<p><em>' ); printf( __( 'This text is displayed wherever %s is called. Output is not wrapped in any HTML tags' , 'last-modified-footer' ), '"lmf_generate_unformatted_output()"' ); echo( '</em></p>' );
			echo ( '<p><b>' ); _e( 'Single posts, pages and attachments:' , 'last-modified-footer' ); echo( '</b></p><p>' ); echo $singular_output_string; echo( '</p>' );
			echo ( '<p><b>' ); _e( 'All other pages:' , 'last-modified-footer' ); echo( '</b></p><p>' ); echo $generic_output_string; echo( '</p>' );

			echo ( '<h4><em>' ); _e( 'Notes:' , 'last-modified-footer' ); echo( '</em></h4>' );
			echo ( '<ul>' );
			echo ( '<li>' ); printf( __( 'If the %s option is selected then the appropriate message will also be automatically be displayed in the page footer' , 'last-modified-footer' ), __( 'Use "wp_footer" Hook' , 'last-modified-footer' ) ); echo( '</li>' );
			echo ( '</ul>' );

			echo ( '<br />' );

			echo ( '<h3>' ); _e( 'Support and Further Info' , 'last-modified-footer' ); echo( '</h3>' );
			echo ( '<p>' ); printf( __( 'Do you have a question or problem? Visit the %s homepage and leave a comment' , 'last-modified-footer' ), '<a href="http://thecuriousfrog.com/projects/last-modified-footer/" target="_blank">Last Modified Footer</a>' ); echo( '</p>' );

			echo ( '</div>' );

			add_action( 'in_admin_footer', array( &$this, 'output_admin_menu_footer' ) );
		}

		//This function generates the plugin options menu footer
		function output_admin_menu_footer() {
			$plugin_data = get_plugin_data( __FILE__ );
			printf('%1$s plugin | Version %2$s | by %3$s<br />', $plugin_data['Title'], $plugin_data['Version'], $plugin_data['Author']);
		}

		//This function registers the plugin admin panel and contextual help menu
		function register_admin_menu() {
			if ( function_exists( 'add_options_page' ) ) {
				$options_page_hook = add_options_page( 'Last Modified Footer', 'Last Modified Footer', 'manage_options', __FILE__, array( &$this, 'output_admin_menu' ) );
				if ( function_exists( 'add_contextual_help' ) ) {
					$help_text = $this->output_help_menu();
					add_contextual_help( $options_page_hook, $help_text );
				}
			}
		}

		//This function is called when the plugin is activated
		function install_options() {
			//Add the plugin options to the database with default values
			$new_plugin_options = $this->get_plugin_options();

			//Grab any existing options from the old option system, then delete the old options
			foreach( $new_plugin_options as $key => $value ) {
				if( $old_option = get_option( 'lmf_' . $key ) ) {
					$new_plugin_options[$key] = $old_option;
					delete_option( 'lmf_' . $key );
				}
			}

			//Store the array of options in the database
			update_option( $this->plugin_options_name, $new_plugin_options );

			//Banish disused options from the database
			delete_option( 'lmf_site_update_text' );
			delete_option( 'lmf_content_update_text' );
			delete_option( 'lmf_message_separator_text' );
			delete_option( 'lmf_footer_css' );
			delete_option( 'lmf_siteupdate_text' );
			delete_option( 'lmf_pageupdate_text' );
			delete_option( 'lmf_widget_title' );
			delete_option( 'lmf_widget_style_output' );
		}

		//This function whitelists the plugins options
		function register_settings() {
			register_setting( 'last_modified_footer_option_group', 'last_modified_footer_plugin_options', array( &$this, 'validate_options' ) );
		}

		//This function validates input from the admin panel
		function validate_options( $input ) {
			//Return the validated options array
			return $input;
		}

		//This function loads the plugin's text domain
		function load_l10n_domain() {
			load_plugin_textdomain ( $this->plugin_text_domain_name );
		}
	}
}//End class lmf_plugin

//Check widget class has not already been defined
if ( !class_exists( "lmf_widget" ) ) {
	class lmf_widget extends WP_Widget {
		//This function is the constructor for the widget class
		function lmf_widget() {
			$widget_ops = array( 'classname' => 'widget_lmf', 'description' => __( 'A customizable message stating the date on which the content and site were last updated' , 'last-modified-footer' ) );
			$this->WP_Widget( 'lmf', 'Last Modified Footer', $widget_ops );
		}

		function widget( $args, $instance ) {
			//$args is an array of strings that help widgets to conform to the active theme: before_widget, before_title, after_widget, and after_title are the array keys.
			extract( $args );

			//Apply filters to the Widget Title
			$title = apply_filters( 'widget_title', empty( $instance[ 'title' ] ) ? '' : $instance[ 'title' ] );

			//Output the tags that come before the widget
			echo $before_widget;

			//Output the Widget Title (if non-blank)
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			//Generate the output for the widget with CSS if appropriate
			if( $instance[ 'style_output' ] == "use_css" )
			{
				//Generate the formatted version of the output
				lmf_generate_formatted_output();
			} else {
				//Generate the unformatted version of the output
				lmf_generate_unformatted_output();
			}

			//Output the tags that come after the widget
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
			$instance[ 'style_output' ] = strip_tags( $new_instance[ 'style_output' ] );
			return $instance;
		}

		function form( $instance ) {
			//Set the defaults
			$instance = wp_parse_args( ( array ) $instance, array( 'title' => __( 'Content Info' , 'last-modified-footer' ), 'style_output' => 'no_styling' ) );

			//Clean up the options
			$title = strip_tags( $instance[ 'title' ] );
			$style_output = strip_tags( $instance[ 'style_output' ] );
			?>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'last-modified-footer' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</label>

			<label for="<?php echo $this->get_field_id( 'style_output' ); ?>"><?php _e( 'Apply CSS to output?' , 'last-modified-footer' ); ?>
				<select name="<?php echo $this->get_field_name( 'style_output' ); ?>" id="<?php echo $this->get_field_id( 'style_output' ); ?>" class="widefat">
					<option value="no_styling"<?php if ( $style_output == "no_styling" ) echo( ' selected="selected" ' ); ?>><?php _e( 'No' , 'last-modified-footer' ); ?></option>
					<option value="use_css"<?php if ( $style_output == "use_css" ) echo( ' selected="selected" ' ); ?>><?php _e( 'Yes' , 'last-modified-footer' ); ?></option>
				</select>
			</label>

			<input type="hidden" id="<?php echo $this->get_field_id( 'submit' ); ?>" name="<?php echo $this->get_field_name( 'submit' ); ?>" value="1" />
			<?php
		}
	}
}//End class lmf_widget

//Declare an instance of the plugin class
if ( class_exists( "lmf_plugin" ) ) {
	$lmf_instance = new lmf_plugin();
}

//This function registers the widget
if (!function_exists( "lmf_register_widget" ) ) {
	function lmf_register_widget() {
		register_widget( 'lmf_widget' );
	}
}

//This function generates the unformatted version of the text
if ( !function_exists( "lmf_generate_unformatted_output" ) ) {
	function lmf_generate_unformatted_output() {
		global $lmf_instance;
		if( !isset( $lmf_instance ) ) {
			return;
		}
		$lmf_instance->generate_output( 'no_styling' );
	}
}

//This function generates the formatted version of the text. The output is wrapped in '<p class="lmf_generated_text">' tags
if ( !function_exists( "lmf_generate_formatted_output" ) ) {
	function lmf_generate_formatted_output() {
		global $lmf_instance;
		if( !isset( $lmf_instance ) ) {
			return;
		}
		$lmf_instance->generate_output( 'use_css' );
	}
}

//Plugin actions and filters
if ( isset($lmf_instance ) ) {
	//Add hook to place the generated text in the site footer
	add_action( 'wp_footer', array( &$lmf_instance, 'generate_footer' ) );

	//Add hook to place CSS for the'p.lmf_generated_text' class in the site header
	add_action( 'wp_head', array( &$lmf_instance, 'insert_css' ) );

	//Add hook to add plugin menu to admin screen
	add_action( 'admin_menu', array( &$lmf_instance, 'register_admin_menu' ) );

	//Add hook to register the plugin settings
	add_action( 'admin_init', array( &$lmf_instance, 'register_settings' ) );

	//Add hook to load the plugin's text domain
	add_action( 'init', array( &$lmf_instance, 'load_l10n_domain' ) );

	//Add a hook to register the widget
	add_action( 'widgets_init' , 'lmf_register_widget' );
}

//Register the activation hook
if ( isset( $lmf_instance ) ) {
	register_activation_hook( __FILE__, array( &$lmf_instance, 'install_options' ) );
}
?>