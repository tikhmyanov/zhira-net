(function ($) {
	"use strict";  
/* Google Map  */
function gMap () {
if ($('#map').length) {

				var mapMarkers = {
					"markers": [
						{
							"latitude": "52.2821013",
							"longitude":"104.2716353",
							"icon": "/wp-content/themes/zn/img/pin.png",
							"baloon_text": 'This is <strong>Texas</strong>'
						}
					]
				};

				$("#map").mapmarker({
					zoom : 16,
					center: "52.2821013, 104.2716353",
					dragging:1,
					mousewheel:0,
					markers: mapMarkers,
					featureType:"all",
					visibility: "on",
					elementType:"geometry"
					
				});
			
}
}
			
/* content carousel  */	
function fitnessCarosule () {
if ($('#reviewer').length) {		
  $("#reviewer").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 2,
      itemsDesktop : [1170,3],
      itemsDesktopSmall : [979,2]
 
  });
}
}
  
  
/* number counter effect */
function counT () {
if ($('.count').length) {	

$('.count').each(function() {
  $(this).prop('Counter', 0).animate({
    Counter: $(this).text()
  }, {
    duration: 4000,
    easing: 'swing',
    step: function(now) {
      $(this).text(Math.ceil(now));
    }
  });
});
}
}
/* Datepicker  */

function datePicker () {
if ($('#datepicker, #datepicker1').length) {	
    $( "#datepicker, #datepicker1" ).datepicker({minDate: 0});
  }
}
		 
 // wow activator
    function wowActivator () {
    	new WOW().init();
    }

//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.preloader').length){
			$('.preloader').delay(500).fadeOut(500);
		}
	}
// Contact Form
    function contactFormValidation () {
        $('#form').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Пожалуйста, введите имя",
                    minlength: "Не меньше 2 символов"
                },
                email: {
                    required: "Пожалуйста, введите email",
                    email: "Неккоректный адрес"
                },
                mobile: {
                    required: "Пожалуйста, введите номер телефона (10 цифр)",
                    minlength: "10"
                }

            },
            submitHandler: function(form, event) {
                event.preventDefault();
                var fd = new FormData($('#form').get(0));
                fd.append('action', 'zn_send_form');

                $.ajax({
                    url: "/wp-admin/admin-ajax.php",
                    method: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(out) {
                        //$('#form :input').attr('disabled', 'disabled');
                        //this.reset();
                        console.log(out);
                        $('#form').fadeTo( "slow", 1, function() {
                           // $(this).find(':input').attr('disabled', 'disabled');
                           // $(this).find('label').css('cursor','default');
                            this.reset();
                            $('#success').fadeIn();
                        });
                    },
                    error: function() {
                        $('#form').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn();
                        });
                    }
                });
            }
        });
    }

// Smooth scroll
    function SmoothScroll () {
      $('.scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
          scrollTop : $($anchor.attr('href')).offset().top + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
      });
    }

// Dom Ready Function
	$(document).on('ready', function () {
		// add your functions
		gMap();
		fitnessCarosule();
		counT();
		datePicker();
		wowActivator();
		contactFormValidation();
		handlePreloader();
        SmoothScroll();
	});
	// window on load functino
	$(window).on('load', function () {
		// add your functions
	});

})(jQuery);