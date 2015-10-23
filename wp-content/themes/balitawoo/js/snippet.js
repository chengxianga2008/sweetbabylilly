/*	+ File ini tidak langsung di load;
	+ File ini berisi kumpulan kode-kode jquery snippet yang siap pakai, gunakan seperlunya saja; sesuaikan dengan kebutuhan
*/

/*
	Notes;
		Next, jangan pernah gunakan event .toggle()
		Baca; http://api.jquery.com/category/deprecated/deprecated-1.8/
*/

/*
	Daftar Isi
		Basic
			Event
				.click()
				.hover()
				(this)

			Manipulation
				.AddClass()
				.toggleClass()
				.toggleClass()
				.remove

		Snippet
			Mengetahui lebar dan tinggi sebuah element
			Lompat ke element
			PlaceHolder Untuk Textarea
			Scroll element
			Menambahkan action pada lebar layar yang ditentukan
			Mengatur lebar elemen li navigation agar posisinya selalu pas

*/

// Basic
	//Event
		// .click()
			$("selectornya").click(function() {
				// Yang dilakukan jika di click
			});

		// .hover()
			$("selectornya").hover(function() {
				// Yang dilakukan jika mouse berada dia area object
			}, function() {
				// Yang dilakukan jika mouse keluar dari object
			});

	// manipulation
		// AddClass, toggleClass and removeClass
			//	addClass
			$("selectornya").addClass('nama-class');
			// fungsinya untuk menambahkan class pada element yang dipilih;

			//	removeClass
			$("selectornya").removeClass('nama-class');
			// fungsinya untuk menghapus class pada element yang dipilih;

			//	toggleClass
			$("selectornya").toggleClass('nama-class');
			// gabungan dari addClass dan removeClass; Digunakan dengan event

			// Prepend
			$( "selector" ).prepend( "Element/HTML" );
			// Memasukan/menambahkan content pada awalan data. Sumber http://api.jquery.com/prepend/

			// Append
			$( "selector" ).append( "Element/HTML" );
			// Memasukan/menambahkan content pada akhiran data. Sumber http://api.jquery.com/append/

			// removeAttr
			$( "selector" ).removeAttr( "attribute" );
			// Menghapus attribute pada element. Sumber http://api.jquery.com/removeAttr/

		// Entar ditambah

// Snippet
	// Mengetahui lebar dan tinggi sebuah element
		$("body *").click(function() {

			var eleWidth = $(this).width();// Variable untuk mengeta
			var eleHeight = $(this).height();

			$(this).append("<strong> width: " + eleWidth + "height" + eleHeight + "</strong>");

		});

	// Lompat ke element
		$("selectornya").click(function() {

			$('html, body').animate({ scrollTop: $('selector-target').offset().top }, 600);

		 });

	// PlaceHolder Untuk Textarea
		$("'[placeholder]'").parents("'form'").submit(function() {
			$(this).find("'[placeholder]'").each(function() {
				var input = $(this);
				if (input.val() == input.attr("'placeholder'")) {
					input.val("''");
				}
			})
		});

	// Scroll element
		$(window).scroll(function(){
			var ScreenHeight = document.documentElement.clientHeight; // Untuk mengetahui tinggi layar
			var scrollLenght = $(window).scrollTop();

			if( scrollLenght < 50 ){// Jika scrollTop lebih kecil dari 50
				// tulis code action disini
				// Misal
					$("selectornya").addClass('nama-class');
			};

			if( scrollLenght > 50 ){// Jika scrollTop lebih besar dari 50
				// tulis code action disini
				// Misal
					$("selectornya").addClass('nama-class');
			};
		});

	// Menambahkan action pada lebar layar yang ditentukan
		if (document.documentElement.clientWidth < 870) {// Jika lebar layar lebih kecil dari 870
			
			// Action disini

		};

	// Mengatur lebar elemen li navigation agar posisinya selalu pas
		// menghitung lebar element nav yang idnya #nav
		var navWrapWidt = $("#site-navigation").width();

		// Menghitung jumlah li pertama di dalam #site-navigation
		var totalLi = $("#site-navigation div ul#menu-primary > li").length;

		// menentukan lebar li dalam px, hasil dari navWrapWidt dibagi jumlah li
		var liwidth = navWrapWidt / totalLi;

		// menentukan lebar li dalam percent, hasil dari navWrapWidt dibagi jumlah li
		var liwidthPercent = 100 / totalLi;

		// memilih elemen li didalam nav, lalu menambahkan css "width" dengan nilai "liwidth" dan "max-width" dangan nilai liwidthPercent
		$("#site-navigation div ul#menu-primary > li").css({
			"width" : liwidth,
			"max-width" : liwidthPercent + "%"
		});

	//

	// Drop-down menu 
		$( "#menu li" ).has( "ul" ).addClass( "parent" ); // Deteksi children, bila ada children menu tambahkan class `parent` pada parent menu

		// Efek slide untuk Drop-down
			$( "#menu li" ).hover(function(){
		        $(this).addClass( "hover" );
		        $(this).find( "ul:first" ).slideToggle( "medium" );
		    }, function(){
		        $(this).removeClass( "hover" );
		        $(this).find( "ul:first" ).slideUp( "medium" );
		    });

	// Deteksi class
	if( $( "selector" ).hasClass( "class" ) ) { 
    	// action ketika class terdeteksi
    };
    // Deteksi Ipad
    var isiPad = navigator.userAgent.match(/iPad/i) != null;
    
    if(isiPad){

       // alert("just Ipad");

    }