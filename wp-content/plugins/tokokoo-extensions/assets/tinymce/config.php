<?php
/**
 * Shortcodes Configuration
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/**
 * Accordion shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['accordion'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[koo-accordion]{{child_shortcode}}[/koo-accordion]',
    'popup_title' => __( 'Accordion shortcode', 'tokokoo' ),
    
    'child_shortcode' => array(
        'shortcode' => '[koo-accordion-content title="{{title}}"]{{content}}[/koo-accordion-content]',
        'clone_button' => __( 'Add more accordion', 'tokokoo' ),
        'params' => array(
            'title' => array(
                'std' => '',
                'type' => 'text',
                'label' => __( 'Accordion title', 'tokokoo' ),
                'desc' => '',
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __( 'Accordion content', 'tokokoo' ),
                'desc' => __( 'Insert the accordion content.', 'tokokoo' )
            )
        )
    )

);

/**
 * Alert shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['alert'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-alert style="{{style}}"]{{content}}[/koo-alert]',
	'popup_title' => __( 'Alert shortcode', 'tokokoo' ),
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __( 'Color', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'white' => __( 'White', 'tokokoo' ),
				'grey' => __( 'Grey', 'tokokoo' ),
				'red' => __( 'Red', 'tokokoo' ),
				'yellow' => __( 'Yellow', 'tokokoo' ),
				'green' => __( 'Green', 'tokokoo' ),
				'blue' => __( 'Blue', 'tokokoo' )
			)
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Alert Text', 'tokokoo' ),
			'desc' => __( 'Insert the alert text.', 'tokokoo' ),
		)
	)
);

/**
 * Button shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['button'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-button url="{{url}}" style="{{style}}" size="{{size}}" type="{{type}}" target="{{target}}"]{{content}}[/koo-button]',
	'popup_title' => __( 'Button Shortcode', 'tokokoo' ),
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Text', 'tokokoo' ),
			'desc' => '',
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Url', 'tokokoo' ),
			'desc' => __( 'Insert url to the button. eg: http://example.com.', 'tokokoo' )
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Color', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'white' => __( 'White', 'tokokoo' ),
				'blue' => __( 'Blue', 'tokokoo' ),
				'black' => __( 'Black', 'tokokoo' ),
				'green' => __( 'Green', 'tokokoo' ),
				'light-blue' => __( 'Light Blue', 'tokokoo' ),
				'pink' => __( 'Pink', 'tokokoo' ),
				'red' => __( 'Red', 'tokokoo' ),
				'orange' => __( 'Orange', 'tokokoo' ),
				'purple' => __( 'Purple', 'tokokoo' ),
				'grey' => __( 'Grey', 'tokokoo' )
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'small' => __( 'Small', 'tokokoo' ),
				'medium' => __( 'Medium', 'tokokoo' ),
				'large' => __( 'Large', 'tokokoo' )
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'square' => __( 'Square', 'tokokoo' ),
				'round' => __( 'Round', 'tokokoo' )
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Target', 'tokokoo' ),
			'desc' => __( '_self = open in same window. _blank = open in new window.', 'tokokoo' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		)
	)
);

/**
 * Box shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['box'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-box style="{{style}}" title="{{title}}"]{{content}}[/koo-box]',
	'popup_title' => __( 'Box Shortcode', 'tokokoo' ),
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'tokokoo' ),
			'desc' => '',
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Box content', 'tokokoo' ),
			'desc' => '',
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Color', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'white' => __( 'White', 'tokokoo' ),
				'black' => __( 'Black', 'tokokoo' ),
				'grey' => __( 'Grey', 'tokokoo' ),
				'red' => __( 'Red', 'tokokoo' ),
				'yellow' => __( 'Yellow', 'tokokoo' ),
				'green' => __( 'Green', 'tokokoo' ),
				'blue' => __( 'Blue', 'tokokoo' ),
				'orange' => __( 'Orange', 'tokokoo' )
			)
		)
	)
);

/**
 * Columns shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['columns'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '{{child_shortcode}}',
	'popup_title' => __( 'Columns shortcode', 'tokokoo' ),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'shortcode' => '[{{column}}]{{content}}[/{{column}}] ',
		'clone_button' => __( 'Add more column', 'tokokoo' ),
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __( 'Column type', 'tokokoo' ),
				'desc' => __( 'Select the width of the column.', 'tokokoo' ),
				'options' => array(
					'koo-one-half' => __( 'One Half', 'tokokoo' ),
					'koo-one-half-last' => __( 'One Half Last', 'tokokoo' ),
					'koo-one-third' => __( 'One Third', 'tokokoo' ),
					'koo-one-third-last' => __( 'One Third Last', 'tokokoo' ),
					'koo-one-fourth' => __( 'One Fourth', 'tokokoo' ),
					'koo-one-fourth-last' => __( 'One Fourth Last', 'tokokoo' ),
					'koo-one-fifth' => __( 'One Fifth', 'tokokoo' ),
					'koo-one-fifth-last' => __( 'One Fifth Last', 'tokokoo' ),
					'koo-one-sixth' => __( 'One Sixth', 'tokokoo' ),
					'koo-one-sixth-last' => __( 'One Sixth Last', 'tokokoo' ),
					'koo-two-third' => __( 'Two Thirds', 'tokokoo' ),
					'koo-two-third-last' => __( 'Two Thirds Last', 'tokokoo' ),
					'koo-two-fifth' => __( 'Two Fifth', 'tokokoo' ),
					'koo-two-fifth-last' => __( 'Two Fifth Last', 'tokokoo' ),
					'koo-three-fourth' => __( 'Three Fourth', 'tokokoo' ),
					'koo-three-fourth-last' => __( 'Three Fourth Last', 'tokokoo' ),
					'koo-three-fifth' => __( 'Three Fifth', 'tokokoo' ),
					'koo-three-fifth-last' => __( 'Three Fifth Last', 'tokokoo' ),
					'koo-four-fifth' => __( 'Four Fifth', 'tokokoo' ),
					'koo-four-fifth-last' => __( 'Four Fifth Last', 'tokokoo' ),
					'koo-five-sixth' => __( 'Five Sixth', 'tokokoo' ),
					'koo-five-sixth-last' => __( 'Five Sixth Last', 'tokokoo' )
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Column content', 'tokokoo' ),
				'desc' => __( 'Insert the column content.', 'tokokoo' ),
			)
		)
	)
);

/**
 * Highlight shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['gmaps'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-gmaps country="{{country}}" state="{{state}}" city="{{city}}" street="{{street}}" zip="{{zip}}" type="{{type}}" width="{{width}}" height="{{height}}"]',
	'popup_title' => __( 'Google Maps shortcode', 'tokokoo' ),
	'params' => array(
		'country' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Country', 'tokokoo' ),
			'desc' => '',
		),
		'state' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'State', 'tokokoo' ),
			'desc' => '',
		),
		'city' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'City', 'tokokoo' ),
			'desc' => '',
		),
		'street' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Street', 'tokokoo' ),
			'desc' => '',
		),
		'zip' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Zip', 'tokokoo' ),
			'desc' => '',
		),
		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'dynamic' => __( 'Dynamic', 'tokokoo' ),
				'static' => __( 'Static', 'tokokoo' )
			)
		),
		'width' => array(
			'std' => 300,
			'type' => 'text',
			'label' => __( 'Width', 'tokokoo' ),
			'desc' => __( 'In pixel (px)', 'tokokoo' ),
		),
		'height' => array(
			'std' => 250,
			'type' => 'text',
			'label' => __( 'Height', 'tokokoo' ),
			'desc' => __( 'In pixel (px)', 'tokokoo' ),
		)
	)
);

/**
 * Highlight shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['highlight'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-highlight style="{{style}}"]{{content}}[/koo-highlight]',
	'popup_title' => __( 'Highlight shortcode', 'tokokoo' ),
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Highlight\'s text', 'tokokoo' ),
			'desc' => '',
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Color', 'tokokoo' ),
			'desc' => '',
			'options' => array(
				'yellow' => __( 'Yellow', 'tokokoo' ),
				'blue' => __( 'Blue', 'tokokoo' ),
				'red' => __( 'Red', 'tokokoo' ),
				'green' => __( 'Green', 'tokokoo' )
			)
		)
	)
);

/**
 * Tabs shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[koo-tabs]{{child_shortcode}}[/koo-tabs]',
    'popup_title' => __( 'Tabs shortcode', 'tokokoo' ),
    
    'child_shortcode' => array(
        'shortcode' => '[koo-tab title="{{title}}"]{{content}}[/koo-tab]',
        'clone_button' => __( 'Add more tab', 'tokokoo' ),
        'params' => array(
            'title' => array(
                'std' => '',
                'type' => 'text',
                'label' => __( 'Tab title', 'tokokoo' ),
                'desc' => '',
            ),
            'content' => array(
                'std' => '',
                'type' => 'textarea',
                'label' => __( 'Tab content', 'tokokoo' ),
                'desc' => ''
            )
        )
    )
);

/**
 * Toggle shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['toggle'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-toggle title="{{title}}" state="{{state}}"]{{content}}[/koo-toggle]',
	'popup_title' => __( 'Toggle Shortcode', 'tokokoo' ),
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Toggle title', 'tokokoo' ),
			'desc' => '',
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Toggle content', 'tokokoo' ),
			'desc' => '',
		),
		'state' => array(
			'type' => 'select',
			'label' => __( 'Toggle state', 'tokokoo'),
			'desc' => __( 'Select the state of the toggle on page load.', 'tokokoo' ),
			'options' => array(
				'open' => __( 'Open', 'tokokoo' ),
				'closed' => __( 'Closed', 'tokokoo' )
			)
		)
	),
);

/**
 * Tooltip shortcode configuration
 *
 * @since 1.0
 */
$koo_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'shortcode' => '[koo-tooltip title="{{title}}" placement="{{placement}}" url="{{url}}"]{{content}}[/koo-tooltip]',
	'popup_title' => __( 'Tooltip shortcode', 'tokokoo' ),
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tooltip title', 'tokokoo' ),
			'desc' => __( 'Specify content text of the tooltip.', 'tokokoo' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Tooltip help text', 'tokokoo' ),
			'desc' => __( 'Specify content text inside the tooltip.', 'tokokoo' ),
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Tooltip placement', 'tokokoo' ),
			'desc' => __( 'Location of the tooltip.', 'tokokoo' ),
			'options' => array(
				'top' => __( 'Top', 'tokokoo' ),
				'bottom' => __( 'Bottom', 'tokokoo' ),
				'left' => __( 'Left', 'tokokoo' ),
				'right' => __( 'Right', 'tokokoo' ),
			)
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'URL', 'tokokoo' ),
			'desc' => __( 'If you want a hyperlink tooltip please insert the url in the box above.', 'tokokoo' ),
		),
	)
);
?>