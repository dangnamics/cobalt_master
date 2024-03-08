/* ========================================================================
* 
* OFFCANVAS.JS
*
* Author: Nick Downs
=========================================================================*/

$(document).ready(function(){
		
		var menutoggle = "[data-toggle=collapse]";
		var offcanvasmenu = ".navbar-collapse";

		FastClick.attach(document.body); // Initiate Fast Click JS. Eliminates 300ms delay on touch devices -- Should this be part of _main.js or fastclick.js?

		$(offcanvasmenu).removeClass("collapse"); // Override Bootstrap Default Funcitonality and display collapsed navigation

		// Click anywhere to close, except the menu.
		$(document).click(function(e) {
			if ( $(e.target).closest(offcanvasmenu).length === 0 ) {
				$("body").removeClass("offcanvas-open");
			}
		});
		
		// Swipe left on the menu to close.
		$(offcanvasmenu).on("swipeleft", function(e) {
			$("body").removeClass("offcanvas-open");	
		});

		// Click menu toggle to close and override default Bootstrap collapse function
		$(menutoggle).click(
			function(e) {
				e.stopImmediatePropagation(); // Override default Bootstrap collapse function
				$("body").toggleClass("offcanvas-open");
			}
		);

		// Disable scrolling on touch devices, except for menu.
		$(document).on('touchmove', function(e) {
			if ( ($(e.target).closest(offcanvasmenu).length === 0 ) && ($("body").hasClass("offcanvas-open")) ) {
				e.preventDefault();
				console.log('click main');
			} else  {
				//console.log('click nav');	
			}
		});
});
