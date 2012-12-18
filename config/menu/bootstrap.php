<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Example config for Twitter Bootstrap main navbar menu
 *
 * @author Ando Roots <ando@sqroot.eu>
 */
return array(
	'view'             => 'templates/menu/bootstrap/navbar', // The view file for the menu
	'current_class'    => 'active', // The CSS class used to mark the active menu item
	'auto_mark_current'=> FALSE, // Set to TRUE to enable active menu item guessing based on the initial request URI

	/**
	 * A list of menu items. All params are optional.
	 * Params:
	 *     url string The URL for the link, default #
	 *     title string The displayed text string, suggested: use I18n __ function
	 *     icon string Icon for the menu item, displayed as <i class="VALUE"></i>
	 *     tooltip string The tooltip text for the link
	 */
	'items'            => array(
		 array(
			'url'     => 'issues',
			'title'   => __('nav.issues'),
			'icon'    => 'icon-tasks',
			'tooltip' => __('nav.tooltip.issues')
		),
		array(
			'url'     => 'users',
			'title'   => __('nav.persons'),
			'icon'    => 'icon-user',
			'tooltip' => __('nav.tooltip.persons')
		),
		array(
			'url'     => 'projects',
			'icon'    => 'icon-folder-close',
			'title'   => __('nav.projects'),
			'tooltip' => __('nav.tooltip.projects')
		),
		array(
			'url'     => 'reports',
			'title'   => __('nav.reports'),
			'icon'    => 'icon-list-ol',
			'tooltip' => __('nav.reports.tooltip'),

			'items'   => array(
				array(
					'url'    => 'logs',
					'icon'   => 'icon-align-justify',
					'title'  => __('nav.reports.logs'),
					'tooltip'=> __('nav.reports.tooltip.logs')
				),
				array(
					'icon'   => 'icon-amazon',
					'title'  => __('nav.reports.bills'),
					'tooltip'=> __('nav.reports.tooltip.bills')
				)
			)
		),
	),
);