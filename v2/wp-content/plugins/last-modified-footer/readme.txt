=== Last Modified Footer ===
Contributors: thecuriousfrog
Donate link: http://thecuriousfrog.com/projects/
Tags: footer, last updated, last modified, site info
Requires at least: 2.8
Tested up to: 2.8.5
Stable tag: 1.1.0

This plugin generates customizable messages stating the last modification date and time for the whole site and the individual content (if appropriate)

== Description ==

The Last Modified Footer plugin generates a message stating the date / time the content being viewed was last modified. This information can be placed in the site footer, or elsewhere on the page

For homepage, archive pages (categories, tags and authors), search results and 404 error pages, something similar to the following text will be generated:

*Site last updated October 1, 2007*

For single posts, pages and attachments something similar to the following text will be generated:

*Site last updated October 1, 2007; This content last updated October 1, 2007*

The message templates, placement and styling as well as the format of the time and date can be modified via the Last Modified Footer administration panel ('Settings' > 'Last Modified Footer').

== Installation ==

1. Unzip the plugin archive
1. Upload the entire `last-modified-footer` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Goto the plugin admin panel to customize the messages that the plugin generates

NB: When the plugin is updated it will attempt to keep your previous configuration options and delete any stray options created by previous versions.

***To make sure that the update process works properly please do not deactivate the plugin prior to updating it*** - The WordPress plugin update functionality takes care of everything for you.

== Frequently Asked Questions ==

= Do I need to alter my site templates or theme =

No. As long as your template has one of the following lines of code in the footer.php file:

`<?php do_action('wp_footer'); ?>`
`<?php wp_footer(); ?>`

Then the plugin can use a built in WordPress hook to automatically insert the information into your website. This should work with 99% of themes based on normal WordPress rules.

Additionally, the included widget can be used to insert the information in a sidebar or there are two plugin functions available to generate the output anywhere that PHP can be executed:

`<?php lmf_generate_unformatted_output(); ?>`
`<?php lmf_generate_formatted_output(); ?>`

= Why Isn't XYZ Working =

If you are having problems then you can ask questions, leave comments or find more information at the plugin's homepage:
[Last Modified Footer](http://thecuriousfrog.com/projects/last-modified-footer/ "Last Modified Footer").

== Screenshots ==

1. The Last Modified Footer options panel (partial)

== Changelog ==

= 1.1.0 =
* Encapsulated plugin functionality in a class
* Consolidated plugin options into an array stored in a single option
* Removed duplicated code from plugin
* Cleaned up code to match [WordPress Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards/ "WordPress Coding Standards")
* Re-wrote admin panel code to use the new options mechanism introduced in WordPress 2.7
* Improved the translatability of messages by allowing manipulation of the position of non-translatable elements in messages
* Moved boolean options to named string options for better forward compatibility
* Added footer message to plugin admin panel stating the name of the plugin, the current version and the author's name
* Re-wrote plugin activation hook to attempt to pull in existing options from current and previous versions of the plugin as well as removing redundant options
* Added call to load the plugin l10n / i18n text domain
* Removed plugin deactivation code to stop configuration options being removed when plugin is deactivated
* Added uninstall script to ensure that configuration options are removed when plugin is deleted
* Encapsulated plugin widget functionality in a class based on the WP_Widget class introduced in WordPress 2.8
* Re-wrote widget code and admin panel to conform with the WP_Widget class requirements

= 1.0.2 =
* Made message templates completely customizable via the admin panel
* Tidied the admin panel up and added per-field contextual help (hidden by default)
* Fixed bug that to ensure that only published posts are used for the 'Site Last Modified' date [props: DavyB](http://thecuriousfrog.com/projects/last-modified-footer/#comment-1320 "props: DavyB")

= 1.0.1 =
* Add Widget to plugin, configurable through WordPress Widgets admin panel
* Updated plugin description to add links to the admin panel

= 1.0.0 =
* Output can be generated on demand with or without styling (use `lmf_generate_formatted_output()` & `lmf_generate_unformatted_output()`)
* Add plugin option to allow automatic placement of content in site footer to be disabled
* Updated admin panel to show styled and unstyled output preview and add controls for new options
* Added content to WP contextual help menu
* Changed version number to 1.0.0 to reflect first 'full functionality' version

= 0.0.2 =
* Text generated by the plugin is now styled using CSS
* Output preview in admin panel is now styled using CSS
* Text inserted between generated messages can now be customized from the admin panel
* Added new option to the admin panel to allow customization of the CSS used to style the output preview and generated text
* Added reference to date / time formatting in the admin panel
* Prepared plugin for internationalization

= 0.0.1 =
* Initial version of plugin based on Content Last Updated Footer plugin v1.0b by [WP CMS](http://wp-cms.com/our-wordpress-plugins/content-last-updated-footer-plugin/ "WP CMS").
* Admin menu code re-written using current recommendations from the WordPress Codex.
* Removed unnecessary sanitization of option text input (this is now performed automatically by WordPress).

== Uninstallation ==

* If you wish to stop using the plugin but keep your configuration options then simply use the 'Deactivate' link on the WordPress 'Manage Plugins' screen
* If you wish to completely uninstall the plugin then use the 'Deactivate' link followed by the 'Delete' link on the WordPress 'Manage Plugins' screen. This removes the plugin files and your configuration options

== Configuration ==

**Single Post / Page Template**
The message template for single posts / pages. This defaults to 'Site last updated `%site_last_modified%`; This content last updated `%content_last_modified%`'. The macros are replaced automatically by the plugin.

**Generic Template**
The message template for other pages. This defaults to 'Site last updated `%site_last_modified%`'. The macros are replaced automatically by the plugin.

**Time / Date Format**
The format to use when displaying the date and time. This defaults to the format used by the site, which is specified in the WordPress options.

**Text Formatting**
The CSS style definition to be applied to the generated string. This defaults to a light grey.

**Use "wp_footer" Hook**
The automatic placement of the message in the site footer can be toggled on / off. This defaults to on.

== Release Notes ==

* No known issues are present in this version