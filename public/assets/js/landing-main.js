

$(function () {
  "use strict";

  // Active menu
  $(function() {
		for (var e = window.location, o = $(".navbar-nav .dropdown-item").filter(function() {
				return this.href == e
			}).addClass("active").parent().addClass("active"); o.is("li");) o = o.parent("").addClass("").parent("").addClass("")
	}),

  
  // back to top //
  $(document).ready(function() {
    $(window).on("scroll", function() {
      $(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
    }), $(".back-to-top").on("click", function() {
      return $("html, body").animate({
        scrollTop: 0
      }, 600), !1
    })
  }),



  /* switcher */
$(function () {
  // load theme saat halaman pertama kali dibuka
  const savedTheme = localStorage.getItem("selectedTheme") || "blue-theme";
  $("html").attr("data-bs-theme", savedTheme);
  $("#" + themeId(savedTheme)).prop("checked", true);

  // handler untuk setiap switcher
  $("#BlueTheme").on("click", function () {
    $("html").attr("data-bs-theme", "blue-theme");
    localStorage.setItem("selectedTheme", "blue-theme");
  });

  $("#LightTheme").on("click", function () {
    $("html").attr("data-bs-theme", "light");
    localStorage.setItem("selectedTheme", "light");
  });

  $("#DarkTheme").on("click", function () {
    $("html").attr("data-bs-theme", "dark");
    localStorage.setItem("selectedTheme", "dark");
  });

  $("#SemiDarkTheme").on("click", function () {
    $("html").attr("data-bs-theme", "semi-dark");
    localStorage.setItem("selectedTheme", "semi-dark");
  });

  $("#BoderedTheme").on("click", function () {
    $("html").attr("data-bs-theme", "bodered-theme");
    localStorage.setItem("selectedTheme", "bodered-theme");
  });

  function themeId(theme) {
    switch (theme) {
      case "blue-theme": return "BlueTheme";
      case "light": return "LightTheme";
      case "dark": return "DarkTheme";
      case "semi-dark": return "SemiDarkTheme";
      case "bodered-theme": return "BoderedTheme";
      default: return "BlueTheme";
    }
  }
});




  
// dropdown slide

  $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
		if (!$(this).next().hasClass('show')) {
		  $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
		}
		var $subMenu = $(this).next(".dropdown-menu");
		$subMenu.toggleClass('show');
	  
	  
		$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		  $('.submenu .show').removeClass("show");
		});
	  
	  
		return false;
	  });




});










