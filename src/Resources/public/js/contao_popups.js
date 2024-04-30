(function($) {
		
	// Function to initialize our Contao Popup
	$.fn.contaoPopup = function() {
		
		// Create a cookie to track lifetime of the Contao Popup
		var createCookie = function(name,value,days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
			}
			else var expires = "";
			document.cookie = name+"="+value+expires+"; path=/";
		}
		
		// Read the cookie we created to track the lifetime
		var readCookie = function (name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}
		
		// Modify our popups then return the updated version to the page
		return this.each(function() {
		    
		    // if $(this) is our popup's parent wrapper
			if ($(this).is('.popup_frame')) {
			    
			    // Hide by default
				$(this).css('display', 'none');
				
				// Locally save variables for manipulation
				var popup = $(this);
				var puid = $(this).attr('puid');
				var popup_delay = $(this).attr('pdelay');					// Milliseconds
				var reshow_delay = parseInt($(this).attr('rdelay'));		// Minutes
				var scroll_trigger = parseInt($(this).attr('strigger'));	// Pixels
				var fade_duration = parseInt($(this).attr('fduration'));	// Milliseconds
				var popup_trigger = $(this).attr('ptrigger');				// CSS Selector
				
                // Create some bools
				var popup_timer = false;
				var scroll_start = false;
				var scroll_trip = false;
				var showPopup = true;
				
				// If there is no delay added in the settings page, set a default so we have at least some value here
				if (popup_delay == '') {
					popup_delay = -1;
				} else {
				    // If there is a delay set, parse as an int and apply it
					popup_delay = parseInt(popup_delay);
				}
				
				// Function to activate the popup
				var activatePopup = function () {

                    // Reset the timeout, as we are just starting out
					clearTimeout(popup_timer);
					var timeNow = Math.floor(Date.now() / 1000);
					
					// If there is a "Reshow Delay" set
					if (reshow_delay) {
						var lastShown = parseInt(readCookie(puid + "_showTime"));
						var threshold = (parseInt(lastShown) + (reshow_delay * 60));
						if (threshold > timeNow) {
							showPopup = false;
						}
					}
					
					// If we need to show the popup	
					if (showPopup) {
					    // Set to false, we only want to do this once
						showPopup = false;
						
						// If we have a "Fade Duration" set
						if (fade_duration > 0) {
							popup.css({"opacity": "0", "display": "initial"}).fadeTo(fade_duration, 1).removeClass('popup_closed').addClass('popup_open');
						} else {
							popup.css("display", "block").removeClass('popup_closed').addClass('popup_open');
						}
						
						// Create our cookie to track the showtime of the popup
						createCookie(puid + "_showTime", timeNow, (Math.floor(reshow_delay / 1440) + 1));
						
						// Setup a click event on the body, which will close the popup when clicking outside of it
						$("body").on('click', function(e) {
							var close_popup = true;
							if ($(e.target).is(popup_trigger)) {
								close_popup = false;
							} else {
								$(e.target).parents().each(function() { 
									if ($(this).hasClass('popup_frame')) {
										close_popup = false;
									}
									if ($(this).is(popup_trigger)) {
										close_popup = false;
									}
								});
							}
							
							// If we need to close the popup
							if (close_popup) {
								popup.css("display", "none").removeClass('popup_open').addClass('popup_closed');
								showPopup = true;
							}
						});
						
						// Setup a click event for the close button
						popup.find(".close").click(function(el){
							el.preventDefault();
							popup.css("display", "none").removeClass('popup_open').addClass('popup_closed');
							showPopup = true;
						})
						
						// Zyppy Search: clear the results
						popup.find('div.mod_zyppy_search div.results.popup_clear').empty();
					}
				};
			
			    // If we have a "Scroll Trigger" set, which will show the popup when scrolling X pixels down
				if (scroll_trigger) {
					scroll_start = $(window).scrollTop();
					scroll_trip = scroll_start + scroll_trigger;
					$(window).scroll(function() {
						if ($(window).scrollTop() > scroll_trip) {
							activatePopup();
						}
					});
				}
				
				// If we have a "Popup Trigger" set, a css selector that when clicked will trigger the popup
				if (popup_trigger) {
					$(popup_trigger).click(function() {
						activatePopup();
					});
				}
				
				// If we have a "Popup Delay" set
				if (popup_delay > 0) {
					popup_timer = setTimeout(activatePopup, popup_delay);
				} else if (popup_delay == 0) {
					activatePopup();
				}
				
				// Cleaning up after init
				$(this).removeClass('pre_init').addClass('post_init');
			}
		});
	};		
		
    // When the page is fullyl loaded
	$(document).ready(function() {
	    // Let's kick this whole thing off
		$('.popup_frame.pre_init').contaoPopup();
	});
})(jQuery);
