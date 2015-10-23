(function ()
{
	// create kooShortcodes plugin
	tinymce.create("tinymce.plugins.kooShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("kooPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Koo Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "koo_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('koo_button', {
                    title: "Insert Koo Shortcode",
					image: KooShortcodes.theme_folder +"/tinymce/images/tokokoo.png",
					icons: false
                });

                btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "Accordion", "accordion" );
					a.addWithPopup( b, "Alert", "alert" );
					a.addWithPopup( b, "Button", "button" );
					a.addWithPopup( b, "Box", "box" );
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Google Maps", "gmaps" );
					a.addWithPopup( b, "Highlight", "highlight" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Toggle", "toggle" );
					a.addWithPopup( b, "Tooltip", "tooltip" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "kooPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Koo Shortcodes',
				author: 'Satrya',
				authorurl: 'http://tokokoo.com/',
				infourl: 'http://tokokoo.com/',
				version: "0.2"
			}
		}
	});
	
	// add kooShortcodes plugin
	tinymce.PluginManager.add("kooShortcodes", tinymce.plugins.kooShortcodes);
})();