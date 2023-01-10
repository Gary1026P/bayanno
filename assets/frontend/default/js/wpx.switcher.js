$(document).ready(function(){

	// GLOBAL VARIABLES
	var filename = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
	var fileExtension = filename.substr( (filename.lastIndexOf('.') + 0) );

	filename = filename.replace(fileExtension, "");

	// STYLE SWITCHER
	$("#cmdShowStyleSwitcher").click(function(){
		if($("#divStyleSwitcher").hasClass("opened")){
			$("body").removeClass("style-switcher-in");
			$("#divStyleSwitcher").removeClass("opened");
		}
		else{
			$("body").addClass("style-switcher-in");
			$("#divStyleSwitcher").addClass("opened");
		}
		return false;
	});


	// Theme color
	$("#themeColor a").click(function(){
		var $this = $(this);
		var value = $(this).data("value");
		var type = $(this).data("type");

		$("#stylesheet").attr("href", "../../assets/css/global-style-" + value + ".css");

		$this.removeClass("active");
		$this.addClass("active");

		Cookies.set('theme_color', value);

		return false;
	});

	// Cookie reading
	var themeColor = Cookies.get('theme_color');

	// Add active class to selected value button
	$("#themeColor").find('a[data-value="'+ themeColor +'"]').addClass("active");

	// Set option from cookie
	if(themeColor != undefined){
		$("#stylesheet").attr("href", "../../assets/css/global-style-" + themeColor + ".css");
	}

	// Theme color
	$("#themeSkin").change(function(){

		var $this = $(this);
		var value = $(this).val();

		if(filename != 'index') {
			$("#stylesheet").attr("href", "../../assets/css/global-style-" + value + ".css");

			if(value == 'dark') {
				
			}
		}

		Cookies.set('theme_skin', value);
	});

	// Cookie reading
	var themeSkin = Cookies.get('theme_skin');

	// Set option from cookie
	if(themeSkin != undefined && filename != 'index' ){
		$('#themeSkin option[value='+themeSkin+']').prop("selected", true);
		$("#stylesheet").attr("href", "../../assets/css/global-style-" + themeSkin + ".css");
	}

	// LAYOUT STYLE
	$("#layout_type input").change(function(){
		if($(this).data("value") == "boxed"){
			$(".body-wrap").addClass("body-boxed");
			Cookies.set('layout', 'boxed');
		}
		else if($(this).data("value") == "fluid" && filename != "page-boxed"){
			$(".body-wrap").removeClass("body-boxed");
			Cookies.set('layout', 'fluid');
		}
	});

	// Cookie reading
	var layoutStyle = Cookies.get('layout');

	// Add active class to selected value button
	$("#layout_type").find('input[data-value="'+ layoutStyle +'"]').prop("checked", true);

	// Set option from cookie
	if(layoutStyle == "boxed"){
		$(".body-wrap").addClass("body-boxed");
	}
	else if(layoutStyle == "fluid" && filename != "page-boxed"){
		$(".body-wrap").removeClass("body-boxed");
	}

	// // BODY BACKGROUND
	$("#body_background a").click(function(){
		// Trigger click for boxed layout type
		$("#layout_type input[data-value='boxed']").trigger("click");

		var value = $(this).data("value");

		$("body").removeClass("body-bg-1 body-bg-2 body-bg-3 body-bg-4 body-bg-5 body-bg-6 body-bg-7 body-bg-8 body-bg-9");
		$("body").addClass(value);
		$("#bodyBackground a").removeClass("active");
		$(this).addClass("active");

		Cookies.set('body_background', value);

		return false;
	});

	// Cookie reading
	var bodyBackground = Cookies.get('body_background');

	// Add active class to selected value button
	$("#body_background").find('a[data-value="'+ bodyBackground +'"]').addClass("active");

	// Set option from cookie
	$("body").addClass(bodyBackground);

	// NAVBAR DROPDOWN
	$("#navbar_dropdown input").change(function(){
		if($(this).data("value") == "default"){
			$(".navbar").removeClass("navbar-dropdown--inverse");
			Cookies.set('navbar_dropdown', 'default');
		}
		else if($(this).data("value") == "inverse"){
			$(".navbar").addClass("navbar-dropdown--inverse");
			Cookies.set('navbar_dropdown', 'inverse');
		}
	});

	// Cookie reading
	var navbarDropdown = Cookies.get('navbar_dropdown');

	// Add active class to selected value button
	$("#navbar_dropdown").find('input[data-value="'+ navbarDropdown +'"]').prop("checked", true);

	// Set option from cookie
	if(navbarDropdown == "default"){
		$(".navbar").removeClass("navbar-dropdown--inverse");
	}
	else if(navbarDropdown == "inverse"){
		$(".navbar").addClass("navbar-dropdown--inverse");
	}

	// NAVBAR DROPDOWN ARROW
	$("#navbar_dropdown_arrow input").change(function(){
		if($(this).data("value") == "no_arrow"){
			$(".navbar").removeClass("navbar-dropdown--arrow");
			Cookies.set('navbar_dropdown_arrow', 'no_arrow');
		}
		else if($(this).data("value") == "with_arrow"){
			$(".navbar").addClass("navbar-dropdown--arrow");
			Cookies.set('navbar_dropdown_arrow', 'with_arrow');
		}
	});

	// Cookie reading
	var navbarDropdownArrow = Cookies.get('navbar_dropdown_arrow');

	// Add active class to selected value button
	$("#navbar_dropdown_arrow").find('input[data-value="'+ navbarDropdownArrow +'"]').prop("checked", true);

	// Set option from cookie
	if(navbarDropdownArrow == "no_arrow"){
		$(".navbar").removeClass("navbar-dropdown--arrow");
	}
	else if(navbarDropdownArrow == "with_arrow"){
		$(".navbar").addClass("navbar-dropdown--arrow");
	}


	// SECTION TITLES
	$("#section_title input").change(function(){
		if(filename != 'elements-section-titles') {
			if($(this).data("value") == "style_1"){
				$(".section-title").removeClass("section-title--style-1 section-title--style-2");
				$(".section-title").find('.section-title-delimiter').addClass('hidden-xs-up');
				$(".section-title").addClass("section-title--style-1");

				Cookies.set('section_title', 'style_1');
			}
			else if($(this).data("value") == "style_2"){
				$(".section-title").removeClass("section-title--style-1 section-title--style-2");
				$(".section-title").find('.section-title-delimiter').addClass('hidden-xs-up');
				$(".section-title").addClass("section-title--style-2");

				Cookies.set('section_title', 'style_2');

			}
			else if($(this).data("value") == "style_3"){
				$(".section-title").removeClass("section-title--style-1 section-title--style-2");
				$(".section-title").addClass("section-title--style-1");
				$(".section-title").find('.section-title-delimiter').removeClass('hidden-xs-up');

				Cookies.set('section_title', 'style_3');
			}
		}
	});



	// Cookie reading
	var sectionTitle = Cookies.get('section_title');

	if(filename != 'elements-section-titles') {
		// Add active class to selected value button
		$("#section_title").find('input[data-value="'+ sectionTitle +'"]').prop("checked", true);

		// if(filename.substring(0, 15) != 'homepage-busine') {
		// 	$("#section_title").find('input[data-value="style_2"]').prop("disabled", true);
		// }

		// Set option from cookie
		if(sectionTitle == "style_1"){
			$(".section-title").removeClass("section-title--style-1 section-title--style-2");
			$(".section-title").find('.section-title-delimiter').addClass('hidden-xs-up');
			$(".section-title").addClass("section-title--style-1");
		}
		else if(sectionTitle == "style_2"){
			$(".section-title").removeClass("section-title--style-1 section-title--style-2");
			$(".section-title").find('.section-title-delimiter').addClass('hidden-xs-up');
			$(".section-title").addClass("section-title--style-2");
		}
		else if(sectionTitle == "style_3"){
			$(".section-title").removeClass("section-title--style-1 section-title--style-2");
			$(".section-title").addClass("section-title--style-1");
			$(".section-title").find('.section-title-delimiter').removeClass('hidden-xs-up');
		}
	} else {
		$("#section_title input").prop("disabled", true);
	}

	$("#btnResetStyles").click(function(){
		Cookies.remove('theme_color');
		Cookies.remove('theme_skin');
		Cookies.remove('layout');
		Cookies.remove('navbar_dropdown');
		Cookies.remove('navbar_dropdown_arrow');
		Cookies.remove('section_title');

		location.reload();

		return false();
	});
});
