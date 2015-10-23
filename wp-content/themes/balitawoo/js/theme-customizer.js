( function( $ ) {
	wp.customize( 'balitawoo_menu_hover_color', function ( value ) {
		var oldval = $( '.menu li a' ).css('background-color');
		value.bind( function( newval ) {
			$( '.menu li a' ).hover(
				function() {
					$(this).css('background-color', newval);
				},
				function() {
					$(this).css('background-color', oldval);
				}
			);
		});
		
	});

	wp.customize( 'balitawoo_menu_color', function ( value ) {
		value.bind( function( newval ) {
			$( '.menu li a' ).css('color', newval);
		});
	});

	wp.customize( 'balitawoo_menu_dropdown_color', function ( value ) {
		value.bind( function( newval ) {
			$( '.menu .sub-menu, .menu .sub-menu li a' ).css('background-color', newval);
		});
	});

	wp.customize( 'balitawoo_site_title_color', function ( value ) {
		value.bind( function( newval ) {
			$( '#logo' ).css('color', newval);
		});
	});

	wp.customize( 'balitawoo_heading_color', function ( value ) {
		value.bind( function( newval ) {
			$( 'head' ).append('<style>h1, h2, h3, h4, h5, h6 {color: '+newval+' !important; }</style>');
		});
	});

	wp.customize( 'balitawoo_global_link_color', function ( value ) {
		value.bind( function( newval ) {
			$( 'head' ).append('<style>a, a:visited {color: '+newval+' !important; }</style>');
		});
	});

	wp.customize( 'balitawoo_link_hover_color', function ( value ) {
		value.bind( function( newval ) {
			$( 'head' ).append('<style>a:hover {color: '+newval+' !important; }</style>');
		});
	});

	wp.customize( 'balitawoo_primary_color', function ( value ) {
		value.bind( function( newval ) {
			$('.prolog, .woocommerce-ordering .chzn-drop .chzn-results, .woocommerce-ordering .chzn-single').css('background-color', newval);
		});
	});

	wp.customize( 'balitawoo_secondary_color', function ( value ) {
		value.bind( function( newval ) {
			style = '.cartbox .widget, .woocommerce-cart .cart th, .woocommerce-ordering .chzn-drop .chzn-results li:hover{background-color: '+newval+'}';
			style += '.cartbox-top {background: url("img/ico_cart.png") no-repeat scroll 30px 16px '+newval+';}'
			$( 'head' ).append('<style>'+style+'</style>');
		});
	});

	wp.customize( 'balitawoo_tabs_background', function ( value ) {
		value.bind( function( newval ) {
			style = 'html ul.tabs li.active, html ul.tabs li.active a, html ul.tabs li.active a:hover { background-color: '+newval+'}';
			$( 'head' ).append('<style>'+style+'</style>');
		});
	});
	
	wp.customize( 'balitawoo_button_background', function ( value ) {
		value.bind( function( newval ) {
			$( '.sidebar .buttons .button, .sidebar .buttons .checkout, .produktxt button, .produktxt input[type=button], .cart button, .cart input[type=button], .button a, .woocommerce-cart .cart .actions input[type="submit"], .form-submit input[type="submit"], .form-submit #submit, button.button, .woocommerce-checkout .lost_password, .woocommerce-checkout .button, .woocommerce-account .lost_password, .woocommerce-account .button, #searchsubmit, .cartbox .widget .buttons .button, .cartbox .widget .buttons .checkout' ).css('background-color', newval);
		});
	});

	wp.customize( 'balitawoo_button_background_hover', function ( value ) {
		value.bind( function( newval ) {
			style = '.sidebar .buttons .button:hover, .sidebar .buttons .checkout:hover, .produktxt button:hover, .produktxt input[type=button]:hover, .cart button:hover, .cart input[type=button]:hover, .button a:hover, .woocommerce-cart .cart .actions input[type="submit"]:hover, .form-submit input[type="submit"]:hover, .form-submit #submit:hover, button.button:hover, .woocommerce-checkout .lost_password:hover, .woocommerce-checkout .button:hover, .woocommerce-account .lost_password:hover, .woocommerce-account .button:hover, #searchsubmit:hover, .cartbox .widget .buttons .button:hover, .cartbox .widget .buttons .checkout:hover {background-color: '+newval+'}';
			$('head').append('<style>'+style+'</style>');
		});
	});

	wp.customize( 'balitawoo_body_font', function ( value ) {
		value.bind( function( newval ) {
			$( 'body' ).css('font-family', newval);
		});
	});

	wp.customize( 'balitawoo_heading_font', function ( value ) {
		value.bind( function( newval ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css('font-family', newval);
		});
	});

	wp.customize( 'balitawoo_site_title_font', function ( value ) {
		value.bind( function( newval ) {
			$('head').append('<style>#logo a{font-family: '+newval+';}</style>');
		});
	});

	wp.customize( 'balitawoo_content_font', function ( value ) {
		value.bind( function( newval ) {
			$( '.feat p, p' ).css('font-family', newval);
		});
	});

	wp.customize( 'balitawoo_product_title_font', function ( value ) {
		value.bind( function( newval ) {
			$('head').append('<style>.produktxt h2, .item h4 {font-family: '+newval+' !important}</style>');
		});
	});

})( jQuery );